<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelUser extends Model
{
    protected $table = 'users_driver';

    protected $fillable = [
        'nama_depan', 'nama_belakang', 'no_hp', 'tipe_driver', 'ktp', 'sim', 'stnk', 'skck', 'suratkesehatan',
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
}
