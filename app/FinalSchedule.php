<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinalSchedule extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'final_schedules';

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
    protected $fillable = ['event_id', 'buyer_id', 'seller_id', 'event_param_id', 'table'];

    public function event() {
        return $this->belongsTo('App\Event');
    }

    public function buyer() {
        return $this->belongsTo('App\Buyer');
    }

    public function seller() {
        return $this->belongsTo('App\Seller');
    }

    public function eventParam() {
        return $this->belongsTo('App\EventParam');
    }
}
