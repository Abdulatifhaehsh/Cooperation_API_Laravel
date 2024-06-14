<?php

namespace App\Models;

use Hashash\ProjectService\Bases\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Award extends BaseModel
{
    use HasFactory, SoftDeletes;

    const table = 'awards';
    const image = 'image';
    const title = 'title';
    const description = 'description';
    const value = 'value';
    const createdAt = 'created_at';
    const updatedAt = 'updated_at';
    const deletedAt = 'deleted_at';

    protected $table = self::table;

    protected $fillable = [
        self::image,
        self::title,
        self::description,
        self::value,
        self::createdAt,
        self::updatedAt
    ];

    protected $casts = [
        self::value => 'integer',
    ];

    protected $hidden = [
        self::deletedAt
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
