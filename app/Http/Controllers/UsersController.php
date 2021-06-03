<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Shift;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule as ValidationRule;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users=User::with('shift')->orderBy('id', 'DESC')->get();
        return view('dashboard.users.index', compact('users'));

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
        return view('dashboard.users.create', compact('shifts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:users|max:100',
            'email' => 'required|unique:users|email',
            'password' => 'required|same:conf_password|min:6',
            'conf_password' => 'required',

        ], [],["name" => 'اسم المستخدم', 'email' => 'البريد الالكتروني','password'=>'كلمة المرور', 'conf_password'=>'تاكيد كلمة المرور  ' ]);
        //
        $user= new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->email_verified_at=date('Y-m-d H:i:s');
        $user->password=Hash::make($request->password);

        $user->save();
        return redirect()->back()->with('message', 'تم اضافة المستخدم بنجاح');
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
        $user=User::find($id);
        $shifts=Shift::get();
        return view('dashboard.users.create', compact('user', 'shifts'));
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
        $validated = $request->validate([
            'name' =>  ['required', ValidationRule::unique('users')->ignore($id), 'max:100'],
            'email' => ['required', ValidationRule::unique('users')->ignore($id)],
            'password' => 'nullable|same:conf_password|min:6',
            //'conf_password' => 'required',

        ], [],["name" => 'اسم المستخدم', 'email' => 'البريد الالكتروني','password'=>'كلمة المرور', 'conf_password'=>'تاكيد كلمة المرور  ' ]);
        //
        $user= User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password){
            $user->password=Hash::make($request->password);
        }
        $user->save();
        return redirect()->back()->with('message', 'تم تعديل المستخدم بنجاح');
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
        $user=User::find($id);
        $user->delete();
        return redirect()->back()->with('message', 'تم حذف المستخدم بنجاح');
    }
}
