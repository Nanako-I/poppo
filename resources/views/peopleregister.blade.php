<!-- resources/views/books.blade.php -->
@vite(['resources/css/app.css', 'resources/js/app.js'])
<x-app-layout>

    <!--ヘッダー[START]-->
     <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="width: 100%;">
            {{ __('新規登録する') }}
        </h2>
    </x-slot>
    <!--ヘッダー[END]-->
            
        <!-- バリデーションエラーの表示に使用-->
       <!-- resources/views/components/errors.blade.php -->
        @if (count($errors) > 0)
            <!-- Form Error List -->
            <div class="flex justify-between p-4 items-center bg-red-500 text-white rounded-lg border-2 border-white">
                @if ($errors->has('name') || $errors->has('date_of_birth'))
                    <div><strong>氏名・生年月日は入力必須です。</strong></div> 
                @endif
                @if ($errors->has('jukyuusha_number'))
                    <div><strong>受給者証番号は10桁で入力してください。</strong></div>
                @endif
                <div>
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            </div>
        @endif


      <body class="h-full w-full">
 
    <div class="flex bg-gray-100">

        <!--左エリア[START]--> 
        <div class="text-gray-700 text-left px-4 py-4 m-2">
        </div>
    </div>
       
        <!--左エリア[END]--> 
        
      <body>
             <!--<form action="{{ url('peopleregister') }}" method="POST" class="w-full" enctype="multipart/form-data">-->
             <!--@csrf-->
               <form action="{{ url('peopleregister') }}" method="POST" class="w-full" enctype="multipart/form-data">
                        @csrf
                <!--<br>-->
                <!--<div class="mx-0.5  my-4">-->
                <!--<h3 class ="font-bold">ウェブカメラで身分証明書（障害者手帳など）の写真を撮ってください</h3>-->
                
                
    <!--<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 px-0.5">-->
    <div style="display: flex; align-items: center; justify-content: center; flex-direction: column;">
    <!--<div class="flex items-center justify-center">-->
        <!--<div class="form-group col-span-1">-->
        <!--max-w-md: 最大幅を指定 この場合、md は中サイズの画面 PCとか？（通常、768px以上の画面幅）を指します-->
        <div class="form-group mb-4 m-2 w-1/2 max-w-md md:w-1/6" style="display: flex; flex-direction: column; align-items: center;">
            <label class="block text-lg font-bold text-gray-700">名前</label>
            <input name="person_name" type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm text-xl font-bold border-gray-300 rounded-md" placeholder="名前">
        </div>
        <!--</div>-->
        <!--<div class="form-group col-span-1">-->
        <div class="form-group mb-4 m-2 w-1/2 max-w-md md:w-1/6" style="display: flex; flex-direction: column; align-items: center;">
            <label class="block text-lg font-bold text-gray-700">生年月日</label>
            <input name="date_of_birth" type="date" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm text-xl font-bold border-gray-300 rounded-md" placeholder="生年月日">
        </div>
        <!--</div>-->
        
      <div class="form-group mb-4 m-2 w-1/2 max-w-md md:w-1/6" style="display: flex; flex-direction: column; align-items: center;">
        <label class="block text-lg font-bold text-gray-700">受給者証番号</label>
        <input name="jukyuusha_number" type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm text-xl font-bold border-gray-300 rounded-md" placeholder="受給者番号">
      </div>
  
      <!--<div class="form-group col-span-1">-->
      <!--  <label class="block text-base font-bold text-gray-700">障害支援区分</label>-->
      <!--  <input name="kubun_number" type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="障害支援区分">-->
      <!--</div>-->
  
        <!--<div class="form-group col-span-1">-->
        <div class="form-group mb-4 m-2" style="display: flex; flex-direction: column; align-items: center;">
          <label class="block text-lg font-bold text-gray-700">プロフィール画像</label>
          <!--<div style="display: flex; flex-direction: column; align-items: center;">-->
          <div style="margin-left: 10px;">
            <input name="filename" id="filename" type="file" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm text-lg border-gray-300 rounded-md ml-20">
            <!--<button class="mt-2" name="filename" id="filename" type="file" accept="image/*">プロフィール画像を選択</button>-->
          </div>
        </div>
        
    
      <!--<div class="form-group col-span-1">-->
      <!--  <label class="block text-base font-bold text-gray-700">障害名</label>-->
      <!--  <input name="disability_name" type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="障がい名">-->
      <!--</div>-->
       <!--<form action="{{ url('peopleregister') }}" method="POST" class="w-full" enctype="multipart/form-data">-->
       <!--                 @csrf-->
        <div class="flex flex-col col-span-1">
            <div class="text-gray-700 text-center px-4 py-2 m-2">
              <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                送信
              </button>
            </div>
        </div>
    </div>
<!--</div>-->
</form>  





        
        
        <hr>
        <!--<h5> 読み取った文字を上のフォームに当てはめてください。<br></h5>-->
 <div id="modal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex z-10 hidden">
  <div id="option-list" class="bg-white p-4 rounded-md shadow-md">
      <p class="bg-transparent hover:bg-blue-700 text-blue-500 font-bold py-2 px-4 rounded underline cursor-pointer" id="modal-trigger">選択するフォームを選んでください</p>
    <button id="person-name-option" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded focus:outline-none">
      名前
    </button>
    <button id="date-of-birth-option" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded focus:outline-none">
      生年月日
    </button>
    <button id="gender-option" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded focus:outline-none">
      性別
    </button>
    <button id="disability-name-option" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded focus:outline-none">
      障がい名
    </button>
    <div id="modal-btn-list" class="mt-4">
      <button class="modal-btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">選択</button>
      <button class="modal-btn bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-2">キャンセル</button>
      
    </div>
  </div>
</div>



    <!--    <div v-show="isModeVideo">-->
    <!--        <div class="float-right">-->
    <!--            <span class="text-right" v-if="this.timeCount > 0">-->
    <!--                &nbsp;&nbsp;&nbsp;-->
    <!--            </span>-->
                    <!--福島先生コード-->
    <!--                <div>-->
    <!--                    <video autoplay muted playsinline id="video"></video>-->
    <!--                </div>-->
    <!--            <button type="button" button id="button" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">写真を撮る</button>-->
    <!--        </div>  -->
                
            <!--カメラが映っている部分が表示されている箇所↓-->
    <!--        <div class="flex mx-2">-->
            <!--福島先生コード-->
    <!--            <input type="hidden" id="base64_image" name="base64_image" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded" value="" />-->
    <!--                <div id="video-container">-->
    <!--                    <div>-->
    <!--                        <img id="image" alt="" />-->
    <!--                    </div>-->
    <!--                    <video id="camera-stream" autoplay></video>-->
    <!--                    <div id="form"></div>-->
    <!--                </div>-->
    <!--　　            <div class="w-full h-48 overflow-auto">-->
    <!--                    <textarea id="text-box" class="w-full h-full break-words text-base"></textarea>-->
    <!--                </div>-->
　　　　<!--　　</div>-->
    <!--      <div v-show="isModeImage">-->
           
              <!--キャンバス要素-->
    <!--          <canvas ref="canvas" width="640" height="480"></canvas>-->
        　
    <!-- ここにコンソールに表示された文章が反映される↓ -->
    <!--          　<span class="font-bold" v-text="selectedText"></span>-->
    <!--      　　　　　　<br>-->
    <!--      　　　　　　　　<br>-->
    <!--        　　<div class="mt-8">-->
    <!--          　　　　　　　　<h3 class="float-left" v-for="(text, key) in inputs">-->
                  <!--ボタンがクリックされると、@click.preventディレクティブによって関数enterTextが呼び出される-->
    <!--           　 <a class="badge badge-primary" href="#" v-text="text" @click.prevent="enterText(key)"></a>&nbsp;-->
    <!--          　　　　　　　　</h3>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--   </div>-->
       <!-- 　         </div>-->
       <!-- 　       </div>-->
       <!--</div>-->
   
 
 <script src="https://unpkg.com/vue@3.2.47/dist/vue.global.prod.js"></script>
 <!--jquery3.6.4をCDN経由で呼び出し↓-->
 <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

               
  
 <script>
 
 document.getElementById('filename').addEventListener('click', function() {
        // 選択されたファイルに対する処理を追加する（例: アップロード処理など）
        console.log('ファイルが選択されました:', this.files[0].name);
    });
    
    
$(document).ready(function() {
    $('#modal-first').fadeIn();
    setTimeout(function(){
      $('#modal-first').fadeOut();
    }, 4000);
  });

  // モーダルを閉じる
  $('#modal-close').click(function() {
    $('#modal-first').fadeOut();
  });
  
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
      await recognizeText(dataUrl);
};

const camera_stream = document.getElementById('camera-stream');
camera_stream.style.display ="none";

    });
  } catch (err) {
    console.error(err);
  }
}





// 福島先生コード↑

const textBox = document.getElementById("text-box");

function setTextToInput(string1,string2){
    var inputtext = document.getElementsByName(string1);
    
    inputtext[0].value = string2;
};
// HTMLのフォームでユーザーがアップロードした画像のBase64エンコードされたデータを取得
// Google Cloud Vision APIの「TEXT_DETECTION」機能を使用するためのリクエストデータを作成します。
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
  document.getElementById("text-box").value = text;
}


function showModal(selectedText) {
  const modal = document.getElementById("modal");
  const personNameOption = document.getElementById("person-name-option");
  const dateOfBirthOption = document.getElementById("date-of-birth-option");
  const genderOption = document.getElementById("gender-option");
  const disabilityNameOption = document.getElementById("disability-name-option");

  personNameOption.addEventListener("click", () => {
    const personNameInput = document.querySelector('input[name="person_name"]');
    //setTextToInput('person_name', personNameInput.value + selectedText
    setTextToInput('person_name', selectedText);
    modal.style.display = 'none';
  });
  dateOfBirthOption.addEventListener("click", () => {
    const dateOfBirthInput = document.querySelector('input[name="date_of_birth"]');
    //setTextToInput('date_of_birth', dateOfBirthInput.value + selectedText);
    setTextToInput('date_of_birth', selectedText);
    modal.style.display = 'none';
  });
  genderOption.addEventListener("click", () => {
    const genderInput = document.querySelector('input[name="gender"]');
    //setTextToInput('gender', genderInput.value + selectedText);
    setTextToInput('gender', selectedText);
    modal.style.display = 'none';
  });
  disabilityNameOption.addEventListener("click", () => {
    const disabilityNameInput = document.querySelector('input[name="disability_name"]');
    //setTextToInput('disability_name', disabilityNameInput.value + selectedText);
    setTextToInput('disability_name', selectedText);
    modal.style.display = 'none';
  });

  modal.style.display = "block";
}

const modalTrigger = document.getElementById("modal-trigger");
modalTrigger.addEventListener("click", showModal);

document.getElementById("text-box").addEventListener("mouseup", () => {
  const selectedText = window.getSelection().toString();
  if (selectedText) {
    showModal(selectedText);
  }
});


main();
// recognizeText();

</script>
 <!--<input type="file" id="file-input" accept="image/*"><br>-->
  <div id="result"></div>

    
    <!--右側エリア[START]-->
    
    <!--右側エリア[END]--> 

</div>
 <!--全エリア[END]-->

</body>
</html>
</x-app-layout>