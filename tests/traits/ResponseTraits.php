<?php

namespace Tests\Traits;

use Illuminate\Http\Request;

trait ResponseTraits
{

    use \App\Traits\RestResponses;

    public function getResponse($type, $data = [], $route = '')
    {
        switch ($type) {
            case 'list':
                $response = $this->listResponse($data)->getContent();
                break;
            case 'show':
                $response = $this->showResponse($data)->getContent();
                break;
            case 'store':
                $response = $this->storeResponse($data, $route)->getContent();
                break;
            case 'destroy':
                $response = $this->deletedResponse()->getContent();
                break;
            case 'notFound':
                $response = $this->notFoundResponse()->getContent();
                break;
            case 'error':
                $response = $this->clientErrorResponse()->getContent();
                break;

        }

        return json_decode($response,true);

    }


}