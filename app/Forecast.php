<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forecast extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'forecast';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['day','c_min','c_max','f_min','f_max'];

    /**
     * Get city.
     */
    public function city()
    {
        return $this->belongsTo('App\City', 'city_id');
    }

    /**
     * Get weather type.
     */
    public function weather()
    {
        return $this->belongsTo('App\Weather', 'weather_id');
    }

}