<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Shift;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $news=News::with('shift')->get();
        return view('dashboard.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $shifts=Shift::get();
        return view('dashboard.news.create', compact('shifts'));
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
            'description' => 'required',
            'shift_id' => 'required',

        ], [],["name" => 'اسم التصنيف', 'description' => 'تفاصيل الخبر' , 'shift_id'=>'تصنيف الخبر']);
        //
        $new= new News();
        $new->name = $request->name;
        $new->description = $request->description;
        $new->shift_id = $request->shift_id;

        $new->save();
        return redirect()->back()->with('message', 'تم اضافة الخبر بنجاح');
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
        $news=News::find($id);
        $shifts=Shift::get();
        return view('dashboard.news.create', compact('news', 'shifts'));
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
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'shift_id' => 'required',

        ], [],["name" => 'اسم التصنيف', 'description' => 'تفاصيل الخبر' , 'shift_id'=>'تصنيف الخبر']);
        //
        $new= News::find($id);
        $new->name = $request->name;
        $new->description = $request->description;
        $new->shift_id = $request->shift_id;

        $new->save();
        return redirect()->back()->with('message', 'تم تعديل الخبر بنجاح');
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
        $news=News::find($id);
        $news->delete();
        return redirect()->back()->with('message', 'تم حذف الخبر بنجاح');
    }
}
