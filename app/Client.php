<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Client as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;
    use LaratrustUserTrait;
    use Notifiable;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'image', 'address', 'phone'
    ];
    protected $dates = ['deleted_at'];
    protected $casts = ['phone' => 'array'];

    protected $appends = ['image_path'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);

    }//end of get first name

    public function getLastNameAttribute($value)
    {
        return ucfirst($value);

    }//end of get last name

    public function getImagePathAttribute()
    {
        return asset('uploads/client_images/' . $this->image);

    }//end of get image path

    public function orders()
    {
        return $this->hasMany(Order::class);

    }//end of orders


}//end of model
