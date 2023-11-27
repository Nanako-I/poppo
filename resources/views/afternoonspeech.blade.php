<x-app-layout>

    <!--ヘッダー[START]-->
     <form action="{{ url('people' ) }}" method="POST" class="w-full max-w-lg">
                        @method('PATCH')
                        @csrf
  <body>
      <div style="display: flex; flex-direction: column;">
         <style>
         body {
              font-family: 'Noto Sans JP', sans-serif; /* フォントをArialに設定 */
              background: linear-gradient(135deg, rgb(253, 219, 146,0), rgb(209, 253, 255,1));
              }
            h2 {
              font-family: Arial, sans-serif; /* フォントをArialに設定 */
              font-size: 20px; /* フォントサイズを20ピクセルに設定 */
              text-decoration: underline;
            }
          </style>
      </div>   
      <div class="flex items-center justify-center my-2 font-bold text-2xl">
      <!--<div style="display: flex; align-items: center; margin-left: auto; margin-right: auto; max-width: 300px;">-->
           <h2>{{$person->person_name}}さんの午前活動記録</h2>
        </div>  
         <div class="flex items-center justify-start m-2">
         <p class="font-bold text-xl">音声で入力する場合、スタートボタンを押してください</p>
        </div> 
   
    </form>
    <style>
.center-container {
display: flex;
flex-direction: column;
justify-content: center;
    align-items: center;
height: 100vh;
}
</style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
      <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
        <i class="fa-solid fa-volume-high text-orange-400" style="font-size: 3em; padding: 0 5px;"></i>
 
        <button id="start-btn" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded-lg text-lg">
          スタート
        </button>

        <button id="stop-btn" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded-lg text-lg">
          ストップ
        </button>
<div id="result-div"></div>

<form action="{{ url('afternoonspeech/'.$person->id.'/edit') }}" method="POST">
  @csrf
<div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
        <textarea id="result-speech" name="morning_activity" class="w-3/4 max-w-lg" style="height: 300px;"></textarea>
    </div>
    <div style="display: flex; align-items: center; justify-content: center;" class="my-2">
        <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
            送信
        </button>
    </div>
</form>
<script>
  const startBtn = document.querySelector('#start-btn');
  const stopBtn = document.querySelector('#stop-btn');
  const resultDiv = document.querySelector('#result-div');
  const resultSpeech = document.querySelector('#result-speech');

  SpeechRecognition = webkitSpeechRecognition || SpeechRecognition;
  let recognition = new SpeechRecognition();

  recognition.lang = 'ja-JP';
  recognition.interimResults = true;
  recognition.continuous = true;

  let finalTranscript = ''; // 確定した(黒の)認識結果

  recognition.onresult = (event) => {
    let interimTranscript = ''; // 暫定(灰色)の認識結果
    for (let i = event.resultIndex; i < event.results.length; i++) {
      let transcript = event.results[i][0].transcript;
      if (event.results[i].isFinal) {
        
        finalTranscript += transcript;
        console.log('aaa');
      } else {
        
        interimTranscript = transcript;
        console.log('bbb');
      }
    }
    // resultDiv.innerHTML = finalTranscript + '<i style="color:#ddd;">' + interimTranscript + '</i>';
    console.log('ccc');
    resultSpeech.value = finalTranscript + interimTranscript;
  }

  startBtn.onclick = () => {
    // 開始ボタンがクリックされたら、既に音声認識が動作している場合は何もしない
    if (!recognition.running) {
      recognition.start();
    }
  }

  stopBtn.onclick = () => {
    // 停止ボタンがクリックされたら音声認識を停止
    recognition.stop();
  }
</script>
</body>
</html>

</x-app-layout>