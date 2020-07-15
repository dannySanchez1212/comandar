<?php

namespace App\Http\Controllers\Voyager;

use TCG\Voyager\Http\Controllers\VoyagerController as BaseVoyagerController;
use Auth;

class VoyagerController extends BaseVoyagerController
{
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

}
