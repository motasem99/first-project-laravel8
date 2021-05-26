<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;

class ShiftsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $shifts=Shift::get();
        return view('dashboard.shifts.index', compact('shifts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.shifts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'name' => 'required',

        ], [],["name" => 'اسم المستخدم']);
        $shift = new Shift();
        $shift->name=$request->name;
        $shift->start_at=$request->start_at;
        $shift->end_at=$request->end_at;
        $shift->saturday=$request->saturday;
        $shift->sunday=$request->sunday;
        $shift->monday=$request->monday;
        $shift->tuesday=$request->tuesday;
        $shift->wednesday=$request->wednesday;
        $shift->thursday=$request->thursday;
        $shift->friday=$request->friday;

        $shift->save();

        return response()->json(['message'=>"تم اضافة الوردية بنجاح"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
