<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellerPreference extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seller_preferences';

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
    protected $fillable = ['event_id', 'buyer_id', 'seller_id', 'rank', 'priority'];

    /**
     * Get all sellers without preferences
     */
    public static function getSellersWithoutPreferences($event_id){
        return Seller::whereNotIn('id',SellerPreference::where('event_id', '=', $event_id)
            ->pluck('seller_id'))->get();

    }
}
