@vite(['resources/css/app.css', 'resources/js/app.js'])
<x-app-layout>
        @if ($errors->any())
            <div style="color: red; font-weight: bold; background-color: #ffe6e6; border: 2px solid red; padding: 10px; border-radius: 5px;">
                <ul style="list-style-type: none; padding-left: 0;">
                    @foreach ($errors->all() as $error)
                        <li style="margin-bottom: 5px; color: red; font-weight: bold; font-size: 1.1em;">
                            <i class="fas fa-exclamation-triangle" style="margin-right: 5px;"></i>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

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
         @import url('https://fonts.googleapis.com/css2?family=Arial&display=swap');
            h1 {
            font-family: Arial, sans-serif; /* フォントをArialに設定 */
          }
        </style>
      <h1 class="sm:text-2xl text-3xl font-bold title-font mb-4 text-gray-900" _msttexthash="91611" _msthidden="1" _msthash="63"></h1>
    </div>
    
 <!-- 利用者情報 -->

@hasanyrole('super administrator|facility staff administrator|facility staff user|facility staff reader')
  <div class="flex flex-row justify-start w-screen overflow-x-auto">
    <div class="slider">
    @csrf
                @if (isset($people) && !empty($people) && count($people) > 0)
             <div class="flex flex-row justify-center tw-flex-row h-150 -m-2">

                @foreach ($people as $person)
                <a href="{{ route('update.selected.items', ['people_id' => $person->id]) }}" class="relative ml-2">
                    @csrf
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
                      
                      
                      <!--連絡事項↓ -->
                      　    　<div class="border-2 p-2 rounded-lg bg-white m-2">
                                    <div class="flex justify-start items-center">
                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                        <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                        <i class="fa-solid fa-comments text-sky-500" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                        <p class="font-bold text-xl ml-2">連絡</p>
                                    </div>
                                        <div class="flex items-center justify-center p-4">

                                           
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


                                    <!-- 利用時間など↓ -->
                                 <div class="border-2 p-2 rounded-lg bg-white m-2">
                                    <div class="flex justify-start items-center">
                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                        <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                        <i class="fa-regular fa-clock text-gray-900" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                        <p class="font-bold text-xl ml-2">利用時間</p>
                                    </div>
                                    
                                   <div class="flex items-center justify-center p-4">
                                      <!-- 登録していない場合 -->
                                        @php
                                            $lastTime = $person->times ? $person->times->last() : null;
                                            $today = \Carbon\Carbon::now()->toDateString();
                                        @endphp
                                        @if ($lastTime === $today)
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
                                                            
                                                            <!-- <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <i class="fa-solid fa-bus text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
                                                                <p class="text-gray-900 font-bold text-xl px-1.5">送迎</p>
                                                            </div> -->
                                                            
                                                            <!-- <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <input type="checkbox" name="pick_up[]" value="送り"　checked class="w-6 h-6">
                                                                <p class="text-gray-900 font-bold text-xl px-1.5">送り</p>
                                                            </div>
                                                            
                                                            <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                <input type="checkbox" name="send[]" value="迎え"　checked class="w-6 h-6">
                                                                <p class="text-gray-900 font-bold text-xl px-1.5">迎え</p>
                                                            </div> -->
                                                            
                                                            
                                                        <div class="my-2" style="display: flex; justify-content: center; align-items: center; max-width: 300px;">
                                                          <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                            送信
                                                          </button>
                                                        </div>
                                                    </details>
                                                </form>
                                                @else
                                                
                                                <div class="flex justify-evenly">
                                                <a href="{{ url('timechange/'.$person->id . '/'.$lastTime->id) }}" class="relative ml-2 flex items-center">
                                                     @csrf
                                                <div class="flex items-center justify-around">
                                                    @php
                                                        $pick_upData = json_decode($lastTime->pick_up);
                                                        $sendData = json_decode($lastTime->send);
                                                        $startTime = \Carbon\Carbon::parse($lastTime->start_time);
                                                        $endTime = \Carbon\Carbon::parse($lastTime->end_time);
                                                        $diffInHours = $startTime->diffInHours($endTime);
                                                        $diffInMinutes = $startTime->diffInMinutes($endTime) % 60;
                                                        $totalUsageTime = $diffInHours . '時間' . $diffInMinutes . '分';
                                                    @endphp
                                                    <div class="flex justify-evenly">
                                                        
                                                        
                                                        <div class="px-1.5">
                                                            <p class="text-gray-900 font-bold text-base">利用日:</p>
                                                            <p class="text-gray-900 font-bold text-xl">{{ \Carbon\Carbon::parse($lastTime->date)->format('n月j日') }}</p>

                                                            <p class="text-gray-900 font-bold text-xl">{{ $lastTime->start_time->format('H:i') }}～{{ $lastTime->end_time->format('H:i') }}</p>

                                                            <p class="text-gray-900 font-bold text-xl">({{ $totalUsageTime }})</p>

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

                                    <!-- 送迎の要否↓ -->
                                 <div class="border-2 p-2 rounded-lg bg-white m-2">
                                    <div class="flex justify-start items-center">
                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                        <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                        <i class="fa-solid fa-bus text-pink-600" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                        <p class="font-bold text-xl ml-2">送迎</p>
                                    </div>
                                </div>

                                <!-- 体温登録↓ -->
                        @if(isset($selectedItems[$person->id]) && in_array('体温', $selectedItems[$person->id]))
                        　    　　  <div class="border-2 p-2 rounded-lg bg-white m-2">
                                    <div class="flex justify-start items-center">
                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                        <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                        <i class="fa-solid fa-thermometer text-sky-600" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                        <p class="font-bold text-xl ml-2">体温</p>
                                    </div>
                                    
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
                                  @endif


                                <!-- トレーニング登録↓ -->
                                @if(isset($selectedItems[$person->id]) && in_array('トレーニング', $selectedItems[$person->id]))
                        　    　　  <div class="border-2 p-2 rounded-lg bg-white m-2">
                                    <div class="flex justify-start items-center">
                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                        <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                        <i class="fa-solid fa-person-walking text-pink-500" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                        <p class="font-bold text-xl ml-2">トレーニング</p>
                                    </div>
                                    
                                   <div class="flex items-center justify-center p-4">
                                      
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
                                        
                                            @if (!$lastTraining || $lastTraining->created_at->diffInHours(now()) >= 6)
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
                                        @endif

                                <!-- 生活習慣登録↓ -->
                                @if(isset($selectedItems[$person->id]) && in_array('トレーニング', $selectedItems[$person->id]))
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
                                        @endif

                                <!-- 創作活動登録↓ -->
                                @if(isset($selectedItems[$person->id]) && in_array('創作活動', $selectedItems[$person->id]))
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
                                        @endif
                                <!-- 集団・個人活動登録↓ -->
                            @if(isset($selectedItems[$person->id]) && in_array('集団・個人活動', $selectedItems[$person->id]))
                        　    　　  <div class="border-2 p-2 rounded-lg bg-white m-2">
                                    <div class="flex justify-start items-center">
                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                        <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                        <i class="fa-solid fa-people-group text-blue-700" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
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
                                                        <p class="text-gray-900 font-bold text-2xl px-1">他個人活動</p>
                                                    @endif
                                                    
                                                    @if(!empty($recreationData) && is_array($recreationData) && count($recreationData) > 0)
                                                        <p class="text-gray-900 font-bold text-2xl px-1">レクリエーション</p>
                                                    @endif
                                                    
                                                    @if(!empty($region_exchangeData) && is_array($region_exchangeData) && count($region_exchangeData) > 0)
                                                        <p class="text-gray-900 font-bold text-2xl px-1">地域交流</p>
                                                    @endif
                                                    
                                                    @if(!empty($self_activity_otherData) && is_array($self_activity_otherData) && count($self_activity_otherData) > 0)
                                                        <p class="text-gray-900 font-bold text-2xl px-1">他集団活動</p>
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
                                         @endif
                                    
                       <!-- 食事登録↓ -->
                       @if(isset($selectedItems[$person->id]) && in_array('食事', $selectedItems[$person->id]))
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
                                            @if (!$lastFood || $lastFood->created_at->diffInHours(now()) >= 6)
                                            
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
                                @endif
                                    
                        <!--水分登録↓-->
                        @if(isset($selectedItems[$person->id]) && in_array('水分摂取', $selectedItems[$person->id]))
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
                                  @endif  

                         <!--内服登録↓-->
                         @if(isset($selectedItems[$person->id]) && in_array('内服', $selectedItems[$person->id]))
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
                                @endif

                        <!--注入登録↓-->
                        @if(isset($selectedItems[$person->id]) && in_array('注入', $selectedItems[$person->id]))
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
                                    @endif

                        
                                <!-- 血圧登録↓ -->
                                @if(isset($selectedItems[$person->id]) && in_array('血圧・脈・SpO2', $selectedItems[$person->id]))
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
                                @endif
                                

                                    <!-- トイレ登録↓ -->
                            @if(isset($selectedItems[$person->id]) && in_array('トイレ', $selectedItems[$person->id]))
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
                                @endif

                            <!--吸引登録↓-->
                            @if(isset($selectedItems[$person->id]) && in_array('吸引', $selectedItems[$person->id]))
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
                                @endif
                                     <!--発作↓-->
                             @if(isset($selectedItems[$person->id]) && in_array('発作', $selectedItems[$person->id]))
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
                                @endif 
                                      　    　
                                    
                                   
                                    
                                    
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