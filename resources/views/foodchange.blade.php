  <x-app-layout>

    <!--ヘッダー[START]-->
  <div class="flex items-center justify-center">
  <!--<div style="display: flex; flex-direction: column;">-->
    <div class="flex flex-col items-center">
        <form action="{{ url('people' ) }}" method="POST" class="w-full max-w-lg">
                            @method('PATCH')
                            @csrf
            <style>
                h2 {
                  font-family: Arial, sans-serif; /* フォントをArialに設定 */
                  font-size: 20px; /* フォントサイズを20ピクセルに設定 */
                }
            </style>
            <div class ="flex items-center justify-center"  style="padding: 20px 0;">
                <div class="flex flex-col items-center">
                    <h2>{{$person->person_name}}さんの食事登録</h2>
                    @php
                       $lastFood = $person->foods->last();
                      
                    @endphp
                    @if(!is_null($lastFood))
                        （{{$lastFood->created_at->format('n/jG：i')}}に登録した内容）
                    @endif
                </div>
            </div>
        </form>
          <form action="{{ url('foodchange/'.$person->id) }}" method="POST">
         
                @csrf
             
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
            <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                <div class="flex flex-col items-center">
                    <style>
                      p {
                        font-family: Arial, sans-serif; /* フォントをArialに設定 */
                        font-size: 25px; /* フォントサイズを20ピクセルに設定 */
                        font-weight: bold;
                      }
                    </style>
                    
                        <div class="flex items-center justify-center">
                             <input type="hidden" name="people_id" value="{{ $person->id }}">
                            <div class="flex flex-col items-center">
                              <span class="text-gray-400 text-4xl" onclick="changeColorAndSize(this, 'rice_bowl_icon_1')">
                                <i class="fa-solid fa-bowl-rice text-red-300"  id="rice_bowl_icon_1" style="font-size: 1.5em; padding: 15px 5px; transition: transform 0.2s;"></i>
                              </span>
                            </div>
                        </div>
                            <div style="max-width: 350px; margin: 1.5rem auto;">
                                <input type="range" id ="rice_range" class="input-range" name="foo" min="0" max="10" oninput="oninput_rice()">
                            </div>
                                  
                          <style>
                          .input-range {
                            -webkit-appearance: none;
                            appearance: none;
                            cursor: pointer;
                            background: #8acdff;
                            height: 14px;
                            width: 100%; 
                            border-radius: 10px; 
                            border: solid 3px #dff1ff; 
                            outline: 0; /* アウトラインを消して代わりにfocusのスタイルをあてる */
                            &:focus {
                              box-shadow: 0 0 3px rgb(0, 161, 255);
                            }
                            /*// -webkit-向けのつまみ*/
                            &::-webkit-slider-thumb {
                              -webkit-appearance: none; 
                              background: #53aeff; 
                              width: 24px; 
                              height: 24px; 
                              border-radius: 50%;
                              box-shadow: 0px 3px 6px 0px rgba(0, 0, 0, 0.15);
                            }
                            /*// -moz-向けのつまみ*/
                            &::-moz-range-thumb {
                              background: #53aeff;
                              width: 24px;
                              height: 24px;
                              border-radius: 50%;
                              box-shadow: 0px 3px 6px 0px rgba(0, 0, 0, 0.15);
                              border: none; 
                            }
                            /*// Firefoxで点線が周りに表示されてしまう問題の解消*/
                            &::-moz-focus-outer {
                              border: 0;
                            }
                            /*// つまみをドラッグしているときのスタイル*/
                            &:active::-webkit-slider-thumb {
                              box-shadow: 0px 5px 10px -2px rgba(0, 0, 0, 0.3);
                            }
                          }
                          
                          </style>
                                  
                              　<!--<div class="flex items-center justify-center">-->
                                    <div style="display: flex; flex-direction: column; align-items: center;">
                                        <div class="flex items-center justify-center ml-4">
                                            @if (!is_null($lastFood))
                                                <input name="staple_food" type="text" value="{{ $lastFood->staple_food }}" id="staple_food" class="w-1/4 h-8px flex-shrink-0 break-words mx-1">
                                            
                                            <p class="text-gray-900 font-bold text-xl">割</p>
                                        </div>
                                
                                        <i class="fa-solid fa-prescription-bottle-medical text-green-600" style="font-size: 3em; padding: 15px 5px; transition: transform 0.2s;"></i>
                                        <!--<form action="送信先のURL" method="POST">-->
                                        <div class="flex items-center justify-center my-2 mr-6">
                                            <p class="text-gray-900 font-bold text-xl" style="white-space: nowrap; padding: 0 5px;">服用</p>
                                            <!--<input name="medicine" type="text" value="{{ $lastFood->medicine }}" id="medicine" class="w-1/4 h-8px flex-shrink-0 break-words mx-1">-->
                                            <select name="medicine" value="{{ $lastFood->medicine }}" id="medicine" class="w-3/5 ml-1.5">
                                                <option value="selected">{{ $lastFood->medicine }}</option>
                                                <option value="あり">あり</option>
                                                <option value="なし">なし</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-center my-2">
                                        <p class="text-gray-900 font-bold text-xl">薬の名称</p>
                                        <input name="medicine_name" type="text" value="{{$lastFood->medicine_name}}" class="h-8px flex-shrink-0 break-words mx-1" style="width: 12rem;">
                                    </div> 
                                        
                                    <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                        <p class="text-gray-900 font-bold text-xl">備考<p>
                                        <textarea id="result-speech" name="bikou" class="w-full max-w-lg" style="height: 300px;">{{ $lastFood->bikou }}</textarea>
                                    </div>
                                    @endif
                                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                          修正
                                    </button>
                 </div>
            </div>
        </div>
</form>

<script>

function oninput_rice(){
  var rice_range = document.getElementById('rice_range');
  const staple_food = document.getElementById("staple_food");
  staple_food.value = rice_range.value;
};


function oninput_meal(){
  var meal_range = document.getElementById('meal_range');
  const side_dish = document.getElementById("side_dish");
  side_dish.value = meal_range.value;
};

// スクロールイベント↓

  function countScroll() {
  var target = document.getElementById('target');
  var x = target.scrollLeft;
  document.getElementById('output').innerHTML = x;
  
  // アイコンのサイズ変更
  // var leftIcon = document.getElementById('leftIcon');
  // var rightIcon = document.getElementById('rightIcon');
  // var newSize = 2 + x / 100; // スクロール量に応じてサイズを変更する調整値
  // leftIcon.style.fontSize = newSize + 'em';
  // rightIcon.style.fontSize = newSize + 'em';
  
  // アイコンの位置調整
  // var iconWrapper = document.getElementById('iconWrapper');
  // var maxScroll = target.scrollWidth - target.clientWidth;
  // var iconPosition = x / maxScroll * (target.clientWidth - leftIcon.clientWidth);
  // iconWrapper.style.left = iconPosition + 'px';
}

// スクロールイベントの監視
var target = document.getElementById('target');
target.addEventListener('scroll', countScroll);
</script>
</x-app-layout>
