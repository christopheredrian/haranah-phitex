<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sellers';

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
    protected $fillable = [
        'user_id',
        'company_name',
        'company_address',
        'event_rep1',
        'event_rep2',
        'designation',
        'email',
        'country',
        'website',
        'phone',
        'products',
        'position',
    ];

    public function user()
	{
		return $this->belongsTo('App\User');
	}

//    public function event()
//    {
//        return $this->belongsTo(Event::class);
//    }

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }
}
