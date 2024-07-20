@vite(['resources/css/app.css', 'resources/js/app.js'])
<x-app-layout>
<head>
 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

    <div style="display: flex; align-items: center; justify-content: center; flex-direction: column;" class="pt-14">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mb-4 text-center">職員に<br>新規登録の案内を送る</h1>
        <div class="share-buttons flex justify-center space-x-4 mt-4">
            <a href="mailto:?subject=新規登録のご案内&body=新規登録のご案内を送ります。" id="share-email" title="Email" style="font-size: 2em;" class="text-white bg-blue-500 p-2 rounded">
                <i class="fas fa-envelope"></i>
            </a>
            <a href="#" id="share-line" title="LINE" style="font-size: 2em;" class="text-white bg-green-500 p-2 rounded">
                <i class="fab fa-line"></i>
            </a>
        </div>
    </div>
 </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // シェアするURLを定義
            const shareUrl =  "{{ $url }}";
            const defaultMessage = "新連絡帳システムのご案内です。以下のリンクから新規登録してください。有効期限は本メッセージ送信後1時間以内となります。有効期限切れの場合はその旨お知らせください:";

            // Emailシェア
            document.getElementById('share-email').addEventListener('click', function (e) {
                e.preventDefault();
                const subject = encodeURIComponent('新規登録のご案内');
                const body = encodeURIComponent(`${defaultMessage} ${shareUrl}`);
                window.location.href = `mailto:?subject=${subject}&body=${body}`;
            });

            // LINEシェア
            document.getElementById('share-line').addEventListener('click', function (e) {
                e.preventDefault();
                const lineShareUrl = `https://social-plugins.line.me/lineit/share?url=${encodeURIComponent(shareUrl)}&text=${encodeURIComponent(defaultMessage)}`;
                window.location.href = lineShareUrl;
            });
        });
    </script>
</x-app-layout>
