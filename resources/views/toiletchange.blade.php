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
                }
            </style>
            <div class ="flex items-center justify-center"  style="padding: 20px 0;">
                <div class="flex flex-col items-center">
                    <h2>{{$person->person_name}}さんの体温記録</h2>
                    
                </div>
            </div>
        </form>
       
<form action="{{ url('toiletchange/' . $person->id . '/' . $toilet->id) }}" method="POST"  enctype="multipart/form-data">
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
        
    <div style="display: flex; flex-direction: column; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
      <!--<input type="datetime-local" name="created_at">-->
      <h3>トイレに行った時間</h3>
    </div>
    <div style="display: flex; flex-direction: column; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
      <input type="time" name="created_at" id="scheduled-time" value="{{ $toilet->created_at }}">
    </div>
    <div style="display: flex; flex-direction: column; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
      <h3>尿の量</h3>
    </div>
    <div style="max-width: 350px; margin: 1.5rem auto;">
        <input type="range" id ="urine_range" class="urine-range" name="foo" min="0" max="3" oninput="oninput_urine()">
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
      </style>
      
  　<div style="display: flex; flex-direction: column; align-items: center;">
  　  <!--多・普通など反映させるテキストボックス↓-->
  　  <input name="urine_amount" type="text" id="urine_amount" value="{{ $toilet->urine_amount }}" class="h-8px flex-shrink-0 break-words mx-1" style="width: 4rem;">
    </div> 
    
  　<div style="display: flex; flex-direction: column; align-items: center; my-2;">
      <h3>便の量</h3>
    </div>
    <div style="max-width: 350px; margin: 1.5rem auto;">
      <input type="range" id ="ben_range" class="ben-range" name="foo" min="0" max="3" oninput="oninput_ben()">
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
      
      </style>
    <div class="flex items-center justify-center">
      <input name="ben_amount" type="text" id="ben_amount" value="{{ $toilet->ben_amount }}" class="h-8px flex-shrink-0 break-words mx-1 ml-px" style="width: 4rem;">
    </div> 
    
    
    <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
        <h3>便の状態</h3>
          <select name="ben_condition" value="{{ $toilet->ben_condition }}" class="mx-1 my-1.5" style="width: 6rem;">
            <option value="{{ $toilet->ben_condition }}">{{ $toilet->ben_condition }}</option>
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
    
    <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
        <h3>便通処置</h3>
          <select name="bentsuu"  value="{{ $toilet->bentsuu }}" class="mx-1 my-1.5" style="width: 6rem;">
            <option value="回答なし">{{ $toilet->bentsuu }}</option>
            <option value="なし">なし</option>
            <option value="浣腸">浣腸</option>
            <option value="下剤">下剤</option>
          </select>
    </div>
    
    <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
    <h3>備考</h3>
    <textarea id="result-speech" name="bikou" class="w-3/4 max-w-lg font-bold" style="height: 200px;">{{ $toilet->bikou }}</textarea>
    </div>
    @if($toilet->filename && $toilet->path)
        <img alt="team" class="w-80 h-64" src="{{ asset('storage/sample/toilet_photo/' . $toilet->filename) }}">
    @endif
    <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
      <label class="block text-lg font-bold text-gray-700">他の写真を登録する</label>
        <div style="margin-left: 10px;">
            <input name="filename" id="filename" type="file" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm text-lg border-gray-300 rounded-md ml-20">
        </div>
    </div>
    <div style="display: flex; align-items: center; margin-left: auto; margin-right: auto; max-width: 300px;" class="my-2">
      <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
        修正
      </button>
    </div>
  </form>
    
</div>
 <!--全エリア[END]-->
 <script>

function oninput_urine(){
  
  // スクロールバーの値を取得
    var rangeValue = document.getElementById("urine_range").value;

    // テキストボックスに反映
    var textBox = document.getElementById("urine_amount");
    switch (rangeValue) {
        // urine_rangeの値が0だったらなしを表示させる
        case "0":
            textBox.value = "なし";
            break;
        case "1":
            textBox.value = "少";
            break;
        case "2":
            textBox.value = "普通";
            break;
        case "3":
            textBox.value = "多";
            break;
        default:
            textBox.value = ""; // エラー処理など
            break;
    }
};
  // var urine_range = document.getElementById('urine_range');
  // const urine_amount = document.getElementById("urine_amount");
  // urine_amount.value = urine_range.value;

function oninput_ben(){
  
  // スクロールバーの値を取得
    var rangeValue = document.getElementById("ben_range").value;

    // テキストボックスに反映
    var textBox = document.getElementById("ben_amount");
    switch (rangeValue) {
        // ben_rangeの値が0だったらなしを表示させる
        case "0":
            textBox.value = "なし";
            break;
        case "1":
            textBox.value = "少";
            break;
        case "2":
            textBox.value = "普通";
            break;
        case "3":
            textBox.value = "多";
            break;
        default:
            textBox.value = ""; // エラー処理など
            break;
    }
};

// function oninput_ben(){
//   var ben_range = document.getElementById('ben_range');
//   const ben_amount = document.getElementById("ben_amount");
//   ben_amount.value = ben_range.value;
// };

// スクロールイベント↓

  // function countScroll() {
  // var target = document.getElementById('target');
  // var x = target.scrollLeft;
  // document.getElementById('output').innerHTML = x;
  

// スクロールイベントの監視
var target = document.getElementById('target');
target.addEventListener('scroll', countScroll);




</script>
</body> 
</x-app-layout>