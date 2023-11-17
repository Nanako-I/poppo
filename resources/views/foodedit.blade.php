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
        <div class ="flex items-center justify-center">
        <h2>{{$person->person_name}}さんの食事登録</h2>
        </div>
        </form>
    
          <!--<button type="button" button id="modal-button" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">食事量をとうろくする</button>-->
  <!--ヘッダー[END]-->
            
        <!-- バリデーションエラーの表示に使用-->
       <!-- resources/views/components/errors.blade.php -->
       
<form action="{{ url('food/'.$person->id.'/edit') }}" method="POST">
         
      
                        @csrf
                        
                        <!--<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-1">-->
                        <!--今日のこんだて-->
                        <!--</label>-->
                        <!--<input name="food" id="text-box" class="appearance-none block w-full text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="">-->
                        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
                         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                         <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                            <!--モーダル表示部分↓-->
          <!--<div id="modal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-10 hidden">-->
                    <div class="flex flex-col items-center">
                        <style>
                          p {
                            font-family: Arial, sans-serif; /* フォントをArialに設定 */
                            font-size: 25px; /* フォントサイズを20ピクセルに設定 */
                            font-weight: bold;
                          }
                        </style>
                  
                            <p>どれぐらい食べましたか？</p>
                              <div class="flex items-center justify-center">
                                <div class="flex flex-col items-center">
                                  <span class="text-gray-400 text-4xl" onclick="changeColorAndSize(this, 'rice_bowl_icon_1')">
                                    <i class="fa-solid fa-bowl-rice text-red-300 hover:text-white"  id="rice_bowl_icon_1" style="font-size: 1.5em; padding: 15px 5px; transition: transform 0.2s;"></i>
                                  </span>
                                </div>
                              </div>
                              
                               <div style="max-width: 350px; margin: 1.5rem auto;">
                                    <input type="range" id ="rice_range" class="input-range" name="foo" min="0" max="10" oninput="oninput_rice()">
                                  </div>
                                  
                                  <style>
                                  /*// リセットCSS（すでに指定済なら不要）*/
                                  /** {*/
                                  /*  box-sizing: border-box;*/
                                  /*}*/
                                  
                                  /*// 🚩：重要なポイント*/
                                  
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
                                  
                              　<div class="flex items-center justify-center">
                              　  <p class="text-lg">主食</p>
                                  <input name="staple_food" type="text" id="staple_food" class="w-1/4 h-8px flex-shrink-0 break-words mx-1">
                                   <p class="text-lg">割</p>
                                </div>
                              
                              <div class="flex items-center justify-center">
                                <div class="flex flex-col items-center">
                                  <span class="text-gray-400 text-4xl" onclick="changeColorAndSize(this, 'set_meal_1')">
                                    <i class="material-icons md-48 text-blue-600 " id="set_meal_1" style="font-size: 2em; padding: 30px 5px 15px 10px; margin-top:20px; transition: transform 0.2s;">set_meal</i>
                                  </span>
                                </div>
                              </div>  
                              
                              <div style="max-width: 350px; margin: 1.5rem auto;">
                                <input type="range" id ="meal_range" class="input-range" name="foo" min="0" max="10" oninput="oninput_meal()">
                              </div>
                                  
                                  <style>
                                  /*// リセットCSS（すでに指定済なら不要）*/
                                  /** {*/
                                  /*  box-sizing: border-box;*/
                                  /*}*/
                                  
                                  /*// 🚩：重要なポイント*/
                                  
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
                                  
                                    <div class="flex items-center justify-center margin-top: 10px;">
                                      <p class="text-lg">　副食</p>
                                      <input name="side_dish" type="text" id="side_dish" class="w-1/4 h-8px flex-shrink-0 break-words mx-1">
                                      <p class="text-lg">割</p>
                                    </div>
                             
                                
                              
                                <!--<div class="flex items-center justify-center  mt-4">-->
                                  <!--<button type="button" button id="next-button" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded" style="padding: 10px;">次へ</button>-->
                            　　<!--</div> -->
                          
                          　   <!--<div id="next-modal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-10 hidden">-->
                          　　　
                                      <i class="fa-solid fa-prescription-bottle-medical text-green-600 hover:text-white" style="font-size: 3em; padding: 15px 5px; transition: transform 0.2s;"></i>
                                      <!--<form action="送信先のURL" method="POST">-->
                                      <div class="flex items-center justify-center my-2">
                                      　 <p class="text-lg">服用</p>
                                          <select name="medicine" class="w-3/5 mx-1">
                                            <option value="selected">選択</option>
                                            <option value="yes">あり</option>
                                            <option value="no">なし</option>
                                          </select>
                                      </div>
                                          <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold my-1.5 py-8 px-4 rounded" style="padding: 10px;">
                                            送信
                                          </button>
                              </div>
                    </div>
                  </div>
  </form>

 <!--全エリア[END]-->
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







// モーダルを表示する関数
function showModal() {
  var modal = document.querySelector('#modal');
  modal.classList.remove('hidden');
}

var modalTrigger = document.querySelector('#modal-button');
modalTrigger.addEventListener('click', function() {
  showModal();
});

var nextButton = document.querySelector('#next-button');
nextButton.addEventListener('click', function() {
  // hide current modal
  var modal = document.querySelector('#modal');
  modal.classList.add('hidden');

  // show next modal
  var nextModal = document.querySelector('#next-modal');
  nextModal.classList.remove('hidden');
});


var count_side_dish = 0;

function changeColorAndSize(element, id) {
const targetIcon = document.getElementById(id);
  // if (element.classList.contains("text-gray-500")) {
  // element.classList.remove("text-gray-500");
  // element.classList.add("text-white");
  // targetIcon.classList.add("text-white");
  targetIcon.style.fontSize = "64px";
  // } else {
  // element.classList.remove("text-white");
  // element.classList.add("text-gray-500");
  // targetIcon.classList.add("text-gray-500");
  // targetIcon.style.fontSize = "48px";
// }
};

const rice_bowl_icon_1 = document.getElementById("rice_bowl_icon_1");
rice_bowl_icon_1.addEventListener("click", () => {
count++;
  rice_bowl_icon_1.classList.remove("text-gray-500");
  rice_bowl_icon_1.classList.add("text-white");
updateStaplefoodStatus();
});

const rice_bowl_icon_2 = document.getElementById("rice_bowl_icon_2");
rice_bowl_icon_2.addEventListener("click", () => {
  count++;
  rice_bowl_icon_2.classList.remove("text-gray-500");
  rice_bowl_icon_2.classList.add("text-white");
  updateStaplefoodStatus();
});

const rice_bowl_icon_3 = document.getElementById("rice_bowl_icon_3");
rice_bowl_icon_3.addEventListener("click", () => {
  count++;
  rice_bowl_icon_3.classList.remove("text-gray-500");
  rice_bowl_icon_3.classList.add("text-white");
  updateStaplefoodStatus();
});

const rice_bowl_icon_4 = document.getElementById("rice_bowl_icon_4");
rice_bowl_icon_4.addEventListener("click", () => {
  count++;
  rice_bowl_icon_4.classList.remove("text-gray-500");
  rice_bowl_icon_4.classList.add("text-white");
  updateStaplefoodStatus();
});

const rice_bowl_icon_5 = document.getElementById("rice_bowl_icon_5");
rice_bowl_icon_5.addEventListener("click", () => {
  count++;
  rice_bowl_icon_5.classList.remove("text-gray-500");
  rice_bowl_icon_5.classList.add("text-white");
  updateStaplefoodStatus();
});


function updateStaplefoodStatus() {
  const staple_food = document.getElementById("staple_food");
  switch (count) {
    case 1:
      staple_food.value = "5分の1";
      console.log("ステータス文字列： 5分の1")
      break;
    case 2:
      staple_food.value = "5分の2";
      console.log("ステータス文字列： 5分の2");
      break;
    case 3:
      staple_food.value = "半分";
      console.log("ステータス文字列： 5分の3");
      break;
    case 4:
      staple_food.value = "5分の4";
      console.log("ステータス文字列： 5分の4");
      break;
    case 5:
      staple_food.value = "完食";
      console.log("ステータス文字列： 完食");
      break;
    default:
      staple_food.value = "";
      console.log("ステータス文字列： ");
      break;
  };
};

let count = 0;
const set_meal_1 = document.getElementById("set_meal_1");
set_meal_1.addEventListener("click", () => {
  count_side_dish++;
  set_meal_1.classList.remove("text-gray-500");
  set_meal_1.classList.add("text-black");
  updateStatus();
});

const set_meal_2 = document.getElementById("set_meal_2");
set_meal_2.addEventListener("click", () => {
  count_side_dish++;
  set_meal_2.classList.remove("text-gray-500");
  set_meal_2.classList.add("text-black");
  updateStatus();
});

const set_meal_3 = document.getElementById("set_meal_3");
set_meal_3.addEventListener("click", () => {
  count_side_dish++;
  set_meal_3.classList.remove("text-gray-500");
  set_meal_3.classList.add("text-black");
  updateStatus();
});

const set_meal_4 = document.getElementById("set_meal_4");
set_meal_4.addEventListener("click", () => {
  count_side_dish++;
  set_meal_4.classList.remove("text-gray-500");
  set_meal_4.classList.add("text-black");
  updateStatus();
});

const set_meal_5 = document.getElementById("set_meal_5");
set_meal_5.addEventListener("click", () => {
  count_side_dish++;
  set_meal_5.classList.remove("text-gray-500");
  set_meal_5.classList.add("text-black");
  updateStatus();
});


function updateStatus() {
  const side_dish = document.getElementById("side_dish");
  switch (count_side_dish) {
    case 1:
      side_dish.value = "5分の1";
      console.log("ステータス文字列： 5分の1")
      break;
    case 2:
      side_dish.value = "5分の2";
      console.log("ステータス文字列： 5分の2");
      break;
    case 3:
      side_dish.value = "半分";
      console.log("ステータス文字列： 5分の3");
      break;
    case 4:
      side_dish.value = "5分の4";
      console.log("ステータス文字列： 5分の4");
      break;
    case 5:
      side_dish.value = "完食";
      console.log("ステータス文字列： 完食");
      break;
    default:
      side_dish.value = "";
      console.log("ステータス文字列： ");
      break;
  };
};
  

async function main() {
  try {
    const video = document.querySelector("#camera-stream");
    const button = document.querySelector("#button");
    const image = document.querySelector("#image");
 　  let dataUrl = "";
    const stream = await navigator.mediaDevices.getUserMedia({
      video: {
        facingMode: "user",
      },
      audio: false,
    });
    
    video.srcObject = stream;
    const [track] = stream.getVideoTracks();
    const settings = track.getSettings();
    const { width, height } = settings;
    const base64_image = document.getElementById("base64_image");
    
    button.addEventListener("click", async (event) => {
      const canvas = document.createElement("canvas");
      canvas.setAttribute("width", width);
      canvas.setAttribute("height", height);
      const context = canvas.getContext("2d");
      context.drawImage(video, 0, 0, width, height);
        
// Webカメラで撮った画像をURLに変換
      dataUrl = canvas.toDataURL("image/jpeg");
      image.src = dataUrl;
      console.log(dataUrl); // 追加
      image.onload = async () => {
        if (!dataUrl) {
          console.log("dataUrl is undefined");
          return;
        }
           // recognizeText関数が呼び出され、テキスト認識を実行
        console.log(await recognizeText(dataUrl));
      };
    });
  } catch (err) {
    console.error(err);
  }
};

// 福島先生コード↑
// HTMLのフォームでユーザーがアップロードした画像のBase64エンコードされたデータを取得
// Google Cloud Vision APIの「TEXT_DETECTION」機能を使用するためのリクエストデータを作成します。
// HTMLのフォームでユーザーがアップロードした画像のBase64エンコードされたデータを取得
// Google Cloud Vision APIの「OBJECT_LOCALIZATION」機能を使用するためのリクエストデータを作成します。

async function recognizeText(dataUrl) {
  if (!dataUrl) return; // 追加
  const base64Data = dataUrl.split(",")[1];
  const requestData = {
    requests: [
      {
        image: {
          content: base64Data,
        },
        features: [{ type: "TEXT_DETECTION" }],
      },
    ],
  };
const apiKey = "{{ config('app.api_key') }}";
const response = await fetch(
 "https://vision.googleapis.com/v1/images:annotate?key=" + apiKey,
  {
    method: "POST",
    body: JSON.stringify(requestData),
  }
);
  
//   応答データからテキストを抽出し、コンソールに出力する
 const data = await response.json();
  const text = data.responses[0].fullTextAnnotation.text;
  console.log(text);
  //   テキストボックスにコンソールに表示された文字を入れる
  // document.getElementById("text-box").value = text;
};

// 


main();
</script>
</x-app-layout>