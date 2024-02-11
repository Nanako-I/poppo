@vite(['resources/css/app.css', 'resources/js/app.js'])
<x-app-layout>
  <!DOCTYPE html>
  <html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>音声認識デモ</title>
    <script type="module" src="./main.js"></script>
    <link rel="stylesheet" href="./style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  </head>
  <body class="bg-light">
    <main>
      <div class="flex justify-center pt-5 pb-5">
        <div class="flex items-center justify-center space-x-4">
          <div>
            <img src="./cat.png" alt="" class="w-24" data-bs-toggle="tooltip" data-bs-placement="left" title="触りたくなるよね">
          </div>
          <div>
            <h1 class="text-3xl">Speech To Text</h1>
          </div>
          <div>
            <img src="./cat.png" alt="" class="w-24" data-bs-toggle="tooltip" data-bs-placement="right" title="気になるよね">
          </div>
        </div>
      </div>

      <div class="border-t border-b">
        <div class="container pt-5 pb-5">

          <div class="flex justify-center">
            <div class="flex items-center" id="recording">
              <button class="btn btn-primary" id="startRecording">録音開始</button>
              <button class="btn btn-primary disabled" id="stopRecording">録音停止</button>
            </div>
          </div>
          
          <div class="flex justify-center mt-5">
            <div class="w-full">
              <label for="speechToText" class="form-label">音声データ変換後テキスト</label>
              <div class="relative">
                <textarea id="speechToText" name="searchStr" class="form-control w-full h-32" readonly></textarea>
                <div class="hidden textRoading absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                  <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="flex justify-center mt-5">
            <div class="w-4/12">
              <label class="form-label" for="keyword">キーワード</label>
              <input class="form-control" type="text" name="keyword" id="keyword" placeholder="キーワード入力してください" required>
            </div>
            <div class="w-4/12">
              <label class="form-label" for="beforeTextNum">前の文字数</label>
              <div class="flex items-center">
                <input class="form-control" type="number" min="0" max="10" id="beforeTextNum" name="beforeTextNum" value="5" required>
                <span class="ml-1">文字</span>
              </div>
            </div>
            <div class="w-4/12">
              <label class="form-label" for="afterTextNum">後の文字数</label>
              <div class="flex items-center">
                <input class="form-control" type="number" min="0" max="10" id="afterTextNum" name="afterTextNum" value="5" required>
                <span class="ml-1">文字</span>
              </div>
            </div>
          </div>
          <div class="flex justify-center mt-5">
            <div class="w-4/12 text-center">
              <button class="btn btn-primary disabled" type="button" id="searchKeyword">検索</button>
            </div>
          </div>
          <div id="outputText" class="mt-5"></div>
        </div>
      </div>
    </main>
  </body>
  </html>


<script>
// // キーワード検索のモジュール
// import extractionKeyword from './extractionKeyword.js';
// // 音声認識APIキー
// import apiKey from './apiKey.js';
// // 音声フォーマット変換モジュール
// import Recorder from "./lib/recoder.js"

// 録音開始ボタン
// const startBtn = document.querySelector('#start-btn');
const startRecording = document.querySelector('#startRecording');
// let startRecording = document.getElementById("startRecording");

// 録音停止ボタン
const stopRecording = document.querySelector('#stopRecording');
// 検索ボタン
const searchKeyword = document.querySelector('#searchKeyword');
// テキスト変換の出力先
const speechToText = document.querySelector('#speechToText');
// キーワード検索の出力先
const outputText = document.querySelector('#outputText');
// loading表示
const textRoading = document.querySelector('.textRoading');

// 変数
let recorder = new Recorder();

// 録音開始ボタン押下
startRecording.addEventListener('click', async () => {
  // 録音テキスト出力クリア
  console.log('クリック');
  speechToText.textContent = '';

  captureStart();
});

// 録音停止ボタン押下
stopRecording.addEventListener('click', () => {
  captureStop();
});

// 録音開始
const captureStart = () => {
  recorder.start();
  // ボタンの活性・非活性
  startRecording.classList.add('disabled');
  stopRecording.classList.remove('disabled');
}
// 録音停止
const captureStop = () => {
  // ボタンの活性・非活性
  stopRecording.classList.add('disabled');
  startRecording.classList.remove('disabled');

  // wav形式のblobを取得
  let audioBlob = recorder.stop();
  // 音声認識
  audioRecognize(audioBlob);
}

// Todo 録音がされていないケースのエラー処理追加
const audioRecognize = async(audioBlob) => {
  const reader = new FileReader();
  reader.readAsDataURL(audioBlob);

  reader.onload = () => {
    const audioBase64 = reader.result.split(',')[1];

    // Speech-To-Textの設定値
    const data = {
      config: {
        encoding: "LINEAR16",
        languageCode: "ja-JP",
        audio_channel_count: 1
      },
      audio: {
        content: audioBase64
      }
    }

    // ローディング表示
    textRoading.classList.remove('d-none');
    // Speech-To-Textをコール
    fetch('https://speech.googleapis.com/v1/speech:recognize?key=' + , {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json; charset=utf-8'
      },
      body: JSON.stringify(data)
    }).then((response) => {
      if(!response.ok) {
        console.error('サーバーエラー');
      }
      return response.text();
    }).then((text) => {
      // ローディング非表示
      textRoading.classList.add('d-none');
      let result_json = JSON.parse(text);
      console.log(result_json);
      // 音声認識結果の表示
      text = result_json.results[0].alternatives[0].transcript;
      speechToText.textContent = text;
    }).catch((error)=>{
      console.error('通信に失敗しました', error);
    });
  };
}

// 音声データ出力先の値変更時
speechToText.addEventListener('change', () => {
  if(speechToText.textLength) {
    searchKeyword.classList.remove('disabled');
  }else{
    searchKeyword.classList.add('disabled');
  }
});

// 監視対象に変更時の処理
const mo = new MutationObserver(function(record, observer) {
  if(speechToText.textLength) {
    searchKeyword.classList.remove('disabled');
  }else{
    searchKeyword.classList.add('disabled');
  }
});
// 音声データの出力テキストを監視
mo.observe(speechToText, {childList: true});

// 検索ボタン押下時
searchKeyword.addEventListener('click', () => {

  // 画面の入力値
  const keyword = document.querySelector('#keyword').value;
  const beforeTextNum = document.querySelector('#beforeTextNum').value;
  const afterTextNum = document.querySelector('#afterTextNum').value;

  let outputEl;

  // 出力先の初期化(子要素削除)
  while(outputText.firstChild){
    outputText.removeChild(outputText.firstChild);
  }

  // バリデーションチェック
  // Todo 項目に応じたチェックおよびエラーメッセージを設定する
  if(speechToText.value === 0 || keyword.length === 0 || beforeTextNum.length === 0 || afterTextNum.length === 0) {
    outputEl = document.createElement('p');
    outputEl.textContent = "検索項目に入力漏れがあります。全て入力してください。";
    outputEl.classList.add('text-danger');
    outputText.appendChild(outputEl);
    return;
  }

  // キーワード箇所の抽出処理
  const jsonData = extractionKeyword(keyword, speechToText.value, parseInt(beforeTextNum), parseInt(afterTextNum));

  // Todo 異常系の処理を書く
  if(jsonData.status === 1){
    // キーワードと一致する文字がない
    if(jsonData.data.length === 0){
      outputEl = document.createElement('p');
      outputEl.textContent = "キーワードは含まれていませんでした。";
      outputText.appendChild(outputEl);
    }else{
      outputEl = document.createElement('ol');
      jsonData.data.map((data)=>{
        const li = document.createElement('li');
        // キーワードにマークをつけるために分割
        const beforeText = data.text.substr(0, data.fromIndex);
        const centerText = data.text.substr(data.fromIndex, keyword.length);
        const afterText  = data.text.substr(data.fromIndex+keyword.length);
        // キーワードをmarkタグで囲む
        li.innerHTML = beforeText+`<mark class="bg-warning rounded">${centerText}</mark>`+afterText;
        outputEl.appendChild(li);
      });
      outputText.appendChild(outputEl);
    }
  }
})

const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
</script>
</x-app-layout>