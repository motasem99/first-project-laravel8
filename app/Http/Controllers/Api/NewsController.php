<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Validation\Validator;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getNews()
    {
        //
        $news=News::get();
        return response()->json(compact('news'));
        // return view('dashboard.news.index', compact('news'));
    }

    public function addNews(Request $request)
    {
        //
        $validator = FacadesValidator::make($request->all(),[
            'name' => 'required',
            'description' => 'required',
            'shift_id' => 'required',

        ], [],["name" => 'اسم التصنيف', 'description' => 'تفاصيل الخبر' , 'shift_id'=>'تصنيف الخبر']);
        //
        if($validator->fails()){
            return response()->json($validator->messages(),402);
        }
        $new= new News();
        $new->name = $request->name;
        $new->description = $request->description;
        $new->shift_id = $request->shift_id;

        $new->save();
        return redirect()->back()->with('message', 'تم اضافة الخبر بنجاح');
    }

    public function login(Request $request) {
        $user=User::where('email', $request->email)->first();
        if(!$user){
            return response()->json(['message'=>'عذرا هذا الايميل غير صحيح'], 401);
        }
        if(Hash::check($request->password, $user->password)){
            $token = $user->createToken('Laravel Password Grant Client')->accessToken;
            $response = ['token' => $token];
            return response($response, 200);
        } else {
            $response = ['message' => 'عذرا كلمة المرور خطا'];
            return response($response, 422);
        }
    }

}
