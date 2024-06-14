<?php

namespace App\Models;

use Hashash\ProjectService\Bases\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registration extends BaseModel
{
    use HasFactory, SoftDeletes;

    const table = 'registrations';
    const userId = 'user_id';
    const activityId = 'activity_id';
    const createdAt = 'created_at';
    const updatedAt = 'updated_at';
    const deletedAt = 'deleted_at';


    protected $table = self::table;

    protected $fillable = [
        self::userId,
        self::activityId,
        self::createdAt,
        self::updatedAt
    ];

    protected $hidden = [
        self::deletedAt
    ];

    protected $casts = [
        self::userId => 'integer',
        self::activityId => 'integer',
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
