<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    const ROLE_USER = 0; // view dashboard & report only

    const ROLE_OPERATOR_SITE = 10; // view dashboard, report & input report manual

    const ROLE_OPERATOR_HO = 11; // view dashboard, report & input report manual

    const ROLE_ADMIN_SITE = 20; // manage site & sensors

    const ROLE_ADMIN_HO = 21; // manage perusahaan, sites & sensors

    const ROLE_SUPER_ADMIN = 30; // manage all

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public static function roleList()
    {
        return [
            self::ROLE_USER => 'USER',
            self::ROLE_OPERATOR_SITE => 'OPERATOR SITE',
            self::ROLE_OPERATOR_HO => 'OPERATOR HO',
            self::ROLE_ADMIN_SITE => 'ADMIN SITE',
            self::ROLE_ADMIN_HO => 'ADMIN HO',
            self::ROLE_SUPER_ADMIN => 'SUPER ADMIN',
        ];
    }
}
