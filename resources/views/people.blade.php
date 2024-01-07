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
                      
                      
                      
                        <!--特記事項↓ -->
                        　    　<!--<div class="border-2 p-2 rounded-lg bg-white m-2">-->
                              <!--      <div class="flex justify-start items-center">-->
                              <!--          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />-->
                              <!--          <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>-->
                              <!--          <i class="fa-solid fa-pencil text-orange-600" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>-->
                              <!--          <p class="font-bold text-xl ml-2">特記事項</p>-->
                              <!--      </div>-->
                              <!--          <div class="flex items-center justify-center p-4">-->
                              <!--              @if (!is_null($person) && count($person->notifications) > 0)-->
                              <!--                  @php-->
                              <!--                      $lastNotification = $person->notifications->whereNotNull('notification')->last();-->
                              <!--                      $lastNotificationDate = $lastNotification ? \Carbon\Carbon::parse($lastNotification->created_at)->toDateString() : null;-->
                              <!--                      $today = \Carbon\Carbon::now()->toDateString();-->
                              <!--                  @endphp-->
                                                
                              <!--              @if ($lastNotificationDate === $today)-->
                                          　     <!-- 登録済みの場合 -->
                              <!--            　     <a href="{{ url('notificationchange/'.$person->id) }}" class="relative ml-2 flex items-center">-->
                              <!--                       @csrf-->
                              <!--                  <p class="font-bold text-xl p-2">{{ $lastNotification->notification }}</p>-->
                              <!--                  <i class="fa-solid fa-pencil text-stone-500" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s; vertical-align: middle;"></i>-->
                              <!--                  </a>-->
                              <!--              @else-->
                                                <!-- 登録していない場合 -->
                              <!--                  <a href="{{ url('notification/'.$person->id.'/edit') }}" class="relative ml-2" style="display: flex; align-items: center;">-->
                              <!--                  <summary class="text-red-500 font-bold text-xl">登録する</summary>-->
                              <!--                  @csrf-->
                              <!--                  <i class="fa-solid fa-plus text-gray-900" style="font-size: 1.5em; padding: 0 5px; transition: transform 0.2s;"></i>-->
                              <!--                  </a>-->
                                                
                              <!--              @endif-->
                              <!--              @else-->
                                                <!-- 登録していない場合 -->
                              <!--                  <a href="{{ url('notification/'.$person->id.'/edit') }}" class="relative ml-2" style="display: flex; align-items: center;">-->
                              <!--                      <summary class="text-red-500 font-bold text-xl">登録する</summary>-->
                              <!--                      @csrf-->
                              <!--                      <i class="fa-solid fa-plus text-gray-900" style="font-size: 1.5em; padding: 0 5px; transition: transform 0.2s;"></i>-->
                              <!--                  </a>-->
                              <!--              @endif-->
                              <!--          </div>-->
                              <!--      </div>-->
                                    
                                    
                                    <!-- 利用時間など↓ -->
                        　    　　  <div class="border-2 p-2 rounded-lg bg-white m-2">
                                    <div class="flex justify-start items-center">
                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                        <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                        <i class="fa-regular fa-clock text-pink-500" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                        <p class="font-bold text-xl ml-2">利用時間・送迎</p>
                                    </div>
                                    
                                   <div class="flex items-center justify-center p-4">
                                      <!-- 登録していない場合 -->
                                        @php
                                           $lastTime = $person->times->last();
                                        @endphp
                                        
                                           @if (!$lastTime || $lastTime->created_at->diffInHours(now()) >= 6)
                                            
                                            <form action="{{ route('time.store', $person->id) }}" method="POST">
                                            <details class="justify-center">
                                            <summary class="text-red-500 font-bold text-xl">登録する</summary>
                                            @csrf
                                            <i class="fa-solid fa-plus text-gray-900" style="font-size: 1.5em; padding: 0 5px; transition: transform 0.2s;"></i>
                                            
                                            
                                                        <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                            <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <p class="text-gray-900 font-bold text-xl px-1.5">利用時間</p>
                                                            </div>
                                                            
                                                             <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <!--<label for="usage_date" class="text-gray-900 font-bold text-xl px-1.5">利用日:</label>-->
                                                                
                                                                <input type="date" name="date" id="usage_date" value="{{ now()->format('Y-m-d') }}" required>
                                                            </div>
    
                                                            <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <input type="time" name="start_time" id="scheduled-time">
                                                                <p class="text-gray-900 font-bold text-xl px-1.5">～</p>
                                                            </div>
                                                            
                                                            <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <input type="time" name="end_time" id="scheduled-time">
                                                            </div>
                                                            
                                                            <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <i class="fa-solid fa-school text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
                                                                <p class="text-gray-900 font-bold text-xl px-1.5">学校</p>
                                                            </div>
                                                            
                                                             <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <select name="school" class="mx-1 my-1.5" style="width: 6rem;">
                                                                    <option value="登録なし">選択</option>
                                                                    <option value="授業終了後">授業終了後</option>
                                                                    <option value="休校">休校</option>
                                                                    <option value="欠席">欠席</option>
                                                                </select>
                                                            </div>
                                                            
                                                            <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <i class="fa-solid fa-bus text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
                                                                <p class="text-gray-900 font-bold text-xl px-1.5">送迎</p>
                                                            </div>
                                                            
                                                            <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <input type="checkbox" name="pick_up[]" value="送り"　checked class="w-6 h-6">
                                                                <p class="text-gray-900 font-bold text-xl px-1.5">送り</p>
                                                            </div>
                                                            
                                                            <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <input type="checkbox" name="send[]" value="迎え"　checked class="w-6 h-6">
                                                                <p class="text-gray-900 font-bold text-xl px-1.5">迎え</p>
                                                            </div>
                                                            
                                                            
                                                        <div class="my-2" style="display: flex; justify-content: center; align-items: center; max-width: 300px;">
                                                          <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                            送信
                                                          </button>
                                                        </div>
                                                    </details>
                                                </form>
                                                @else
                                                <!-- 直近のトレーニング結果表示 -->
                                                <div class="flex justify-evenly">
                                                <a href="{{ url('timechange/'.$person->id) }}" class="relative ml-2 flex items-center">
                                                     @csrf
                                                <div class="flex items-center justify-around">
                                                    @php
                                                        $pick_upData = json_decode($lastTime->pick_up);
                                                        $sendData = json_decode($lastTime->send);
                                                    @endphp
                                                    <div class="flex justify-evenly">
                                                        
                                                        
                                                        <div class="px-1.5">
                                                            <p class="text-gray-900 font-bold text-base">利用日:</p>
                                                            <p class="text-gray-900 font-bold text-xl">{{ \Carbon\Carbon::parse($lastTime->date)->format('n月j日') }}</p>

                                                            <p class="text-gray-900 font-bold text-xl">{{ $lastTime->start_time->format('H:i') }}～{{ $lastTime->end_time->format('H:i') }}</p>

                                                        </div>
                                                        
                                                        @if(!empty($pick_upData) && is_array($pick_upData) && count($pick_upData) > 0)
                                                        <div class="px-1.5">
                                                            <p class="text-gray-900 font-bold text-base">迎え:</p>
                                                            <p class="text-gray-900 font-bold text-xl px-1">済</p>
                                                        </div>
                                                        @endif
                                                        
                                                        @if(!empty($sendData) && is_array($sendData) && count($sendData) > 0)
                                                        <div class="px-1.5">
                                                            <p class="text-gray-900 font-bold text-base">送り:</p>
                                                            <p class="text-gray-900 font-bold text-xl px-1">済</p>
                                                        </div>
                                                        @endif
                                                    
                                                    
                                                    </div>
                                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                                    <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                                    <i class="fa-solid fa-pencil text-stone-500" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                                </a>
                                                </div>
                                               </div>
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
                                                    <form action="{{ route('temperatures.store', $person->id) }}" method="POST">
                                                        <details class="justify-center"> <!-- この行を追加 -->
                                                    
                                                        <summary class="text-red-500 font-bold text-xl">検温してください</summary>
                                                        @csrf
                                                        <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                            <div class="flex items-center justify-center ml-4">
                                                                <input name="temperature" id="text-box" class="appearance-none block w-1/2 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white font-bold" type="text" placeholder="">
                                                                <p class="text-gray-900 font-bold text-xl">℃</p>
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
                                                    </details>
                                                </form>
                                                <!--</div>-->
                                                </div>
                                            @else
                                                <!-- 直近の検温結果表示 -->
                                                <a href="{{ url('temperaturechange/'.$person->id) }}" class="relative ml-2 flex items-center">
                                                     @csrf
                                                    <p class="text-gray-900 font-bold text-2xl">{{ $lastTemperature->temperature }}℃</p>
                                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                                    <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                                    <i class="fa-solid fa-pencil text-stone-500" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                                </a>
                                            @endif
                                        @else
                                            <form action="{{ route('temperatures.store', $person->id) }}" method="POST">
                                                <details>
                                                     <summary class="text-red-500 font-bold text-xl">検温してください</summary>
                                                    @csrf
                                                        <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                            <div class="flex items-center justify-center ml-4">
                                                                <input name="temperature" id="text-box" class="appearance-none block w-1/2 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white font-bold" type="text" placeholder="">
                                                                <p class="text-gray-900 font-bold text-xl">℃</p>
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
                                                </details>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                                
                                <!-- 食事登録↓ -->
                        　    　 <div class="border-2 p-2 rounded-lg bg-white m-2">
                                    <div class="flex justify-start items-center">
                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                        <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                        <i class="fa-solid fa-bowl-rice text-emerald-700" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                        <p class="font-bold text-xl ml-2">食事</p>
                                    </div>
                                    
                                    <!-- people.blade.php -->
                                   <div class="flex items-center justify-center p-4">
                                        
                                        
                                        @php
                                           $lastFood = $person->foods->last();
                                           
                                        @endphp
                                            @if ($lastFood && $lastFood->created_at->diffInHours(now()) >= 6)
                                            
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
                                        
                                       
                                        <form action="{{ route('food.store', $person->id) }}" method="POST">
                                        <details class="justify-center">
                                        <summary class="text-red-500 font-bold text-xl">登録する</summary>
                                                @csrf
                                        <div class="flex items-center justify-center">
                                      <!--<div style="display: flex; flex-direction: column;">-->
                                         <div class="flex flex-col items-center">        
                                        <i class="fa-solid fa-plus text-gray-900" style="font-size: 1.5em; padding: 0 5px; transition: transform 0.2s;"></i>
                                        <input type="hidden" name="people_id" value="{{ $person->id }}">
                                        
                              
                                    <div style="display: flex; flex-direction: column; align-items: center;">
                                        
                                          <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                            <!--<input name="staple_food" type="text" id="staple_food" class="w-1/4 h-8px flex-shrink-0 break-words mx-1">-->
                                            <p class="text-gray-900 font-bold text-xl">昼食</p>
                                                <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                    <select name="lunch" class="mx-1 my-1.5" style="width: 6rem;">
                                                        <option value="selected">選択</option>
                                                        <option value="あり">あり</option>
                                                        <option value="なし">なし</option>
                                                    </select>
                                                </div>
                                          </div>
                                        <!--</div>-->
                                        <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                          <p class="text-gray-900 font-bold text-xl">備考（メニューなど）<p>
                                          <textarea id="result-speech" name="lunch_bikou" class="w-full max-w-lg font-bold" style="height: 150px;"></textarea>
                                        </div>
                                        
                                        <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                            <p class="text-gray-900 font-bold text-xl">間食</p>
                                                <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                    <select name="oyatsu" class="mx-1 my-1.5" style="width: 6rem;">
                                                        <option value="selected">選択</option>
                                                        <option value="あり">あり</option>
                                                        <option value="なし">なし</option>
                                                    </select>
                                                </div>
                                          </div>
                                        <!--</div>-->
                                        <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                          <p class="text-gray-900 font-bold text-xl">備考（メニューなど）<p>
                                          <textarea id="result-speech" name="oyatsu_bikou" class="w-full max-w-lg font-bold" style="height: 150px;"></textarea>
                                        </div>
                                    </div>
                               
                                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    送信
                                    </button>
                                </div>
                            </div>
                        </details>
                        </form>
                                            @else
                                                <!-- 直近の検温結果表示 -->
                                                <div class="flex justify-evenly">
                                                <a href="{{ url('foodchange/'.$person->id) }}" class="relative ml-2 flex items-center">
                                                     @csrf
                                               
                                                        <div class="px-1.5">
                                                            <p class="text-gray-900 font-bold text-base">昼食:</p>
                                                            <p class="text-gray-900 font-bold text-2xl">{{ $lastFood->lunch }}</p>
                                                        </div>
                                                    
                                                        <div class="px-1.5">
                                                            <p class="text-gray-900 font-bold text-base">間食:</p>
                                                            <p class="text-gray-900 font-bold text-2xl">{{ $lastFood->oyatsu }}</p>
                                                        </div>
                                                    
                                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                                    <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                                    <i class="fa-solid fa-pencil text-stone-500" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                                </a>
                                               </div>
                                            @endif
                                        
                                    </div>
                                </div>
                  
                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                        <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                        <a href="{{ url('food/'.$person->id.'/edit') }}" class="relative">
                                        </a>
                                        
                                    <!-- トイレ登録↓ -->
                        　    　<div class="border-2 p-2 rounded-lg bg-white m-2">
                                <div class="flex justify-start items-center">
                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                    <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                    <i class="fa-solid fa-toilet-paper text-blue-700" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                    <p class="font-bold text-xl ml-2">トイレ</p>
                                </div>
                                <div class="flex items-center justify-center p-4">
                                    
                                        @php
                                            $lastToilets = $person->toilets->last();
                                        @endphp
                                        @if ($lastToilets === null || $lastToilets->created_at->diffInHours(now()) >= 12)
                                    <form action="{{ route('toilet.store', $person->id) }}" method="POST">
                                                @csrf
                                            <div>
                                                <details>
                                                     <summary class="text-red-500 font-bold text-xl">記録してください</summary>
                                                   
                                                        <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                            <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                                <p class="text-gray-900 font-bold text-xl">尿</p>
                                                                    <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                                        <select name="urine" class="mx-1 my-1.5" style="width: 6rem;">
                                                                            <option value="selected">選択</option>
                                                                            <option value="あり">あり</option>
                                                                            <option value="なし">なし</option>
                                                                        </select>
                                                                    </div>
                                                            </div>
                                                            
                                                            <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                                <p class="text-gray-900 font-bold text-xl">便</p>
                                                                    <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                                        <select name="ben" class="mx-1 my-1.5" style="width: 6rem;">
                                                                            <option value="selected">選択</option>
                                                                            <option value="あり">あり</option>
                                                                            <option value="なし">なし</option>
                                                                        </select>
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
                                                </details>
                                               
                                            </div>   
                                            </form>
                                            @else
                                        
                                            <a href="{{ url('toiletchange/'.$person->id) }}" class="relative ml-2 flex items-center">
                                                     @csrf
                                            <div class="flex justify-evenly">
                                                <div class="px-1.5">
                                                    <p class="text-gray-900 font-bold text-sm">尿:</p>
                                                    <p class="text-gray-900 font-bold text-xl">{{ $lastToilets->urine }}</p>
                                                </div>
                                           
                                                <div class="px-1.5">
                                                    <p class="text-gray-900 font-bold text-sm">便:</p>
                                                    <p class="text-gray-900 font-bold text-xl">{{ $lastToilets->ben }}</p>
                                                </div>
                                                <div class="px-2">
                                                     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                                    <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                                    <i class="fa-solid fa-pencil text-stone-500" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                                </div>
                                            </div>
                                            </a>
                                        @endif
                                    
                                </div>
                            </div>    
                                   <!-- トレーニング登録↓ -->
                        　    　　  <div class="border-2 p-2 rounded-lg bg-white m-2">
                                    <div class="flex justify-start items-center">
                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                        <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                        <i class="fa-solid fa-person-walking text-pink-500" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                        <p class="font-bold text-xl ml-2">トレーニング</p>
                                    </div>
                                    
                                   <div class="flex items-center justify-center p-4">
                                      
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
                                        <!-- 登録していない場合 -->
                                        @php
                                           $lastTraining = $person->trainings->last();
                                        @endphp
                                        
                                            @if ($lastTraining || $lastTraining->created_at->diffInHours(now()) >= 6)
                                            <form action="{{ route('training.store', $person->id) }}" method="POST">
                                            <details class="justify-center">
                                            <summary class="text-red-500 font-bold text-xl">登録する</summary>
                                            @csrf
                                            <i class="fa-solid fa-plus text-gray-900" style="font-size: 1.5em; padding: 0 5px; transition: transform 0.2s;"></i>
                                            
                                            
                                                        <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                            <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <p class="text-gray-900 font-bold text-xl px-1.5">本日行ったトレーニング</p>
                                                            </div>
                                                            
                                                            <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <input type="checkbox" name="communication[]" value="コミュニケーション"　checked class="w-6 h-6">
                                                                <p class="text-gray-900 font-bold text-xl px-1.5">コミュニケーション</p>
                                                            </div>
                                                            
                                                             <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <input type="checkbox" name="exercise[]" value="運動"　checked class="w-6 h-6">
                                                                <p class="text-gray-900 font-bold text-xl px-1.5">運動</p>
                                                            </div>
                                                            
                                                            <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <input type="checkbox" name="reading_writing[]" value="読み書き"　checked class="w-6 h-6">
                                                                <p class="text-gray-900 font-bold text-xl px-1.5">読み書き</p>
                                                            </div>
                                                            
                                                            <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <input type="checkbox" name="calculation[]" value="計算"　checked class="w-6 h-6">
                                                                <p class="text-gray-900 font-bold text-xl px-1.5">計算</p>
                                                            </div>
                                                            
                                                            <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <input type="checkbox" name="homework[]" value="宿題"　checked class="w-6 h-6">
                                                                <p class="text-gray-900 font-bold text-xl px-1.5">宿題</p>
                                                            </div>
                                                            
                                                            <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <input type="checkbox" name="shopping[]" value="買い物"　checked class="w-6 h-6">
                                                                <p class="text-gray-900 font-bold text-xl px-1.5">買い物</p>
                                                            </div>
                                                            
                                                            <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <input type="checkbox" name="training_other[]" value="その他"　checked class="w-6 h-6">
                                                                <p class="text-gray-900 font-bold text-xl px-1.5">その他</p>
                                                             </div>
                                                            
                                                            <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                                <p class="text-gray-900 font-bold text-xl">備考</p>
                                                                <textarea id="result-speech" name="training_other_sentence" class="w-3/4 max-w-lg font-bold" style="height: 200px;"></textarea>
                                                            </div>
                                                        <div class="my-2" style="display: flex; justify-content: center; align-items: center; max-width: 300px;">
                                                          <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                            送信
                                                          </button>
                                                        </div>
                                                    </details>
                                                </form>
                                                @else
                                                <!-- 直近のトレーニング結果表示 -->
                                                <div class="flex justify-evenly">
                                                <a href="{{ url('trainingchange/'.$person->id) }}" class="relative ml-2 flex items-center">
                                                     @csrf
                                                <div class="flex items-center justify-around">
                                                    @php
                                                        $communicationData = json_decode($lastTraining->communication);
                                                        $exerciseData = json_decode($lastTraining->exercise);
                                                        $reading_writingData = json_decode($lastTraining->reading_writing);
                                                        $calculationData = json_decode($lastTraining->calculation);
                                                        $homeworkData = json_decode($lastTraining->homework);
                                                        $shoppingData = json_decode($lastTraining->shopping);
                                                        $training_otherData = json_decode($lastTraining->training_other);
                                                       
                                                        
                                                    @endphp
                                                    
                                                    @if(!empty($communicationData) && is_array($communicationData) && count($communicationData) > 0)
                                                        <p class="text-gray-900 font-bold text-2xl px-1">コミュニケーション</p>
                                                    @endif
                                                    
                                                    @if(!empty($exerciseData) && is_array($exerciseData) && count($exerciseData) > 0)
                                                        <p class="text-gray-900 font-bold text-2xl px-1">運動</p>
                                                    @endif
                                                    
                                                    @if(!empty($reading_writingData) && is_array($reading_writingData) && count($reading_writingData) > 0)
                                                        <p class="text-gray-900 font-bold text-2xl px-1">読み書き</p>
                                                    @endif
                                                    
                                                    @if(!empty($calculationData) && is_array($calculationData) && count($calculationData) > 0)
                                                        <p class="text-gray-900 font-bold text-2xl px-1">計算</p>
                                                    @endif
                                                    
                                                    @if(!empty($homeworkData) && is_array($homeworkData) && count($homeworkData) > 0)
                                                        <p class="text-gray-900 font-bold text-2xl px-1">宿題</p>
                                                    @endif
                                                    
                                                    @if(!empty($shoppingData) && is_array($shoppingData) && count($shoppingData) > 0)
                                                        <p class="text-gray-900 font-bold text-2xl px-1">買い物</p>
                                                    @endif
                                                   
                                                    @if(!empty($training_otherData) && is_array($training_otherData) && count($training_otherData) > 0)
                                                        <p class="text-gray-900 font-bold text-2xl px-1">その他</p>
                                                    @endif
                                                                                                       
                                                     
                                                    
                                                
                                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                                    <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                                    <i class="fa-solid fa-pencil text-stone-500" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                                </a>
                                                </div>
                                               </div>
                                               @endif
                                            </div>
                                         </div>
                                   
                                <!-- 生活習慣登録↓ -->
                        　    　　  <div class="border-2 p-2 rounded-lg bg-white m-2">
                                    <div class="flex justify-start items-center">
                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                        <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                        <i class="fa-solid fa-broom text-amber-700" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                        <p class="font-bold text-xl ml-2">生活習慣</p>
                                    </div>
                                    
                                   <div class="flex items-center justify-center p-4">
                                      <!-- 登録していない場合 -->
                                        @php
                                           $lastLifestyle = $person->lifestyles->last();
                                        @endphp
                                        
                                           @if (!$lastLifestyle || $lastLifestyle->created_at->diffInHours(now()) >= 6)
                                            
                                            <form action="{{ route('lifestyle.store', $person->id) }}" method="POST">
                                            <details class="justify-center">
                                            <summary class="text-red-500 font-bold text-xl">登録する</summary>
                                            @csrf
                                            <i class="fa-solid fa-plus text-gray-900" style="font-size: 1.5em; padding: 0 5px; transition: transform 0.2s;"></i>
                                            
                                            
                                                        <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                            <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <p class="text-gray-900 font-bold text-xl px-1.5">本日行った生活習慣トレーニング</p>
                                                            </div>
                                                            
                                                            <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <input type="checkbox" name="baggage[]" value="荷物整理"　checked class="w-6 h-6">
                                                                <p class="text-gray-900 font-bold text-xl px-1.5">荷物整理</p>
                                                            </div>
                                                            
                                                             <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <input type="checkbox" name="clean[]" value="掃除"　checked class="w-6 h-6">
                                                                <p class="text-gray-900 font-bold text-xl px-1.5">掃除</p>
                                                            </div>
                                                            
                                                            <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <input type="checkbox" name="other[]" value="その他"　checked class="w-6 h-6">
                                                                <p class="text-gray-900 font-bold text-xl px-1.5">その他</p>
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
                                                    </details>
                                                </form>
                                                @else
                                                <!-- 直近のトレーニング結果表示 -->
                                                <div class="flex justify-evenly">
                                                <a href="{{ url('lifestylechange/'.$person->id) }}" class="relative ml-2 flex items-center">
                                                     @csrf
                                                <div class="flex items-center justify-around">
                                                    @php
                                                        $baggageData = json_decode($lastLifestyle->baggage);
                                                        $cleanData = json_decode($lastLifestyle->clean);
                                                        $otherData = json_decode($lastLifestyle->other);
                                                    @endphp
                                                    
                                                    @if(!empty($baggageData) && is_array($baggageData) && count($baggageData) > 0)
                                                        <p class="text-gray-900 font-bold text-2xl px-1">荷物整理</p>
                                                    @endif
                                                    
                                                    @if(!empty($cleanData) && is_array($cleanData) && count($cleanData) > 0)
                                                        <p class="text-gray-900 font-bold text-2xl px-1">掃除</p>
                                                    @endif
                                                    
                                                    @if(!empty($otherData) && is_array($otherData) && count($otherData) > 0)
                                                        <p class="text-gray-900 font-bold text-2xl px-1">その他</p>
                                                    @endif
                                                    
                                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                                    <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                                    <i class="fa-solid fa-pencil text-stone-500" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                                </a>
                                                </div>
                                               </div>
                                               @endif
                                            </div>
                                         </div>
                                         
                                <!-- 創作活動登録↓ -->
                        　    　　  <div class="border-2 p-2 rounded-lg bg-white m-2">
                                    <div class="flex justify-start items-center">
                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                        <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                        <i class="fa-solid fa-brush text-orange-600" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                        <p class="font-bold text-xl ml-2">創作活動</p>
                                    </div>
                                    
                                   <div class="flex items-center justify-center p-4">
                                      <!-- 登録していない場合 -->
                                        @php
                                           $lastCreative = $person->creatives->last();
                                        @endphp
                                        
                                           @if (!$lastCreative || $lastCreative->created_at->diffInHours(now()) >= 6)
                                            
                                            <form action="{{ route('creative.store', $person->id) }}" method="POST">
                                            <details class="justify-center">
                                            <summary class="text-red-500 font-bold text-xl">登録する</summary>
                                            @csrf
                                            <i class="fa-solid fa-plus text-gray-900" style="font-size: 1.5em; padding: 0 5px; transition: transform 0.2s;"></i>
                                            
                                            
                                                        <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                            <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <p class="text-gray-900 font-bold text-xl px-1.5">本日行った創作活動</p>
                                                            </div>
                                                            
                                                            <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <input type="checkbox" name="craft[]" value="図画工作"　checked class="w-6 h-6">
                                                                <p class="text-gray-900 font-bold text-xl px-1.5">図画工作</p>
                                                            </div>
                                                            
                                                             <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <input type="checkbox" name="cooking[]" value="料理"　checked class="w-6 h-6">
                                                                <p class="text-gray-900 font-bold text-xl px-1.5">料理</p>
                                                            </div>
                                                            
                                                            <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <input type="checkbox" name="other[]" value="その他"　checked class="w-6 h-6">
                                                                <p class="text-gray-900 font-bold text-xl px-1.5">その他</p>
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
                                                    </details>
                                                </form>
                                                @else
                                                <!-- 直近のトレーニング結果表示 -->
                                                <div class="flex justify-evenly">
                                                <a href="{{ url('creativechange/'.$person->id) }}" class="relative ml-2 flex items-center">
                                                     @csrf
                                                <div class="flex items-center justify-around">
                                                    @php
                                                        $craftData = json_decode($lastCreative->craft);
                                                        $cookingData = json_decode($lastCreative->cooking);
                                                        $otherData = json_decode($lastCreative->other);
                                                    @endphp
                                                    
                                                    @if(!empty($craftData) && is_array($craftData) && count($craftData) > 0)
                                                        <p class="text-gray-900 font-bold text-2xl px-1">図画工作</p>
                                                    @endif
                                                    
                                                    @if(!empty($cookingData) && is_array($cookingData) && count($cookingData) > 0)
                                                        <p class="text-gray-900 font-bold text-2xl px-1">料理</p>
                                                    @endif
                                                    
                                                    @if(!empty($otherData) && is_array($otherData) && count($otherData) > 0)
                                                        <p class="text-gray-900 font-bold text-2xl px-1">その他</p>
                                                    @endif
                                                    
                                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                                    <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                                    <i class="fa-solid fa-pencil text-stone-500" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                                </a>
                                                </div>
                                               </div>
                                               @endif
                                            </div>
                                         </div>
                                    
                                <!--連絡事項↓ -->
                        　    　<!--<div class="border-2 p-2 rounded-lg bg-white m-2">-->
                              <!--      <div class="flex justify-start items-center">-->
                              <!--          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />-->
                              <!--          <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>-->
                              <!--          <i class="fa-solid fa-comments text-sky-500" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>-->
                              <!--          <p class="font-bold text-xl ml-2">連絡</p>-->
                              <!--      </div>-->
                              <!--          <div class="flex items-center justify-center p-4">-->
                                             
                                            <!-- 登録していない場合 -->
                              <!--              <a href="{{ url('chat/'.$person->id) }}" class="relative ml-2" style="display: flex; align-items: center;">-->
                              <!--              <summary class="text-red-500 font-bold text-xl">連絡する</summary>-->
                              <!--              @csrf-->
                              <!--              <i class="fa-solid fa-plus text-gray-900" style="font-size: 1.5em; padding: 0 5px; transition: transform 0.2s;"></i>-->
                              <!--              </a>-->
                              <!--          </div>-->
                              <!--      </div>-->
                                    
                       
                                        
                        
                                
                              
                            

                                
                            <!-- 集団・個人活動登録↓ -->
                        　    　　  <div class="border-2 p-2 rounded-lg bg-white m-2">
                                    <div class="flex justify-start items-center">
                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                        <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                        <i class="fa-solid fa-people-group text-pink-500" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                        <p class="font-bold text-xl ml-2">集団・個人活動</p>
                                    </div>
                                    
                                   <div class="flex items-center justify-center p-4">
                                      <!-- 登録していない場合 -->
                                        
                                        @php
                                            $lastActivity= $person->activities->last();
                                        @endphp
                                        @if (!$lastActivity || $lastActivity->created_at->diffInHours(now()) >= 6)

                                       <form action="{{ route('activity.store', $person->id) }}" method="POST">
                                            <details class="justify-center">
                                            <summary class="text-red-500 font-bold text-xl">登録する</summary>
                                            @csrf
                                            <i class="fa-solid fa-plus text-gray-900" style="font-size: 1.5em; padding: 0 5px; transition: transform 0.2s;"></i>
                                            
                                            
                                                        <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                            <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <p class="text-gray-900 font-bold text-xl px-1.5">本日行った個人活動</p>
                                                            </div>
                                                            
                                                            <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <input type="checkbox" name="kadai[]" value="課題"　checked class="w-6 h-6">
                                                                <p class="text-gray-900 font-bold text-xl px-1.5">課題</p>
                                                            </div>
                                                            
                                                             <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <input type="checkbox" name="rest[]" value="余暇"　checked class="w-6 h-6">
                                                                <p class="text-gray-900 font-bold text-xl px-1.5">余暇</p>
                                                            </div>
                                                            
                                                            <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <input type="checkbox" name="self_activity_other[]" value="その他"　checked class="w-6 h-6">
                                                                <p class="text-gray-900 font-bold text-xl px-1.5">その他</p>
                                                            </div>
                                                            
                                                            <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                                <p class="text-gray-900 font-bold text-xl">個人活動の内容など</p>
                                                                <textarea id="result-speech" name="self_activity_bikou" class="w-3/4 max-w-lg font-bold" style="height: 200px;"></textarea>
                                                            </div>
                                                            
                                                            <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <p class="text-gray-900 font-bold text-xl px-1.5">本日行った集団活動</p>
                                                            </div>
                                                            
                                                            <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <input type="checkbox" name="recreation[]" value="レクリエーション"　checked class="w-6 h-6">
                                                                <p class="text-gray-900 font-bold text-xl px-1.5">レクリエーション</p>
                                                            </div>
                                                            
                                                             <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <input type="checkbox" name="region_exchange[]" value="地域交流"　checked class="w-6 h-6">
                                                                <p class="text-gray-900 font-bold text-xl px-1.5">地域交流</p>
                                                            </div>
                                                            
                                                            <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <input type="checkbox" name="group_activity_other[]" value="その他"　checked class="w-6 h-6">
                                                                <p class="text-gray-900 font-bold text-xl px-1.5">その他</p>
                                                            </div>
                                                            
                                                            <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                                <p class="text-gray-900 font-bold text-xl">集団活動の内容など</p>
                                                                <textarea id="result-speech" name="group_activity_bikou" class="w-3/4 max-w-lg font-bold" style="height: 200px;"></textarea>
                                                            </div>
                                                            
                                                        <div class="my-2" style="display: flex; justify-content: center; align-items: center; max-width: 300px;">
                                                          <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                            送信
                                                          </button>
                                                        </div>
                                                    </details>
                                                </form>
                                               
                                                @else
                                                <!-- 直近のトレーニング結果表示 -->
                                                <div class="flex justify-evenly">
                                                <a href="{{ url('activitychange/'.$person->id) }}" class="relative ml-2 flex items-center">
                                                     @csrf
                                                <div class="flex items-center justify-around">
                                                    @php
                                                        $kadaiData = json_decode($lastActivity->kadai);
                                                        $restData = json_decode($lastActivity->rest);
                                                        $self_activity_otherData = json_decode($lastActivity->self_activity_other);
                                                        $recreationData = json_decode($lastActivity->recreation);
                                                        $region_exchangeData = json_decode($lastActivity->region_exchange);
                                                        $group_activity_otherData = json_decode($lastActivity->group_activity_other);
                                                    @endphp
                                                    
                                                    @if(!empty($kadaiData) && is_array($kadaiData) && count($kadaiData) > 0)
                                                        <p class="text-gray-900 font-bold text-2xl px-1">課題</p>
                                                    @endif
                                                    
                                                    @if(!empty($restData) && is_array($restData) && count($restData) > 0)
                                                        <p class="text-gray-900 font-bold text-2xl px-1">余暇</p>
                                                    @endif
                                                    
                                                    @if(!empty($self_activity_otherData) && is_array($self_activity_otherData) && count($self_activity_otherData) > 0)
                                                        <p class="text-gray-900 font-bold text-2xl px-1">その他個人活動</p>
                                                    @endif
                                                    
                                                    @if(!empty($recreationData) && is_array($recreationData) && count($recreationData) > 0)
                                                        <p class="text-gray-900 font-bold text-2xl px-1">レクリエーション</p>
                                                    @endif
                                                    
                                                    @if(!empty($region_exchangeData) && is_array($region_exchangeData) && count($region_exchangeData) > 0)
                                                        <p class="text-gray-900 font-bold text-2xl px-1">地域交流</p>
                                                    @endif
                                                    
                                                    @if(!empty($self_activity_otherData) && is_array($self_activity_otherData) && count($self_activity_otherData) > 0)
                                                        <p class="text-gray-900 font-bold text-2xl px-1">その他集団活動</p>
                                                    @endif
                                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                                    <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                                    <i class="fa-solid fa-pencil text-stone-500" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                                </a>
                                                </div>
                                               </div>
                                               @endif
                                            </div>
                                         </div>        
                                     
                                    
                                    <!--連絡帳-->
                                    　　<!--<div class="border-2 p-2 rounded-lg bg-white m-2">-->
                                      <!--    <div class="flex justify-start items-center">-->
                                      <!--      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />-->
                                      <!--      <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>-->
                                      <!--      <i class="fa-regular fa-clipboard text-green-700" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>-->
                                      <!--      <p class="text-green-700 font-bold text-xl ml-2">{{ $person->person_name }}さんの連絡帳</p>-->
                                      <!--    </div>-->
                                      <!--    <div class="flex justify-center mt-4">-->
                                      <!--      <a href="{{ url('record/'.$person->id.'/edit') }}" class="relative">-->
                                      <!--        @csrf-->
                                      <!--        <i class="material-icons md-90">add</i>-->
                                      <!--      </a>-->
                                      <!--    </div>-->
                                    　　<!--</div>-->

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