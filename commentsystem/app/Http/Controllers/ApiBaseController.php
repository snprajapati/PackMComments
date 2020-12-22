<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiBaseController extends Controller
{
    private $response = [
        'status_code' => null,
        'data'  => null,
        'message'   => null
    ];
    
    /**
     * errorResponse
     *
     * @param  mixed $data
     * @param  mixed $message
     * @param  mixed $statusCode
     * @return void
     */
    public function errorResponse($response, $statusCode = 500)
    {
        $this->response['status_code'] = $statusCode;
        $this->response['data'] = $response['data'];
        $this->response['message'] = $response['message'];

        return response()->json($this->response, $statusCode);
    }
    
    /**
     * successResponse
     *
     * @param  mixed $data
     * @param  mixed $message
     * @return void
     */
    public function successResponse($response)
    {
        $this->response['status_code'] = 200;
        $this->response['data'] = $response['data'];
        $this->response['message'] = $response['message'];

        return response()->json($this->response,200);
    }
}
