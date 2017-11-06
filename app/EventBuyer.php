<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventBuyer extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'event_buyers';

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
    protected $fillable = ['event_id', 'buyer_id'];

    
}
