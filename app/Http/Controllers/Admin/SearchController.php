<?php

namespace App\Http\Controllers\Admin;

use App\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $response_results = Response::search($request->q)
                                ->paginate(20);

        return view('admin.search.index', compact('response_results'));
    }
}
