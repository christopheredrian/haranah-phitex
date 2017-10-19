<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuperAdministrator extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'super_administrators';

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
    protected $fillable = ['user_id'];

    public function user()
	{
		return $this->belongsTo('App\User');
	}
	
}
