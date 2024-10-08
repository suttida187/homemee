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
    
    if ($search) {
        // ดึงข้อมูลที่ตรงกับคำค้นหาจากฟิลด์ที่กำหนด
        $query = $query->where('first_name', 'LIKE', "%$search%")
                       ->orWhere('last_name', 'LIKE', "%$search%")
                       ->orWhere('phone_number', 'LIKE', "%$search%")
                       ->orWhere('email', 'LIKE', "%$search%")
                       ->get();
    } else {
        // ถ้าไม่มีการค้นหาให้ดึงข้อมูลทั้งหมด
        $query = $query->get();
    }

    return view('agent.index', compact('query'));
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
        $query = DB::table('agents')
            ->where('id',  $id)
            ->get();
        return view('agent.edit', compact('query'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255', // เพิ่มการตรวจสอบนี้
        ]/* ,[
            'email' => 'อีเมล'
        ] */);

        DB::table('agents')->where('id', $id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
        ]);

        // ส่งกลับหลังจากอัปเดต
        return redirect('agent-index')->with('message', "อัพเดททำเร็จ" );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('agents')->where('id', $id)->delete();

        return redirect('agent-index')->with('message', 'ข้อมูลถูกลบเรียบร้อยแล้ว');
    }
}
