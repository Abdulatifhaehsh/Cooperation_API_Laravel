<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Hashash\ProjectService\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, ModelTrait;

    const table = 'users';
    const firstName = 'first_name';
    const lastName = 'last_name';
    const username = 'username';
    const userType = 'user_type';
    const password = 'password';
    const image = 'image';
    const wallet = 'wallet';
    const departmentId = 'department_id';
    const phoneNumber = 'phone_number';
    const createdAt = 'created_at';
    const updatedAt = 'updated_at';
    const deletedAt = 'deleted_at';

    protected $table = self::table;

    protected $fillable = [
        self::username,
        self::password,
        self::userType,
        self::firstName,
        self::lastName,
        self::image,
        self::phoneNumber,
        self::departmentId,
        self::wallet,
        self::createdAt,
        self::updatedAt
    ];


    protected $hidden = [
        self::password,
        self::deletedAt
    ];

    protected $with = [
        'department'
    ];

    protected $casts = [
        self::wallet => 'integer',
        self::departmentId => 'integer',
    ];




    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Hash::make($value)
        );
    }

    public function tokenApi(User $user)
    {
        // return $user->createToken('cooperation', [$user->user_type])->accessToken;
        $token = $user->createToken('cooperation', [$user->user_type]);
        $accessToken = $token->accessToken;
        return $accessToken;
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function reaction()
    {
        return $this->hasMany(Reaction::class);
    }

    public function registration()
    {
        return $this->hasMany(Registration::class);
    }

    public function activiy()
    {
        return $this->hasMany(Activiy::class);
    }



    public function myAwards()
    {
        return $this->belongsToMany(Award::class, 'award_post_users', 'user_id', 'award_id')
            ->select('awards.*')
            ->selectRaw('COUNT(awards.id) as awards_count')
            ->groupBy(
                'awards.id',
                'awards.description',
                'awards.title',
                'awards.value',
                'awards.image',
                'awards.created_at',
                'awards.updated_at',
                'awards.deleted_at',
                'award_post_users.user_id',
                'award_post_users.award_id'
            );;
    }



    public function givingAwards()
    {
        return $this->hasManyThrough(Award::class, Post::class, 'user_id', 'id', 'id', 'award_id')
            ->select('awards.*', 'posts.user_id')
            ->selectRaw('COUNT(awards.id) as awards_count')
            ->groupBy(
                'awards.id',
                'awards.description',
                'awards.title',
                'awards.value',
                'awards.image',
                'awards.created_at',
                'awards.updated_at',
                'awards.deleted_at',
                'posts.user_id'
            );
    }



    public function post()
    {
        return $this->hasMany(Post::class);
    }

    public function rating()
    {
        return $this->hasMany(Rating::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
}
