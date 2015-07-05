<?php
/**
 * Created by PhpStorm.
 * User: dejan
 * Date: 5/07/15
 * Time: 10:38 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Token extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'token',
        'email',
        'organisation_id',
        'requested_on',
        'verified_on',
        'user_id'
    ];

    public static function create(array $attributes = array()) {
        $attributes['requested_on'] = date("Y-m-d H:i:s");
        $attributes['type'] = "organisation_claim";
        $attributes['token'] = sha1(serialize($attributes['organisation_id']) . serialize($attributes['user_id']) . serialize($attributes['email']) . time() . rand(1,9999));
        return parent::create($attributes);
    }
}