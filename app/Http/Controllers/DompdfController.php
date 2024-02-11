<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\Temperature;
use App\Models\Bloodpressure;
use App\Models\Toilet;
use App\Models\Food;
use App\Models\Speech;
use App\Models\Person;
use Illuminate\Http\Request;
use PDF;


class DompdfController extends Controller
{
   public function generatePDF($people_id)
    {
        $person = Person::findOrFail($people_id);
        $temperatures = Temperature::where('people_id', $people_id)->get();
        $toilets = Toilet::where('people_id', $people_id)->get();
        $foods = Food::where('people_id', $people_id)->get();
        $speeches = Speech::where('people_id', $people_id)->get();

        $pdf = PDF::loadView('recordedit', compact('person', 'temperatures', 'toilets', 'foods', 'speeches'));
       
        // return redirect()->route('outputPDF.edit', compact('person', 'temperatures', 'toilets', 'foods', 'speeches'));
    }
    public function record(){
        return view('record');
    }
    // public function pdf(){
    //     $records=Record::all();
    //     $pdf=PDF::loadView('record_pdf', compact('records'));
    //     return $pdf->download('recordfile.pdf');
    // } 
    
    public function pdf($people_id,Request $request)
    {
    $person = Person::findOrFail($people_id);
        // $people_id は既にメソッドの引数として渡されているため、不要
    // $people_id = $request->input('people_id'); // これは不要
    $selectedDate = $request->input('selected_date');
    // dd($selectedDate);←日付は取れてる

    // $person を取得する処理を追加
    // $person = Person::findOrFail($people_id);

        // 選択された日付と人物に基づくデータを取得
        // 実際のデータ構造に基づいてこれを調整する必要があります
        // $recordData = Record::where('people_id', $people_id)
        //     ->whereDate('created_at', $selectedDate)
        //     ->get();
        $lastFood = Food::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->latest()
        ->first();
    
    $lastTemperature = Temperature::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->latest()
        ->first();
        
    $lastBloodPressure = Bloodpressure::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->latest()
        ->first();
        
    $lastToilet = Toilet::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->latest()
        ->first();
    
    $lastMorningActivity = Speech::where('people_id', $people_id)
    ->whereDate('created_at', $selectedDate)
    ->whereNotNull('morning_activity')
    ->latest()
    ->first();

    $lastAfternoonActivity = Speech::where('people_id', $people_id)
    ->whereDate('created_at', $selectedDate)
    ->whereNotNull('afternoon_activity')
    ->latest()
    ->first();
//         $recordData = [
//     'lastFood' => Food::where('people_id', $people_id)
//         ->whereDate('created_at', $selectedDate)
//         ->latest()
//         ->first(),
//     'lastTemperature' => Temperature::where('people_id', $people_id)
//         ->whereDate('created_at', $selectedDate)
//         ->latest()
//         ->first(),
//     'lastBloodPressure' => Bloodpressure::where('people_id', $people_id)
//         ->whereDate('created_at', $selectedDate)
//         ->latest()
//         ->first(),
//     'lastToilet' => Toilet::where('people_id', $people_id)
//         ->whereDate('created_at', $selectedDate)
//         ->latest()
//         ->first(),
//     'lastMorningActivity' => Speech::where('people_id', $people_id)
//         ->whereDate('created_at', $selectedDate)
//         ->whereNotNull('morning_activity')
//         ->latest()
//         ->first(),
//     'lastAfternoonActivity' => Speech::where('people_id', $people_id)
//         ->whereDate('created_at', $selectedDate)
//         ->whereNotNull('afternoon_activity')
//         ->latest()
//         ->first(),
// ];


        // レコードデータを使用してビューを読み込む
    // $pdf = PDF::loadView('record_pdf', compact('recordData', 'person', 'selectedDate'));
    $pdf = PDF::loadView('record_pdf', compact('person', 'lastTemperature', 'lastBloodPressure', 'lastToilet', 'lastFood', 'lastMorningActivity', 'lastAfternoonActivity', 'selectedDate'));


        // PDFファイルをダウンロード
        return $pdf->download('recordfile.pdf');
        //  return view('recordedit', compact('person', 'lastTemperature', 'lastBloodPressure', 'lastToilet', 'lastFood', 'lastMorningActivity', 'lastAfternoonActivity', 'selectedDate'));
}
    
    public function show($people_id, Request $request)
    {
        $person = Person::findOrFail($people_id);
    $selectedDate = $request->input('selected_date');
    
    $lastFood = Food::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->latest()
        ->first();
    
    $lastTemperature = Temperature::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->latest()
        ->first();
        
    $lastBloodPressure = Bloodpressure::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->latest()
        ->first();
        
    $lastToilet = Toilet::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->latest()
        ->first();
    
    $lastMorningActivity = Speech::where('people_id', $people_id)
    ->whereDate('created_at', $selectedDate)
    ->whereNotNull('morning_activity')
    ->latest()
    ->first();

    $lastAfternoonActivity = Speech::where('people_id', $people_id)
    ->whereDate('created_at', $selectedDate)
    ->whereNotNull('afternoon_activity')
    ->latest()
    ->first();

        return view('recordedit', compact('person', 'lastTemperature', 'lastBloodPressure', 'lastToilet', 'lastFood', 'lastMorningActivity', 'lastAfternoonActivity', 'selectedDate'));
    }

};

