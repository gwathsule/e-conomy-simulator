<?php

namespace App\Domains\Governo;

use App\Domains\Governo\Services\StoreGoverno;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GovernoController extends Controller
{
    public function index()
    {
        return Governo::all();
    }

    public function store(Request $request)
    {
        /** @var StoreGoverno $service */
        $service = new StoreGoverno();
        return $service->handle($request->toArray());
    }
}