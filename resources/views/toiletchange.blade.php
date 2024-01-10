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
        p {
            font-family: Arial, sans-serif; /* フォントをArialに設定 */
            font-size: 25px; /* フォントサイズを20ピクセルに設定 */
            font-weight: bold;
          }
      </style>
      <div class="mx-1.5">
        <h2>{{$person->person_name}}さんのトイレ記録</h2>
        @php
           $lastToilets = $person->toilets->last();
        @endphp
        @if(!is_null($lastToilets) && !is_null($lastToilets->created_at))
            （{{$lastToilets->created_at->format('n/jG：i')}}に登録した内容）
        @endif
        
        
      </div>
    </form>
   </div>
  </div>
    <!--ヘッダー[END]-->
            
        <!-- バリデーションエラーの表示に使用-->
       <!-- resources/views/components/errors.blade.php -->
       
<form action="{{ url('toiletchange/'.$person->id) }}" method="POST">
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
        
   
    <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
        <p class="text-gray-900 font-bold text-xl">尿</p>
            <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                <select name="urine" class="mx-1 my-1.5" style="width: 6rem;">
                    <option value="あり"{{ $lastToilets->urine === 'あり' ? ' selected' : '' }}>あり</option>
                    <option value="なし"{{ $lastToilets->urine === 'なし' ? ' selected' : '' }}>なし</option>
                    
                </select>
            </div>
    </div>
    
    <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
        <p class="text-gray-900 font-bold text-xl">便</p>
            <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                <select name="ben" class="mx-1 my-1.5" style="width: 6rem;">
                    <option value="あり"{{ $lastToilets->urine === 'あり' ? ' selected' : '' }}>あり</option>
                    <option value="なし"{{ $lastToilets->urine === 'なし' ? ' selected' : '' }}>なし</option>
                   
                </select>
            </div>
    </div>
    <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
        <p class="text-gray-900 font-bold text-xl">備考</p>
        <textarea id="result-speech" name="bikou" class="w-3/4 max-w-lg font-bold" style="height: 150px;">{{ $lastToilets->bikou }}</textarea>
    </div>
    
   
    
    
    
    <!--<div style="display: flex; align-items: center; margin-left: auto; margin-right: auto; max-width: 300px; my-2">-->
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