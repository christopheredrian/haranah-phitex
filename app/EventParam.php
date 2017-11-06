<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventParam extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'event_params';

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
    protected $fillable = ['start_time', 'end_time', 'event_id'];

    public function event()
	{
		return $this->belongsTo('App\Event');
	}
	
}
