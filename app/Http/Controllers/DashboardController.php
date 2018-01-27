<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tickets = Ticket::where('user_id', auth()->user()->id)->get();
        return view('dashboard.index', compact('tickets'));
    }
}
