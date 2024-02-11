@vite(['resources/css/app.css', 'resources/js/app.js'])
<x-app-layout>
    
    <!DOCTYPE html>
<!--<html lang="ja">-->
<head>
    <!--<meta charset="UTF-8">-->
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <title>Real-time Speech Recognition with Google Cloud Speech-to-Text API</title>
</head>
<body>

<div id="output">
  <h1>Real-time Speech Recognition</h1>
  <textarea id="transcript" rows="10"></textarea>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const transcriptElement = document.getElementById('transcript');

  // Create output element dynamically
  const outputElement = document.createElement('div');
  outputElement.id = 'output';
  document.body.appendChild(outputElement);

  async function startSpeechRecognition() {
    const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
    const audioContext = new AudioContext();
    const audioInput = audioContext.createMediaStreamSource(stream);

    const scriptProcessorNode = audioContext.createScriptProcessor(4096, 1, 1);
    scriptProcessorNode.onaudioprocess = async (event) => {
      const audioBuffer = event.inputBuffer;
      const audioData = new Float32Array(audioBuffer.getChannelData(0));

      const audioBlob = new Blob([audioData], { type: 'audio/wav' });

      // Convert Blob to Base64
      const reader = new FileReader();
      reader.onloadend = async () => {
        const base64Data = reader.result.split(',')[1];

        // Call Google Cloud Speech-to-Text API
        const apiKey = 'AIzaSyBtE_NInCBqcXT-DqWpQxTcVTY6T6IcEsY';
        const apiUrl = "https://speech.googleapis.com/v1/speech:recognize?key=AIzaSyBtE_NInCBqcXT-DqWpQxTcVTY6T6IcEsY";

        const requestData = {
          config: {
            encoding: 'LINEAR16',
            sampleRateHertz: 16000,
            languageCode: 'ja-JP',
          },
          audio: {
            content: base64Data,
          },
        };

        try {
          const response = await fetch(apiUrl, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify(requestData),
          });

          const result = await response.json();
          console.log('Speech-to-Text API response:', result);

          if (result.results && result.results.length > 0) {
          
            const transcript = result.results[0].alternatives[0].transcript;

            // Update the real-time transcript
            transcriptElement.value = transcriptElement.value + transcript;

            // Display transcript in the dynamically created output element 足したのを代入する
            outputElement.innerText = outputElement.innerText + transcript;
            
            // Log transcript to console in real-time
            console.log(transcript);
            
          }else {
            // リザルトがない場合、デフォルトのメッセージを設定
            const defaultTranscript = "No speech detected.";
            transcriptElement.value = defaultTranscript;
            outputElement.innerText = defaultTranscript;
            
          }
          
        } catch (error) {
          console.error('Error during speech recognition:', error);
        }
      };

      reader.readAsDataURL(audioBlob);
    };

    audioInput.connect(scriptProcessorNode);
    scriptProcessorNode.connect(audioContext.destination);
  }

  startSpeechRecognition();
});


</script>


</body>
<!--</html>-->

    
</x-app-layout>