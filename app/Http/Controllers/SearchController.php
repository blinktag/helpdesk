<?php

namespace App\Http\Controllers;

use App\Response;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $response_results = Response::search($request->q)
                                ->where('user_id', auth()->user()->id)
                                ->paginate(10);

        return view('search.index', compact('response_results'));
    }
}
