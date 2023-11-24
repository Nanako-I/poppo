<x-app-layout>

    <!--ヘッダー[START]-->
    
  <div class="flex items-center justify-center">
   <div class="flex flex-col items-center">
     <form action="{{ url('people' ) }}" method="POST" class="w-full max-w-lg">
                        @method('PATCH')
                        @csrf
                        
        <style>
        h2 {
          font-family: Arial, sans-serif; /* フォントをArialに設定 */
          font-size: 20px; /* フォントサイズを20ピクセルに設定 */
          font-weight: bold;
          text-decoration: underline;
        }
      </style>
    <h2>{{$person->person_name}}さんのトイレ記録</h2>
    </form>
   </div>
  </div>
    <!--ヘッダー[END]-->
            
        <!-- バリデーションエラーの表示に使用-->
       <!-- resources/views/components/errors.blade.php -->
       
<form action="{{ url('toilet/'.$person->id.'/edit') }}" method="POST">
         
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    @csrf
                        
                    
<body>                    
<div style="display: flex; flex-direction: column;">
     <style>
     body {
          font-family: 'Noto Sans JP', sans-serif; /* フォントをArialに設定 */
          background: linear-gradient(135deg, rgb(253, 219, 146,0), rgb(209, 253, 255,1));
          }
     h3 {
          font-family: Arial, sans-serif; /* フォントをArialに設定 */
          font-size: 20px; /* フォントサイズを20ピクセルに設定 */
          /*font-weight: bold;*/
          text-decoration: underline;
        }
        </style>
        
    <div style="display: flex; flex-direction: column; align-items: center; my-2;">
        <input type="datetime-local" name="created_at">
    </div>
             
    <div style="max-width: 350px; margin: 1.5rem auto;">
        <input type="range" id ="urine_range" class="urine-range" name="foo" min="0" max="2" oninput="oninput_urine()">
    </div>
      
    <style>
      /*// リセットCSS（すでに指定済なら不要）*/
      /** {*/
      /*  box-sizing: border-box;*/
      /*}*/
      
      /*// 🚩：重要なポイント*/
      
      .urine-range {
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
      
  　<div class="flex items-center justify-center">
  　  <p class="text-lg">尿</p>
      <input name="urine_amount" type="text" id="toilet_amount" class="w-1/4 h-8px flex-shrink-0 break-words mx-1">
       <p class="text-lg">割</p>
    </div>         
  
    <div style="max-width: 350px; margin: 1.5rem auto;">
        <input type="range" id ="ben_range" class="ben-range" name="foo" min="0" max="2" oninput="oninput_ben()">
    </div>
      
      <style>
     
      
      .ben-range {
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
      
  　<div class="flex items-center justify-center">
  　 　<p class="text-lg">便</p>
      <input name="ben_amount" type="text" id="toilet_amount" class="w-1/4 h-8px flex-shrink-0 break-words mx-1">
    　<p class="text-lg">割</p>
    </div> 
    
    
    <div style="display: flex; flex-direction: column; align-items: center; my-2;">
        <p class="text-lg">便の状態</p>
          <select name="ben_condition" class="w-3/5 mx-1">
            <option value="selected">選択</option>
            <option value="硬便">硬便</option>
            <option value="普通便">普通便</option>
            <option value="軟便">軟便</option>
            <option value="泥状便">泥状便</option>
            <option value="水様便">水様便</option>
          </select>
    </div>
 
    <style>
      .checkbox-container {
        display: flex;
        align-items: center;
      }
      input[type="checkbox"] {
        margin-right: 8px;
      }
    </style>

    <div style="display: flex; align-items: center; margin-left: auto; margin-right: auto; max-width: 300px;">
         <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg text-lg mr-4">
           送信
         </button>
    </div>
  </form>
    
</div>
 <!--全エリア[END]-->
 <script>

function oninput_urine(){
  var urine_range = document.getElementById('urine_range');
  const urine_amount = document.getElementById("urine_amount");
  urine_amount.value = urine_range.value;
};


function oninput_ben(){
  var ben_range = document.getElementById('ben_range');
  const ben_amount = document.getElementById("ben_amount");
  ben_amount.value = ben_range.value;
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
</body> 
</x-app-layout>