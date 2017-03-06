<?php

use Illuminate\Support\Facades\Cache;

class CityControllerTest extends TestCase
{

    use \Tests\Traits\ResponseTraits;

    public function testGetIndex()
    {
        
        // Create 2 cities
        factory('App\City', 2)->create();
        
        // Should return list
        $this->json('GET', $this->apiUrl.'/cities')
             ->seeStatusCode(200)
             ->seeJsonStructure([
                'data' => [
                    '*' => [
                        'id', 'name', 'country'
                    ]
                ],
                'code',
                'status'
            ]);

    }
    

    public function testDestroyMethod() 
    {

        // Create a city
        $city = factory('App\City')->create();
        
        // SUCCESS
        $this->json('DELETE', $this->apiUrl.'/cities/'.$city->id)
             ->seeStatusCode(202)
             ->seeJsonEquals($this->getResponse('destroy'));

        $this->notSeeInDatabase('cities', ['id' => $city->id]);

        // NOT FOUND
        $this->json('DELETE', $this->apiUrl.'/cities/999')
             ->seeStatusCode(404)
             ->seeJsonEquals($this->getResponse('notFound'));

    }

    public function testShowMethod()
    {

        $city = factory('App\City')->create();

        // SUCCESS
        $this->json('GET', $this->apiUrl.'/cities/'.$city->id)
             ->seeStatusCode(200)
             ->seeJsonEquals($this->getResponse('show', $city));

        // NOT FOUND
        $this->json('GET', $this->apiUrl.'/cities/999')
             ->seeStatusCode(404)
             ->seeJsonEquals($this->getResponse('notFound'));
         
    }


    public function testStoreMethod()
    {

        $cityData = [
            'name' => 'Zakynthos',
            'country' => 'GR'
        ];

        // SUCCESS
        $city = $this->json('POST', $this->apiUrl.'/cities', $cityData)
            ->seeStatusCode(201);

        $response = json_decode($city->response->getContent());
        $response->data->name = $cityData['name'];
        $response->data->country = $cityData['country'];

        $city->seeJsonEquals($this->getResponse('store', $response->data, 'city'));

        // VALIDATION ERROR
        $city = $this->json('POST', $this->apiUrl.'/cities', 
        ['name' => 2, 'country' => 'GRE'])->seeStatusCode(422);
         
    }


    public function testUpdateMethod()
    {

        $cityData = [
            'name' => 'Zakynthos',
            'country' => 'GR'
        ];

        $city = factory('App\City')->create();

        $city->name = $cityData['name'];
        $city->country = $cityData['country'];
        
        // SUCCESS
        $this->json('PUT', $this->apiUrl.'/cities/'.$city->id, $cityData)
            ->seeStatusCode(200)
            ->seeJsonEquals($this->getResponse('show', $city));

        // VALIDATION ERROR
        $this->json('PUT', $this->apiUrl.'/cities/'.$city->id, ['country' => 'GRE'])
            ->seeStatusCode(422);

         
    }

    public function testQueryMethod()
    {

        // Populate weather conditions
        $conditions = factory('App\Weather', 5)->create();
        
        // Populate forecast data
        $cities = factory('App\City', 2)->create()
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

        // Perform a query
        $today = date('Ymd', strtotime("+1 days"));
        $cityName = $cities[0]->name;

        $city = $this->json('GET', $this->apiUrl.'/query', ["city" => $cityName])
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'data' => [
                        'id', 
                        'name', 
                        'country',
                        'forecast' => [
                            '*' => [
                                'id', 
                                'city_id', 
                                'weather_id', 
                                'day', 
                                'c_min', 
                                'c_max',
                                'f_min', 
                                'f_max',
                                'weather' => [
                                    'id', 'name', 'icon'
                                ]
                            ]
                        ]

                ],
                'code',
                'status'
            ]);

    }

}