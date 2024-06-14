<?php

namespace App\Models;

use Hashash\ProjectService\Bases\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends BaseModel
{
    use HasFactory, SoftDeletes;

    const table = 'comments';
    const comment = 'comment';
    const userId = 'user_id';
    const postId = 'post_id';
    const commentId = 'comment_id';
    const createdAt = 'created_at';
    const updatedAt = 'updated_at';
    const deletedAt = 'deleted_at';

    protected $table = self::table;

    protected $fillable = [
        self::comment,
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

    public function replies()
    {
        return $this->hasMany(self::class);
    }


    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }
}
