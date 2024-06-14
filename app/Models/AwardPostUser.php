<?php

namespace App\Models;

use Hashash\ProjectService\Bases\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AwardPostUser extends BaseModel
{
    use HasFactory, SoftDeletes;


    const table = 'award_post_users';
    const userId = 'user_id';
    const postId = 'post_id';
    const awardId = 'award_id';
    const createdAt = 'created_at';
    const updatedAt = 'updated_at';
    const deletedAt = 'deleted_at';

    protected $table = self::table;

    protected $fillable = [
        self::userId,
        self::postId,
        self::awardId,
        self::createdAt,
        self::updatedAt
    ];

    protected $casts = [
        self::userId => 'integer',
        self::postId => 'integer',
        self::awardId => 'integer',
    ];

    protected $hidden = [
        self::deletedAt
    ];

    public function post()
    {
        return $this->hasOne(Post::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
