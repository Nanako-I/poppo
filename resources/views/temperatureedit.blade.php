<x-app-layout>

    <!--ヘッダー[START]-->
     <form action="{{ url('people' ) }}" method="POST" class="w-full max-w-lg">
                        @method('PATCH')
                        @csrf
                        
    <body>
            <style>
            body {
                  font-family: 'Noto Sans JP', sans-serif; /* フォントをArialに設定 */
                  background: linear-gradient(135deg, rgb(253, 219, 146,0), rgb(209, 253, 255,1));
                  }
            h2 {
              font-family: Arial, sans-serif; /* フォントをArialに設定 */
              font-size: 20px; /* フォントサイズを20ピクセルに設定 */
            }
          </style>
    <!--<h2>体温登録</h2>-->
    <h2>{{$person->person_name}}さんの体温登録</h2>
    </form>
    <!--ヘッダー[END]-->
            
        <!-- バリデーションエラーの表示に使用-->
       <!-- resources/views/components/errors.blade.php -->
       
<form action="{{ url('temperature/'.$person->id.'/edit') }}" method="POST">
         
      
                        @csrf
                        <!--{{$person->person_name}}さんのID番号-->
                        <!--<input name="people_id" value="{{$person->id}}" class="appearance-none block w-full text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="">-->
                        <!--<input type="hidden" name="id" value="{{ $person->id }}">-->
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-1">
                        <!--体温をとうろくする-->
                        </label>
                        <input name="temperature" id="text-box" class="appearance-none block w-1/4 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white font-bold" type="text" placeholder="">
                       
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                送信
                            </button>
                            
        
    <!--右側エリア[START]-->
      <!--<div class="flex-1 text-gray-700 text-left bg-blue-100 px-4 py-2 m-2">-->
         <!-- 現在の本 -->
        <div>
           <!--<video autoplay muted playsinline id="video"></video>-->
        </div>
            <button type="button" button id="button" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">写真を撮る</button>
                <!--<button type="button" button id="take-photo" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded" @click="capture">キャプチャ</button>-->
                 
            <!--</div>  -->
                <div>
                   <img id="image" alt="" />
                </div>
              <!--福島先生コード-->
              <!--<form action="storage.php" method="post">-->
                 <input type="hidden" id="base64_image" name="base64_image" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded" value="" />
                  <!--<button type="button" button id="" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">画像保存</button>-->
                    <div id="video-container">
                        <video id="camera-stream" autoplay></video>
                        <div id="camera-range"></div>
                    </div>
    　　　　     <!--<input type="text" id="text-box" class="w-300 h-10">-->
                    <div v-show="isModeImage">
                    <canvas ref="canvas" width="640" height="480"></canvas>
        </div>
    <!--右側エリア[[END]--> 
    </div>
</form>
 <!--全エリア[END]-->
 <script>
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
    });
  } catch (err) {
    console.error(err);
  }
}
// 福島先生コード↑
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
  
//   応答データからテキストを抽出し、コンソールに出力
 const data = await response.json();
  const text = data.responses[0].fullTextAnnotation.text;
  console.log(text);
  //   テキストボックスにコンソールに表示された文字を入れる
  document.getElementById("text-box").value = text;
}
main();
// recognizeText();

const textBox = document.getElementById('text-box');
textBox.addEventListener('input', function() {
  const value = textBox.value;
  if (!/^\d+(\.\d)?$/.test(value)) {
    alert('小数点以下1桁までの合計3桁の数字を登録してください');
  }
});

</script>
</body>
</x-app-layout>