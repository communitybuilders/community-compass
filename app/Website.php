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
     * Return the organisation that this website belongs to.
     *
     * @return Organisation
     */
    public function getOrganisation()
    {
        return Organisation::find($this->entity_id)->first();
    }
}
