<?php

use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      // Populate weather conditions
        $conditions = factory('App\Weather', 5)->create();
        
        // Populate forecast data
        $cities = factory('App\City', 10)->create()
            ->each(function ($city) {
                $date = new DateTime(date("Y-m-d"));
                // 5 days
                foreach (range(1, 5) as $day)
                {
                    $date->add(new DateInterval('P1D'));

                    $city->forecast()->save(factory('App\Forecast')->create([
                        'city_id' => $city->id,
                        'weather_id' => $day,
                        'day' => $date->format("Y-m-d")
                    ]));

                };
                
            });

    }
}
