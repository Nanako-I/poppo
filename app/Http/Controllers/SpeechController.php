<?php

namespace App\Http\Controllers;

use App\Models\Speech;
use App\Models\Person;
use Illuminate\Http\Request;
// use Google\Cloud\Speech\V1\SpeechClient;
// use Google\Cloud\Speech\V1\RecognitionConfig;
// use Google\Cloud\Speech\V1\RecognitionConfig\AudioEncoding;
// use Google\Cloud\Speech\V1\StreamingRecognitionConfig;
// use Google\Cloud\Speech\V1\StreamingRecognizeRequest;

class SpeechController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $speech = Speech::all();
        // ('people')に$peopleが代入される
        
        // 'people'はpeople.blade.phpの省略↓　// compact('people')で合っている↓
        return view('people',compact('speech'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create(Request $request)
    {
        $storeData = $request->validate([
            // 'temperature' => 'required|max:255',
            // 'people_id' => 'required|exists:people,id',
        ]);
        // バリデーションした内容を保存する↓
        
        $speech = Speech::create([
        'people_id' => $request->people_id,
        'morning_activity' => $request->morning_activity,
        'afternoon_activity' => $request->afternoon_activity,
        
         
    ]);
    // return redirect('people/{id}/edit');
//   $person = Person::findOrFail($request->people_id);
   $people = Person::all();
    // return redirect()->route('speech.edit', ['people_id' => $person->id]);
    // return view('people', ['people' => Person::all()]);
    return view('people', compact('speech', 'people'));
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
            // 'temperature' => 'required|max:255',
            // 'people_id' => 'required|exists:people,id',
        ]);
        // バリデーションした内容を保存する↓
        
        $speech = Speech::create([
        'people_id' => $request->people_id,
        'morning_activity' => $request->morning_activity,
        'afternoon_activity' => $request->afternoon_activity,
        
         
    ]);
    // return redirect('people/{id}/edit');
//   $person = Person::findOrFail($request->people_id);
   $people = Person::all();
    // return redirect()->route('speech.edit', ['people_id' => $person->id]);
    // return view('people', ['people' => Person::all()]);
    return view('people', compact('speech', 'people'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Speech  $speech
     * @return \Illuminate\Http\Response
     */
   public function show($people_id)
{
    $person = Person::findOrFail($people_id);
    $speeches = $person->speeches;

    $people = Person::all(); // ここで $people を取得

    return view('morningspeech', ['id' => $person->id],compact('person'));
    // return view('morningspeechedit', ['id' => $person->id],compact('person'));
    // return view('people', compact('speeches', 'people'));

    
    // $temperature = Temperature::findOrFail($id);

    // return view('temperaturelist', compact('temperature'));
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Speech  $speech
     * @return \Illuminate\Http\Response
     */
     public function edit($people_id)
{
    $person = Person::findOrFail($people_id);
    $speeches = $person->speeches;

    $people = Person::all(); // ここで $people を取得

    return view('afternoonspeech', ['id' => $person->id],compact('person'));
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Speech  $speech
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Speech $speech)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Speech  $speech
     * @return \Illuminate\Http\Response
     */
    public function destroy(Speech $speech)
    {
        //
    }
}