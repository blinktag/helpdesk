<?php

namespace App\Http\Controllers\Admin;

use App\Ticket;
use App\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin.dashboard.index');
    }

    public function browse(Department $department)
    {
        if (!$department) {
            return redirect(route('admin.dashboard.browse', 1));
        }

        $departments = Department::all();
        $tickets = Ticket::where('department')->get();
        return view('admin.dashboard.index', compact('departments', 'tickets'));
    }
}
