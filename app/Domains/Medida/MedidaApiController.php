<?php

namespace App\Domains\Medida;

use App\Http\Controllers\Controller;

class MedidaApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getMedidas()
    {
        return response()->json(Medida::all());
    }
}