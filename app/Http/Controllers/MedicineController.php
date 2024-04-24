<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\User;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //   / 全件データ取得して一覧表示する↓
        // $people は変数名　Person::でPersonモデルにアクセスする
        $medicine = Medicine::all();
        // ('people')に$peopleが代入される
        
        // 'people'はpeople.blade.phpの省略↓　// compact('people')で合っている↓
        return view('people',compact('medicine'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
{
    $person = Person::findOrFail($request->people_id);
    return redirect()->route('medicine.edit', ['people_id' => $person->id]);
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
        
        $medicine = Medicine::create([
        'people_id' => $request->people_id,
        'user_id_medicine' => $request->user_id_medicine,
        'created_at' => $request->created_at,
        'medicine' => $request->medicine,
        'medicine_bikou' => $request->medicine_bikou,
        'updated_at' => $request->updated_at, 
    ]);
    // return redirect('people/{id}/edit');
    $people = Person::all();
     // 二重送信防止
    $request->session()->regenerateToken();

    return view('people', compact('medicine', 'people'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function show($id)
{
    
    $person = Person::findOrFail($id);
    $medicines = $person->medicines;

    return view('people', compact('medicines'));
    
    
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $people_id)
{
   
    $person = Person::findOrFail($people_id);
    $today = \Carbon\Carbon::now()->toDateString();
    $selectedDate = $request->input('selected_date', Carbon::now()->toDateString());
    $selectedDateStart = Carbon::parse($selectedDate)->startOfDay();
    $selectedDateEnd = Carbon::parse($selectedDate)->endOfDay();

    $medicinesOnSelectedDate = $person->medicines->whereBetween('created_at', [$selectedDateStart, $selectedDateEnd]);
    return view('medicineedit', compact('person', 'selectedDate', 'medicinesOnSelectedDate'));
}

public function change(Request $request, $people_id, $id)
    {
        // ユーザーを取得
        $user = User::findOrFail($people_id);
        // ユーザーが持つ体温の記録からユーザーIDを取得
        $user_id = $user->id;
    
        // すべてのユーザーを取得
        $users = User::all();
        $person = Person::findOrFail($people_id);
        $medicine = Medicine::findOrFail($id);
        return view('medicinechange', compact('person', 'medicine','users'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medicine $medicine)
    {
    //データ更新
        $medicine = Medicine::find($request->id);
        $form = $request->all();
        $medicine->fill($form)->save();
    
        $request->session()->regenerateToken();
    
        $people = Person::all();
        // 二重送信防止
        $request->session()->regenerateToken();
        return view('people', compact('medicine', 'people'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $medicine = Medicine::find($id);
    if ($medicine) {
        $medicine->delete();
    }
        return redirect()->route('people.index');
    }
}
