<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    // 事業所登録画面を表示
    public function create()
    {
        return view('facilityregister');

    }
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $storeData = $request->validate([
           
        ]);
        // バリデーションした内容を保存する↓
        
        $facility = Facility::create([
        'facility_name' => $request->facility_name,
        'bikou' => $request->bikou,
    ]);
    
    // 中間テーブルへの登録
    // ログインしているユーザーのIDを取得して、関連付ける
    $user = auth()->user();
    $facility->facility_staffs()->attach($user->id);
    
    
    $user->user_roles()->attach(1); // ここでrole_id＝1（staff）を紐づける
    // 二重送信防止
    $request->session()->regenerateToken();
    return redirect('/people'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */



}