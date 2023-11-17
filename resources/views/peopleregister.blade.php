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
      <body class="h-full w-full">
  <!--画面遷移すぐのモーダル表示-->
  <!--<div class="absolute z-50 top-0 right-0 bottom-0 left-0 bg-black bg-opacity-50 flex items-center justify-center hidden" id="modal-first">-->
  <!--  <div class="bg-gray rounded-lg w-1/2 h-full px-4 pt-5 pb-4 text-center">-->
  <!--    <div class="flex justify-end">-->
  <!--      <button type="button" class="text-gray-500 hover:text-gray-400 focus:outline-none" id="modal-close">-->
  <!--        <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">-->
  <!--          <path d="M18.293 5.293a1 1 0 0 0-1.414 0L12 10.586 7.707 6.293a1 1 0 1 0-1.414 1.414L10.586 12l-4.293 4.293a1 1 0 1 0 1.414 1.414L12 13.414l4.293 4.293a1 1 0 0 0 1.414-1.414L13.414 12l4.293-4.293a1 1 0 0 0 0-1.414z"/>-->
  <!--        </svg>-->
  <!--      </button>-->
  <!--    </div>-->
  <!--    <div class="mb-4">-->
  <!--      <p class="text-lg font-medium justify-center" style="color:white;">写真を撮ってください。</p>-->
  <!--    </div>-->
  <!--  </div>-->
  <!--</div>-->
<!--</body>-->

        
          <!--全エリア[START]-->
    <div class="flex bg-gray-100">

        <!--左エリア[START]--> 
        <div class="text-gray-700 text-left px-4 py-4 m-2">


            <!-- 本のタイトル -->
            
        </div>
    </div>
       
        <!--左エリア[END]--> 
        
      <body>
             <form action="{{ url('peopleregister') }}" method="POST" class="w-full" enctype="multipart/form-data">
                        @csrf
              
                <br>
                <div class="mx-0.5  my-4">
                <h3 class ="font-bold">ウェブカメラで身分証明書（障害者手帳など）の写真を撮ってください</h3>
                
                <!--モーダル表示部分↓-->
                <!--<div id="modal" class="modal">-->
                <!--    <div class="modal-content">  -->
                    <!--モーダル表示部分↑-->
                    
                　　 <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 px-0.5">
  <div class="form-group col-span-1">
    <label class="block text-base font-bold text-gray-700">名前</label>
    <input name="person_name" type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="名前">
  </div>
  <div class="form-group col-span-1">
    <label class="block text-base font-bold text-gray-700">生年月日</label>
    <input name="date_of_birth" type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="生年月日">
  </div>
  
  <div class="form-group col-span-1">
    <label class="block text-base font-bold text-gray-700">受給者番号</label>
    <input name="jukyuusha_number" type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="受給者番号">
  </div>
  
  <div class="form-group col-span-1">
    <label class="block text-base font-bold text-gray-700">障害支援区分</label>
    <input name="kubun_number" type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="障害支援区分">
  </div>
  
 <div class="form-group col-span-1">
      <label class="block text-base font-bold text-gray-700">プロフィール画像</label>
      <input name="filename" id="filename" type="file" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
    </div>
    
  <div class="form-group col-span-1">
    <label class="block text-base font-bold text-gray-700">障害名</label>
    <input name="disability_name" type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="障がい名">
  </div>
  <div class="flex flex-col col-span-1">
    <div class="text-gray-700 text-center px-4 py-2 m-2">
      <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
        送信
      </button>
    </div>
  </div>
</div>
</div>
</form>  

                <!--    </div>-->
                <!--</div>-->
 




        
        
        <hr>
        <h5>
            読み取った文字を上のフォームに当てはめてください。<br></h5>
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


<!-- <div id="modal" class="modal hidden fixed z-50 inset-0 overflow-auto bg-black bg-opacity-40">-->
<!--  <div class="modal-content bg-white m-auto p-4 border border-gray-300 w-80 max-w-md">-->
<!--    <h2 class="text-lg font-bold">選択したテキストをフォームに反映しますか？</h2>-->
<!--    <div class="modal-btn-container flex justify-between mt-4">-->
<!--      <button class="modal-btn bg-green-500 text-white px-4 py-2 rounded cursor-pointer">はい</button>-->
<!--      <button class="modal-btn bg-green-500 text-white px-4 py-2 rounded cursor-pointer hover:bg-green-600" onclick="document.getElementById('modal').classList.add('hidden')">いいえ</button>-->
<!--    </div>-->
<!--  </div>-->
<!--</div>-->


<!--            <div id="modal" class="modal">-->
<!--  <div class="modal-content">-->
<!--    <h2>選択したテキストを入力してください</h2>-->
<!--    <form>-->
<!--      <div class="form-group">-->
<!--        <label for="person_name">名前</label>-->
<!--        <input type="text" id="person_name" name="person_name">-->
<!--      </div>-->
<!--      <div class="form-group">-->
<!--        <label for="date_of_birth">生年月日</label>-->
<!--        <input type="text" id="date_of_birth" name="date_of_birth">-->
<!--      </div>-->
<!--      <div class="form-group">-->
<!--        <label for="gender">性別</label>-->
<!--        <input type="text" id="gender" name="gender">-->
<!--      </div>-->
<!--      <div class="form-group">-->
<!--        <label for="disability_name">障害名</label>-->
<!--        <input type="text" id="disability_name" name="disability_name">-->
<!--      </div>-->
<!--      <div class="modal-btn-container">-->
<!--        <button type="button" class="modal-btn">反映する</button>-->
<!--      </div>-->
<!--    </form>-->
<!--  </div>-->
<!--</div>-->

        
        
        <div v-show="isModeVideo">
            <div class="float-right">
                <span class="text-right" v-if="this.timeCount > 0">
                 
                    &nbsp;&nbsp;&nbsp;
                    
                     </span>
                     
                     <!--福島先生コード-->
                      <div>
                          <video autoplay muted playsinline id="video"></video>
                      </div>
    
             　 <button type="button" button id="button" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">写真を撮る</button>
                <!--<button type="button" button id="take-photo" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded" @click="capture">キャプチャ</button>-->
                 
            </div>  
                
            <!--カメラが映っている部分が表示されている箇所↓-->
            <div class="flex mx-2">
                 <!--<style>
                    <div class="relative h-screen">
                      <video id="camera-stream" class="absolute inset-0 w-full h-full object-cover"></video>
                       <div id="camera-range" class="absolute inset-10 w-80 h-80 border-2 border-red-500"></div>
                    </div>
        
                  </style>
              
              <!--福島先生コード-->
              <!--<form action="storage.php" method="post">-->
                 <input type="hidden" id="base64_image" name="base64_image" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded" value="" />
                  <!--<button type="button" button id="" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">画像保存</button>-->
              <!--</form>-->
    
                    <div id="video-container">
                        <div>
                            <img id="image" alt="" />
                        </div>
                        <video id="camera-stream" autoplay></video>
                        <div id="form"></div>
                    </div>
    　　              <div class="w-full h-48 overflow-auto">
                        <textarea id="text-box" class="w-full h-full break-words text-base"></textarea>
                    </div>
　　　　　　
        </div>
          <div v-show="isModeImage">
           <!--   <div class="float-right">-->
           <!--      キャプチャしました。<br>この画像から情報を読みとりますか？-->
           <!--      <br>-->
           <!--       <div class="text-right">-->
           <!--         <button type="button" class="bg-gray-100 text-gray-700 rounded-md py-2 px-4 mr-2" @click="cancel">キャンセル</button>-->
           <!--         <button type="button" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-md" @click="extract">OK</button>-->
           <!--       </div>-->
           
           <!--extractedText という変数が truthy（真）である場合、div 要素が描画される↓-->
           <!--       <div v-if="extractedText" class="whitespace-pre"></div>-->
            
           <!--        <hr class="border-t-2 border-gray-500">-->
           <!--         <span class="badge badge-primary">取得されたテキスト</span>-->
　　　　　　　　　　　<!--　<div v-text="extractedText" @mouseup="selection"></div>-->
               <!--extractedTextという変数に格納されたテキストを表示する.その要素がクリックされた時にselectionメソッドを実行するように設定-->
           <!--        <div class="mt-2" @mouseup="selection" v-text="extractedText"></div>-->
           <!--       </div>-->
              <!--</div>-->
              <!--キャンバス要素-->
              <canvas ref="canvas" width="640" height="480"></canvas>
        　<!--</div>-->
        　<!--左上のフロート部分↓-->
        　　　　<!--<div class="modal fixed z-10 inset-0 overflow-y-auto" id="modal">-->
            <!--      <div class="modal-dialog inline-block align-middle max-w-md w-full p-4 my-8 overflow-hidden text-left transition-all transform bg-white shadow-xl rounded">-->
            <!--        <div class="modal-content">-->
            <!--           <div class="modal-header">-->
            <!--      　　　　　　<h5 class="modal-title text-lg font-bold">自動入力する項目を選択してください</h5>-->
            <!--           </div>-->
                        


      <!-- ここにモーダルの中身を記述 -->
                    
                    <!-- ここにコンソールに表示された文章が反映される↓ -->
                 <!--<input type="text" id="text-box">-->
               
        　　　　　　　　　　　　　　　　　<!--<div class="modal-body">-->
            　　　　　　　　　　　　　<!--　　 <strong class="font-bold">選択されたテキスト：</strong>-->
              　　　　　　　　　　　　　　　　　　　<span class="font-bold" v-text="selectedText"></span>
           <!--<strong>選択されたテキスト：</strong> <span v-text="selectedText"></span>-->
        　　　　　　　        　　　　　　<br>
          　　　　　        　　　　<br>
            　　　　　　　  　　　　　　　<div class="mt-8">
              　　　　　　　     　　　　　　<h3 class="float-left" v-for="(text, key) in inputs">
                  <!--ボタンがクリックされると、@click.preventディレクティブによって関数enterTextが呼び出される-->
               　 <a class="badge badge-primary" href="#" v-text="text" @click.prevent="enterText(key)"></a>&nbsp;
              　　　　　　　     　　　　　
              　　　　　　　       　　　　</h3>
                                </div>
                          </div>
                    </div>
        　         </div>
        　       </div>
        
             
            
    
   
    </div>
   
 <!--vue3.2.47をＣＤＮ経由で呼び出す↓　3.2.47のバージョンで呼び出し-->
 <!--<script src="https://unpkg.com/vue@3.2.47/dist/vue.global.prod.js"></script>-->
 <!--バージョン変えずに呼び出し↓-->
 <!--<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>-->
 <!--バージョン変えずに呼び出し↓-->
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>-->
   <script src="https://unpkg.com/vue@3.2.47/dist/vue.global.prod.js"></script>
 <!--jquery3.6.4をCDN経由で呼び出し↓-->
 <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

               
  
 <script>
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