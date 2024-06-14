<?php

namespace App\Models;

use Hashash\ProjectService\Bases\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends BaseModel
{
    use HasFactory, SoftDeletes;

    const table = 'posts';
    const userId = 'user_id';
    const tagId = 'tag_id';
    const awardId = 'award_id';
    const description = 'description';
    const isAccepted = 'is_accepted';
    const title = 'title';
    const createdAt = 'created_at';
    const updatedAt = 'updated_at';
    const deletedAt = 'deleted_at';

    protected $table = self::table;

    protected $fillable = [
        self::userId,
        self::tagId,
        self::awardId,
        self::isAccepted,
        self::description,
        self::title,
        self::createdAt,
        self::updatedAt
    ];

    protected $casts = [
        self::userId => 'integer',
        self::tagId => 'integer',
        self::awardId => 'integer',
        self::isAccepted => 'boolean',
    ];

    protected $hidden = [
        self::deletedAt
    ];

    protected $with = [
        'images',
        'tag',
        'award',
        'reactions.user',
        'comments.replies.reactions.user',
        'comments.replies.user',
        'comments.reactions.user',
        'comments.user',
        'user',
        'awardUsers',

    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }


    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }


    public function award()
    {
        return $this->belongsTo(Award::class);
    }


    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function awardUsers()
    {
        return $this->belongsToMany(User::class, 'award_post_users', 'post_id', 'user_id');
    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
