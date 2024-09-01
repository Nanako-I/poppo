<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CustomID;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CustomIDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        $custom_id = CustomID::all();
        return view('custom_id_entryform');
    }

    
  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $facilityId)
    {
        // バリデーションルールを定義
        $rules = [
            'custom_id' => 'required|string|max:255',
        ];

        // バリデーションを実行
        $validator = Validator::make($request->all(), $rules);

        // バリデーションが失敗した場合の処理
        if ($validator->fails()) {
            return redirect()->route('custom_id.store', ['facilityId' => $facilityId])
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'IDの登録が失敗しました');
        }

        $user = auth()->user();
        $facilities = $user->facility_staffs()->get();
        $firstFacility = $facilities->first();
        $facilityId = $firstFacility->id;

        // $firstFacilityがnullでないか確認
        if (!$firstFacility) {
            return redirect()->back()->withErrors('施設が見つかりませんでした。');
        }
        // カスタムIDが既に存在するかどうかをチェック
        $existingCustomID = CustomID::where('custom_id', $request->custom_id)
            ->where('facility_id', $facilityId)
            ->first();

        if ($existingCustomID) {
            return redirect()->route('custom_id.store', ['facilityId' => $facilityId])->with('error', 'すでにこのIDは登録されています。');
        }

        // 新しいカスタムIDを作成
        $newCustomID = CustomID::create([
            'custom_id' => $request->custom_id,
            'facility_id' => $facilityId,
            'created_at' => $request->created_at,
            'updated_at' => $request->updated_at,
        ]);

        $staff_id = CustomID::all();
        
        if ($existingCustomID) {
        return redirect()->route('custom_id.entryform', ['facilityId' => $facilityId])
        ->with('error', 'すでにこのIDは登録されています。');
        }
        
        
        $request->session()->regenerateToken();
        
        $allCustomID = CustomID::where('facility_id', $facilityId)->get();
        return view('custom_id_entryform', compact('newCustomID', 'staff_id', 'facilityId', 'allCustomID'));
    }
    // if ($user_roles->isNotEmpty()) {
    //         return redirect(RouteServiceProvider::HOMEFAMILY);
    //     }
    
    //         // 上記のいずれの条件にも該当しない場合のデフォルトのリダイレクト
    //         return redirect()->route('hogoshalogin')->with('error', 'ご家族の方以外はこちらのフォームからログインできません。');
    //     }
        
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
//     public function entryForm()
// {
//     $user = auth()->user();
//     // facility_staffsメソッドからuserの情報をゲットする↓
//     $facilities = $user->facility_staffs()->get();
//     $firstFacility = $facilities->first();
//     // dd($firstFacility);
    
    
//     return view('custom_id_entryform');
// }
 public function entryForm(Request $request, $id)
{
    $user = auth()->user();
    // facility_staffsメソッドからuserの情報をゲットする↓
    $facilities = $user->facility_staffs()->get();
    $firstFacility = $facilities->first();
    $facilityId = $firstFacility->id; // $firstFacilityのIDを取得
    // dd($facilityId);
    $CustomID = CustomID::findOrFail($id);
    $selectedDate = $request->input('selected_date', \Carbon\Carbon::now()->toDateString());

    // 日付でフィルタリングせずにすべてのID記録を取得
    // $allCustomID = DB::table('custom_ids')->get();
    $allCustomID = DB::table('custom_ids')
        ->where('facility_id', $facilityId)
        ->get();


    
    return view('custom_id_entryform', compact('selectedDate', 'facilityId', 'allCustomID'));
}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
//     public function edit(Request $request, $id)
// {
//     $newCustomID = CustomID::findOrFail($id);
//     $today = \Carbon\Carbon::now()->toDateString();
    
//     return view('custom_id_edit', compact('newCustomID'));
// }

public function edit(Request $request, $id)
{
    $user = auth()->user();
    // facility_staffsメソッドからuserの情報をゲットする↓
    $facilities = $user->facility_staffs()->get();
    $firstFacility = $facilities->first();
    $facilityId = $firstFacility->id; // $firstFacilityのIDを取得
 
    $CustomID = CustomID::findOrFail($id);
    $selectedDate = $request->input('selected_date', \Carbon\Carbon::now()->toDateString());
    // $allCustomID = DB::table('custom_ids')->get();
    // custom_idsテーブルから該当するfacility_idのカスタムIDを取得
    $allCustomID = DB::table('custom_ids')
        ->where('facility_id', $facilityId)
        ->get();

    return view('custom_id_entryform', compact( 'selectedDate', 'facilityId', 'allCustomID'));
}


// public function change(Request 

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
   
    
    


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $newCustomID = CustomID::find($id);
    if ($newCustomID) {
        $newCustomID->delete();
    }
    $user = auth()->user();
    // facility_staffsメソッドからuserの情報をゲットする↓
    $facilities = $user->facility_staffs()->get();
    $firstFacility = $facilities->first();
    $facilityId = $firstFacility->id; // $firstFacilityのIDを取得
        // return redirect()->route('custom_id.store');
        return redirect()->route('custom_id.store', ['facilityId' => $facilityId]);
    }
}
