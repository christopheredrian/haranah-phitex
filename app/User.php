<?php

namespace App;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Notifiable;
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
        'last_name', 'first_name', 'email', 'password', 'role', 'activated'
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
     * Returns true if the current user has a particular role
     * @param $role
     * @return bool
     */
    public function hasRole($role){
        if($this->role === $role){
            return true;
        } else {
            return false;
        }
    }

    public function getRole(){
        return $this->role;
    }

    /**
     * Gets the buyer instance for this user
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function buyer(){
        return $this->hasOne(Buyer::class);
    }

    /**
     * Gets the seller instance for this user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seller(){
        return $this->hasOne(Seller::class);
    }

}
