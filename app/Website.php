<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Website
 *
 * @package App
 */
class Website extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'entity_type',
        'entity_id',
        'url'
    ];

    /**
     * Each website can belong to an organisation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organisation()
    {
        return $this->belongsTo('App\Organisation', 'entity_id');
    }

}
