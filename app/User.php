<?php

namespace App;

use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'apellido_materno', 'apellido_paterno', 'username', 'name', 'email', 'password',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['full_name', 'apellidos'];

    public function setPasswordAttribute($pass)
    {
        if (Hash::needsRehash($pass))
        {
            $pass = Hash::make($pass);
        }
        
        $this->attributes['password'] = $pass;
    }

    /**
     * Obtiene el nombre completo como un solo campo
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->attributes['name'].' '.$this->attributes['apellido_paterno'].' '.$this->attributes['apellido_materno'];
    }

    /**
     * Obtiene los apellidos como un solo campo
     *
     * @return string
     */
    public function getApellidosAttribute()
    {
        return $this->attributes['apellido_paterno'].' '.$this->attributes['apellido_materno'];
    }
}
