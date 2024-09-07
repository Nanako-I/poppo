@vite(['resources/css/app.css', 'resources/js/app.js'])
<x-app-layout>

    <!--ヘッダー[START]-->

    <!--ヘッダー[END]-->

        <!-- バリデーションエラーの表示に使用-->
       <!-- resources/views/components/errors.blade.php -->
        @if (count($errors) > 0)
            <!-- Form Error List -->
            <div class="flex justify-between p-4 items-center bg-red-500 text-white rounded-lg border-2 p-2 border-white">
                <div><strong>入力した文字を修正してください。</strong></div>
                <div>
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <!-- バリデーションエラーの表示に使用-->
   @php
    $user = Auth::user();

    $permissions = $user->getPermissionsViaRoles();


@endphp
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    window.peopleIds = @json($people->pluck('id'));
    window.UserId = {{ Auth::id() }};
</script>

<body>
<style>
  /* フォントを指定 */

  body {
    font-family: 'Noto Sans JP', sans-serif; /* フォントをArialに設定 */
  background: linear-gradient(135deg, rgb(209, 253, 255,0.5), rgb(253, 219, 146,1));
  }
</style>
    <!--// 処理-->

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet">


<div class="flex flex-col items-center justify-center w-full my-2">
    <style>
        /* @import url('https://fonts.googleapis.com/css2?family=Arial&display=swap'); */
        h1 {
        font-family: Arial, sans-serif; /* フォントをArialに設定 */
        }
    </style>
    <h1 class="sm:text-2xl text-3xl font-bold title-font mb-4 text-gray-900" _msttexthash="91611" _msthidden="1" _msthash="63"></h1>
</div>





 <!-- 利用者情報 -->
<!--@role('facility staff administrator')-->
@hasanyrole('facility staff administrator|facility staff user|facility staff reader')
  <div class="flex flex-row justify-start w-screen overflow-x-auto">
    <div class="slider">
    @csrf
                @if (!is_null($people) && count($people) > 0)
             <div class="flex flex-row justify-center tw-flex-row h-150 -m-2">

                @foreach ($people as $person)
                <!--$person->load('temperatures');-->
                  <div class="p-2 h-full lg:w-1/3 md:w-full flex">
                   <div class="slide height:auto  border-2 p-2 p-4 w-full md:w-64 lg:w-100 rounded-lg bg-white">
                     <style>
                      .slide {
                        width:100vw;
                        background: rgb(244,244,244);
                      }
                      @media screen and (min-width: 768px){
                        .slide {
                            width:600px;
                        }
                      }
                      @media screen and (min-width: 1024px){
                        .slide {
                            width:700px;
                        }
                      }

                     </style>

                     <!--<a href="{{ url('chart/'.$person->id.'/edit') }}" class="relative  ml-2">-->
                     <!--                                            @csrf-->

                      <div class="h-30 flex flex-row items-center rounded-lg bg-white width:100vw relative z-0">
                          <!--ハンバーガーメニューが表示された時は、下に表示されるようz-0をつける-->

                          @if ($person->filename)
                              <img alt="team" class="w-16 h-16 bg-gray-100 object-cover object-center flex-shrink-0 rounded-full mr-4" src="{{ asset('storage/sample/' . $person->filename) }}">
                            @else
                              <img alt="team" class="w-16 h-16 bg-gray-100 object-cover object-center flex-shrink-0 rounded-full mr-4" src="https://dummyimage.com/80x80">
                            @endif

                                <style>
                                  /* フォントを指定 */
                                  .h2 {
                                    font-family: Arial, sans-serif; /* フォントをArialに設定 */
                                  }
                                   .p {
                                    font-family: Arial, sans-serif; /* フォントをArialに設定 */
                                  }
                                 </style>
                                        <div class="flex-grow">
                                          <h2 class="h2 text-gray-900 title-font font-bold text-2.5xl" _msttexthash="277030">{{$person->person_name}}</h2>
                                          <p class="text-gray-900 font-bold text-xs" _msttexthash="150072">{{$person->date_of_birth}}生まれ</p>
                                        </div>
                      </div>





                      <!--</a>-->


                                <!--連絡事項↓ -->
                        　    　<div class="border-2 p-2 rounded-lg bg-white m-2">
                                    <div class="flex justify-start items-center">
                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                        <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                        <i class="fa-solid fa-comments text-sky-500" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                        <p class="font-bold text-xl ml-2">連絡</p>
                                    </div>
                                        <div class="flex items-center justify-center p-4">

                                            <!-- 登録していない場合 -->
                                            <!-- <a href="{{ url('chat/'.$person->id) }}" class="relative ml-2" style="display: flex; align-items: center;">
                                                <summary class="text-red-500 font-bold text-xl">連絡する</summary>
                                                @csrf
                                                <i class="fa-solid fa-plus text-gray-900" style="font-size: 1.5em; padding: 0 5px; transition: transform 0.2s;"></i>

                                                <!-- 未読メッセージがある場合に new マークを表示 -->
                                                <!-- @if($person->unreadMessages)
                                                    <span class="ml-2 text-red-500 text-sm font-bold">New</span>
                                                @endif
                                            </a> -->
                                            <!-- リアルタイムで新着メッセージが届いた場合にNewと表示 -->
                                            <a href="{{ url('chat/'.$person->id) }}" id="person-{{ $person->id }}" class="relative ml-2" style="display: flex; align-items: center;">
                                                <summary class="text-red-500 font-bold text-xl">連絡する</summary>
                                                @csrf
                                                <i class="fa-solid fa-plus text-gray-900" style="font-size: 1.5em; padding: 0 5px; transition: transform 0.2s;"></i>

                                                <!-- 未読メッセージがある場合に new マークを表示 -->
                                                @if($person->unreadMessages)
                                                    <span id="new-indicator-{{ $person->id }}" class="ml-2 text-red-500 text-sm font-bold">New</span>
                                                @else
                                                    <span id="new-indicator-{{ $person->id }}" class="ml-2 text-red-500 text-sm font-bold" style="display: none;">New</span>
                                                @endif
                                            </a>


                                        </div>
                                    </div>

                       <!-- 食事登録↓ -->
                        　    　 <div class="border-2 p-2 rounded-lg bg-white m-2">
                                     <div class="flex justify-start items-center">
                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                        <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                        <i class="fa-solid fa-bowl-rice text-emerald-700" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                        <p class="font-bold text-xl ml-2">食事量</p>
                                    </div>

                                    <!-- people.blade.php -->
                                   <div class="flex items-center justify-center p-4">
                                        @if (!is_null($person) && !empty($person->foods) && count($person->foods) > 0)
                                        @php
                                           $lastFood = $person->foods->last();

                                        @endphp
                                            @if ($lastFood && $lastFood->created_at->isToday())

                                            <!-- 直近の食事結果表示 -->
                                                <div class="flex justify-evenly">
                                                <a href="{{ url('foodchange/'.$person->id) }}" class="relative ml-2 flex items-center">
                                                     @csrf
                                                <!--<div class="flex justify-evenly">-->
                                                    <!--<a href="javascript:void(0);" class="font-bold text-xl">-->
                                                        <div class="px-1.5">
                                                            <p class="text-gray-900 font-bold text-base">摂取量:</p>
                                                            <p class="text-gray-900 font-bold text-2xl">{{ $lastFood->staple_food }}</p>
                                                        </div>
                                                    <!--</a>-->
                                                    <!--<a href="javascript:void(0);" class="font-bold text-xl">-->
                                                        <div class="px-1.5">
                                                            <p class="text-gray-900 font-bold text-base">服用:</p>
                                                            <p class="text-gray-900 font-bold text-2xl">{{ $lastFood->medicine == 'yes' ? 'あり' : 'なし' }}</p>
                                                        </div>
                                                    <!--</a>-->
                                                <!--</div>-->
                                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                                    <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                                    <i class="fa-solid fa-pencil text-stone-500" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                                </a>
                                               </div>
                                            @else
                                                <a href="{{ url('food/'.$person->id.'/edit') }}" class="relative ml-2" style="display: flex; align-items: center;">
                                                <p class="text-red-500 font-bold text-xl">登録して<br>ください</p>
                                                @csrf
                                                <i class="fa-solid fa-plus text-gray-900" style="font-size: 1.5em; padding: 0 5px; transition: transform 0.2s;"></i>
                                                </a>
                                            @endif
                                        @else
                                            <a href="{{ url('food/'.$person->id.'/edit') }}" class="relative ml-2" style="display: flex; align-items: center;">
                                            <p class="text-red-500 font-bold text-xl">登録して<br>ください</p>
                                                @csrf
                                            <i class="fa-solid fa-plus text-gray-900" style="font-size: 1.5em; padding: 0 5px; transition: transform 0.2s;"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>

                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                        <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                        <a href="{{ url('food/'.$person->id.'/edit') }}" class="relative">
                                        </a>

                        <!--水分登録↓-->
                            　<div class="border-2 p-2 rounded-lg bg-white m-2">
                                <div class="flex justify-start items-center">
                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                    <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                    <i class="fa-solid fa-glass-water text-sky-500" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                    <p class="font-bold text-xl ml-2">水分摂取</p>
                                </div>
                                 <div class="flex items-center justify-center p-4">
                                            @if (!is_null($person) && count($person->waters) > 0)
                                            @php
                                               $lastWater = $person->waters->last();
                                               $today = \Carbon\Carbon::now()->toDateString();
                                               $todaysWaters = $person->waters()
                                                ->where('created_at', '>=', $today)
                                                ->where('created_at', '<', $today . ' 23:59:59')
                                                ->orderBy('created_at', 'asc') // 昇順に並べ替え
                                                ->get();
                                            @endphp

                                                @if ($todaysWaters->count() > 0)
                                                <div class="flex flex-col">
                                                    <p class="text-gray-900 font-bold text-lg">水分を摂った時間</p>
                                                    <!-- 今日の水分摂取リスト -->
                                                    @foreach ($todaysWaters as $water)
                                                            <div class="flex-row items-center justify-between p-2 border-b border-gray-300">
                                                            <p class="text-gray-900 font-bold text-lg">{{ $water->created_at->format('H:i') }}</p>
                                                            </div>
                                                    @endforeach
                                                            <a href="{{ url('wateredit/' . $person->id) }}" class="text-stone-500">
                                                                <i class="fa-solid fa-pencil" style="font-size: 1.5em;"></i>
                                                            </a>


                                                    <div style="display: flex; flex-direction: column; align-items: center;">
                                                            <form action="{{ route('water.store', $person->id) }}" method="POST">
                                                                <details class="justify-center"> <!-- この行を追加 -->

                                                                <summary class="text-red-500 font-bold text-xl">登録する</summary>
                                                                @csrf
                                                                <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                                    <div class="flex flex-col items-center justify-center ml-4">
                                                                        <p class="text-gray-900 font-bold text-xl">水分を摂った時間</p>
                                                                        <input type="time" name="created_at" id="scheduled-time">
                                                                        <!--<input name="temperature" id="text-box" class="appearance-none block w-1/2 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white font-bold" type="text" placeholder="">-->
                                                                    </div>

                                                                    <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                                        <p class="text-gray-900 font-bold text-xl">備考</p>
                                                                        <textarea id="result-speech" name="water_bikou" class="w-3/4 max-w-lg font-bold" style="height: 200px;"></textarea>
                                                                    </div>

                                                                <div class="my-2" style="display: flex; justify-content: center; align-items: center; max-width: 300px;">
                                                                  <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                                    送信
                                                                  </button>
                                                                </div>
                                                            </details>
                                                        </form>
                                                    </div>
                                                </div>
                                            @else
                                                  <div style="display: flex; flex-direction: column; align-items: center;">
                                                        <form action="{{ route('water.store', $person->id) }}" method="POST">
                                                            <details class="justify-center"> <!-- この行を追加 -->

                                                            <summary class="text-red-500 font-bold text-xl">登録する</summary>
                                                            @csrf
                                                            <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                                <div class="flex flex-col items-center justify-center ml-4">
                                                                    <p class="text-gray-900 font-bold text-xl">水分を摂った時間</p>
                                                                    <input type="time" name="created_at" id="scheduled-time">
                                                                    <!--<input name="temperature" id="text-box" class="appearance-none block w-1/2 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white font-bold" type="text" placeholder="">-->
                                                                </div>

                                                                <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                                    <p class="text-gray-900 font-bold text-xl">備考</p>
                                                                    <textarea id="result-speech" name="water_bikou" class="w-3/4 max-w-lg font-bold" style="height: 200px;"></textarea>
                                                                </div>

                                                            <div class="my-2" style="display: flex; justify-content: center; align-items: center; max-width: 300px;">
                                                              <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                                送信
                                                              </button>
                                                            </div>
                                                        </details>
                                                    </form>
                                                    </div>
                                                @endif
                                            @else
                                                <form action="{{ route('water.store', $person->id) }}" method="POST">
                                                    <details>
                                                         <summary class="text-red-500 font-bold text-xl">登録する</summary>
                                                        @csrf
                                                            <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                                <div class="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                                    <p class="text-gray-900 font-bold text-xl">水分を摂った時間</p>
                                                                    <input type="time" name="created_at" id="scheduled-time">
                                                                    <!--<input name="temperature" id="text-box" class="appearance-none block w-1/2 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white font-bold" type="text" placeholder="">-->
                                                                </div>

                                                                <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                                    <p class="text-gray-900 font-bold text-xl">備考</p>
                                                                    <textarea id="result-speech" name="water_bikou" class="w-3/4 max-w-lg font-bold" style="height: 200px;"></textarea>
                                                                </div>

                                                            <div class="my-2" style="display: flex; justify-content: center; align-items: center; max-width: 300px;">
                                                              <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                                送信
                                                              </button>
                                                            </div>
                                                    </details>
                                                </form>
                                            @endif
                                        </div>
                                  </div>

                         <!--内服登録↓-->
                            　<div class="border-2 p-2 rounded-lg bg-white m-2">
                                <div class="flex justify-start items-center">
                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                    <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                    <i class="fa-solid fa-prescription-bottle-medical text-emerald-700" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                    <p class="font-bold text-xl ml-2">内服</p>
                                </div>
                                 <div class="flex items-center justify-center p-4">
                                            @if (!is_null($person) && count($person->medicines) > 0)
                                            @php
                                               $today = \Carbon\Carbon::now()->toDateString();
                                               $todaysMedicines = $person->medicines()
                                                ->where('created_at', '>=', $today)
                                                ->where('created_at', '<', $today . ' 23:59:59')
                                                ->orderBy('created_at', 'asc') // 昇順に並べ替え
                                                ->get();
                                            @endphp

                                                @if ($todaysMedicines->count() > 0)
                                                <div class="flex flex-col">
                                                        <p class="text-gray-900 font-bold text-lg">内服した時間</p>
                                                        <!-- 今日の内服時間リスト -->
                                                        @foreach ($todaysMedicines as $medicine)
                                                            <div class="flex-row items-center justify-between p-2 border-b border-gray-300">
                                                                <p class="text-gray-900 font-bold text-lg">{{ $medicine->created_at->format('H:i') }}</p>
                                                            </div>
                                                        @endforeach
                                                            <a href="{{ url('medicineedit/' . $person->id) }}" class="text-stone-500">
                                                                <i class="fa-solid fa-pencil" style="font-size: 1.5em;"></i>
                                                            </a>
                                                        <div style="display: flex; flex-direction: column; align-items: center;">
                                                                <form action="{{ route('medicine.store', $person->id) }}" method="POST">
                                                                    <details class="justify-center">
                                                                    <summary class="text-red-500 font-bold text-xl">登録する</summary>
                                                                    @csrf

                                                                    <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                                    <div style="display: flex; align-items: center; justify-content: center; flex-direction: column;">
                                                                        <div class="flex flex-col items-center justify-center">
                                                                            <p class="text-gray-900 font-bold text-xl">内服した時間</p>
                                                                            <input type="time" name="created_at" id="scheduled-time">
                                                                        </div>

                                                                        <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                                            <p class="text-gray-900 font-bold text-xl">備考</p>
                                                                            <textarea id="" name="medicine_bikou" class="w-3/4 max-w-lg font-bold" style="height: 200px;"></textarea>
                                                                        </div>

                                                                        <div class="my-2" style="display: flex; justify-content: center; align-items: center; max-width: 300px;">
                                                                          <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                                            送信
                                                                          </button>
                                                                        </div>
                                                                    </div>
                                                                    </details>
                                                                </form>

                                                        </div>
                                                    </div>

                                                @else
                                                  <div style="display: flex; flex-direction: column; align-items: center;">
                                                        <form action="{{ route('medicine.store', $person->id) }}" method="POST">
                                                            <details class="justify-center"> <!-- この行を追加 -->

                                                            <summary class="text-red-500 font-bold text-xl">登録する</summary>
                                                            @csrf
                                                            <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                            <div style="display: flex; align-items: center; justify-content: center; flex-direction: column;">
                                                                <div class="flex flex-col items-center justify-center">
                                                                    <p class="text-gray-900 font-bold text-xl">内服した時間</p>
                                                                    <input type="time" name="created_at" id="scheduled-time">
                                                                </div>

                                                                <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                                    <p class="text-gray-900 font-bold text-xl">備考</p>
                                                                    <textarea id="result-speech" name="medicine_bikou" class="w-3/4 max-w-lg font-bold" style="height: 200px;"></textarea>
                                                                </div>

                                                                <div class="my-2" style="display: flex; justify-content: center; align-items: center; max-width: 300px;">
                                                                  <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                                    送信
                                                                  </button>
                                                                </div>
                                                            </div>
                                                        </details>
                                                    </form>

                                                    </div>
                                                @endif
                                            @else
                                                <form action="{{ route('medicine.store', $person->id) }}" method="POST">
                                                    <details>
                                                         <summary class="text-red-500 font-bold text-xl">登録する</summary>
                                                        @csrf
                                                            <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                            <div style="display: flex; align-items: center; justify-content: center; flex-direction: column;">
                                                                <div class="flex items-center justify-center">
                                                                    <p class="text-gray-900 font-bold text-xl">内服した時間</p>
                                                                    <input type="time" name="created_at" id="scheduled-time">
                                                                </div>

                                                                <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                                    <p class="text-gray-900 font-bold text-xl">備考</p>
                                                                    <textarea id="result-speech" name="medicine_bikou" class="w-3/4 max-w-lg font-bold" style="height: 200px;"></textarea>
                                                                </div>

                                                                <div class="my-2" style="display: flex; justify-content: center; align-items: center; max-width: 300px;">
                                                                  <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                                    送信
                                                                  </button>
                                                                </div>
                                                            </div>
                                                    </details>
                                                </form>
                                            @endif
                                        </div>
                                  </div>

                        <!--注入登録↓-->
                            　<div class="border-2 p-2 rounded-lg bg-white m-2">
                                <div class="flex justify-start items-center">
                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                    <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                    <i class="fa-solid fa-prescription-bottle-medical text-sky-500" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                    <p class="font-bold text-xl ml-2">注入</p>
                                </div>
                                 <div class="flex items-center justify-center p-4">
                                            @if (!is_null($person) && count($person->tubes) > 0)
                                            @php
                                               $today = \Carbon\Carbon::now()->toDateString();
                                               $todaysTubes = $person->tubes()
                                                ->where('created_at', '>=', $today)
                                                ->where('created_at', '<', $today . ' 23:59:59')
                                                ->orderBy('created_at', 'asc') // 昇順に並べ替え
                                                ->get();
                                            @endphp

                                                @if ($todaysTubes->count() > 0)
                                                <div class="flex flex-col">
                                                        <p class="text-gray-900 font-bold text-lg">注入した時間</p>
                                                        <!-- 今日の注入時間リスト -->
                                                        @foreach ($todaysTubes as $tube)
                                                            <div class="flex-row items-center justify-between p-2 border-b border-gray-300">
                                                                <p class="text-gray-900 font-bold text-lg">{{ $tube->created_at->format('H:i') }}</p>
                                                            </div>
                                                        @endforeach
                                                            <a href="{{ url('tubeedit/' . $person->id) }}" class="text-stone-500">
                                                                <i class="fa-solid fa-pencil" style="font-size: 1.5em;"></i>
                                                            </a>
                                                        <div style="display: flex; flex-direction: column; align-items: center;">
                                                                <form action="{{ route('tube.store', $person->id) }}" method="POST" enctype="multipart/form-data">
                                                                    <details class="justify-center">
                                                                    <summary class="text-red-500 font-bold text-xl">登録する</summary>
                                                                    @csrf

                                                                    <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                                    <div style="display: flex; align-items: center; justify-content: center; flex-direction: column;">
                                                                        <div class="flex flex-col items-center justify-center">
                                                                            <p class="text-gray-900 font-bold text-xl">注入した時間</p>
                                                                            <input type="time" name="created_at" id="scheduled-time">
                                                                        </div>

                                                                        <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                                            <p class="text-gray-900 font-bold text-xl">備考</p>
                                                                            <textarea id="result-speech" name="tube_bikou" class="w-3/4 max-w-lg font-bold" style="height: 200px;"></textarea>
                                                                        </div>
                                                                        <label class="block text-lg font-bold text-gray-700">写真を登録する</label>
                                                                            <div style="margin-left: 10px;">
                                                                                <input name="filename" id="filename" type="file" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm text-lg border-gray-300 rounded-md ml-20">
                                                                            </div>
                                                                        <div class="my-2" style="display: flex; justify-content: center; align-items: center; max-width: 300px;">
                                                                          <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                                            送信
                                                                          </button>
                                                                        </div>
                                                                    </div>
                                                                    </details>
                                                                </form>

                                                        </div>
                                                    </div>

                                                @else
                                                  <div style="display: flex; flex-direction: column; align-items: center;">
                                                        <form action="{{ route('tube.store', $person->id) }}" method="POST" enctype="multipart/form-data">
                                                            <details class="justify-center"> <!-- この行を追加 -->

                                                            <summary class="text-red-500 font-bold text-xl">登録する</summary>
                                                            @csrf
                                                            <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                            <div style="display: flex; align-items: center; justify-content: center; flex-direction: column;">
                                                                <div class="flex flex-col items-center justify-center">
                                                                    <p class="text-gray-900 font-bold text-xl">注入した時間</p>
                                                                    <input type="time" name="created_at" id="scheduled-time">
                                                                </div>

                                                                <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                                    <p class="text-gray-900 font-bold text-xl">備考</p>
                                                                    <textarea id="result-speech" name="tube_bikou" class="w-3/4 max-w-lg font-bold" style="height: 200px;"></textarea>
                                                                </div>
                                                                <label class="block text-lg font-bold text-gray-700">写真を登録する</label>
                                                                    <div style="margin-left: 10px;">
                                                                        <input name="filename" id="filename" type="file" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm text-lg border-gray-300 rounded-md ml-20">
                                                                    </div>

                                                                <div class="my-2" style="display: flex; justify-content: center; align-items: center; max-width: 300px;">
                                                                  <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                                    送信
                                                                  </button>
                                                                </div>
                                                            </div>
                                                        </details>
                                                    </form>
                                                    <!--</div>-->
                                                    </div>
                                                @endif
                                            @else
                                                <form action="{{ route('tube.store', $person->id) }}" method="POST" enctype="multipart/form-data">
                                                    <details>
                                                         <summary class="text-red-500 font-bold text-xl">登録する</summary>
                                                        @csrf
                                                            <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                            <div style="display: flex; align-items: center; justify-content: center; flex-direction: column;">
                                                                <div class="flex items-center justify-center">
                                                                    <p class="text-gray-900 font-bold text-xl">注入した時間</p>
                                                                    <input type="time" name="created_at" id="scheduled-time">
                                                                </div>

                                                                <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                                    <p class="text-gray-900 font-bold text-xl">備考</p>
                                                                    <textarea id="result-speech" name="tube_bikou" class="w-3/4 max-w-lg font-bold" style="height: 200px;"></textarea>
                                                                </div>
                                                                <label class="block text-lg font-bold text-gray-700">写真を登録する</label>
                                                                    <div style="margin-left: 10px;">
                                                                        <input name="filename" id="filename" type="file" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm text-lg border-gray-300 rounded-md ml-20">
                                                                    </div>
                                                                <div class="my-2" style="display: flex; justify-content: center; align-items: center; max-width: 300px;">
                                                                  <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                                    送信
                                                                  </button>
                                                                </div>
                                                            </div>
                                                    </details>
                                                </form>
                                            @endif
                                        </div>
                                  </div>
                        <!-- 体温登録↓ -->
                        　    　　  <div class="border-2 p-2 rounded-lg bg-white m-2">
                                    <div class="flex justify-start items-center">
                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                        <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                        <i class="fa-solid fa-thermometer text-sky-600" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                        <p class="font-bold text-xl ml-2">体温</p>
                                    </div>

                                    <!-- people.blade.php -->
                                   <div class="flex items-center justify-center p-4">
                                        @if (!is_null($person) && count($person->temperatures) > 0)
                                            @php
                                               $today = \Carbon\Carbon::now()->toDateString();
                                               $todaysTemperatures = $person->temperatures()
                                                ->where('created_at', '>=', $today)
                                                ->where('created_at', '<', $today . ' 23:59:59')
                                                ->orderBy('created_at', 'asc') // 昇順に並べ替え
                                                ->get();
                                            @endphp


                                                <!-- 検温フォーム -->
                                               <style>
                                                    summary::-webkit-details-marker {
                                                        display: inline-block;
                                                        content: '▼'; /* アイコンの文字を指定 */
                                                        margin-right: 5px; /* 適宜調整してください */
                                                    }
                                                    summary {
                                                        display: list-item;
                                                        cursor: pointer;
                                                        list-style: none;
                                                        font-weight: bold;
                                                        text-align: center; /* 検温してくださいを中央に配置するためのスタイル */
                                                    }
                                                    summary::-moz-list-bullet {
                                                        display: inline-block;
                                                        content: '▼'; /* アイコンの文字を指定 */
                                                        margin-right: 5px; /* 適宜調整してください */
                                                    }

                                                    summary::marker {
                                                        display: inline-block;
                                                        content: '▼'; /* アイコンの文字を指定 */
                                                        margin-right: 5px; /* 適宜調整してください */
                                                    }
                                                </style>
                                              <!-- 直近の検温結果表示 -->
                                                @if ($todaysTemperatures->count() > 0)
                                                <div class="flex flex-col">
                                                    <p class="text-gray-900 font-bold text-lg">今日の体温</p>



                                                    <!-- 今日の体温リスト -->
                                                    @foreach ($todaysTemperatures as $temperature)
                                                            <div class="flex items-center justify-between p-2 border-b border-gray-300">
                                                            <p class="text-gray-900 font-bold text-lg mr-1.5">{{ $temperature->created_at->format('H:i') }}</p>
                                                            <p class="text-gray-900 font-bold text-lg ml-4">{{ $temperature->temperature }}℃</p>
                                                            </div>
                                                    @endforeach
                                                            <a href="{{ url('temperatureedit/' . $person->id) }}" class="text-stone-500">
                                                                <i class="fa-solid fa-pencil" style="font-size: 1.5em;"></i>
                                                            </a>


                                                    <div style="display: flex; flex-direction: column; align-items: center;">
                                                            <form action="{{ route('temperatures.store', $person->id) }}" method="POST">
                                                                <details class="justify-center"> <!-- この行を追加 -->

                                                                <summary class="text-red-500 font-bold text-xl">登録する</summary>
                                                                @csrf
                                                                <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                                <div class="flex flex-col justify-center items-center space-x-4">
                                                                    <div class="flex flex-col items-center justify-center">
                                                                        <p class="text-gray-900 font-bold text-xl">計測時間</p>
                                                                        <input type="time" name="created_at" id="scheduled-time">
                                                                    </div>

                                                                    <div class="flex flex-col items-center justify-center mt-2.5">
                                                                        <div class="flex items-center ml-32">
                                                                            <input name="temperature" id="text-box" class="appearance-none block w-1/2 text-gray-900 py-3 px-4 leading-tight focus:outline-none focus:bg-white font-bold" type="text" placeholder="">
                                                                            <span class="ml-1 text-gray-900 font-bold text-xl">℃</span>
                                                                        </div>
                                                                    </div>


                                                                    <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                                        <p class="text-gray-900 font-bold text-xl">備考</p>
                                                                        <textarea id="result-speech" name="bikou" class="w-3/4 max-w-lg font-bold" style="height: 200px;"></textarea>
                                                                    </div>

                                                                    <div class="my-2" style="display: flex; justify-content: center; align-items: center; max-width: 300px;">
                                                                      <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                                        送信
                                                                      </button>
                                                                    </div>
                                                                </div>
                                                            </details>
                                                        </form>
                                                    </div>
                                                </div>
                                            @else
                                                  <div style="display: flex; flex-direction: column; align-items: center;">
                                                        <form action="{{ route('temperatures.store', $person->id) }}" method="POST">
                                                            <details class="justify-center"> <!-- この行を追加 -->

                                                                <summary class="text-red-500 font-bold text-xl">登録する</summary>
                                                                @csrf
                                                                <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                                <div class="flex flex-col justify-center items-center space-x-4">
                                                                    <div class="flex flex-col items-center justify-center">
                                                                        <p class="text-gray-900 font-bold text-xl">計測時間</p>
                                                                        <input type="time" name="created_at" id="scheduled-time">
                                                                    </div>

                                                                    <div class="flex flex-col items-center justify-center mt-2.5">
                                                                        <div class="flex items-center ml-32">
                                                                            <input name="temperature" id="text-box" class="appearance-none block w-1/2 text-gray-900 py-3 px-4 leading-tight focus:outline-none focus:bg-white font-bold" type="text" placeholder="">
                                                                            <span class="ml-1 text-gray-900 font-bold text-xl">℃</span>
                                                                        </div>
                                                                    </div>


                                                                    <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                                        <p class="text-gray-900 font-bold text-xl">備考</p>
                                                                        <textarea id="result-speech" name="bikou" class="w-3/4 max-w-lg font-bold" style="height: 200px;"></textarea>
                                                                    </div>

                                                                    <div class="my-2" style="display: flex; justify-content: center; align-items: center; max-width: 300px;">
                                                                      <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                                        送信
                                                                      </button>
                                                                    </div>
                                                                </div>
                                                            </details>
                                                    </form>
                                                    </div>
                                                @endif
                                            @else
                                                <form action="{{ route('temperatures.store', $person->id) }}" method="POST">
                                                    <details class="justify-center"> <!-- この行を追加 -->
                                                        <summary class="text-red-500 font-bold text-xl">登録する</summary>
                                                            @csrf
                                                            <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                            <div class="flex flex-col justify-center items-center space-x-4">
                                                                <div class="flex flex-col items-center justify-center">
                                                                    <p class="text-gray-900 font-bold text-xl">計測時間</p>
                                                                    <input type="time" name="created_at" id="scheduled-time">
                                                                </div>

                                                                <div class="flex flex-col items-center justify-center mt-2.5">
                                                                    <div class="flex items-center ml-32">
                                                                        <input name="temperature" id="text-box" class="appearance-none block w-1/2 text-gray-900 py-3 px-4 leading-tight focus:outline-none focus:bg-white font-bold" type="text" placeholder="">
                                                                        <span class="ml-1 text-gray-900 font-bold text-xl">℃</span>
                                                                    </div>
                                                                </div>


                                                                <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                                    <p class="text-gray-900 font-bold text-xl">備考</p>
                                                                    <textarea id="result-speech" name="bikou" class="w-3/4 max-w-lg font-bold" style="height: 200px;"></textarea>
                                                                </div>

                                                                <div class="my-2" style="display: flex; justify-content: center; align-items: center; max-width: 300px;">
                                                                  <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                                    送信
                                                                  </button>
                                                                </div>
                                                            </div>
                                                        </details>
                                                </form>
                                            @endif
                                        </div>
                                  </div>
                                <!-- 血圧登録↓ -->
                        　    　 <div class="border-2 p-2 rounded-lg bg-white m-2">
                                    <div class="flex justify-start items-center">
                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                        <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                        <i class="fa-solid fa-heart-pulse text-pink-600" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                        <p class="font-bold text-xl ml-2">血圧・脈・SpO2</p>
                                    </div>

                                    <div class="flex items-center justify-center p-4">
                                            @if (!is_null($person) && count($person->bloodpressures) > 0)
                                            @php
                                               $today = \Carbon\Carbon::now()->toDateString();
                                               $todaysBloodpressures = $person->bloodpressures()
                                                ->where('created_at', '>=', $today)
                                                ->where('created_at', '<', $today . ' 23:59:59')
                                                ->orderBy('created_at', 'asc') // 昇順に並べ替え
                                                ->get();
                                            @endphp

                                                @if ($todaysBloodpressures->count() > 0)
                                                <div class="flex flex-col">
                                                    <p class="text-gray-900 font-bold text-lg">バイタルの計測時間</p>
                                                    <!-- 今日のバイタルリスト -->
                                                    @foreach ($todaysBloodpressures as $bloodpressure)
                                                            <div class="flex-row items-center justify-between p-2 border-b border-gray-300">
                                                                <p class="text-gray-900 font-bold text-lg">{{ $bloodpressure->created_at->format('H:i') }}</p>
                                                            </div>
                                                            <div class="flex items-center justify-around">
                                                        　　　　    <div class="px-2">
                                                        　　　　        <p class="text-gray-900 font-bold text-base">血圧:</p>
                                                                    <p class="text-gray-900 font-bold text-2xl">{{ $bloodpressure->max_blood }}/{{ $bloodpressure->min_blood }}</p>
                                                                </div>
                                                                <div class="px-2">
                                                        　　　　        <p class="text-gray-900 font-bold text-base">脈:</p>
                                                                    <p class="text-gray-900 font-bold text-2xl">{{ $bloodpressure->pulse}}/分</p>
                                                                </div>
                                                                <div class="px-2">
                                                        　　　　        <p class="text-gray-900 font-bold text-base">SpO2:</p>
                                                                    <p class="text-gray-900 font-bold text-2xl">{{ $bloodpressure->spo2}}％</p>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                        <div class="px-2 flex justify-end">
                                                            <a href="{{ url('bloodpressuresedit/' . $person->id) }}" class="text-stone-500">
                                                                <i class="fa-solid fa-pencil" style="font-size: 1.5em;"></i>
                                                            </a>
                                                        </div>
                                                        <div class="px-2 flex justify-center">
                                                            <a href="{{ url('bloodpressures/'.$person->id) }}" class="text-stone-500">
                                                                <p class="text-red-500 font-bold text-xl">登録する</p>
                                                                @csrf
                                                                <i class="fa-solid fa-plus text-gray-900" style="font-size: 1.5em; padding: 0 5px; transition: transform 0.2s;"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div style="display: flex; flex-direction: column; align-items: center;">
                                                        <a href="{{ url('bloodpressures/'.$person->id) }}" class="relative ml-2" style="display: flex; align-items: center;">
                                                            <summary class="text-red-500 font-bold text-xl">記録してください</summary>
                                                             @csrf
                                                            <i class="fa-solid fa-plus text-gray-900" style="font-size: 1.5em; padding: 0 5px; transition: transform 0.2s;"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                            @else
                                                <a href="{{ url('bloodpressures/'.$person->id) }}"  class="relative ml-2" style="display: flex; align-items: center;">
                                                    <summary class="text-red-500 font-bold text-xl">記録してください</summary>
                                                    @csrf
                                                    <i class="fa-solid fa-plus text-gray-900" style="font-size: 1.5em; padding: 0 5px; transition: transform 0.2s;"></i>
                                                </a>
                                            @endif
                                        </div>
                                  </div>





                                <!-- トイレ登録↓ -->
                        　    　<div class="border-2 p-2 rounded-lg bg-white m-2">
                                <div class="flex justify-start items-center">
                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                    <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                    <i class="fa-solid fa-toilet-paper text-blue-700" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                    <p class="font-bold text-xl ml-2">トイレ</p>
                                </div>
                                <div class="flex items-center justify-center p-4">
                                            @if (!is_null($person) && count($person->kyuuins) > 0)
                                            @php
                                               $today = \Carbon\Carbon::now()->toDateString();
                                               $todaysToilets = $person->toilets()
                                                ->where('created_at', '>=', $today)
                                                ->where('created_at', '<', $today . ' 23:59:59')
                                                ->orderBy('created_at', 'asc') // 昇順に並べ替え
                                                ->get();
                                            @endphp

                                                @if ($todaysToilets->count() > 0)
                                                <div class="flex flex-col">
                                                    <!--<div style="display: flex; align-items: center; justify-content: center; flex-direction: column;">-->
                                                        <p class="text-gray-900 font-bold text-lg">トイレをした時間</p>
                                                        <!-- 今日のトイレ時間リスト -->
                                                        @foreach ($todaysToilets as $toilet)
                                                            <div class="flex-row items-center justify-between p-2 border-b border-gray-300">
                                                                <p class="text-gray-900 font-bold text-lg">{{ $toilet->created_at->format('H:i') }}</p>
                                                            </div>
                                                                <div class="flex items-center justify-around">
                                                        　　　　    <div class="px-2">

                                                                    <p class="text-gray-900 font-bold text-sm">尿量:</p>
                                                                    <p class="text-gray-900 font-bold text-xl">{{ $toilet->urine_amount }}</p>
                                                                </div>

                                                                <div class="px-2">
                                                                    <p class="text-gray-900 font-bold text-sm">便量:</p>
                                                                    <p class="text-gray-900 font-bold text-xl">{{ $toilet->ben_amount }}</p>
                                                                </div>

                                                                <div class="px-2">
                                                                    <p class="text-gray-900 font-bold text-sm">便状態:</p>
                                                                    <p class="text-gray-900 font-bold text-xl">{{ $toilet->ben_condition }}</p>
                                                                </div>
                                                        </div>
                                                        @endforeach
                                                            <a href="{{ url('toiletedit/' . $person->id) }}" class="text-stone-500">
                                                                <i class="fa-solid fa-pencil" style="font-size: 1.5em;"></i>
                                                            </a>
                                                        <div class="px-2 flex justify-center">
                                                            <a href="{{ url('toilet/'.$person->id) }}" class="text-stone-500">
                                                                <p class="text-red-500 font-bold text-xl">登録する</p>
                                                                @csrf
                                                                <i class="fa-solid fa-plus text-gray-900" style="font-size: 1.5em; padding: 0 5px; transition: transform 0.2s;"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div style="display: flex; flex-direction: column; align-items: center;">
                                                        <a href="{{ url('toilet/'.$person->id) }}" class="relative ml-2" style="display: flex; align-items: center;">
                                                            <summary class="text-red-500 font-bold text-xl">記録してください</summary>
                                                             @csrf
                                                            <i class="fa-solid fa-plus text-gray-900" style="font-size: 1.5em; padding: 0 5px; transition: transform 0.2s;"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                            @else
                                                <a href="{{ url('toilet/'.$person->id) }}"  class="relative ml-2" style="display: flex; align-items: center;">
                                                    <summary class="text-red-500 font-bold text-xl">記録してください</summary>
                                                    @csrf
                                                    <i class="fa-solid fa-plus text-gray-900" style="font-size: 1.5em; padding: 0 5px; transition: transform 0.2s;"></i>
                                                </a>
                                            @endif
                                        </div>
                                  </div>

                            <!--吸引登録↓-->
                            　<div class="border-2 p-2 rounded-lg bg-white m-2">
                                <div class="flex justify-start items-center">
                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                    <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                    <i class="fa-solid fa-droplet text-sky-500" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                    <p class="font-bold text-xl ml-2">吸引</p>
                                </div>
                                 <div class="flex items-center justify-center p-4">
                                            @if (!is_null($person) && count($person->kyuuins) > 0)
                                            @php
                                               $today = \Carbon\Carbon::now()->toDateString();
                                               $todaysKyuuins = $person->kyuuins()
                                                ->where('created_at', '>=', $today)
                                                ->where('created_at', '<', $today . ' 23:59:59')
                                                ->orderBy('created_at', 'asc') // 昇順に並べ替え
                                                ->get();
                                            @endphp

                                                @if ($todaysKyuuins->count() > 0)
                                                <div class="flex flex-col">
                                                    <!--<div style="display: flex; align-items: center; justify-content: center; flex-direction: column;">-->
                                                        <p class="text-gray-900 font-bold text-lg">吸引した時間</p>
                                                        <!-- 今日の吸引時間リスト -->
                                                        @foreach ($todaysKyuuins as $kyuuin)
                                                            <div class="flex-row items-center justify-between p-2 border-b border-gray-300">
                                                                <p class="text-gray-900 font-bold text-lg">{{ $kyuuin->created_at->format('H:i') }}</p>
                                                            </div>
                                                        @endforeach
                                                            <a href="{{ url('kyuuinedit/' . $person->id) }}" class="text-stone-500">
                                                                <i class="fa-solid fa-pencil" style="font-size: 1.5em;"></i>
                                                            </a>
                                                        <div style="display: flex; flex-direction: column; align-items: center;">
                                                                <form action="{{ route('kyuuin.store', $person->id) }}" method="POST" enctype="multipart/form-data">
                                                                    <details class="justify-center">

                                                                    <summary class="text-red-500 font-bold text-xl">登録する</summary>
                                                                    @csrf

                                                                    <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                                    <div style="display: flex; align-items: center; justify-content: center; flex-direction: column;">
                                                                        <div class="flex flex-col items-center justify-center">
                                                                            <p class="text-gray-900 font-bold text-xl">吸引した時間</p>
                                                                            <input type="time" name="created_at" id="scheduled-time">
                                                                        </div>

                                                                        <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                                            <p class="text-gray-900 font-bold text-xl">備考</p>
                                                                            <textarea id="result-speech" name="bikou" class="w-3/4 max-w-lg font-bold" style="height: 200px;"></textarea>
                                                                        </div>
                                                                        <label class="block text-lg font-bold text-gray-700">写真を登録する</label>
                                                                            <div style="margin-left: 10px;">
                                                                                <input name="filename" id="filename" type="file" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm text-lg border-gray-300 rounded-md ml-20">
                                                                            </div>
                                                                        <div class="my-2" style="display: flex; justify-content: center; align-items: center; max-width: 300px;">
                                                                          <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                                            送信
                                                                          </button>
                                                                        </div>
                                                                    </div>
                                                                    </details>
                                                                </form>

                                                        </div>
                                                    </div>

                                                @else
                                                  <div style="display: flex; flex-direction: column; align-items: center;">
                                                        <form action="{{ route('kyuuin.store', $person->id) }}" method="POST" enctype="multipart/form-data">
                                                            <details class="justify-center"> <!-- この行を追加 -->

                                                            <summary class="text-red-500 font-bold text-xl">登録する</summary>
                                                            @csrf
                                                            <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                            <div style="display: flex; align-items: center; justify-content: center; flex-direction: column;">
                                                                <div class="flex flex-col items-center justify-center">
                                                                    <p class="text-gray-900 font-bold text-xl">吸引した時間</p>
                                                                    <input type="time" name="created_at" id="scheduled-time">
                                                                </div>

                                                                <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                                    <p class="text-gray-900 font-bold text-xl">備考</p>
                                                                    <textarea id="result-speech" name="bikou" class="w-3/4 max-w-lg font-bold" style="height: 200px;"></textarea>
                                                                </div>
                                                                <label class="block text-lg font-bold text-gray-700">写真を登録する</label>
                                                                    <div style="margin-left: 10px;">
                                                                        <input name="filename" id="filename" type="file" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm text-lg border-gray-300 rounded-md ml-20">
                                                                    </div>

                                                                <div class="my-2" style="display: flex; justify-content: center; align-items: center; max-width: 300px;">
                                                                  <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                                    送信
                                                                  </button>
                                                                </div>
                                                            </div>
                                                        </details>
                                                    </form>
                                                    <!--</div>-->
                                                    </div>
                                                @endif
                                            @else
                                                <form action="{{ route('kyuuin.store', $person->id) }}" method="POST" enctype="multipart/form-data">
                                                    <details>
                                                         <summary class="text-red-500 font-bold text-xl">登録する</summary>
                                                        @csrf
                                                            <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                            <div style="display: flex; align-items: center; justify-content: center; flex-direction: column;">
                                                                <div class="flex items-center justify-center">
                                                                    <p class="text-gray-900 font-bold text-xl">吸引した時間</p>
                                                                    <input type="time" name="created_at" id="scheduled-time">
                                                                </div>

                                                                <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                                    <p class="text-gray-900 font-bold text-xl">備考</p>
                                                                    <textarea id="result-speech" name="bikou" class="w-3/4 max-w-lg font-bold" style="height: 200px;"></textarea>
                                                                </div>
                                                                <label class="block text-lg font-bold text-gray-700">写真を登録する</label>
                                                                    <div style="margin-left: 10px;">
                                                                        <input name="filename" id="filename" type="file" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm text-lg border-gray-300 rounded-md ml-20">
                                                                    </div>
                                                                <div class="my-2" style="display: flex; justify-content: center; align-items: center; max-width: 300px;">
                                                                  <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                                    送信
                                                                  </button>
                                                                </div>
                                                            </div>
                                                    </details>
                                                </form>
                                            @endif
                                        </div>
                                  </div>

                                     <!--発作↓-->
                            　<div class="border-2 p-2 rounded-lg bg-white m-2">
                                <div class="flex justify-start items-center">
                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                    <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                    <i class="fa-solid fa-circle-exclamation text-pink-600" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                    <p class="font-bold text-xl ml-2">発作</p>
                                </div>
                                 <div class="flex items-center justify-center p-4">
                                            @if (!is_null($person) && count($person->hossas) > 0)
                                            @php
                                               $today = \Carbon\Carbon::now()->toDateString();
                                               $todaysHossas = $person->hossas()
                                                ->where('created_at', '>=', $today)
                                                ->where('created_at', '<', $today . ' 23:59:59')
                                                ->orderBy('created_at', 'asc') // 昇順に並べ替え
                                                ->get();
                                            @endphp

                                                @if ($todaysHossas->count() > 0)
                                                <div class="flex flex-col">
                                                        <p class="text-gray-900 font-bold text-lg">発作が起きた時間</p>
                                                        <!-- 今日発作が起きた時間 -->
                                                        @foreach ($todaysHossas as $hossa)
                                                            <div class="flex-row items-center justify-between p-2 border-b border-gray-300">
                                                                <p class="text-gray-900 font-bold text-lg">{{ $hossa->created_at->format('H:i') }}</p>
                                                            </div>
                                                        @endforeach
                                                            <a href="{{ url('hossaedit/' . $person->id) }}" class="text-stone-500">
                                                                <i class="fa-solid fa-pencil" style="font-size: 1.5em;"></i>
                                                            </a>
                                                        <div style="display: flex; flex-direction: column; align-items: center;">
                                                                <form action="{{ route('hossa.store', $person->id) }}" method="POST" enctype="multipart/form-data">
                                                                    <details class="justify-center">

                                                                    <summary class="text-red-500 font-bold text-xl">登録する</summary>
                                                                    @csrf

                                                                    <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                                    <div style="display: flex; align-items: center; justify-content: center; flex-direction: column;">
                                                                        <div class="flex flex-col items-center justify-center">
                                                                            <p class="text-gray-900 font-bold text-xl">発作が起きた時間</p>
                                                                            <input type="time" name="created_at" id="scheduled-time">
                                                                        </div>

                                                                        <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                                            <p class="text-gray-900 font-bold text-xl">備考</p>
                                                                            <textarea id="result-speech" name="hossa_bikou" class="w-3/4 max-w-lg font-bold" style="height: 200px;"></textarea>
                                                                        </div>
                                                                        <label class="block text-lg font-bold text-gray-700">動画を登録する</label>
                                                                            <div style="margin-left: 10px;">
                                                                                <input name="filename" id="filename" type="file" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm text-lg border-gray-300 rounded-md ml-20">
                                                                            </div>
                                                                        <div class="my-2" style="display: flex; justify-content: center; align-items: center; max-width: 300px;">
                                                                          <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                                            送信
                                                                          </button>
                                                                        </div>
                                                                    </div>
                                                                    </details>
                                                                </form>

                                                        </div>
                                                    </div>

                                                @else
                                                  <div style="display: flex; flex-direction: column; align-items: center;">
                                                        <form action="{{ route('hossa.store', $person->id) }}" method="POST" enctype="multipart/form-data">
                                                            <details class="justify-center"> <!-- この行を追加 -->

                                                            <summary class="text-red-500 font-bold text-xl">登録する</summary>
                                                            @csrf
                                                            <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                            <div style="display: flex; align-items: center; justify-content: center; flex-direction: column;">
                                                                <div class="flex flex-col items-center justify-center">
                                                                    <p class="text-gray-900 font-bold text-xl">発作が起きた時間</p>
                                                                    <input type="time" name="created_at" id="scheduled-time">
                                                                </div>

                                                                <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                                    <p class="text-gray-900 font-bold text-xl">備考</p>
                                                                    <textarea id="result-speech" name="hossa_bikou" class="w-3/4 max-w-lg font-bold" style="height: 200px;"></textarea>
                                                                </div>
                                                                <label class="block text-lg font-bold text-gray-700">動画を登録する</label>
                                                                    <div style="margin-left: 10px;">
                                                                        <input name="filename" id="filename" type="file" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm text-lg border-gray-300 rounded-md ml-20">
                                                                    </div>

                                                                <div class="my-2" style="display: flex; justify-content: center; align-items: center; max-width: 300px;">
                                                                  <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                                    送信
                                                                  </button>
                                                                </div>
                                                            </div>
                                                        </details>
                                                    </form>
                                                    <!--</div>-->
                                                    </div>
                                                @endif
                                            @else
                                                <form action="{{ route('hossa.store', $person->id) }}" method="POST" enctype="multipart/form-data">
                                                    <details>
                                                         <summary class="text-red-500 font-bold text-xl">登録する</summary>
                                                        @csrf
                                                            <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                            <div style="display: flex; align-items: center; justify-content: center; flex-direction: column;">
                                                                <div class="flex items-center justify-center">
                                                                    <p class="text-gray-900 font-bold text-xl">発作が起きた時間</p>
                                                                    <input type="time" name="created_at" id="scheduled-time">
                                                                </div>

                                                                <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                                    <p class="text-gray-900 font-bold text-xl">備考</p>
                                                                    <textarea id="result-speech" name="hossa_bikou" class="w-3/4 max-w-lg font-bold" style="height: 200px;"></textarea>
                                                                </div>
                                                                <label class="block text-lg font-bold text-gray-700">動画を登録する</label>
                                                                    <div style="margin-left: 10px;">
                                                                        <input name="filename" id="filename" type="file" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm text-lg border-gray-300 rounded-md ml-20">
                                                                    </div>
                                                                <div class="my-2" style="display: flex; justify-content: center; align-items: center; max-width: 300px;">
                                                                  <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                                    送信
                                                                  </button>
                                                                </div>
                                                            </div>
                                                    </details>
                                                </form>
                                            @endif
                                        </div>
                                  </div>
                                      <!-- 午前の活動↓ -->
                        　    　<div class="border-2 p-2 rounded-lg bg-white m-2">
                                    <div class="flex justify-start items-center">
                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                        <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                        <i class="fa-solid fa-sun text-orange-600" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                        <p class="font-bold text-xl ml-2">1日の活動・様子</p>
                                    </div>
                                        <div class="flex items-center justify-center p-4">
                                            @if (!is_null($person) && count($person->speeches) > 0)
                                                @php
                                                    $lastSpeech = $person->speeches->whereNotNull('morning_activity')->last();
                                                    $lastSpeechDate = $lastSpeech ? \Carbon\Carbon::parse($lastSpeech->created_at)->toDateString() : null;
                                                    $today = \Carbon\Carbon::now()->toDateString();
                                                @endphp

                                            @if ($lastSpeechDate === $today)
                                          　     <!-- 登録済みの場合 -->
                                          　     <a href="{{ url('morningspeechchange/'.$person->id) }}" class="relative ml-2 flex items-center">
                                                     @csrf
                                                <p class="font-bold text-xl p-2">済</p>
                                                <i class="fa-solid fa-pencil text-stone-500" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s; vertical-align: middle;"></i>
                                                </a>
                                            @else
                                                <!-- 登録していない場合 -->
                                                <a href="{{ url('morningspeech/'.$person->id.'/edit') }}" class="relative ml-2" style="display: flex; align-items: center;">
                                                <summary class="text-red-500 font-bold text-xl">登録してください</summary>
                                                @csrf
                                                <i class="fa-solid fa-plus text-gray-900" style="font-size: 1.5em; padding: 0 5px; transition: transform 0.2s;"></i>
                                                </a>

                                            @endif
                                            @else
                                                <!-- 登録していない場合 -->
                                                <a href="{{ url('morningspeech/'.$person->id.'/edit') }}" class="relative ml-2" style="display: flex; align-items: center;">
                                                    <summary class="text-red-500 font-bold text-xl">登録してください</summary>
                                                    @csrf
                                                    <i class="fa-solid fa-plus text-gray-900" style="font-size: 1.5em; padding: 0 5px; transition: transform 0.2s;"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>




                                        <div class="border-2 p-2 rounded-lg bg-white mx-2 mb-2 mt-8">
                                          <div class="flex justify-start items-center">
                                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                            <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                            <i class="fa-regular fa-clipboard text-green-700" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                            <p class="font-bold text-xl ml-2">{{ $person->person_name }}さんの記録</p>
                                          </div>
                                          <div class="flex justify-center mt-4">
                                            <a href="{{ url('record/'.$person->id.'/edit') }}" class="relative">
                                              @csrf
                                              <i class="material-icons md-90">add</i>
                                            </a>
                                          </div>
                                    　　</div>
                                  　　


                                   <!-- 動画マニュアル↓ -->
                        　    　<!--<div class="border-2 p-2 rounded-lg bg-white m-2">-->
                              <!--      <div class="flex justify-start items-center">-->
                              <!--          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />-->
                              <!--          <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>-->
                              <!--          <i class="fa-solid fa-circle-play text-blue-700" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>-->
                              <!--          <p class="font-bold text-xl ml-2">{{ $person->person_name }}さんの動画マニュアル</p>-->
                              <!--      </div>-->
                              <!--          <div class="flex justify-center mt-4">-->

                              <!--              @if ($person->videos && ($person->videos->isEmpty()) )-->
                                            <!-- 登録していない場合 -->
                              <!--                  <a href="{{ url('videos/'.$person->id) }}" class="relative ml-2 flex items-center">-->
                              <!--                  <summary class="text-red-500 font-bold text-xl ml-1.5">登録する</summary>-->
                              <!--                  @csrf-->
                              <!--                  <i class="fa-solid fa-plus text-gray-900" style="font-size: 1.5em; padding: 0 5px; transition: transform 0.2s;"></i>-->
                              <!--                  </a>-->

                              <!--              @else-->

                                          　    <!-- 登録済みの場合 -->
                              <!--                  <a href="{{ url('videos/'.$person->id) }}" class="relative ml-2 flex items-center">-->
                              <!--                       @csrf-->
                              <!--                  <p class="font-bold text-xl p-2">見る</p>-->
                              <!--                  </a>-->
                              <!--              @endif-->
                              <!--              </a>-->
                              <!--            </div>-->
                              <!--      </div> -->


                    </div>
                  </div>
                @endforeach
              </div>
              @if (count($people) % 2 == 0)
                <div class="flex justify-center">
                  <div class="p-2 lg:w-1/3 md:w-1/2 w-full">
                    <!--<div class="h-50 flex items-center border-gray-200 border-2 p-4 rounded-lg"></div>-->
                  </div>
                </div>
              @endif
            @endif

        <!--    <div>-->
        <!--    <form action="{{ route('chart') }}" method="GET">-->
        <!--        @csrf-->
        <!--        <h2>下記のボタンを押下してExcelファイルをダウンロードしてください。</h2>-->
        <!--        <button>download</button>-->
        <!--    </form>-->
        <!--</div>-->
   <!--@endrole-->
   @endhasanyrole
    </div>
  </div>
<!--</section>-->
</div>

 <!--全エリア[END]-->

</body>
</html>
<script>


 const startBtn = document.querySelector('#start-btn');
const stopBtn = document.querySelector('#stop-btn');
const resultSpeech = document.querySelector('#result-speech');

let morningRecognition = initMorningRecognition();

function initMorningRecognition() {
    let recognition = new (webkitSpeechRecognition || SpeechRecognition)();
    recognition.lang = 'ja-JP';
    recognition.interimResults = true;
    recognition.continuous = true;

    let finalTranscript = ''; // 確定した(黒の)認識結果

    recognition.onresult = (event) => {
        let interimTranscript = ''; // 暫定(灰色)の認識結果
        for (let i = event.resultIndex; i < event.results.length; i++) {
            let transcript = event.results[i][0].transcript;
            if (event.results[i].isFinal) {
                finalTranscript += transcript;
                console.log('aaa');
            } else {
                interimTranscript = transcript;
                console.log('bbb');
            }
        }
        console.log('ccc');
        resultSpeech.value = finalTranscript + interimTranscript;
    }

    return recognition;
}

if (startBtn) {
    console.log('Start button found:', startBtn);
    startBtn.onclick = () => {
        console.log('Start button clicked.');
        morningRecognition.start();
    };
} else {
    console.error('Start button not found.');
}

if (stopBtn) {
    stopBtn.onclick = () => {
        morningRecognition.stop();
    }
} else {
    console.error('Stop button not found.');
}

// 午後の活動の認識処理も同様に別のオブジェクトを作成
const startBtn2 = document.querySelector('#start-btn2');
const stopBtn2 = document.querySelector('#stop-btn2');
const afternoonSpeech = document.querySelector('#afternoon-speech');

let afternoonRecognition = initAfternoonRecognition();

function initAfternoonRecognition() {
    let recognition2 = new (webkitSpeechRecognition || SpeechRecognition)();
    recognition2.lang = 'ja-JP';
    recognition2.interimResults = true;
    recognition2.continuous = true;

    let finalTranscript2 = ''; // 確定した(黒の)認識結果

    recognition2.onresult = (event) => {
        let interimTranscript2 = ''; // 暫定(灰色)の認識結果
        for (let i = event.resultIndex; i < event.results.length; i++) {
            let transcript2 = event.results[i][0].transcript;
            if (event.results[i].isFinal) {
                finalTranscript2 += transcript;
                console.log('aaa');
            } else {
                interimTranscript2 = transcript;
                console.log('bbb');
            }
        }
        console.log('ccc');
        afternoonSpeech.value = finalTranscript2 + interimTranscript2;
    }

    return recognition2;
}

if (startBtn2) {
    console.log('Start button 2 found:', startBtn2);
    startBtn2.onclick = () => {
        console.log('Start button 2 clicked.');
        afternoonRecognition.start();
    };
} else {
    console.error('Start button 2 not found.');
}

if (stopBtn2) {
    stopBtn2.onclick = () => {
        afternoonRecognition.stop();
    }
} else {
    console.error('Stop button 2 not found.');
}


// showToiletModal関数を定期的に実行する (例: 1分ごとに実行)
setInterval(showToiletModal, 60000);
const slides = document.querySelectorAll('.slide');
let currentSlide = 0;
function showSlide(n) {
  // すべてのスライドを非表示にする
  for (let i = 0; i < slides.length; i++) {
    slides[i].classList.remove('active');
  }
  // 指定されたスライドを表示する
  slides[n].classList.add('active');
  currentSlide = n;
}
function nextSlide() {
  // 次のスライドを表示する
  if (currentSlide === slides.length - 1) {
    showSlide(0);
  } else {
    showSlide(currentSlide + 1);
  }
}
</script>
</x-app-layout>
