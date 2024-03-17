<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\User;
use App\Models\Medicine;
use Illuminate\Http\Request;

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
        'created_at_medicine' => $request->created_at_medicine,
        'medicine' => $request->medicine,
        'medicine_bikou' => $request->medicine_bikou,
        'updated_at' => $request->updated_at, 
    ]);
    // return redirect('people/{id}/edit');
     $people = Person::all();
//   $person = Person::findOrFail($request->people_id);
    // return redirect()->route('toilet.edit', ['people_id' => $person->id]); //
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
    
    // $temperature = Temperature::findOrFail($id);

    // return view('temperaturelist', compact('temperature'));
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
    return view('medicineedit', ['id' => $person->id],compact('person'));
}

public function change(Request $request, $people_id)
    {
        $person = Person::findOrFail($people_id);
        $lastMedicine = $person->medicines->last();
        
        return view('medicinechange', compact('person', 'lastMedicine'));
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
        $person = Person::find($request->people_id);
        $user_medicine = User::find($request->user_id_medicine);
        $medicine->people_id = $person->id;
        $medicine->user_id_medicine = $user_medicine->id;
        $medicine->medicine = $request->medicine;
        $medicine->medicine_bikou = $request->medicine_bikou;
        $medicine->created_at_medicine = $request->created_at_medicine;
        $medicine->save();
        
        $people = Person::all();
        
        return view('people', compact('medicine', 'people'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food $food)
    {
        //
    }
}
