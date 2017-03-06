<?php

use Illuminate\Support\Facades\Cache;

class WeatherControllerTest extends TestCase
{

    use \Tests\Traits\ResponseTraits;

    public function testGetIndex()
    {
        
        // Create 2 weather conditions
        factory('App\Weather', 2)->create();
        
        // Should return list
        $this->json('GET', $this->apiUrl.'/weather')
             ->seeStatusCode(200)
             ->seeJsonStructure([
                'data' => [
                    '*' => [
                        'id', 'name', 'icon'
                    ]
                ],
                'code',
                'status'
            ]);

    }
    

    public function testDestroyMethod() 
    {

        // Create a weather condition
        $weather = factory('App\Weather')->create();
        
        // SUCCESS
        $this->json('DELETE', $this->apiUrl.'/weather/'.$weather->id)
             ->seeStatusCode(202)
             ->seeJsonEquals($this->getResponse('destroy'));

        $this->notSeeInDatabase('weather', ['id' => $weather->id]);

        // NOT FOUND
        $this->json('DELETE', $this->apiUrl.'/weather/999')
             ->seeStatusCode(404)
             ->seeJsonEquals($this->getResponse('notFound'));

    }

    public function testShowMethod()
    {

        $weather = factory('App\Weather')->create();

        // SUCCESS
        $this->json('GET', $this->apiUrl.'/weather/'.$weather->id)
             ->seeStatusCode(200)
             ->seeJsonEquals($this->getResponse('show', $weather));

        // NOT FOUND
        $this->json('GET', $this->apiUrl.'/weather/999')
             ->seeStatusCode(404)
             ->seeJsonEquals($this->getResponse('notFound'));
         
    }


    public function testStoreMethod()
    {

        $weatherData = [
            'name' => 'Hot weather',
            'icon' => '1jnb'
        ];

        // SUCCESS
        $weather = $this->json('POST', $this->apiUrl.'/weather', $weatherData)
            ->seeStatusCode(201);

        $response = json_decode($weather->response->getContent());
        $response->data->name = $weatherData['name'];
        $response->data->icon = $weatherData['icon'];

        $weather->seeJsonEquals($this->getResponse('store', $response->data, 'weather'));

        // VALIDATION ERROR
        $weather = $this->json('POST', $this->apiUrl.'/weather', 
        ['name' => 2, 'icon' => '23d4234'])->seeStatusCode(422);
         
    }


    public function testUpdateMethod()
    {

        $weatherData = [
            'name' => 'Calm weather',
            'icon' => 'h3vs'
        ];

        $weather = factory('App\Weather')->create();

        $weather->name = $weatherData['name'];
        $weather->icon = $weatherData['icon'];
        
        // SUCCESS
        $this->json('PUT', $this->apiUrl.'/weather/'.$weather->id, $weatherData)
            ->seeStatusCode(200)
            ->seeJsonEquals($this->getResponse('show', $weather));

        // VALIDATION ERROR
        $this->json('PUT', $this->apiUrl.'/weather/'.$weather->id, ['icon' => 'sdfsdf'])
            ->seeStatusCode(422);

         
    }

}