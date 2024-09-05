<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

use App\Models\User;
use App\Models\Facility;
use App\Models\Person;
use App\Models\Role;
use App\Models\Chat;

class HogoshaUserController extends Controller
{
    public function showRegister()
   {
       return view('hogosharegister');
   }
   
    public function register(Request $request)
   {
      $form = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => [
            'required',
            'string',
            'min:8',
            'confirmed',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/' // '大文字小文字英数字含む,
        ], [
            //validation.phpにバリデーションのエラーは記載
        ]
        ]);
        
        // 入力データを配列に保存
    $userData = [
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => Hash::make($request->input('password')),
    ];
    // dd($userData);
    $request->session()->put('user_data', $userData);
    // dd($request->session()->get('user_data'));
    return view('hogoshanumber', compact('userData'));

  }

  public function edit(Request $request)
    {
        $user = auth()->user();

        // ログインしているユーザーに関連する人物を取得
        $people = $user->people_family()->get();
        // 各Personに対して未読メッセージがあるかを確認
        foreach ($people as $person) {
            $unreadMessages = Chat::where('people_id', $person->id)
                                ->where('is_read', false)
                                ->where('user_identifier', '!=', $user->id)
                                ->exists();
            $person->unreadMessages = $unreadMessages;
        }


        \Log::info('HogoshaUserController edit method started.');
        return view('hogosha', compact('people'));
    }


   public function hogosha()
  {
      // 現在ログインしているユーザーを取得
      $user = Auth::user();

      // ユーザーが関連付けられている全てのPerson（利用者）を取得
      $people = $user->people_family()->get();


      // データをビューに渡す
      return view('hogosha', compact('people'));
  }
   
   public function create()
   {
       return view('hogoshanumber');
   }

   
   public function numberregister(Request $request)
{
   
      // バリデーションルールとメッセージを定義
    $rules = [
        'jukyuusha_number' => 'required|digits:10',
        'date_of_birth' => 'required|date_format:Y-m-d', // 必要に応じてフォーマットを調整
    ];

    $messages = [
        'jukyuusha_number.required' => '受給者証番号は必須です。',
        'jukyuusha_number.digits' => '受給者証番号は10桁で入力してください。',
        'date_of_birth.required' => '生年月日は必須です。',
        'date_of_birth.date_format' => '生年月日は正しい形式で入力してください。',
    ];

    // バリデーションを実行
    $validator = Validator::make($request->all(), $rules, $messages);
    if ($validator->fails()) {
        // バリデーションに失敗した場合、エラーメッセージとともに同じビューを返す
        return view('hogoshanumber', [
            'errors' => $validator->errors(),
            'input' => $request->all()
        ]);
    }
    // 受給者証番号と生年月日で人を検索
    $person = Person::where('jukyuusha_number', $request->jukyuusha_number)
                    ->where('date_of_birth', $request->date_of_birth)
                    ->first();
    // dd($person);
        // 人が見つかった場合
        if ($person) {
            // セッションから登録データを取得
            $registerData = $request->session()->get('user_data');
            //  dd($registerData);
            
            if (!$registerData) {
            $error = 'セッションの登録データが見つかりませんでした。';
            return view('hogoshanumber', compact('error'));
        }

        try {
            DB::beginTransaction();

            $user = User::query()->create([
                'name' => $registerData['name'],
                'email' => $registerData['email'],
                'password' => Hash::make($registerData['password']),
            ]);

            Auth::login($user);

            $user->people_family()->syncWithoutDetaching($person->id);
            $people = $user->people_family()->get();
            $user->assignRole('client family user');

            DB::commit();
// 未読メッセージを取得
$unreadMessages = Chat::where('people_id', $person->id)
->where('is_read', false)
->where('user_identifier', '!=', $user->id)
->exists();
// hogosha ビューにデータを渡して表示
            return view('hogosha', compact('people', 'unreadMessages'));
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('登録処理中のエラー: ' . $e->getMessage());
            $error = '登録処理中にエラーが発生しました。もう一度お試しください。';
            return view('hogoshanumber', compact('error'));
        }
    } else {
        $error = '受給者証番号と生年月日が一致する利用者が存在しません。<br>施設側でこのアプリにご家族の登録がされているか施設にお問い合わせください';
        return view('hogoshanumber', compact('error'));
    }

}
}
