<?php

namespace App\Http\Controllers;

use App\Weather;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Cache;

class WeatherController extends Controller
{

    use \App\Traits\RestResponses;

    protected $cacheLasts = 1440;

    protected $weather;

    public function __construct(Weather $weather) {
        $this->weather = $weather;
    }

    /**
    * GET /weather
    * @return Response
    **/
    public function index()
    {
        $weather = Cache::remember('weather:list', $this->cacheLasts, function () {
            return $this->weather->all();
        });
        return $this->listResponse($weather);
    }


    /**
    * GET /weather/{id}
    * @param integer $id
    * @return Response
    **/
    public function show($id)
    {

        try {

            $weather = Cache::remember('weather:'.$id, $this->cacheLasts, function () use($id) {
                return $this->weather->findOrFail($id);
            });

            return $this->showResponse($weather);

        } catch(ModelNotFoundException $ex){ 
            return $this->notFoundResponse();
        }

    }

    /**
    * POST /weather
    * @param Request $request
    * @return Response
    **/
    public function store(Request $request)
    {
    
        try {

            $this->validate($request, [
                'name' => 'required|unique:weather,name|max:120', 
                'icon' => 'required|string|size:4'
            ]);

            $weather = $this->weather->create($request->all());

            return $this->storeResponse($weather, 'weather');

        } catch(\Illuminate\Validation\ValidationException $ex){
            return $this->clientErrorResponse(['form_validations'=>$ex->validator->errors()]);
        }

    }

    /**
    * PUT /weather/{id}
    * @param Request $request
    * @param integer $id
    * @return Response
    **/
    public function update(Request $request, $id)
    {

        try {

            $this->validate($request, [
                'name' => 'required|unique:weather,name|max:120', 
                'icon' => 'string|size:4'
            ]);

            $weather = $this->weather->find($id);
            $weather->fill($request->all());
            $weather->save();

            return $this->showResponse($weather);


        } catch(\Illuminate\Validation\ValidationException $ex){
            return $this->clientErrorResponse(['form_validations' => $ex->validator->errors()]);
        }

    }

    /**
    * DELETE /weather/{id}
    * @param integer $id
    * @return Response
    **/
    public function destroy($id)
    {

        try {
            $weather = $this->weather->findOrFail($id);
        } catch(ModelNotFoundException $ex){ 
            return $this->notFoundResponse();
        }

        $weather->delete();

        return $this->deletedResponse();

    }

}