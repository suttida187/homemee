<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $query = DB::table('properties');
        if ($request->all()) {
            $query = $query
                ->where('property_name', 'LIKE', "%$search%")
                ->orWhere('property_type', 'LIKE', "%$search%")
                ->orWhere('location', 'LIKE', "%$search%")
                ->orWhere('price', 'LIKE', "%$search%")
                ->get();
        } else {
            $query = $query
                ->get();
        }
        return view('home',compact('query'));
    }
}