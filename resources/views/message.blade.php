<x-app-layout>
    
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat App</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>

    <div id="chat">
        <textarea id="message"></textarea>
        <br>
        <button type="button" id="sendMessageBtn">送信</button>

        <hr>

        <div id="messages"></div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var messageInput = document.getElementById('message');
            var sendMessageBtn = document.getElementById('sendMessageBtn');
            var messagesContainer = document.getElementById('messages');

            function getMessages() {
                const url = '/ajax/message';
                axios.get(url)
                    .then((response) => {
                        renderMessages(response.data);
                    });
            }

            function renderMessages(messages) {
                messagesContainer.innerHTML = ''; // メッセージをクリア

                messages.forEach(function (m) {
                    var messageDiv = document.createElement('div');

                    // 登録された日時
                    var dateSpan = document.createElement('span');
                    dateSpan.textContent = m.created_at + '： ';
                    messageDiv.appendChild(dateSpan);

                    // メッセージ内容
                    var bodySpan = document.createElement('span');
                    bodySpan.textContent = m.body;
                    messageDiv.appendChild(bodySpan);

                    messagesContainer.appendChild(messageDiv);
                });
            }

            // sendMessage 関数の追加
            sendMessageBtn.addEventListener('click', function () {
                var message = messageInput.value;

                const url = '/ajax/message';
                const params = { message: message };
                axios.post(url, params)
                    .then((response) => {
                        // 成功したらメッセージをクリア
                        messageInput.value = '';
                        getMessages(); // メッセージを再読込
                    });
            });

            // 初回読み込み
            getMessages();

            // メッセージが追加されたときに再読み込み
            Echo.channel('chat')
                .listen('MessageCreated', function (e) {
                    getMessages();
                });
        });
    </script>

</body>
</html>



</x-app-layout>