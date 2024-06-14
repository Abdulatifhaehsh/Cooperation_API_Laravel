<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\DeleteUserRequest;
use App\Http\Requests\User\SignInRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Hashash\ProjectService\Helpers\FileClass;
use Hashash\ProjectService\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(private User $users, private FileClass $fileClass)
    {
    }

    public function signIn(SignInRequest $request)
    {
        $userData = $request->validated();

        if (Auth::attempt($userData)) {
            $user = Auth::user();
            $user['token_api'] = $this->users->tokenApi($user);
            return ResponseHelper::operationSuccess($user);
        }

        return ResponseHelper::operationFail();
    }

    public function createUser(CreateUserRequest $request)
    {
        $user = $this->users->createData($request->validated());
        if (empty($user))
            return ResponseHelper::operationFail();
        return ResponseHelper::create($user);
    }

    public function updateUser(UpdateUserRequest $request)
    {
        $data = $request->validated();
        if ($request->has('image')) {
            $file = $request->file('image');
            $fileUri = $this->fileClass
                ->uploadFile(
                    $file,
                    time() . '.' . $file->extension(),
                    'images/users/'
                );
            $data['image'] = $fileUri;
        }
        $id = $request->user()->id;
        $user = $this->users->updateData(['id' => $id], $data);
        if (empty($user))
            return ResponseHelper::operationFail();
        return ResponseHelper::update('Updated successfully');
    }

    public function deleteUser(DeleteUserRequest $request)
    {
        $user = $this->users->softDeleteData($request->validated());
        if (empty($user))
            return ResponseHelper::operationFail();
        return ResponseHelper::delete('Deleted successfully');
    }

    public function getUsers(Request $request)
    {
        return ResponseHelper::select($this->users->getData(relations: [
            'givingAwards',
            'myAwards'
        ]));
    }

    public function myUser(Request $request)
    {
        return ResponseHelper::select($this->users->findData(filter: ['id' => $request->user()->id], relations: [
            'givingAwards',
            'myAwards'
        ]));
    }
}
