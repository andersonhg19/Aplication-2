<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

            'id_type_document',
            'num_document',
            'name',
            'lastname',
            'address',
            'mail_address',
            'phone',
            'cell_phone',
            'id_type_comunication',
            'id_type_user',
            'id_service',
            'id_state_user',
            'password'               

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
        'document_verified_at' => 'datetime',
    ];


        //Relación de uno a muchos
    public function post(){
        return $this->hasMany('App\Post');
    }


}
