<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait RestResponses
{

    protected function showResponse($data)
    {
        $response = [
            'code' => 200,
            'status' => 'success',
            'data' => $data
        ];
        return response()->json($response, $response['code']);
    }

    protected function storeResponse($data, $route)
    {
        $response = [
            'code' => 201,
            'status' => 'success',
            'data' => $data
        ];

        return response()->json($response, $response['code'], [
            'Location' => route($route, ['id' => $data->id])
        ]);
    }

    protected function listResponse($data)
    {
        $response = [
            'code' => 200,
            'status' => 'success',
            'data' => $data
        ];
        return response()->json($response, $response['code']);
    }
    
    protected function deletedResponse()
    {
        $response = [
            'code' => 202,
            'status' => 'success',
            'data' => [],
            'message' => 'Resource deleted'
        ];
        return response()->json($response, $response['code']);
    }

    protected function notFoundResponse()
    {

        $response = [
            'code' => 404,
            'status' => 'error',
            'data' => 'Resource Not Found',
            'message' => 'Not Found'
        ];
        return response()->json($response, $response['code']);
    }

    protected function clientErrorResponse($data)
    {
        $response = [
            'code' => 422,
            'status' => 'error',
            'data' => $data,
            'message' => 'Unprocessable entity'
        ];
        return response()->json($response, $response['code']);
    }

}