<?php

namespace App\Http\Controllers;
// ↓livewireを呼び出し
// namespace App\Http\Livewire;
//use Illuminate\Foundation\Auth\User; // 認証分岐のため追加
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
// Personモデルを呼び出している↓
use App\Models\User;
use App\Models\Facility;
use App\Models\Person;
use App\Models\Speech;
use App\Models\Toilets;
use App\Models\Temperature;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 全件データ取得して一覧表示する↓
        // $people は変数名　Person::でPersonモデルにアクセスする
        // $people = Person::all();
        // ログインしているユーザーの情報↓
       
        $user = auth()->user();
    //   dd($user);
    
    // $staffId = $user->facility_staffs()->first()->pivot->staff_id;
    // dd($staffId);
    $user->facility_staffs()->first();
    // dd($user);
    // $user->load('facility_staffs');
        // facility_staffsメソッドからuserの情報をゲットする↓
        $facilities = $user->facility_staffs()->get();
        // dd($facilities);
        $firstFacility = $facilities->first();
        // dd($firstFacility);
        if ($firstFacility) {
            $people = $firstFacility->people_facilities()->get();
        } else {
            $people = [];// まだpeople（利用者が登録されていない時もエラーが出ないようにする）
        }
        // dd($firstFacility);
        // ↑これで$facilityが取れている
        // $people = $firstFacility->people_facilities()->get();
        // $user = User::find(1); // IDが1のユーザーを取得
        // $people = $user->people_facilities()->get(); // そのユーザーのすべてのロールを取得
        // $people = $facilities->people_facilities()->get(); 
        // dd($people);
        //  ↑これで取れる
//       $sql = $user->people_facilities()->toSql();
// dd($sql);

// $people = collect(); // 空のコレクションを作成する

// foreach ($facilities as $facility) {
//     $peopleIds = $peopleIds->merge($facility->people_facilities()->pluck('people_id'));
// }

// すべての people_id を取得
// $allPeopleIds = $peopleIds->unique();
// dd($allPeopleIds);
// $peopleIds = collect(); // 空のコレクションを作成
// foreach ($facilities as $facility) {
//     // $people = $people->merge($facility->people_facilities()->get());
//     // $people = $people->merge($facility->people()->get());
//     $peopleIds = $peopleIds->merge($facility->people_facilities()->pluck('facility_id'));
// }
// $oVisitLogs = Facility::where('facility_name',$facilities)->get();
// // dd($oVisitLog);

// foreach($oVisitLogs as $l){
//   foreach($l->people_facilities as $s){
//      //スタッフの名前
//      $s->facility_id;
//      dd($s);
//   }
// }

// $peopleFacilities = collect(); // 空のコレクションを作成する

// foreach ($facilities as $facility) {
//     $facilityPeople = $facility->people_facilities()->get();
//     $peopleFacilities = $peopleFacilities->merge($facilityPeople);
// }

// dd($peopleFacilities);
// // dd($people);
// foreach ($facilities as $facility) {
//     // dd($facility);
//     // ↑これで$facilityが取れている
//     // $people = $person->$facility->people_facilities()->get();
//     // dd($people);
    
//     $facilityPeople = $facility->people_facilities()->get();
//     $people = $people->merge($facilityPeople);
    
//     // echo "id:{$facility->id} name:{$member->name}";
//     // $peopleFacilities = $peopleFacilities->merge($facility->people_facilities()->with('facility_staffs')->get());
// }
// dd($people);
// foreach ($facilities as $facility) {
//     // echo "id:{$facility->id} name:{$member->name}";
//     // $peopleFacilities = $peopleFacilities->merge($facility->people_facilities()->with('facility_staffs')->get());
// }

// dd($peopleFacilities);
// $peopleFacilities = $facilities->people_facilities()->with('people')->get();
// dd($peopleFacilities);
//         foreach ($facilities->$people as $person) {
//     $people = $facility->people_facilities()->get();
//     // foreach ($people as $person) {
//         // ループの中で使用する処理を記述
//         dd($people);
    // }
// }


    //     $people = collect(); // 空のコレクションを作成
        
    //     foreach ($facilities as $facility) {
    //     $people = $people->merge($facility->people_facilities()->get());
    //      dd($people);
    // }
    // dd($people);
    
//     foreach ($people->people_facilities as $people_facility) {
//     dd($people);
// }
        return view('people',compact('people'));
        // APIのときは　return $people;などでJSONデータで返す
   
    }

            // 1対1の場合↓
        //   $people = Person::where('id',$user->people_id)->first();
        // }
        
   
    //   companyのuserを判断する
        // $this->authorize('company', $user);
        
        
        // $relationship = $people->pivot->relationship;
    //   dd($relationship);
        //return view('people', compact('people', 'familyPeople'));
        //return view('people', ['user' => $user, 'people' => $user->people]);

        // APIのときは　return $people;などでJSONデータで返す
   
    
 //}

// use Livewire\Component;

// class Birthday extends Component
// {
//     public $birthday;

//     public function render()
//     {
//         return view('livewire.birthday');
//     }
// }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
{
    return view('peopleregister');
}


   public function store(Request $request)
{
    $storeData = $request->validate([
        'person_name' => 'required|max:255',
        'date_of_birth' => 'required|max:255',
        'jukyuusha_number' => 'required|digits:10',
    ]);

    $directory = 'public/sample';
    $filename = null;
    $filepath = null;

    if ($request->hasFile('filename')) {
        $request->validate([
            'filename' => 'image|max:2048',
        ]);
        $filename = uniqid() . '.' . $request->file('filename')->getClientOriginalExtension();
         $filename = $request->file('filename')->getClientOriginalName();	
        $request->file('filename')->storeAs($directory, $filename);
        $filepath = $directory . '/' . $filename;
    }

    $newpeople = Person::create([
        'person_name' => $request->person_name,
        'date_of_birth' => $request->date_of_birth,
        'gender' => $request->gender,
        'jukyuusha_number' => $request->jukyuusha_number,
        'filename' => $filename,
        'path' => $filepath,

    ]);
    
    $user = auth()->user();
    
    // dd($user);
    // facility_staffsメソッドからuserの情報をゲットする↓
    $facilities = $user->facility_staffs()->get();
    // dd($facilities);
    $firstFacility = $facilities->first();
    // dd($firstFacility);
    
    // 現在ログインしているユーザーが属する施設にpeople（利用者）を紐づける↓
    // syncWithoutDetaching＝完全重複以外は、重複OK
    $newpeople->people_facilities()->syncWithoutDetaching($firstFacility->id);
    
    if ($firstFacility) {
        $people = $firstFacility->people_facilities()->get();
    } else {
        $people = [];// まだpeople（利用者が登録されていない時もエラーが出ないようにする）
    }

    // return redirect('people');
    return view('people',compact('people'));
}

//      public function templist()
// {
//     $people = Person::all();
        // ('people')に$peopleが代入される
        
        // 'people'はpeople.blade.phpの省略↓　// compact('people')で合っている↓
        // return view('temperaturelist',compact('people'));
    // return view('temperaturelist');
// }
    // return view('peopleregister');

        // $people = Person::create($storeData);
        // // トップページに返す↓
        // return redirect('/people');
    
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
    return view('temperature.'.$person->id.'.edit');//
    }
    
    // public function showAmountFood(Person $person)
    // {
    // return view('food.'.$person->id.'.edit');//
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
     
    // 更新画面の表示↓
    public function edit($id)
{
    $person = Person::find($id);
    return view('peopleedit', compact('person'));
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
     
    // 体温登録のルート↓
    public function showtemperature(Person $person)
{
    $people = Person::all();
        // ('people')に$peopleが代入される
    return view('temperaturelist',compact('people'));
} 

// 食事
// 登録のルート↓
    public function showfood(Person $person)
{
    $people = Person::all();
        // ('people')に$peopleが代入される
    return view('foodlist',compact('people'));
} 
    //  フォームから送られてきたデータ↓
    public function update(Request $request, Person $person)
    {
       $storeData = $request->validate([
            //  requireは必須項目　nullableは書かなくてもいい
            // 'person_name' => 'required|max:255',
            // 'date_of_birth' => 'required|max:255',
            // 'age' => 'required|max:255',
        ]);
        
        $person ->update($updateData);
        // トップページに返す↓
        return redirect('/people');
    }


    
public function uploadForm()
    {
        // return view('people');変更↓
       return view('peopleregister');
    }
    
    



 public function __invoke()
    {
        return view('person');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        
        $person->delete();
        return redirect('/people');
    }
}