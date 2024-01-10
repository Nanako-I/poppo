<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Person;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {
       $report = Report::all();
        // ('people')に$peopleが代入される
        
        // 'people'はpeople.blade.phpの省略↓　// compact('people')で合っている↓
        return view('people',compact('report'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $storeData = $request->validate([
            
        ]);
        // バリデーションした内容を保存する↓
        
        $report = Report::create([
        'people_id' => $request->people_id,
        'report_contents' => $request->report_contents,
       
        
         
    ]);
    // return redirect('people/{id}/edit');
//   $person = Person::findOrFail($request->people_id);
   $people = Person::all();
    
    return view('people', compact('report', 'people'));
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
        
        $report = Report::create([
        'people_id' => $request->people_id,
        'report_contents' => $request->report_contents,
        
         
    ]);
   
   $people = Person::all();
   return view('people', compact('report', 'people'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show($people_id)
{
    $person = Person::findOrFail($people_id);
    $reports = $person->reports;

    $people = Person::all(); // ここで $people を取得

    return view('report', ['id' => $person->id],compact('person'));
    
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit($people_id)
{
    $person = Person::findOrFail($people_id);
    $reports = $person->reports;

    $people = Person::all(); // ここで $people を取得

    return view('report', ['id' => $person->id],compact('person'));
}


    public function change(Request $request, $people_id)
{
    $person = Person::findOrFail($people_id);
    $lastReport = $person->reports->last(); // 最後のSpeechモデルを取得
    $lastReportValue = $lastReport ? $lastReport->report_contents : null;

    return view('reportchange', compact('person', 'lastReportValue'));
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
      //データ更新
        $person = Person::find($request->people_id);
        $report->people_id = $person->id;
        $report->report_contents = $request->report_contents;
        $report->save();
        
        $people = Person::all();
        
        return view('people', compact('report', 'people'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}
