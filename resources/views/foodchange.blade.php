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
                            
                                  
                              　<!--<div class="flex items-center justify-center">-->
                              　
                              　<div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                            <!--<input name="staple_food" type="text" id="staple_food" class="w-1/4 h-8px flex-shrink-0 break-words mx-1">-->
                                            <p class="text-gray-900 font-bold text-xl">昼食</p>
                                                <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                    <select name="lunch" class="mx-1 my-1.5" style="width: 6rem;">
                                                        
                                                        <option value="あり"{{ $lastFood->lunch === 'あり' ? ' selected' : '' }}>あり</option>
                                                        <option value="なし"{{ $lastFood->lunch === 'なし' ? ' selected' : '' }}>なし</option>
                                                        <!--<option value="あり">あり</option>-->
                                                        <!--<option value="なし">なし</option>-->
                                                    </select>
                                                </div>
                                          </div>
                                  <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                    <p class="text-gray-900 font-bold text-xl">備考（メニューなど）<p>
                                    <textarea id="result-speech" name="lunch_bikou" class="w-full max-w-lg" style="height: 150px;">{{ $lastFood->lunch_bikou }}</textarea>
                                  </div>
                                  
                                  <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                            <p class="text-gray-900 font-bold text-xl">間食</p>
                                                <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                                    <select name="oyatsu" class="mx-1 my-1.5" style="width: 6rem;">
                                                        <<option value="あり"{{ $lastFood->oyatsu === 'あり' ? ' selected' : '' }}>あり</option>
                                                        <option value="なし"{{ $lastFood->oyatsu === 'なし' ? ' selected' : '' }}>なし</option>
                                                        <!--<option value="あり">あり</option>-->
                                                        <!--<option value="なし">なし</option>-->
                                                    </select>
                                                </div>
                                          </div>
                                        <!--</div>-->
                                        <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                          <p class="text-gray-900 font-bold text-xl">備考（メニューなど）<p>
                                          <textarea id="result-speech" name="oyatsu_bikou" class="w-full max-w-lg" style="height: 150px;">{{ $lastFood->oyatsu_bikou }}</textarea>
                                        </div>
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
