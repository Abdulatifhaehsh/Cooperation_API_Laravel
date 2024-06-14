<?php



namespace App\Models;

use Hashash\ProjectService\Bases\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends BaseModel
{
    use HasFactory, SoftDeletes;

    const table = 'purchases';
    const userId = 'user_id';
    const itemId = 'item_id';
    const value = 'value';
    const quantity = 'quantity';
    const createdAt = 'created_at';
    const updatedAt = 'updated_at';
    const deletedAt = 'deleted_at';

    protected $table = self::table;

    protected $fillable = [
        self::userId,
        self::itemId,
        self::value,
        self::quantity,
        self::createdAt,
        self::updatedAt
    ];

    protected $casts = [
        self::userId => 'integer',
        self::itemId => 'integer',
        self::value => 'integer',
        self::quantity => 'integer',
    ];
    protected $hidden = [
        self::deletedAt
    ];

    protected $with = [
        'user',
        'item',

    ];

    protected $dates = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
