<!-- resources/views/books.blade.php -->
@vite(['resources/css/app.css', 'resources/js/app.js'])
<x-app-layout>
<!-- バリデーションエラーの表示に使用-->
    <body>
    <div style="display: flex; align-items: center; justify-content: center; flex-direction: column;">
        <div class="form-group mb-4 m-2 w-1/2 max-w-md md:w-1/6" style="display: flex; flex-direction: column; align-items: center;">
            <label class="block text-xl font-bold text-gray-700">利用者の登録は済んでいますか？<br>(ご家族の招待にはまず利用者の登録が必要です)</label>
        </div>
     <div style="display: flex; align-items: center; justify-content: center; flex-direction: column;" class="pt-14">
        <div class="w-full max-w-md">
            <a href="{{ url('/invitation') }}">
                <div class="p-6 rounded-lg shadow-lg mb-4 hover:-translate-y-2 hover:shadow-lg transition-transform bg-gradient-to-r from-red-200 via-red-50 to-pink-300 border-2 border-red-400">
                    <h2 class="text-xl font-semibold text-center">はい</h2>
                </div>
            </a>
            <a href="{{ url('/peopleregister') }}">
                <div class="p-6 rounded-lg shadow-lg hover:-translate-y-2 hover:shadow-lg transition-transform bg-gradient-to-r from-orange-300 via-red-50 to-yellow-100 border-2 border-yellow-400">
                    <h2 class="text-xl font-semibold text-center">いいえ（利用者の登録に進む）</h2>
                </div>
            </a>
        </div>
    </div>
    </div>
</body>
</html>
</x-app-layout>