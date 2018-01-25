<?php

namespace App\Http\Controllers\Auth;

use App\ConfirmationToken;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ActivationController extends Controller
{

    protected $redirectTo = '/';

    public function activate(ConfirmationToken $token)
    {
        $token->user->update(['activated' => true]);
        $token->delete();

        Auth::login($token->user);

        return redirect()->intended($this->redirectPath())->withSuccess('You are now signed in');
    }

    public function redirectPath()
    {
        return $this->redirectTo;
    }
}
