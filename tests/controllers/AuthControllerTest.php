<?php

use Illuminate\Support\Facades\Cache;

class AuthControllerTest extends TestCase
{

    use \Tests\Traits\ResponseTraits;

    public function testAuthSuccessLogin()
    {

        // Create user
        $user = factory('App\User')->create([
            'name' => 'John Travolta',
            'email' => 'user@email.com',
            'password' => app('hash')->make('1234')
        ]);

        // Perform Login
        $this->json('POST', $this->apiUrl.'/auth/login', [
            'email'=> $user->email,
            'password' => 1234
            ])
             ->seeStatusCode(200)
             ->seeJsonStructure([
                 'data' => ['token'],
                 'status',
                 'code'
                 ]);

    }


    public function testAuthBadLogin()
    {
        // Not found user
        $this->json('POST', $this->apiUrl.'/auth/login', [
            'email'=> 'invalid@email.com',
            'password' => 1234
            ])
             ->seeStatusCode(404)
             ->seeJsonStructure([
                 'data',
                 'status',
                 'code',
                 'message'
                 ]);

    }

}