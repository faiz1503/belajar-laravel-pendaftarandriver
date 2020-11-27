<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelFood extends Model
{
    protected $table = 'merchants_food';

    protected $fillable = [
        'nama_bisnis', 'tipe_bisnis', 'alamat', 'kota', 'nama_depan', 'nama_belakang', 'no_hp', 'email', 'password', 'suratperusahaan', 'suratdirektur', 'suratpenanggungjawab', 'suratpembayaran',
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
