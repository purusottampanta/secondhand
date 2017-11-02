<?php

namespace App\Models;

use App\Traits\ActivityTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cviebrock\EloquentSluggable\Sluggable;

class User extends Authenticatable
{
    use Notifiable, Sluggable, SoftDeletes, ActivityTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'profile_picture', 'slug', 'phone', 'mobile_phone', 'street', 'area_location', 'city', 'country', 'gender', 'confirmation_code', 'is_admin', 'confirmed', ''
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'full_name'
            ]
        ];
    }

    public function getTitle()
    {
        return $this->full_name;
    }

    /**
     * this method returns first name of user from full name
     * @return mixed 
     */
    public function getFirstNameAttribute()
    {
        $name = explode(' ', $this->full_name);
        return implode(' ', array_diff($name, [last($name)]));
    }

    /**
     * this method returns last name of user from full name
     * @return mixed 
     */
    public function getLastNameAttribute()
    {
        return (last(explode(' ', $this->full_name)));
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * find url for profile picture
     * @return mixed 
     */
    public function profilePicture()
    {
        $value = $this->profile_picture;
        return asset($value ? getSmallThumbnail($value) : 'img/avatar.jpg');
    }

    /**
     * find profile thumbnail
     * @return mixed 
     */
    public function thumbnail()
    {
        $value = $this->profile_picture;
        return asset($value ? getThumbnail($value) : 'img/avatar.jpg');
    }
}
