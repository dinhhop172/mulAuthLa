<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $table = 'customer';
    protected $fillable = ['name', 'email', 'address', 'password'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    function order(){
        return $this->hasMany('App\Models\Order', 'customer_id', 'id');
    }
}
