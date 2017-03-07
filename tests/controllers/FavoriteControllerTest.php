<?php

use Illuminate\Support\Facades\Cache;
use Tymon\JWTAuth\Facades\JWTAuth;

class FavoriteControllerTest extends TestCase
{

    use \Tests\Traits\ResponseTraits;
    
    /**
    * Populate with user, city and get user token
    * @return User
    */
    public function populateFavorites()
    {
        // Create city
        $city = factory('App\City')->create();

        // Create user
        $user = factory('App\User')->create([
            'name' => 'John Travolta',
            'email' => 'user@email.com',
            'password' => app('hash')->make('1234')
        ]);

        // Attach 2 cities as favorites
        $user->favorites()->attach($city->id);

       return $user;

    }

    public function testUnauthorizedUser()
    {
        // Test invalid token on authorized endpoint
        $this->json('GET', $this->apiUrl.'/favorites',
            ['token' => 'invalid_token'])
            ->seeStatusCode(401)
            ->seeJsonEquals([
                'error' => 'Unauthorized'
            ]);

        // Test without token on authorized endpoint
        $this->json('GET', $this->apiUrl.'/favorites')
            ->seeStatusCode(400)
            ->seeJsonEquals([
                'error' => 'Token not provided'
            ]);
    }

    public function testGetIndex()
    {
        
       $user = $this->populateFavorites();
       $token = JWTAuth::fromUser($user);

       // Should return list
       $this->json('GET', $this->apiUrl.'/favorites',
        ['token' => $token])
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

    public function testDestroyFavorite()
    {
        
       $user = $this->populateFavorites();
       $token = JWTAuth::fromUser($user);

       $city_id = 1;

       // Should return list
       $this->json('DELETE', $this->apiUrl.'/favorites/'.$city_id,
        ['token' => $token])
             ->seeStatusCode(202)
             ->seeJsonEquals($this->getResponse('destroy'));

       $this->notSeeInDatabase('favorites', [
           'city_id' => $city_id,
           'user_id' => $user->id
           ]);

       // NOT FOUND
       $this->json('DELETE', $this->apiUrl.'/favorites/999',
       ['token' => $token])
             ->seeStatusCode(404)
             ->seeJsonEquals($this->getResponse('notFound'));

    }

    public function testStoreFavorite()
    {
        
       $user = $this->populateFavorites();
       $token = JWTAuth::fromUser($user);

       $city = factory('App\City')->create();

       // Should return list
       $this->json('POST', $this->apiUrl.'/favorites/'.$city->id,
        ['token' => $token])
             ->seeStatusCode(200)
             ->seeJsonEquals($this->getResponse('show'));

       $this->seeInDatabase('favorites', [
           'city_id' => $city->id,
           'user_id' => $user->id
           ]);


    }


}