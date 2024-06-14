<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Http\Requests\Post\DeletePostRequest;
use App\Http\Requests\Post\GetPostsRequest;
use App\Http\Requests\Post\StatePostRequest;
use App\Http\Requests\Post\StorePostRequest;
use App\Models\Award;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Hashash\ProjectService\Helpers\FileClass;
use Hashash\ProjectService\Helpers\ResponseHelper;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(private Post $posts, private FileClass $fileClass)
    {
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $user = $request->user();
        $data[Post::userId] = $user->id;

        $tag = (new Tag())->findData(['id' => $data[Post::tagId]]);
        if ($tag[Tag::isAdmin] && $user[User::userType] == UserType::user) {
            return ResponseHelper::invalidData();
        }

        $awardUsers = [];
        if ($data[Post::tagId] == 1 && $request->has('award_users')) {
            $awardUsers = $data['award_users'];
            if (collect($awardUsers)->contains($user->id)) {
                return ResponseHelper::invalidData();
            }
            unset($data['award_users']);
        }

        if ($data[Post::tagId] != 1) {
            if ($request->has('award_users'))
                unset($data['award_users']);
            if ($request->has(Post::awardId))
                unset($data[Post::awardId]);
        }

        $images = [];
        if ($request->has('images')) {
            $files = $request->file('images');
            unset($data['images']);
            for ($i = 0; $i < count($files); $i++) {
                $fileUri = $this->fileClass
                    ->uploadFile(
                        $files[$i],
                        time() . $i . '.' . $files[$i]->extension(),
                        'images/posts/'
                    );
                $images[$i]['image'] = $fileUri;
            }
        }


        if ($user->user_type == UserType::admin) {
            $data[Post::isAccepted] = true;
        }


        $createPost = $this->posts->createData($data);

        $createPost->images()->createMany($images);

        foreach ($awardUsers as $userId) {
            if ($createPost->is_accepted)
                $this->transactionWallet($userId, $createPost->award_id);
            $createPost->awardUsers()->attach($userId, ['award_id' => $createPost->award_id]);
        }


        return ResponseHelper::create($createPost->load(['images', 'tag', 'award', 'user', 'awardUsers']));
    }

    private function transactionWallet($userId, $awardId)
    {
        $award = Award::where(['id' => $awardId])->first();
        $user = User::where(['id' => $userId])->first();
        $user->wallet += $award->value;
        $user->save();
    }

    public function acceptPost(StatePostRequest $request)
    {
        $data = $request->validated();
        $id = $data['id'];
        $post = $this->posts->findData(['id' => $id], relations: ['awardUsers']);
        if ($post->is_accepted) {
            return ResponseHelper::operationFail('already have accepted');
        }
        if ($post->award_id != null)
            foreach ($post->awardUsers as $user) {
                $this->transactionWallet($user->id, $post->award_id);
            }

        $post->is_accepted = true;
        $post->save();
        return ResponseHelper::update('Accepted successfully');
    }

    public function getPosts(GetPostsRequest $request)
    {
        $user = $request->user();
        $data = $request->validated();
        $data[Post::isAccepted] = true;
        $posts = $this->posts->getData(limit: 10, isPaginate: true, filter: $data);
        foreach ($posts as $post) {
            $post->is_liked = $post->reactions->contains('user_id', $user->id);
            foreach ($post->comments as $comment) {
                $comment->is_liked = $comment->reactions->contains('user_id', $user->id);
                foreach ($comment->replies as $reply) {
                    $reply->is_liked = $reply->reactions->contains('user_id', $user->id);
                }
            }
        }
        return ResponseHelper::select($posts);
    }

    public function getPostsForAdmin(Request $request)
    {
        $posts = $this->posts->getData(limit: 10, isPaginate: true,);
        return ResponseHelper::select($posts);
    }

    public function delete(DeletePostRequest $request)
    {
        $post = $this->posts->softDeleteData($request->validated());
        if (empty($post))
            return ResponseHelper::operationFail();
        return ResponseHelper::delete('Deleted successfully');
    }
}
