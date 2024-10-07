<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Property;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('property.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $member = new Property;
        $member->property_name = $request['property_name'];
        $member->property_type = $request['property_type'];
        $member->location = $request['location'];
        $member->price = $request['price'];
        $member->area = $request['area'];
        $member->status = $request['status'];
        $member->description = $request['description'];
        $dateImg = [];
        $randomText  = time();
        if($request->hasFile('img')){
            $imagefile = $request->file('img');

            foreach ($imagefile as $image) {
              $data =   $image->move(public_path().'/img/product',$randomText."".$image->getClientOriginalName());
              $dateImg[] =  $randomText."".$image->getClientOriginalName();
            }
        }
        $member->img = json_encode($dateImg);
        $member->save();
    return redirect('home')->with('message', "บันทึกสำเร็จ" );
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
        $member = Property::find($id);
        return view('property.edit',['member' => $member]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $member =  Property::find($id);
        $member->property_name = $request['property_name'];
        $member->property_type = $request['property_type'];
        $member->location = $request['location'];
        $member->price = $request['price'];
        $member->area = $request['area'];
        $member->status = $request['status'];
        $member->description = $request['description'];
        $dateImg = [];
        $randomText  = time();
        if($request->hasFile('img')){
            $img = json_decode($member->img);

            foreach( $img as $image) {
                $image_path = public_path().'/img/product/'.$image;
                if (file_exists($image_path)) {
                    // ถ้ามีไฟล์อยู่จริง จึงลบ
                    unlink($image_path);
                }
            }
            $imagefile = $request->file('img');

            foreach ($imagefile as $image) {
              $data =   $image->move(public_path().'/img/product',$randomText."".$image->getClientOriginalName());
              $dateImg[] =  $randomText."".$image->getClientOriginalName();
            }

            $member->img = json_encode($dateImg);
        }
       
        $member->save();
    return redirect('home')->with('message', "บันทึกสำเร็จ" );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $member = Property::find($id);
        $img = json_decode($member->img);

        foreach( $img as $image) {
            $image_path = public_path().'/img/product/'.$image;
            if (file_exists($image_path)) {
                // ถ้ามีไฟล์อยู่จริง จึงลบ
                unlink($image_path);
            }
        }
        $member->delete();
        return redirect('home')->with('message', "ลบสำเร็จ" );
    }
}