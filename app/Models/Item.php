<?php



namespace App\Models;

use Hashash\ProjectService\Bases\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends BaseModel
{
    use HasFactory, SoftDeletes;

    const table = 'items';
    const image = 'image';
    const title = 'title';
    const description = 'description';
    const value = 'value';
    const quantity = 'quantity';
    const createdAt = 'created_at';
    const updatedAt = 'updated_at';
    const deletedAt = 'deleted_at';

    protected $table = self::table;

    protected $fillable = [
        self::image,
        self::title,
        self::description,
        self::value,
        self::quantity,
        self::createdAt,
        self::updatedAt
    ];

    protected $hidden = [
        self::deletedAt
    ];

    protected $casts = [
        self::value => 'integer',
        self::quantity => 'integer',
    ];




    protected $dates = [];
}
