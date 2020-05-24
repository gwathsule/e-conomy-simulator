<?php

namespace App\Domains\User;

use App\Http\Controllers\Controller;

class UserAdminController extends Controller
{
    public function homeAdminPage()
    {
        return view('admin.home');
    }
}
