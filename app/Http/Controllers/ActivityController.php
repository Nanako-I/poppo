<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Person;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activity = Activity::all();
        // ('people')に$peopleが代入される
        
        // 'people'はpeople.blade.phpの省略↓　// compact('people')で合っている↓
        return view('people',compact('activity'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
{
    $person = Person::findOrFail($request->people_id);
    return redirect()->route('activity.edit', ['people_id' => $person->id]);
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
    $kadai = json_encode($request->input('kadai', []));
    $rest = json_encode($request->input('rest', []));
    $self_activity_other = json_encode($request->input('self_activity_other', []));
    $recreation = json_encode($request->input('recreation', []));
    $region_exchange = json_encode($request->input('region_exchange', []));
    $group_activity_other = json_encode($request->input('group_activity_other', []));

    $activity = Activity::create([
        'people_id' => $request->people_id,
        'kadai' => $kadai,
        'rest' => $rest,
        'self_activity_other' => $self_activity_other,
        'self_activity_bikou' => $request->self_activity_bikou,
        'recreation' => $recreation,
        'region_exchange' => $region_exchange,
        'group_activity_other' => $group_activity_other,
        'group_activity_bikou' => $request->group_activity_bikou,
    ]);

    // 他の処理
    $people = Person::all();
    return view('people', compact('activity', 'people'));
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show($people_id)
{
    $person = Person::findOrFail($people_id);
    $activity = $person->activities;

    return view('people',compact('activity'));
}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $people_id)
{
    $person = Person::findOrFail($people_id);
    return view('activityedit', ['id' => $person->id],compact('person'));
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function change(Request $request, $people_id)
    {
        $person = Person::findOrFail($people_id);
        $lastActivity = $person->activities->last();
        return view('activitychange', compact('person', 'lastActivity'));
    }
    
    public function update(Request $request, Activity $activity)
    {
    // チェックボックスのデータをJSON形式に変換
    
    $kadai = json_encode($request->input('kadai', []));
    $rest = json_encode($request->input('rest', []));
    $self_activity_other = json_encode($request->input('self_activity_other', []));
    $recreation = json_encode($request->input('recreation', []));
    $region_exchange = json_encode($request->input('region_exchange', []));
    $group_activity_other = json_encode($request->input('group_activity_other', []));
   
    
    $activity = Activity::create([
        'people_id' => $request->people_id,
        'kadai' => $kadai,
        'rest' => $rest,
        'self_activity_other' => $self_activity_other,
        'self_activity_bikou' => $request->self_activity_bikou,
        'recreation' => $recreation,
        'region_exchange' => $region_exchange,
        'group_activity_other' => $group_activity_other,
        'group_activity_bikou' => $request->group_activity_bikou,
        
    ]);
    
        $people = Person::all();
        return view('people', compact('activity', 'people'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        //
    }
}
