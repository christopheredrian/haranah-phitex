<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuyerEvent extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'buyer_event';

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
    protected $fillable = ['event_id','seller_id'];
}
