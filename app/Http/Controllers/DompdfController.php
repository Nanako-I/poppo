<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\Time;
use App\Models\Temperature;
use App\Models\Toilet;
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
        // バリデーションルールを定義
        // $rules = [
        //     'input_field' => 'required|string|utf8',
        // ];

        // バリデータを作成
        // $validator = Validator::make($request->all(), $rules);
        
    $person = Person::findOrFail($people_id);
        // $people_id は既にメソッドの引数として渡されているため、不要
    // $people_id = $request->input('people_id'); // これは不要
    $selectedDate = $request->input('selected_date');
    
        
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
        // $lastActivityValue = $lastActivity ? json_decode($lastActivity->value) : null;
        $today = 'today';
        //  $hankoName = $request->input('hanko_name');
        $hankoName = $person->pdfs->last();

        // レコードデータを使用してビューを読み込む
    $pdf = PDF::loadView('record_pdf', compact('person', 'lastTemperature', 'lastToilet', 'lastFood', 'lastTraining', 'lastLifestyle', 'lastCreative', 'lastActivity', 'selectedDate', 'today', 'hankoName'));


        // PDFファイルをダウンロード
        // return $pdf->download('recordfile.pdf');
        return $pdf->stream('title.pdf');
        // return view('record_pdf', compact('person', 'lastTemperature', 'lastToilet', 'lastFood', 'lastTraining', 'lastLifestyle', 'lastCreative', 'lastActivity', 'selectedDate', 'today', 'hankoName'));
}
    
    public function show($people_id, Request $request)
    {
         
    $person = Person::findOrFail($people_id);
    $selectedDate = $request->input('selected_date');
    
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

        return view('recorddownload', compact('person', 'lastTemperature', 'lastToilet', 'lastFood', 'lastTraining', 'lastLifestyle', 'lastCreative', 'lastActivity', 'selectedDate'));
        
        
    }

};