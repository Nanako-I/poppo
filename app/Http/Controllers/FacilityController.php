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
//         $user = auth()->user();
// dd($user);
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
            // 'food' => 'required|max:255',
            // 'staple_food' => 'required|max:255',
            // 'side_dish' => 'required|max:255',
            // 'medicine' => 'required|max:255',
        ]);
        // バリデーションした内容を保存する↓
        
        $facility = Facility::create([
        'facility_name' => $request->facility_name,
        'bikou' => $request->bikou,
        
         
    ]);
    
    // $facility->facility_staffs()->sync($request->get('facility_id', []));
    // 中間テーブルへの登録
        // ログインしているユーザーのIDを取得して、関連付ける
    $user = auth()->user();
    $facility->facility_staffs()->attach($user->id);
    
    
    $user->user_roles()->attach(1); // ここでrole_id＝1を紐づける
        // DB::commit();
    // auth()->user()->facility_staffs()->attach($request->facility_id);
//$item->categories()->sync($request->get('category_ids', []));
    // return redirect('people/{id}/edit');
    // $people = Person::all();
    // 二重送信防止
    $request->session()->regenerateToken();
    return redirect('/people'); 
    // return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */



}