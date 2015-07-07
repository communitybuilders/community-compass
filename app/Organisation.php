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

    /**
     * Each organisation can have an address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function address()
    {
        return $this->hasOne('App\Address', 'entity_id');
    }

    /**
     * Each organisation can have an image.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function image()
    {
        return $this->hasOne('App\Image', 'entity_id');
    }

    /**
     * Each organisation can have a website.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function website()
    {
        return $this->hasOne('App\Website', 'entity_id');
    }

    /**
     * Function to organisation values
     *
     * @return array
     */
    public function fillorganisation()
    {
        $results = DB::table('organisations')->leftjoin('image', 'organisations.id', '=', 'image.entity_id')->take(30)->select("organisations.*", "image.image_uri")->get();
        return $results;
    }

    /**
     * Function to organisation values
     * @param int $row
     * @return array
     */
    public function fillorganisationbyid($row)
    {
        $results = DB::table('organisations')->leftjoin('image', 'organisations.id', '=', 'image.entity_id')->take(30)->where('organisations.id', '>=', $row)->get();
        return $results;
    }
}
