<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ActivateResendRequest;
use App\Events\Auth\UserRequestedActivationEmail;

class ActivationResendController extends Controller
{
    public function index()
    {
        return view('auth.activation.resend.index');
    }

    public function store(ActivateResendRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!optional($user)->activated) {
            event(new UserRequestedActivationEmail($user));
        }


        return redirect()->route('login')->withSuccess('An activation email has been sent.');
    }
}
