<?php

namespace App\Models;

use Hashash\ProjectService\Bases\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends BaseModel
{
    use HasFactory, SoftDeletes;

    const table = 'activities';
    const image = 'image';
    const beginAt = 'begin_at';
    const endAt = 'end_at';
    const description = 'description';
    const registrationEnd = 'registration_end';
    const title = 'title';
    const location = 'location';
    const maxMembers = 'max_members';
    const createdAt = 'created_at';
    const updatedAt = 'updated_at';
    const deletedAt = 'deleted_at';

    protected $fillable = [
        self::image,
        self::beginAt,
        self::endAt,
        self::description,
        self::registrationEnd,
        self::title,
        self::location,
        self::maxMembers,
        self::createdAt,
        self::updatedAt
    ];

    protected $casts = [
        // self::beginAt => 'date_format:Y-m-d H:i:s',
        // self::registrationEnd => 'date_format:Y-m-d H:i:s',
        // self::endAt => 'date_format:Y-m-d H:i:s',
        // self::maxMembers => 'integer'
    ];

    protected $with = [
        'ratings.user',
        'registrations.user'
    ];

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
