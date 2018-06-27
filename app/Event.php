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
    protected $fillable = ['event_name', 'event_place', 'event_date', 'event_status', 'event_description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function buyers()
    {
        return $this->belongsToMany(Buyer::class);
    }

    /**
     * Returns all sellers in this event
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sellers()
    {
        return $this->belongsToMany(Seller::class);
    }

    /**
     * Returns all seller emails in this event
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sellerEmails()
    {
        $seller_emails = $this->sellers->map(function ($seller, $key) {
            return $seller->user->email;
        });

        return $seller_emails->toArray();
    }

    /**
     * Returns all buyers emails in this event
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function buyerEmails()
    {
        $buyer_emails = $this->buyers->map(function ($buyer, $key) {
            return $buyer->user->email;
        });

        return $buyer_emails->toArray();
    }

    public function event_params()
    {
        return $this->hasMany('App\EventParam');
    }

    /**
     * Returns the bootstrap label class
     * @return string
     */
    public function getLabelClass()
    {
        $status = $this->event_status;
        switch ($status) {
            case 'Registration Closed':
                return 'label label-warning';
            case 'New Event':
                return 'label label-primary';
            case 'Registration Open':
                return 'label label-success';
            case 'Schedule Finalized':
                return 'label label-danger';
            default:
                return 'label label-default';
        }
        // new - primary, closed - warning, opened - success, finalized - red
    }

}
