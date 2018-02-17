<?php

namespace App\Http\Controllers\Admin;

use App\Pipe;
use App\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PipeStoreRequest;

class PipeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pipes = Pipe::with('department')->get();
        return view('admin.pipes.index', compact('pipes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all()->pluck('name', 'id');
        return view('admin.pipes.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\PipeStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PipeStoreRequest $request)
    {
        Pipe::create([
            'server'        => request('server'),
            'username'      => request('username'),
            'password'      => encrypt(request('password')),
            'department_id' => request('department_id')
        ]);

        return redirect(route('admin.pipes.index'))->withSuccess('Pipe created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pipe  $pipe
     * @return \Illuminate\Http\Response
     */
    public function show(Pipe $pipe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pipe  $pipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Pipe $pipe)
    {
        $departments = Department::all()->pluck('name', 'id');
        return view('admin.pipes.edit', compact('pipe', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\PipeStoreRequest  $request
     * @param  \App\Pipe  $pipe
     * @return \Illuminate\Http\Response
     */
    public function update(PipeStoreRequest $request, Pipe $pipe)
    {
        $pipe->update([
            'server'        => request('server'),
            'username'      => request('username'),
            'password'      => encrypt(request('password')),
            'department_id' => request('department_id')
        ]);

        return redirect(route('admin.pipes.index'))->withSuccess('Pipe updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pipe  $pipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pipe $pipe)
    {
        //
    }
}
