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
        
           <!--<section class="text-gray-600 body-font" _msthidden="29">-->
  <!--<div class="container px-5 py-24 mx-auto" _msthidden="29">-->
   <div class="flex flex-col items-center justify-center w-full my-2">
        <style>
         @import url('https://fonts.googleapis.com/css2?family=Arial&display=swap');
            h1 {
            font-family: Arial, sans-serif; /* フォントをArialに設定 */
          }
        </style>
      <h1 class="sm:text-2xl text-3xl font-bold title-font mb-4 text-gray-900" _msttexthash="91611" _msthidden="1" _msthash="63"></h1>
    </div>
    
                <!-- トイレ誘導のためのモーダル -->
            <div class="fixed inset-0 overflow-y-auto hidden" id="myModal">
                  <!--<div class="modal-overlay absolute inset-0 bg-gray-500 opacity-75"></div>-->
                  <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                    <div class="modal-content py-4 text-left px-6">
                      <div class="modal-header flex justify-between items-center">
                        <h5 class="modal-title text-2xl font-bold">食事記録</h5>
                        <!--<button type="button" class="close" data-dismiss="modal" aria-label="閉じる">-->
                        <!--  <span aria-hidden="true">&times;</span>-->
                        <!--</button>-->
                      </div>
                      <div class="modal-body py-2">
                        <p class="text-lg">朝ごはんの記録はつけましたか？</p>
                      </div>
                      <div class="modal-footer flex justify-end items-center py-2">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="myModal .close">閉じる</button>
                      </div>
                    </div>
                  </div>
            </div>



    <!-- 現在の本 -->
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
                     
                     <a href="{{ url('chart/'.$person->id.'/edit') }}" class="relative  ml-2">
                                                                 @csrf

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
                      </a>
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
                                            @if ($lastFood && $lastFood->created_at->diffInHours(now()) >= 6)
                                                <p class="text-red-500 font-bold text-xl">登録して<br>ください</p>
                                                 <a href="{{ url('food/'.$person->id.'/edit') }}" class="relative  ml-2">
                                                     @csrf
                                                 <i class="material-icons md-90 ml-auto">add</i>
                                                 </a>
                                            @else
                                                <!-- 直近の検温結果表示 -->
                                                <div class="flex justify-evenly">
                                                        <a href="{{ route('foods.show', $lastFood->id) }}" class="font-bold text-xl">
                                                            <div class="px-1.5">
                                                                <p class="text-gray-900 font-bold text-sm">摂取量:</p>
                                                                <p class="text-gray-900 font-bold text-xl">{{ $lastFood->staple_food }}</p>
                                                            </div>
                                                        </a>
                                                        <a href="{{ route('foods.show', $lastFood->id) }}" class="font-bold text-xl">
                                                            <div class="px-1.5">
                                                                <p class="text-gray-900 font-bold text-sm">服用:</p>
                                                                <p class="text-gray-900 font-bold text-xl">{{ $lastFood->medicine == 'yes' ? 'あり' : 'なし' }}</p>
                                                            </div>
                                                         </a>
                                                    </div>
                                            @endif
                                        @else
                                            
                                            <p class="text-red-500 font-bold text-xl">登録して<br>ください</p>
                                                 <a href="{{ url('food/'.$person->id.'/edit') }}" class="relative  ml-2">
                                                     @csrf
                                                 <i class="material-icons md-90 ml-auto">add</i>
                                                 </a>
                                        @endif
                                    </div>
                                </div>
                  
                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                        <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                        <a href="{{ url('food/'.$person->id.'/edit') }}" class="relative">
                                          
                                          <!--<i class="fa-solid fa-bowl-rice text-blue-500 hover:text-blue-500" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>-->
                                            <!--<span class="absolute bottom-full left-1/2 transform -translate-x-1/2 bg-white text-gray-900 px-6 py-2 rounded-lg text-lg font-bold opacity-0 transition-opacity duration-300 border-4 border-lime-600" style="writing-mode: horizontal-tb; width: 200px;">食事量を入力する</span>-->
                                        </a>
                                        
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
                                           $lastTemperature = $person->temperatures->last();
                                        @endphp
                                            @if ($lastTemperature->created_at->diffInHours(now()) >= 6)
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
                                              
                                                <div style="display: flex; flex-direction: column; align-items: center;">
                                                <details class="justify-center"> <!-- この行を追加 -->
                                                    
                                                        <summary class="text-red-500 font-bold text-xl">検温してください</summary>
                                                        <form action="{{ route('temperatures.store', $person->id) }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                                <div class="flex items-center justify-center ml-4">
                                                                    <input name="temperature" id="text-box" class="appearance-none block w-1/2 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white font-bold" type="text" placeholder="">
                                                                    <p class="text-gray-900 font-bold text-xl">℃</p>
                                                                </div>
                                                                
                                                                <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                                    <p class="text-gray-900 font-bold text-xl">備考</p>
                                                                    <textarea id="result-speech" name="bikou" class="w-3/4 max-w-lg" style="height: 200px;"></textarea>
                                                                </div>
                                                            <div class="my-2" style="display: flex; justify-content: center; align-items: center; max-width: 300px;">
                                                              <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                                送信
                                                              </button>
                                                            </div>
                                                        </form>
                                                    
                                                </details>
                                                <!--</div>-->
                                                </div>
                                            @else
                                                <!-- 直近の検温結果表示 -->
                                                <a href="{{ route('temperatures.show', $lastTemperature->id) }}" class="font-bold text-xl">{{ $lastTemperature->temperature }}℃</a>
                                            @endif
                                        @else
                                            <details>
                                                <summary class="text-red-500 font-bold text-xl">検温してください</summary>
                                                <form action="{{ route('temperatures.store', $person->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                        <div class="flex items-center justify-center ml-4">
                                                            <input name="temperature" id="text-box" class="appearance-none block w-1/2 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white font-bold" type="text" placeholder="">
                                                            <p class="text-gray-900 font-bold text-xl">℃</p>
                                                        </div>
                                                        
                                                        <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                            <p class="text-gray-900 font-bold text-xl">備考</p>
                                                            <textarea id="result-speech" name="bikou" class="w-3/4 max-w-lg" style="height: 200px;"></textarea>
                                                        </div>
                                                    <div class="my-2" style="display: flex; justify-content: center; align-items: center; max-width: 300px;">
                                                      <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                        送信
                                                      </button>
                                                    </div>
                                                </form>
                                            </details>
                                                
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
                                    
                                    <!-- people.blade.php -->
                                    <div class="flex items-center justify-center p-4">
                                        @if (!is_null($person) && count($person->bloodpressures) > 0)
                                            @php
                                               $lastBloodpressures = $person->bloodpressures->last();
                                            @endphp
                                            @if ($lastBloodpressures->created_at->diffInHours(now()) >= 6)
                                                <!-- 血圧フォーム -->
                                                <summary class="text-red-500 font-bold text-xl">記録してください</summary>
                                                <a href="{{ url('bloodpressures/'.$person->id.'/edit') }}" class="relative ml-2">
                                                    @csrf
                                                <i class="material-icons md-90 ml-auto">add</i>
                                                </a>
                                            @else
                                                <!-- 直近のバイタル結果表示 -->
                                                <a href="{{ route('bloodpressures.show', $lastBloodpressures->id) }}" class="text-gray-900 font-bold text-xl">
                                        　　　　    @csrf
                                            　　　　<div class="flex justify-evenly">
                                            　　　　        <div class="px-1.5">
                                                　　　　        <p class="text-gray-900 font-bold text-sm">血圧:</p>
                                                            <p class="text-gray-900 font-bold text-xl">{{ $lastBloodpressures->max_blood }}/{{ $lastBloodpressures->min_blood }}</p>
                                                            <!--<p class="text-gray-900 font-bold text-sm">/</p>-->
                                                            <!--<p class="text-gray-900 font-bold text-xl">{{ $lastBloodpressures->min_blood }}</p>-->
                                                        </div>
                                                        <div class="px-1.5">
                                                　　　　        <p class="text-gray-900 font-bold text-sm">脈:</p>
                                                            <p class="text-gray-900 font-bold text-xl">{{ $lastBloodpressures->pulse}}/分</p>
                                                            <!--<p class="text-gray-900 font-bold text-sm">/分</p>-->
                                                        </div>
                                                        <div class="px-1.5">
                                                　　　　        <p class="text-gray-900 font-bold text-sm">SpO2:</p>
                                                            <p class="text-gray-900 font-bold text-xl">{{ $lastBloodpressures->spo2}}％</p>
                                                            <!--<p class="text-gray-900 font-bold text-sm">％</p>-->
                                                        </div>
                                                    </div>
                                                </a>
                                            @endif
                                        @else
                                            <summary class="text-red-500 font-bold text-xl">記録してください</summary>
                                                <a href="{{ url('bloodpressures/'.$person->id.'/edit') }}" class="relative ml-2">
                                                    @csrf
                                                <i class="material-icons md-90 ml-auto">add</i>
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
                                    @if (!is_null($person) && count($person->toilets) > 0)
                                        @php
                                            $lastToilets = $person->toilets->last();
                                        @endphp
                                        @if ($lastToilets === null || $lastToilets->created_at->diffInHours(now()) >= 12)
                                            <summary class="text-red-500 font-bold text-xl">誘導してください
                                                <p class="text-red-500 font-bold text-xl">未排便{{ $lastToilets ? $lastToilets->created_at->diffInDays(now()) : 0 }}日目</p>
                                            </summary>
                                            <a href="{{ url('toilet/'.$person->id.'/edit') }}" class="relative ml-2">
                                                @csrf
                                                <i class="material-icons md-90 ml-auto">add</i>
                                            </a>
                                        @else
                                            <div class="flex justify-evenly">
                                                <a href="{{ route('toilets.show', $lastToilets->id) }}" class="font-bold text-xl">
                                                    <div class="px-1.5">
                                                        <p class="text-gray-900 font-bold text-sm">尿量:</p>
                                                        <p class="text-gray-900 font-bold text-xl">{{ $lastToilets->urine_amount }}</p>
                                                    </div>
                                                </a>
                                                <a href="{{ route('toilets.show', $lastToilets->id) }}" class="font-bold text-xl">
                                                    <div class="px-1.5">
                                                        <p class="text-gray-900 font-bold text-sm">便量:</p>
                                                        <p class="text-gray-900 font-bold text-xl">{{ $lastToilets->ben_amount }}</p>
                                                        <p class="text-gray-900 font-bold text-xl">{{ $lastToilets->ben_condition }}</p>
                                                    </div>
                                                </a>
                                            </div>
                                        @endif
                                    @else
                                        <p class="text-red-500 font-bold text-xl">登録して<br>ください</p>
                                        <a href="{{ url('toilet/'.$person->id.'/edit') }}" class="relative ml-2">
                                            @csrf
                                            <i class="material-icons md-90 ml-auto">add</i>
                                        </a>
                                    @endif
                                </div>
                            </div>

                                  
                                
                                      <!-- 午前の活動↓ -->
                        　    　<div class="border-2 p-2 rounded-lg bg-white m-2">
                                    <div class="flex justify-start items-center">
                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                        <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                        <i class="fa-solid fa-sun text-orange-600" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                        <p class="font-bold text-xl ml-2">午前の活動</p>
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
                                                <p class="font-bold text-xl p-2">済</p>
                                                
                                            @else
                                                <!-- 登録していない場合 -->
                                                <!--<details>-->
                                                <summary class="text-red-500 font-bold text-xl">登録してください</summary>
                                                <a href="{{ url('morningspeech/'.$person->id.'/edit') }}" class="relative ml-2">
                                                
                                                
                                                @csrf
                                                <i class="material-icons md-90 ml-auto">add</i>
                                                </a>
                                                
                                            @endif
                                            @else
                                                <!-- 登録していない場合 -->
                                               <summary class="text-red-500 font-bold text-xl">登録してください</summary>
                                                
                                                <a href="{{ url('morningspeech/'.$person->id.'/edit') }}" class="relative ml-2">
                                                @csrf
                                                <i class="material-icons md-90 ml-auto">add</i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    
                                     <!-- 午後の活動↓ -->
                        　    　<div class="border-2 p-2 rounded-lg bg-white m-2">
                                    <div class="flex justify-start items-center">
                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                        <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                        <i class="fa-solid fa-person text-pink-600" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                        <p class="font-bold text-xl ml-2">午後の活動</p>
                                    </div>
                                        <div class="flex items-center justify-center p-4">
                                            @if (!is_null($person) && count($person->speeches) > 0)
                                                @php
                                                    $lastAfternoonSpeech = $person->speeches->whereNotNull('afternoon_activity')->last();
                                                    $lastAfternoonSpeechDate = $lastAfternoonSpeech ? \Carbon\Carbon::parse($lastAfternoonSpeech->created_at)->toDateString() : null;
                                                    $today = \Carbon\Carbon::now()->toDateString();
                                                @endphp
                                                
                                            @if ($lastAfternoonSpeechDate === $today)
                                          　     <!-- 登録済みの場合 -->
                                                <p class="font-bold text-xl p-2">済</p>
                                                
                                            @else
                                                <!-- 登録していない場合 -->
                                                <summary class="text-red-500 font-bold text-xl">登録してください</summary>
                                                <a href="{{ url('afternoonspeech/'.$person->id.'/edit') }}" class="relative ml-2">
                                                @csrf
                                                <i class="material-icons md-90 ml-auto">add</i>
                                                </a>
                                            @endif
                                            @else
                                                <!-- 登録していない場合 -->
                                               <summary class="text-red-500 font-bold text-xl">登録してください</summary>
                                                <a href="{{ url('afternoonspeech/'.$person->id.'/edit') }}" class="relative ml-2">
                                                @csrf
                                                <i class="material-icons md-90 ml-auto">add</i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    　　<div class="border-2 p-2 rounded-lg bg-white m-2">
                                          <div class="flex justify-start items-center">
                                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                            <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                            <i class="fa-regular fa-clipboard text-green-700" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                            <p class="text-green-700 font-bold text-xl ml-2">{{ $person->person_name }}さんの記録</p>
                                          </div>
                                          <div class="flex justify-center mt-4">
                                            <a href="{{ url('record/'.$person->id.'/edit') }}" class="relative">
                                              @csrf
                                              <i class="material-icons md-90">add</i>
                                            </a>
                                          </div>
                                    　　</div>

                                    

                                        
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
    </div>
  </div>
<!--</section>-->


   

            　　
   　　　　　　　　　　　　　
    <!--右側エリア[END]--> 

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