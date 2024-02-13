<?php

namespace App\Http\Controllers;
// ↓livewireを呼び出し
// namespace App\Http\Livewire;
//use Illuminate\Foundation\Auth\User; // 認証分岐のため追加
use Illuminate\Support\Facades\Auth;

// Personモデルを呼び出している↓
use App\Models\User;
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
    public function index(User $user)
    {
        // ifどちらにも当てはまらない場合でもエラーが出ないようにする↓
        $people = [];
        $families = []; 
        // 全件データ取得して一覧表示する↓
        // $people は変数名　Person::でPersonモデルにアクセスする
        // $people = Person::all();
        
        
        // 条件1　userがフラグ0（家族である）かつ　
        if($user->flag===0){
            $people = Person::all();
            return view('people',compact('people'));
           
        }
        else{
            // userが家族である　中間テーブルを参照する
            // $order = Order::find(1);

            // foreach ($order->products as $product) {
            // dd($product->pivot->quantity); // 1
            
            // 下記2行でuserの情報とfamiliesテーブルの情報が配列で出せる ↓
           //Personモデルに定義された、関連するUserモデルとの関係を表すメソッドを呼び出し
            //   $families = Person::find(1)->users()->get()->toArray();
            //  dd($families);
            
            // 今ログインしてるuserのID
            $userId = Auth::id();
            // dd($userId);
            //$user = User::find($userId);
// dd($user);いしだの事業所、いしだかぞくなど配列で出る
$user = User::with('people')->find($userId);
// dd($user);
            //Personモデルのデータベーステーブルから、idが1のPersonモデルのレコードを取得
            // $family = Person::find(1)->users;
            // dd($family);　peopleテーブルのidが1の山田桃子が取ってこられて、関係するuser（やまだかぞく）が配列で出る
            
            //Userモデルのコレクション $family と、その中の最初のUserモデルに紐づく Peopleテーブルの情報を取得
            // $familyPeople = $family->merge($family->first()->people); // Peopleテーブルの情報を取得
           // dd($familyPeople->toArray());
             
             
            // 現在ログインしているユーザーの ID を取得
// $userId = Auth::id();

// $user = User::find($userId);
// dd($user);
// $familyPeople = $user->people; // 中間テーブル families を介して Person モデルのデータを取得
// if ($familyPeople !== null) {
    
// dd($familyPeople->toArray());

//     if ($familyPeople) {
//         dd($familyPeople->toArray());
//     } else {
//         // $user に関連する people が見つからなかった場合の処理
//     }
// } else {
//     // ユーザーが見つからなかった場合の処理
// }

// $family にはログインしているユーザーに紐づいた Person モデルのコレクションが格納されます
//dd($family->toArray());

            //foreach ($user->people ?? [] as $person) {
                
              //   $pivotData = $person->pivot;
             //dd($person->pivot->relationship); // 1
            //  $people[] = $person; // データを $people 配列に格納
             // 変数を初期化
    // $people = [];
    //         return view('people',compact('family'));
    return view('people', ['user' => $user, 'people' => $user->people]);
    //return view('people',compact('people'));
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
   
    }
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

    $people = Person::create([
        'person_name' => $request->person_name,
        'date_of_birth' => $request->date_of_birth,
        'gender' => $request->gender,
        'disability_name' => $request->disability_name,
        'filename' => $filename,
        'path' => $filepath,

    ]);

    return redirect('people');
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