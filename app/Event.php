<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'events';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['event_name','event_place','event_date','event_status'];

    public function buyers()
    {
        return $this->belongsToMany('App\Buyer','event_buyers');
    }
    public function sellers()
    {
        return $this->belongsToMany('App\Seller','event_sellers');
    }
    public function event_params()
    {
        return $this->hasMany('App\EventParam');
        return $this->hasMany('App\EventParam');
    }
}
