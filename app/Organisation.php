<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

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
    protected $fillable = [
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
        return $this->belongsToMany('App\Category');
    }

    /**
     * An organisation can operate in many states.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function states()
    {
        return $this->belongsToMany('App\State');
    }

    public function addresses()
    {
        return Address::organisations($this->id);
    }

    /**
     * Function to organisation values
     *
     * @return array
     */
    public function fillorganisation()
    {
        $results = DB::table('organisations')->take(30)->get();
        return $results;
    }

    /**
     * Function to organisation values
     * @param int $row
     * @return array
     */
    public function fillorganisationbyid($row)
    {
        $results = DB::table('organisations')->take(30)->where('id', '<=', $row)->get();
        return $results;
    }
}
