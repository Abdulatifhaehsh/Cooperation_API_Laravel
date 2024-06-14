<?php

namespace App\Models;

use Hashash\ProjectService\Bases\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends BaseModel
{
    use HasFactory, SoftDeletes;

    const table = 'tags';
    const name = 'name';
    const isAdmin = 'is_admin';
    const createdAt = 'created_at';
    const updatedAt = 'updated_at';
    const deletedAt = 'deleted_at';




    protected $fillable = [
        self::name,
        self::isAdmin,
        self::createdAt,
        self::updatedAt
    ];



    protected $hidden = [
        self::deletedAt
    ];

    protected $casts = [
        self::isAdmin => 'boolean'
    ];

    public function post()
    {
        return $this->hasOne(Post::class);
    }
}
