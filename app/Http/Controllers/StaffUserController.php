<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Facility;
use App\Models\Person;
use App\Models\Role;
use App\Models\CustomID;

class StaffUserController extends Controller
{
    
   public function staffshow()
   {
       return view('staffregister');
   }
    public function register(Request $request)
   {
      $form = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'custom_id' => ['required', 'string', 'exists:custom_ids,custom_id'],
            'password' => [
            'required',
            'string',
            'min:8',
            'confirmed',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/' // '大文字小文字英数字含む,
        ], $messages = [
            'name.required' => '名前は必須です。',
            'custom_id.required' => 'IDは必須です。',
            'custom_id.exists' => '入力されたIDは存在しません。施設管理者にあなたのIDを登録したか確認してください。',
            'email.required' => '事業所のメールアドレスを入力してください。',
            'email.email' => '有効なメールアドレスを入力してください。',
            'password.required' => 'パスワードは必須です。',
            'password.min' => 'パスワードは8文字以上で入力してください。',
            'validation.confirmed' => 'パスワード確認が一致しません。',
        ]
        ]);
          // バリデーションを実行
    //$form = $request->validate($rules, $messages);
    // custom_idsテーブルから職員のIDがあるか検索
    $custom_id_record = CustomID::where('custom_id', $request->custom_id)->first();

    // custom_idが見つかった場合
    if ($custom_id_record) {
        // usersテーブルで既に使用されているか確認
        $existingUser = User::where('custom_id', $request->custom_id)->first();
        
        if ($existingUser) {
            return back()->withErrors(['custom_id' => 'この職員IDは既に使用されています。'])->withInput();
        }

        // 入力データを配列に保存
        $userData = [
            'name' => $request->input('name'),
            // 'email' => $request->input('email'),
            'custom_id' => $request->input('custom_id'),
            'password' => Hash::make($request->input('password'))
        ];

        // ユーザーを作成
        $user = User::create($userData);
        
        Auth::login($user);

        // facility_idが facilities テーブルに存在するか確認
        $facilityExists = Facility::where('id', $custom_id_record->facility_id)->exists();

        if (!$facilityExists) {
            return back()->withErrors(['facility_id' => '関連する施設が存在しません。'])->withInput();
        }

        // facility_staffsテーブルに関連付けを保存
        DB::table('facility_staffs')->insert([
            'user_id' => $user->id,
            'facility_id' => $custom_id_record->facility_id, // ここで custom_ids テーブルの facility_id を使用
            // 'custom_id' => $custom_id_record->custom_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ロールを紐づける
        $user->assignRole('facility staff user');

        // 登録完了ページにリダイレクト
        return view('people')->with('success', '登録が完了しました');
    } else {
        // custom_idが見つからなかった場合、エラーメッセージを表示
        return back()->withErrors(['custom_id' => '職員IDが見つかりません'])->withInput();
    }
}

  
   
   public function numberregister(Request $request)
{
    $request->validate([
        'jukyuusha_number' => 'required|digits:10',// バリデーションルールは適宜変更してください
    ]);

    // ログインユーザーを取得
    // $user = auth()->user();
    
    // // jukyuusha_numberカラムから人を検索
    // $person = Person::where('jukyuusha_number', $request->jukyuusha_number)->first();

    // // 人が見つかった場合
    // if ($person) {
    // // people_familiesテーブルに関連付ける
    // $user->people_family()->syncWithoutDetaching($person->id);
       
    //     // 任意のリダイレクト先にリダイレクトするなどの処理を行う
    // $people = $user->people_family()->get();
    // // $user->user_roles()->attach(2); // ここでrole_id＝2(family)を紐づける
    // $user->assignRole('client family user'); // ここで'client family user' を紐づける

    // return view('hogosha', compact('people'));
    // 受給者証番号カラムから人を検索
        $person = Person::where('jukyuusha_number', $request->jukyuusha_number)->first();

        // 人が見つかった場合
        if ($person) {
            // セッションから登録データを取得
            $registerData = $request->session()->get('user_data');
            // dd($registerData);
            // セッションから登録するデータは取れている
            
            try {
                $user = User::query()->create([
                'name' => $registerData['name'],
                'email' => $registerData['email'],
                'password' => Hash::make($registerData['password']),
            ]);
                Auth::login($user);

                // people_familiesテーブルに関連付ける
                $user->people_family()->syncWithoutDetaching($person->id);

                // 任意のリダイレクト先にリダイレクトするなどの処理を行う
                $people = $user->people_family()->get();
                $user->assignRole('client family user'); // ここで 'client family user' を紐づける

                // DB::commit();

                return view('hogosha', compact('people'));
                    } catch (\Exception $e) {
                DB::rollBack();
                $error = '登録処理中にエラーが発生しました。もう一度お試しください。';
                return view('hogoshanumber', compact('error'));
                    }
                } else {
                    // 人が見つからなかった場合の処理
                    $error = 'この受給者証番号の利用者が存在しません。<br>施設側でこのアプリにご家族の登録がされているか施設にお問い合わせください';
                    return view('hogoshanumber', compact('error'));
                }
            }
}
