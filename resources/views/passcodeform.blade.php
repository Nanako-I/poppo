@vite(['resources/css/app.css', 'resources/js/app.js'])
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ぶーけあ</title>
  <style>
    /* 携帯画面用のスタイル */
    @media (max-width: 640px) {
      .preregistrationmail {
        padding: 20px; /* コンテナ全体のパディング */
        /*font-size: 3rem;*/
      }

      .title h1 {
      font-size: 3rem; /* 見出しのフォントサイズ */
    }

      .preregistrationmail p {
        font-size: 2rem; /* 段落のフォントサイズ */
      }
      

      .submit-btn {
        font-size: 24px; /* ボタンのテキストサイズ */
        padding: 16px 32px; /* ボタンの内側の余白 */
        width: 100%; /* ボタンの幅を100%に設定 */
      }

      input[type="email"] {
        font-size: 30px; /* 入力フィールドのフォントサイズ */
        padding: 14px 20px; /* 入力フィールドの内側の余白 */
      }
    }
  </style>
</head>
<body>
<div class="preregistrationmail relative overflow-hidden">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-24">
        <div class="text-center">
            <div class="title">
                <h1 class="text-3xl sm:text-6xl font-bold text-gray-800 dark:text-neutral-200">
                    パスコードの入力
                </h1>
            </div>
            <p class="mt-3 text-3xl text-gray-600 dark:text-neutral-400">
                メールで届いたパスコードを入力してください
            </p>
            <div class="mt-7 sm:mt-12 mx-auto max-w-xl relative">
                <!-- Form -->
                <form method="POST" action="{{ route('passcode.validate') }}">
                    @csrf
                    <div class="relative z-10 flex space-x-3 p-3 bg-white border rounded-lg shadow-lg shadow-gray-100 dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-gray-900/20">
                        <div class="flex-[1_0_0%]">
                            <label for="passcode" class="block text-sm text-gray-700 font-medium dark:text-white">
                                <span class="sr-only">パスコード</span>
                            </label>
                            <input type="text" name="passcode" id="passcode" class="py-2.5 px-4 block w-full border-transparent rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="6桁のパスコード">
                        </div>
                        <div class="flex-[0_0_auto]">
                            <button type="submit" class="submit-btn inline-flex justify-center items-center gap-x-2 text-lg font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none py-4 px-6">
                                送信
                            </button>
                      </div>
                    </div>
                     @if($errors->any())
                        <div class="mt-4 text-red-600">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                  </form>
          <!-- End Form -->
          <!-- SVG Element -->
          <div class="hidden md:block absolute top-0 end-0 -translate-y-12 translate-x-20">
            <svg class="w-16 h-auto text-orange-500" width="121" height="135" viewBox="0 0 121 135" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M5 16.4754C11.7688 27.4499 21.2452 57.3224 5 89.0164" stroke="currentColor" stroke-width="10" stroke-linecap="round"/>
              <path d="M33.6761 112.104C44.6984 98.1239 74.2618 57.6776 83.4821 5" stroke="currentColor" stroke-width="10" stroke-linecap="round"/>
              <path d="M50.5525 130C68.2064 127.495 110.731 117.541 116 78.0874" stroke="currentColor" stroke-width="10" stroke-linecap="round"/>
            </svg>
          </div>
          <!-- End SVG Element -->

        <!-- SVG Element -->
        <div class="hidden md:block absolute bottom-0 start-0 translate-y-10 -translate-x-32">
          <svg class="w-40 h-auto text-cyan-500" width="347" height="188" viewBox="0 0 347 188" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M4 82.4591C54.7956 92.8751 30.9771 162.782 68.2065 181.385C112.642 203.59 127.943 78.57 122.161 25.5053C120.504 2.2376 93.4028 -8.11128 89.7468 25.5053C85.8633 61.2125 130.186 199.678 180.982 146.248L214.898 107.02C224.322 95.4118 242.9 79.2851 258.6 107.02C274.299 134.754 299.315 125.589 309.861 117.539L343 93.4426" stroke="currentColor" stroke-width="7" stroke-linecap="round"/>
          </svg>
        </div>
        <!-- End SVG Element -->
      </div>

    </div>
  </div>
</div>
<!-- End Hero -->
<script>
        document.getElementById('registration-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const email = document.getElementById('email').value;

            fetch('/send-passcode', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ email: email })
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
    </body>
    </html>