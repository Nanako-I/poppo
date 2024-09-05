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
                      
                        
                        @hasanyrole('client family user|client family reader')   
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
                                        <a href="{{ url('chat/'.$person->id) }}" class="relative ml-2" style="display: flex; align-items: center;">
                                        <!-- 未読メッセージがある場合に new マークを表示 -->
                                          @if($person->unreadMessages)
                                          <span class="ml-2 text-red-500 text-sm font-bold">New</span>
                                          @endif
                                        <summary class="text-red-500 font-bold text-xl">連絡する</summary>
                                        @csrf
                                        <i class="fa-solid fa-plus text-gray-900" style="font-size: 1.5em; padding: 0 5px; transition: transform 0.2s;"></i>
                                        </a>
                                    </div>
                                </div>
                         <!-- 体調登録↓ -->
                        　    　 <div class="border-2 p-2 rounded-lg bg-white m-2">
                                     <div class="flex justify-start items-center">
                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                        <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                        <i class="fa-solid fa-face-smile text-orange-600" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                        <p class="font-bold text-xl ml-2">今日の体調</p>
                                    </div>
                                    
                                    <!-- people.blade.php -->
                                   <div class="flex items-center justify-center p-4">
                                        @if (!is_null($person) && !empty($person->child_conditions) && count($person->child_conditions) > 0)
                                        @php
                                           $lastCondition = $person->child_conditions->last();
                                        @endphp
                                            @if ($lastCondition && $lastCondition->created_at->isToday())
                                            
                                            <!-- 体調表示 -->
                                                <div class="flex justify-evenly">
                                                <a href="{{ url('conditionchange/'.$person->id) }}" class="relative ml-2 flex items-center">
                                                     @csrf
                                                    <p class="text-gray-900 font-bold text-2xl">{{ $lastCondition->condition }}</p>
                                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                                    <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                                    <i class="fa-solid fa-pencil text-stone-500" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                                </a>
                                               </div>
                                            @else
                                              <div style="display: flex; flex-direction: column; align-items: center;">
                                                    <form action="{{ route('condition.post', $person->id) }}" method="POST">
                                                        <details class="justify-center"> <!-- この行を追加 -->
                                                    
                                                        <summary class="text-red-500 font-bold text-xl">登録してください</summary>
                                                        @csrf
                                                        <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                            <div class="flex items-center justify-center ml-4">
                                                                <h3>体調</h3>
                                                                <select name="condition" class="mx-1 my-1.5" style="width: 6rem;">
                                                                    <option value="回答なし">選択</option>
                                                                    <option value="良い">良い</option>
                                                                    <option value="普通">普通</option>
                                                                    <option value="不良">不良</option>
                                                                </select>
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
                                            @endif
                                        @else
                                            <form action="{{ route('condition.post', $person->id) }}" method="POST">
                                                        <details class="justify-center"> <!-- この行を追加 -->
                                                    
                                                        <summary class="text-red-500 font-bold text-xl">登録してください</summary>
                                                        @csrf
                                                        <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                            <div class="flex items-center justify-center ml-4">
                                                                <h3>体調</h3>
                                                                <select name="condition" class="mx-1 my-1.5" style="width: 6rem;">
                                                                    <option value="回答なし">選択</option>
                                                                    <option value="良い">良い</option>
                                                                    <option value="普通">普通</option>
                                                                    <option value="不良">不良</option>
                                                                </select>
                                                            </div>
                                                            
                                                            <!--<div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">-->
                                                            <!--    <p class="text-gray-900 font-bold text-xl">備考</p>-->
                                                            <!--    <textarea id="result-speech" name="bikou" class="w-3/4 max-w-lg font-bold" style="height: 200px;"></textarea>-->
                                                            <!--</div>-->
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

                                <!-- 最終体温登録↓ -->
                        　    　 <div class="border-2 p-2 rounded-lg bg-white m-2">
                                    <div class="flex justify-start items-center">
                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                        <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                        <i class="fa-solid fa-thermometer text-sky-600" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                        <p class="font-bold text-xl ml-2">体温</p>
                                    </div>
                                    
                                  
                                   <div class="flex items-center justify-center p-4">
                                        @if (!is_null($person) && !is_null($person->child_temperatures) && count($person->child_temperatures) > 0)
                                        @php
                                           $lastTemperature = $person->child_temperatures->last();
                                        @endphp
                                            @if ($lastTemperature && $lastTemperature->created_at->isToday())
                                            
                                            <!-- 体温表示 -->
                                                <div class="flex justify-evenly">
                                                    <a href="{{ url('childtemperaturechange/'.$person->id) }}" class="relative ml-2 flex items-center">
                                                         @csrf
                                                        <div class="flex items-center justify-around">
                                                    　　　　    <div class="px-2">
                                                    　　　　        <p class="text-gray-900 font-bold text-base">最終計測時間:</p>
                                                                <p class="text-gray-900 font-bold text-2xl">
                                                                   {{ \Carbon\Carbon::parse($lastTemperature->created_at)->format('m/d H:i') }}
                                                                 </p>
                                                            </div>
                                                            <div class="px-2">
                                                    　　　　        <p class="text-gray-900 font-bold text-base">体温:</p>
                                                                <p class="text-gray-900 font-bold text-2xl">{{ $lastTemperature->temperature}}℃</p>
                                                            </div>
                                                       
                                                            <div class="px-2">
                                                                <i class="fa-solid fa-pencil text-stone-500" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s; vertical-align: middle;"></i>
                                                            </div>
                                                        </div>
                                                    </a>
                                               </div>
                                            @else
                                              <div style="display: flex; flex-direction: column; align-items: center;">
                                                    <form action="{{ route('childtemperature.post', $person->id) }}" method="POST">
                                                        <details class="justify-center">
                                                        <summary class="text-red-500 font-bold text-xl">登録してください</summary>
                                                        @csrf
                                                        <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                         <div style="display: flex; flex-direction: column; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                            <div class="flex-direction: column; justify-center ml-4">
                                                                <h3 class="text-gray-900 font-bold text-xl">最終計測時間</h3>
                                                                    <div style="display: flex; flex-direction: column; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                        <input type="datetime-local" name="created_at" id="scheduled-time">
                                                                    </div>
                                                            </div>    
                                                            <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                                <h3 class="text-gray-900 font-bold text-xl">体温</h3>
                                                                <input name="temperature" id="text-box" class="appearance-none block w-1/2 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white font-bold" type="text" placeholder="">
                                                                <p class="text-gray-900 font-bold text-xl">℃</p>
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
                                            @endif
                                        @else
                                            <div style="display: flex; flex-direction: column; align-items: center;">
                                                    <form action="{{ route('childtemperature.post', $person->id) }}" method="POST">
                                                        <details class="justify-center">
                                                        <summary class="text-red-500 font-bold text-xl">登録してください</summary>
                                                        @csrf
                                                        <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                         <div style="display: flex; flex-direction: column; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                            <div class="flex items-center justify-center ml-4">
                                                                <h3 class="text-gray-900 font-bold text-xl">最終計測時間</h3>
                                                                    <div style="display: flex; flex-direction: column; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                        <input type="datetime-local" name="created_at" id="scheduled-time">
                                                                    </div>
                                                            </div>    
                                                            <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                                <h3 class="text-gray-900 font-bold text-xl">体温</h3>
                                                                <input name="temperature" id="text-box" class="appearance-none block w-1/2 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white font-bold" type="text" placeholder="">
                                                                <p class="text-gray-900 font-bold text-xl">℃</p>
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
                                        @endif
                                    </div>
                                </div>          
                  
                          
                                <!-- 最終食事・おやつ登録↓ -->
                        　    　 <div class="border-2 p-2 rounded-lg bg-white m-2">
                                    <div class="flex justify-start items-center">
                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                        <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                        <i class="fa-solid fa-bowl-rice text-emerald-700" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                        <p class="font-bold text-xl ml-2">食事</p>
                                    </div>
                                    
                                  
                                   <div class="flex items-center justify-center p-4">
                                        @if (!is_null($person) && !is_null($person->child_foods) && count($person->child_foods) > 0)
                                        @php
                                           $lastFood = $person->child_foods->last();
                                        @endphp
                                            @if ($lastFood && $lastFood->created_at->isToday())
                                            
                                            <!-- 食事表示 -->
                                                <div class="flex justify-evenly">
                                                <a href="{{ url('childfoodchange/'.$person->id) }}" class="relative ml-2 flex items-center">
                                                     @csrf
                                                    <div class="flex items-center justify-around">
                                                　　　　    <div class="px-2">
                                                　　　　        <p class="text-gray-900 font-bold text-base">最終食事時間:</p>
                                                            <p class="text-gray-900 font-bold text-2xl">
                                                               {{ \Carbon\Carbon::parse($lastFood->food_created_at)->format('m/d H:i') }}
                                                             </p>

                                                        </div>
                                                        <div class="px-2">
                                                　　　　        <p class="text-gray-900 font-bold text-base">おやつの有無:</p>
                                                            <p class="text-gray-900 font-bold text-2xl">{{ $lastFood->oyatsu}}</p>
                                                        </div>
                                                   
                                                    <div class="px-2">
                                                    <i class="fa-solid fa-pencil text-stone-500" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s; vertical-align: middle;"></i>
                                                    </div>
                                                </div>
                                                </a>
                                               </div>
                                            @else
                                              <div style="display: flex; flex-direction: column; align-items: center;">
                                                    <form action="{{ route('childfood.post', $person->id) }}" method="POST">
                                                        <details class="justify-center"> <!-- この行を追加 -->
                                                    
                                                        <summary class="text-red-500 font-bold text-xl">登録してください</summary>
                                                        @csrf
                                                        <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                         <div style="display: flex; flex-direction: column; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                            <div class="flex-direction: column; justify-center ml-4">
                                                                <h3 class="text-gray-900 font-bold text-xl">最終食事時間</h3>
                                                                    <div style="display: flex; flex-direction: column; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                    <input type="datetime-local" name="food_created_at" id="scheduled-time">
                                                                    </div>
                                                            </div>    
                                                            <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                            <h3 class="text-gray-900 font-bold text-xl">おやつの持参</h3>
                                                              <select name="oyatsu" class="mx-1 my-1.5" style="width: 6rem;">
                                                                <option value="回答なし">選択</option>
                                                                <option value="あり">あり</option>
                                                                <option value="なし">なし</option>
                                                              </select>
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
                                            @endif
                                        @else
                                            <div style="display: flex; flex-direction: column; align-items: center;">
                                                    <form action="{{ route('childfood.post', $person->id) }}" method="POST">
                                                        <details class="justify-center"> <!-- この行を追加 -->
                                                    
                                                        <summary class="text-red-500 font-bold text-xl">登録してください</summary>
                                                        @csrf
                                                        <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                         <div style="display: flex; flex-direction: column; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                            <div class="flex items-center justify-center ml-4">
                                                                <h3 class="text-gray-900 font-bold text-xl">最終食事時間</h3>
                                                                    <div style="display: flex; flex-direction: column; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                    <input type="datetime-local" name="food_created_at" id="scheduled-time">
                                                                </div>
                                                            </div>    
                                                            <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                            <h3 class="text-gray-900 font-bold text-xl">おやつの持参</h3>
                                                              <select name="oyatsu" class="mx-1 my-1.5" style="width: 6rem;">
                                                                <option value="回答なし">選択</option>
                                                                <option value="あり">あり</option>
                                                                <option value="なし">なし</option>
                                                              </select>
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
                                    @if (!is_null($person) && !is_null($person->child_toilets) && count($person->child_toilets) > 0)
                                        @php
                                           $lastToilet = $person->child_toilets->last();
                                        @endphp
                                            @if ($lastToilet && $lastToilet->created_at->isToday())
                                         <!-- 食事表示 -->
                                                <div class="flex justify-evenly">
                                                <a href="{{ url('childtoiletchange/'.$person->id) }}" class="relative ml-2 flex items-center">
                                                     @csrf
                                                    <div class="flex items-center justify-around">
                                                　　　　    <div class="px-2">
                                                　　　　        <p class="text-gray-900 font-bold text-base">最終排尿時間:</p>
                                                            <p class="text-gray-900 font-bold text-2xl">
                                                               {{ \Carbon\Carbon::parse($lastToilet->urine_created_at)->format('m/d H:i') }}
                                                             </p>

                                                        </div>
                                                        
                                                        <div class="px-2">
                                                　　　　        <p class="text-gray-900 font-bold text-base">最終排便時間:</p>
                                                            <p class="text-gray-900 font-bold text-2xl">
                                                               {{ \Carbon\Carbon::parse($lastToilet->ben_created_at)->format('m/d H:i') }}
                                                             </p>

                                                        </div>
                                                        
                                                        <div class="px-2">
                                                　　　　        <p class="text-gray-900 font-bold text-base">便の状態:</p>
                                                            <p class="text-gray-900 font-bold text-xl">{{ $lastToilet->ben_condition }}</p>
                                                        </div>
                                                   
                                                    <div class="px-2">
                                                    <i class="fa-solid fa-pencil text-stone-500" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s; vertical-align: middle;"></i>
                                                    </div>
                                                </div>
                                                </a>
                                               </div>
                                            @else
                                              <div style="display: flex; flex-direction: column; align-items: center;">
                                                    <form action="{{ route('childtoilet.post', $person->id) }}" method="POST">
                                                        <details class="justify-center"> <!-- この行を追加 -->
                                                    
                                                        <summary class="text-red-500 font-bold text-xl">登録してください</summary>
                                                        @csrf
                                                        <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                         <div style="display: flex; flex-direction: column; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                            <div class="flex-direction: column; justify-center ml-4">
                                                                <h3 class="text-gray-900 font-bold text-xl">最終排尿時間</h3>
                                                                    <div style="display: flex; flex-direction: column; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                    <input type="datetime-local" name="urine_created_at" id="scheduled-time">
                                                                    </div>
                                                            </div>
                                                            
                                                            <div class="flex-direction: column; justify-center ml-4">
                                                                <h3 class="text-gray-900 font-bold text-xl">最終排便時間</h3>
                                                                    <div style="display: flex; flex-direction: column; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                    <input type="datetime-local" name="ben_created_at" id="scheduled-time">
                                                                    </div>
                                                            </div>
                                                            
                                                            <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                            <h3 class="text-gray-900 font-bold text-xl">便の状態</h3>
                                                              <select name="ben_condition" class="mx-1 my-1.5" style="width: 6rem;">
                                                                <option value="回答なし">選択</option>
                                                                <option value="硬便">硬便</option>
                                                                <option value="普通便">普通便</option>
                                                                <option value="軟便">軟便</option>
                                                                <option value="泥状便">泥状便</option>
                                                                <option value="水様便">水様便</option>
                                                             </select>
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
                                            @endif
                                        @else
                                            <div style="display: flex; flex-direction: column; align-items: center;">
                                                    <form action="{{ route('childtoilet.post', $person->id) }}" method="POST">
                                                        <details class="justify-center"> <!-- この行を追加 -->
                                                    
                                                        <summary class="text-red-500 font-bold text-xl">登録してください</summary>
                                                        @csrf
                                                        <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                         <div style="display: flex; flex-direction: column; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                            <div class="flex items-center justify-center ml-4">
                                                                <h3 class="text-gray-900 font-bold text-xl">最終排尿時間</h3>
                                                                    <div style="display: flex; flex-direction: column; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                    <input type="datetime-local" name="urine_created_at" id="scheduled-time">
                                                                    </div>
                                                            </div>
                                                            
                                                            <div class="flex-direction: column; justify-center ml-4">
                                                                <h3 class="text-gray-900 font-bold text-xl">最終排便時間</h3>
                                                                    <div style="display: flex; flex-direction: column; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                                    <input type="datetime-local" name="ben_created_at" id="scheduled-time">
                                                                    </div>
                                                            </div>
                                                            
                                                            <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                            <h3 class="text-gray-900 font-bold text-xl">便の状態</h3>
                                                              <select name="ben_condition" class="mx-1 my-1.5" style="width: 6rem;">
                                                                <option value="回答なし">選択</option>
                                                                <option value="硬便">硬便</option>
                                                                <option value="普通便">普通便</option>
                                                                <option value="軟便">軟便</option>
                                                                <option value="泥状便">泥状便</option>
                                                                <option value="水様便">水様便</option>
                                                             </select>
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
                                        @endif
                                    </div>
                                </div>
                                   
                                 <div class="border-2 p-2 rounded-lg bg-white m-2">
                                    <div class="flex justify-start items-center">
                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                                        <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                                        <i class="fa-solid fa-bath text-violet-600" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s;"></i>
                                        <p class="font-bold text-xl ml-2">入浴希望</p>
                                    </div>
                                    
                                    
                                   <div class="flex items-center justify-center p-4">
                                        @if (!is_null($person) && !is_null($person->baths) && count($person->baths) > 0)
                                        @php
                                           $lastBath = $person->baths->last();
                                        @endphp
                                            @if ($lastBath && $lastBath->created_at->isToday())
                                            
                                            <!-- 入浴希望表示 -->
                                                <div class="flex justify-evenly">
                                                <a href="{{ url('childbathchange/'.$person->id) }}" class="relative ml-2 flex items-center">
                                                     @csrf
                                                    <div class="flex justify-evenly">
                                                        <div style="display: flex; flex-direction: column; align-items: center;">
                                                    　　　　    <div class="px-2">
                                                    　　　　        <p class="text-gray-900 font-bold text-base">入浴:</p>
                                                            </div>
                                                            <div class="px-2">
                                                    　　　　        <p class="text-gray-900 font-bold text-2xl">{{ $lastBath->kibou}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="px-2">
                                                        <i class="fa-solid fa-pencil text-stone-500" style="font-size: 2em; padding: 0 5px; transition: transform 0.2s; vertical-align: middle;"></i>
                                                        </div>
                                                    </div>
                                                </a>
                                               </div>
                                            @else
                                              <div style="display: flex; flex-direction: column; align-items: center;">
                                                    <form action="{{ route('childbath.post', $person->id) }}" method="POST">
                                                        <details class="justify-center"> <!-- この行を追加 -->
                                                    
                                                        <summary class="text-red-500 font-bold text-xl">登録してください</summary>
                                                        @csrf
                                                        <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                         <div style="display: flex; flex-direction: column; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">

                                                            <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                            <select name="kibou" class="mx-1 my-1.5" style="width: 10rem;">
                                                                <option value="回答なし">選択</option>
                                                                <option value="希望する">希望する</option>
                                                                <option value="希望しない">希望しない</option>
                                                              </select>
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
                                            @endif
                                        @else
                                            <div style="display: flex; flex-direction: column; align-items: center;">
                                                    <form action="{{ route('childbath.post', $person->id) }}" method="POST">
                                                        <details class="justify-center"> <!-- この行を追加 -->
                                                    
                                                        <summary class="text-red-500 font-bold text-xl">登録してください</summary>
                                                        @csrf
                                                        <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                         <div style="display: flex; flex-direction: column; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                                               
                                                            <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                            <select name="kibou" class="mx-1 my-1.5" style="width: 10rem;">
                                                                <option value="回答なし">選択</option>
                                                                <option value="希望する">希望する</option>
                                                                <option value="希望しない">希望しない</option>
                                                            </select>
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
                                    　　
                               

                                        
                    </div>
                  </div>
                  @endhasanyrole 
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