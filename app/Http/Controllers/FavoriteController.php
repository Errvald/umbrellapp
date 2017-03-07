<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\QueryException;

class FavoriteController extends AuthController
{

    use \App\Traits\RestResponses;

    protected $cacheLasts = 1440;

    protected $user;

    public function __construct()
    {
        $user = \Auth::User();
        $this->user = User::find($user->id);
    }

    /**
    * GET /favorites
    * @return Response
    **/
    public function index()
    {
        $favorites = Cache::remember('favorites:list', $this->cacheLasts, function () {
            return $this->user->favorites()->get();
        });
        return $this->listResponse($favorites);
    }


    /**
    * POST /favorites
    * Stores or restores a favorite
    * @param Request $request
    * @return Response
    **/
    public function store(Request $request, $id)
    {
        try {
            $this->user->favorites()->syncWithoutDetaching([$id]);
            return $this->showResponse([]);
        } catch(QueryException $ex){ 
            return $this->notFoundResponse();
        }

    }

    /**
    * DELETE /favorites/{id}
    * @param integer $id
    * @return Response
    **/
    public function destroy($id)
    {
        $detached = $this->user->favorites()->detach($id);
        
        if($detached){
            Cache::forget('favorites:list');
            return $this->deletedResponse();
        }else{
            return $this->notFoundResponse();
        }
        
    }


}