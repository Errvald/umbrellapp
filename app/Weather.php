<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'weather';

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
    protected $fillable = ['name','icon'];

    /**
    * Handle model cache
    **/
    public static function boot() {
		parent::boot();
		static::deleting(function($item) {
			\Cache::forget('weather:'.$item->id);
		});

        static::updated(function($item) {
			\Cache::forget('weather:'.$item->id);
		});

        static::created(function($item) {
			\Cache::forget('weather:list');
		});
        
	}

}