<?php

namespace App\Http\Controllers\Voyager\http;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Http\Controllers\VoyagerController as BaseVoyagerController;

class VoyagerController extends BaseVoyagerController
{
    public function index()
    {
        return view('modules.auth.login');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
