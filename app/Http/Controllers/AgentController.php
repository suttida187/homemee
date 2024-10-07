<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agent;
use Illuminate\Support\Facades\DB;

class AgentController extends Controller

{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $query = DB::table('agents');
        if ($request->all()) {
            $query = $query
                ->where('first_name', 'LIKE', "%$search%")
                ->orWhere('last_name', 'LIKE', "%$search%")
                ->orWhere('phone_number', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%")
                ->get();
        } else {
            $query = $query
                ->get();
        }
        return view('agent.index',compact('query'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('agent.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $member = new Agent;
        $member->first_name = $request['first_name'];
        $member->last_name = $request['last_name'];
        $member->phone_number = $request['phone_number'];
        $member->email = $request['email'];
        $member->save();
    return redirect('agent-index')->with('message', "บันทึกสำเร็จ" );
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
