<?php

namespace App\Http\Controllers;

use App\City;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Cache;

class CityController extends Controller
{

    use \App\Traits\RestResponses;

    protected $cacheLasts = 1440;

    protected $city;

    public function __construct(City $city) {
        $this->city = $city;
    }

    /**
    * GET /cities
    * @return Response
    **/
    public function index()
    {
        $cities = Cache::remember('city:list', $this->cacheLasts, function () {
            return $this->city->all();
        });
        return $this->listResponse($cities);
    }

     /**
     * GET /cities/{id}
     * @param integer $id
     * @return Response
     */
    public function show($id)
    {

        try {

            $city = Cache::remember('city:'.$id, $this->cacheLasts, function () use($id) {
                return $this->city->findOrFail($id);
            });

            return $this->showResponse($city);

        } catch(ModelNotFoundException $ex){ 
            return $this->notFoundResponse();
        }

    }

    /**
    * POST /cities
    * @param Request $request
    * @return Response
    **/
    public function store(Request $request)
    {
    
        try {

            $this->validate($request, [
                'name'    => 'required|unique:cities,name|max:120', 
                'country' => 'required|string|size:2'
            ]);

            $city = $this->city->create($request->all());

            return $this->storeResponse($city, 'city');

        } catch(\Illuminate\Validation\ValidationException $ex){
            return $this->clientErrorResponse(['form_validations'=>$ex->validator->errors()]);
        }

    }

    /**
    * PUT /cities/{id}
    * @param Request $request
    * @param integer $id
    * @return Response
    **/
    public function update(Request $request, $id)
    {

        try {

            $this->validate($request, [
                'name'    => 'required|unique:cities,name|max:120', 
                'country' => 'string|size:2'
            ]);

            $city = $this->city->find($id);
            $city->fill($request->all());
            $city->save();

            return $this->showResponse($city);


        } catch(\Illuminate\Validation\ValidationException $ex){
            return $this->clientErrorResponse(['form_validations' => $ex->validator->errors()]);
        }

    }

    /**
    * DELETE /cities/{id}
    * @param integer $id
    * @return Response
    **/
    public function destroy($id)
    {

        try {
            $city = $this->city->findOrFail($id);
        } catch(ModelNotFoundException $ex){ 
            return $this->notFoundResponse();
        }

        $city->delete();

        return $this->deletedResponse();

    }

    /**
     * GET /query
     *
     * @param  Request  $request
     * @return Response
     */
    public function query(Request $request)
    {

        try {

            $this->validate($request, [
                'city'    => 'required|max:200',
                'days'    => 'numeric|max:5|min:1'
            ]);

        } catch(\Illuminate\Validation\ValidationException $ex){
            return $this->clientErrorResponse(['form_validations' => $ex->validator->errors()]);
        }

        // Use the chached query if we have one query:{city}:{20170601}
        $strippedDate = date('Ymd', strtotime("+1 days"));
        $cacheKey = 'query:'.$request->city.':'.$strippedDate;
        $cachedQuery = Cache::get($cacheKey);
        if($cachedQuery)
            return $this->showResponse($cachedQuery);

        // Find city by name
        $city = $this->city->where('name', 'LIKE', '%'.$request->city.'%')->first();
        
        // If city exists query forecast
        if($city){

            $response = $city->toArray();
            $forecast = $city->getForecast($request->input('days', 5));

            if($forecast){
                $response['forecast'] = $forecast;
                Cache::put($cacheKey, $response, $this->cacheLasts);
            }

            return $this->showResponse($response);
        }

        return $this->showResponse([]);

    }


}