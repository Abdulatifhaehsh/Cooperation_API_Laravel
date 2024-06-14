<?php

namespace App\Models;

use Hashash\ProjectService\Bases\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends BaseModel
{
    use HasFactory, SoftDeletes;

    const table = 'departments';
    const section = 'section';
    const createdAt = 'created_at';
    const updatedAt = 'updated_at';
    const deletedAt = 'deleted_at';

    protected $table = self::table;

    protected $fillable = [
        self::section,
        self::createdAt,
        self::updatedAt
    ];

    protected $hidden = [
        self::deletedAt
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
