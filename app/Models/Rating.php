<?php

namespace App\Models;

use Hashash\ProjectService\Bases\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rating extends BaseModel
{
    use HasFactory, SoftDeletes;

    const table = 'ratings';
    const userId = 'user_id';
    const activityId = 'activity_id';
    const starCount = 'star_count';
    const comment = 'comment';
    const createdAt = 'created_at';
    const updatedAt = 'updated_at';
    const deletedAt = 'deleted_at';


    protected $table = self::table;

    protected $fillable = [
        self::userId,
        self::activityId,
        self::starCount,
        self::comment,
        self::createdAt,
        self::updatedAt
    ];

    protected $hidden = [
        self::deletedAt
    ];

    protected $casts = [
        self::userId => 'integer',
        self::activityId => 'integer',
        self::starCount => 'integer',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
