<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\Account\PasswordUpdated;
use App\Http\Requests\Account\PasswordStoreRequest;

class PasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin.password.index');
    }

    public function store(PasswordStoreRequest $request)
    {
        auth()->user()->update([
            'password' => bcrypt($request->password)
        ]);

        Mail::to(auth('admin')->user())->send(new PasswordUpdated());

        return redirect()->route('admin.password.index')
                    ->withSuccess('Password Updated');
    }
}
