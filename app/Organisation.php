<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Organisation
 *
 * @package App
 */
class Organisation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillabe = [
        'type',
        'legal_name',
        'other_name',
        'abn',
        'registration_date',
        'established_date',
        'size',
        'num_responsible_persons',
        'financial_year_end'
    ];

    /**
     * An organisation can have many categories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany('Category');
    }

    /**
     * An organisation can operate in many states.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function states()
    {
        return $this->belongsToMany('State');
    }
}
