<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\Person;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trainings = Training::all();
        // $people = Person::with('trainings')->findOrFail($people_id);
    //   $trainings = Training::all();
    // Controller などで Eager Loading を行う
// $people = Person::with('trainings')->get();


        // ('people')に$peopleが代入される
        
        // 'people'はpeople.blade.phpの省略↓　// compact('people')で合っている↓
        return view('people',compact('trainings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
{
    $person = Training::findOrFail($request->people_id);
    return redirect()->route('training.edit', ['people_id' => $person->id]);
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
        // バリデーションルールを追加
    ]);

    // チェックボックスのデータをJSON形式に変換
    $communication = json_encode($request->input('communication', []));
    $exercise = json_encode($request->input('exercise', []));
    $reading_writing = json_encode($request->input('reading_writing', []));
    $calculation = json_encode($request->input('calculation', []));
    $homework = json_encode($request->input('homework', []));
    $shopping = json_encode($request->input('shopping', []));
    $training_other = json_encode($request->input('training_other', []));

    $training = Training::create([
        'people_id' => $request->people_id,
        'communication' => $communication,
        'exercise' => $exercise,
        'reading_writing' => $reading_writing,
        'calculation' => $calculation,
        'homework' => $homework,
        'shopping' => $shopping,
        'training_other' => $training_other,
        'training_other_sentence' => $request->training_other_sentence,
    ]);

    // 他の処理
$people = Person::all();
    return view('people', compact('training', 'people'));
}


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\training  $training
     * @return \Illuminate\Http\Response
     */
    public function show($people_id)
{
    // $person = Person::with('trainings')->findOrFail($people_id);
    // $trainings = $person->trainings;
    
    $person = Person::findOrFail($people_id);
    $training = $person->trainings;

 
    return view('people',compact('training'));
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\training  $training
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $people_id)
{
    $person = Person::findOrFail($people_id);
    return view('trainingedit', ['id' => $person->id],compact('person'));
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\training  $training
     * @return \Illuminate\Http\Response
     */
     public function change(Request $request, $people_id)
    {
        $person = Person::findOrFail($people_id);
        $lastTraining = $person->trainings->last();
        // $food = Food::all();
      
        // return view('foodchange', ['id' => $person->id, 'foods' => $foods], compact('person'));
        return view('trainingchange', compact('person', 'lastTraining'));
    }
    
    public function update(Request $request, Training $training)
    {
    //  public function update(PostRequest $request, Post $post)
    // {
    
     // チェックボックスのデータをJSON形式に変換
    $communication = json_encode($request->input('communication', []));
    $exercise = json_encode($request->input('exercise', []));
    $reading_writing = json_encode($request->input('reading_writing', []));
    $calculation = json_encode($request->input('calculation', []));
    $homework = json_encode($request->input('homework', []));
    $shopping = json_encode($request->input('shopping', []));
    $training_other = json_encode($request->input('training_other', []));

    $training = Training::create([
        'people_id' => $request->people_id,
        'communication' => $communication,
        'exercise' => $exercise,
        'reading_writing' => $reading_writing,
        'calculation' => $calculation,
        'homework' => $homework,
        'shopping' => $shopping,
        'training_other' => $training_other,
        'training_other_sentence' => $request->training_other_sentence,
    ]);
    
        
        $people = Person::all();
        
        return view('people', compact('training', 'people'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\training  $training
     * @return \Illuminate\Http\Response
     */
    public function destroy(training $training)
    {
        //
    }
}
