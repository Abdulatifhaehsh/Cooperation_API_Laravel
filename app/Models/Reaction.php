<?php

namespace App\Models;

use Hashash\ProjectService\Bases\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reaction extends BaseModel
{
    use HasFactory, SoftDeletes;

    const table = 'reactions';

    const userId = 'user_id';
    const postId = 'post_id';
    const commentId = 'comment_id';
    const createdAt = 'created_at';
    const updatedAt = 'updated_at';
    const deletedAt = 'deleted_at';

    protected $table = self::table;


    protected $fillable = [
        self::userId,
        self::postId,
        self::commentId,
        self::createdAt,
        self::updatedAt
    ];

    protected $hidden = [
        self::deletedAt
    ];

    protected $casts = [
        self::userId => 'integer',
        self::postId => 'integer',
        self::commentId => 'integer',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
