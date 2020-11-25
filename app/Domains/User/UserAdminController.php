<?php

namespace App\Domains\User;

use App\Domains\Medida\Medida;
use App\Http\Controllers\Controller;

class UserAdminController extends Controller
{
    public function homeAdminPage()
    {
        $listaMedidas = Medida::all();
        return view('admin.home') ->with([
            'listaMedidas' => $listaMedidas
        ]);
    }
}
