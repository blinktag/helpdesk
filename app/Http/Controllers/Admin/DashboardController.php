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

    public function browse(Request $request)
    {
        if (!$request->id) {
            $department = Department::first();
            return redirect(route('admin.browse.department', ['id' => $department->id, 'status' => 'open']));
        }

        $status      = $request->status;
        $departments = Department::all();
        $department  = Department::find($request->id);
        $tickets     = Ticket::where('department_id', $request->id)
                        ->where('status', $status)
                        ->paginate(20);

        return view('admin.dashboard.browse', compact('departments', 'tickets', 'department', 'status'));
    }
}
