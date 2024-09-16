<?php

namespace App\Http\Controllers;

use App\Models\Record;

use App\Models\Time;

use App\Models\Temperature;
use App\Models\Bloodpressure;
use App\Models\Toilet;
use App\Models\Water;
use App\Models\Medicine;
use App\Models\Tube;
use App\Models\Kyuuin;
use App\Models\Hossa;
use App\Models\Food;
use App\Models\Speech;
use App\Models\Training;
use App\Models\Lifestyle;
use App\Models\Creative;
use App\Models\Activity;
use App\Models\Dompdf;
use App\Models\Person;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Validator;


class DompdfController extends Controller
{
   public function generatePDF($people_id)
    {
        $person = Person::findOrFail($people_id);
        $times = Time::where('people_id', $people_id)->get();
        $temperatures = Temperature::where('people_id', $people_id)->get();
        $toilets = Toilet::where('people_id', $people_id)->get();
        $foods = Food::where('people_id', $people_id)->get();
        $speeches = Speech::where('people_id', $people_id)->get();
        $trainings = Training::where('people_id', $people_id)->get();
        $lifestyles = Lifestyle::where('people_id', $people_id)->get();
        $creatives = Creative::where('people_id', $people_id)->get();
        $activities = Activity::where('people_id', $people_id)->get();
        

        $pdf = PDF::loadView('recordedit', compact('person', 'times', 'temperatures', 'toilets', 'foods', 'speeches', 'trainings', 'lifestyles', 'creatives', 'activities'));
       
    }
    public function record(){
        return view('record');
    }
    
    public function store($people_id,Request $request)
    {
        $storeData = $request->validate([
            'hanko_name' => 'required', // 必須バリデーションを追加
        ]);
        // バリデーションした内容を保存する↓
        
        $hanko = Dompdf::create([
        'people_id' => $request->people_id,
        'hanko_name' => trim($request->hanko_name), // trim() を使用して空白を削除
        'kiroku_date' => $request->kiroku_date,
    ]);
    
      $person = Person::findOrFail($people_id);
      $selectedDate = $request->kiroku_date; // kiroku_date を取得する
      // created_atカラムの値から日付を取得する
      $hankoDate = $hanko->created_at->format('Y-m-d');
      $hankoName = $request->hanko_name; // hanko_name を取得する
     
      
      $lastTemperature = Temperature::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->latest()
        ->first();
        
        $lastToilet = Toilet::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->latest()
        ->first();
        
        $lastFood = Food::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->latest()
        ->first();
        
        $lastTraining = Training::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        // ->whereNotNull('morning_activity')
        ->latest()
        ->first();
    
        $lastLifestyle = Lifestyle::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        // ->whereNotNull('morning_activity')
        ->latest()
        ->first();
        
        $lastCreative = Creative::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        // ->whereNotNull('morning_activity')
        ->latest()
        ->first();
    
    
        $lastActivity = Activity::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        // ->whereNotNull('morning_activity')
        ->latest()
        ->first();
  return view('recorddownload', compact('person', 'hanko',  'hankoName', 'hankoDate','lastTemperature', 'lastToilet', 'lastFood', 'lastTraining', 'lastLifestyle', 'lastCreative', 'lastActivity', 'selectedDate'));
    
    }
    
    public function sanitizeUTF8($value)
    {
        // 不完全なマルチバイト文字を修正する
        // iconv() を使用して不完全なマルチバイト文字列を修正する
    return iconv(mb_detect_encoding($value, mb_detect_order(), true), 'UTF-8//IGNORE', $value);

    }
    
    public function pdf($people_id,Request $request)
    {
        
    $person = Person::findOrFail($people_id);
        // $people_id は既にメソッドの引数として渡されているため、不要
    // $people_id = $request->input('people_id'); // これは不要
    $selectedDate = $request->input('selected_date');
        
        // その日に登録された全ての体温データを取得
        $temperaturesOnSelectedDate = Temperature::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->orderBy('created_at')
        ->get();
        
        $bloodPressuresOnSelectedDate = Bloodpressure::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->orderBy('created_at')
        ->get();

        $watersOnSelectedDate = Water::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->orderBy('created_at')
        ->get();

        $medicinesOnSelectedDate = Medicine::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->orderBy('created_at')
        ->get();

        $tubesOnSelectedDate = Tube::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->orderBy('created_at')
        ->get();

        $kyuuinsOnSelectedDate = Kyuuin::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->orderBy('created_at')
        ->get();

        $hossasOnSelectedDate = Hossa::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->orderBy('created_at')
        ->get();

        $toiletsOnSelectedDate = Toilet::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->orderBy('created_at')
        ->get();

        $foodsOnSelectedDate = Food::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->orderBy('created_at')
        ->get();
     
        $lastTraining = Training::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->latest()
        ->first();
 
 
    
        $lastLifestyle = Lifestyle::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->latest()
        ->first();
    
        $lastCreative = Creative::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->latest()
        ->first();
 
    
        $lastActivity = Activity::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        ->latest()
        ->first();
        // $lastActivityValue = $lastActivity ? json_decode($lastActivity->value) : null;
        $today = 'today';
        $hankoName = $person->pdfs->last();

        // レコードデータを使用してビューを読み込む
    $pdf = PDF::loadView('record_pdf', compact('person', 'temperaturesOnSelectedDate','bloodPressuresOnSelectedDate','watersOnSelectedDate','medicinesOnSelectedDate','tubesOnSelectedDate','kyuuinsOnSelectedDate','hossasOnSelectedDate','toiletsOnSelectedDate', 'foodsOnSelectedDate', 'lastTraining', 'lastLifestyle', 'lastCreative', 'lastActivity', 'selectedDate', 'today', 'hankoName'));


        // PDFファイルをプレビュー
        // return $pdf->stream('recordfile.pdf');

        // PDFファイルをダウンロード
        return $pdf->download('記録表.pdf');
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

    $lastTraining = Training::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        // ->whereNotNull('morning_activity')
        ->latest()
        ->first();
    
        $lastLifestyle = Lifestyle::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        // ->whereNotNull('morning_activity')
        ->latest()
        ->first();
        
        $lastCreative = Creative::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        // ->whereNotNull('morning_activity')
        ->latest()
        ->first();
    
    
        $lastActivity = Activity::where('people_id', $people_id)
        ->whereDate('created_at', $selectedDate)
        // ->whereNotNull('morning_activity')
        ->latest()
        ->first();

        return view('recordedit', compact('person', 'lastTemperature', 'lastBloodPressure', 'lastToilet', 'lastFood', 'lastMorningActivity', 'lastAfternoonActivity',  'lastTraining', 'lastLifestyle', 'lastCreative', 'lastActivity', 'selectedDate'));
    }

};

