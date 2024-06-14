<?php

namespace App\Models;

use Hashash\ProjectService\Bases\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends BaseModel
{
    use HasFactory, SoftDeletes;

    const table = 'images';
    const image = 'image';
    const postId = 'post_id';
    const createdAt = 'created_at';
    const updatedAt = 'updated_at';
    const deletedAt = 'deleted_at';

    protected $table = self::table;


    protected $fillable = [
        self::image,
        self::postId,
        self::createdAt,
        self::updatedAt
    ];

    protected $hidden = [
        self::deletedAt
    ];

    protected $casts = [
        self::postId => 'integer',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
