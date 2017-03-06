<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    protected $table = 'cities';
    public $timestamps = false;
    protected $fillable = ['name','country'];

    /**
     * Get city forecast.
     **/
    public function forecast()
    {
        return $this->hasMany('App\Forecast', 'city_id');
    }

    public function getForecast($days)
    {
        $today = date('Y-m-d', strtotime("+1 days"));
            
        $forecast = $this->forecast()
            ->with('weather')
            ->where('day', '>=', $today)
            ->limit($days)
            ->get();

        return $forecast;

    }
    
    /**
    * Handle model cache
    **/
    public static function boot() {
		parent::boot();
		static::deleting(function($city) {
			\Cache::forget('city:'.$city->id);
		});

        static::updated(function($city) {
			\Cache::forget('city:'.$city->id);
		});

        static::created(function($city) {
			\Cache::forget('city:list');
		});
        
	}

}