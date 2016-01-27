<?php

namespace Knoters\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    public function successResponse($data)
    {
        return [
            'data' => $data

        ];
    }

    public function errorResponse(\Exception $e)
    {
        $message = session('exception', $e->getMessage());

        session()->forget('exception');

        return [
            'errors' => [
                [
                    'code'   => $e->getCode(),
                    'status' => 500,
                    'title'  => $message
                ]
            ]
        ];
    }
}
