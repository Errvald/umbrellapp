<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{

    use \App\Traits\RestResponses;

    /**
     * @var \Tymon\JWTAuth\JWTAuth
     */
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    public function loginPost(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email|max:255',
            'password' => 'required',
        ]);

        try {
            if (! $token = $this->jwt->attempt($request->only('email', 'password'))) {
                return $this->authorizeErrorResponse('',404, 'user_not_found');
            }
        } catch (TokenExpiredException $e) {
            return $this->authorizeErrorResponse('',401, 'token_expired');
        } catch (TokenInvalidException $e) {
            return $this->authorizeErrorResponse('',401, 'token_invalid');
        } catch (JWTException $e) {
            return $this->authorizeErrorResponse('',401, 'token_absent', $e->getMessage());
        }

        return $this->authorizeResponse(compact('token'));

    }
}