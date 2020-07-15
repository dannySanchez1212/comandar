<?php

namespace App\Http\Controllers\Voyager\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\invitation;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreInvitationRequest;

class invitationController extends Controller
{
    public function index(){
        $invitations = invitation::where('registered_at',null)->orderBy('created_at', 'desc')->get();
        return view('user.invitation.index', compact('invitations'));
    }

    public function store(StoreInvitationRequest $request)
    {
    $invitation = new invitation($request->all());
    $invitation->generateInvitationToken();
    $invitation->save();

    return redirect()->route('requestInvitation')
        ->with('success', 'Invitation to register successfully requested. Please wait for registration link.');
    }


}
