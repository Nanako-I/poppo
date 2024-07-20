<!-- resources/views/books.blade.php -->
@vite(['resources/css/app.css', 'resources/js/app.js'])
<script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
<x-app-layout>

    <body class="h-full w-full">
        
        <form action="{{ route('custom_id.store', ['facilityId' => $facilityId]) }}" method="POST">
                        @csrf
           <div style="display: flex; align-items: center; justify-content: center; flex-direction: column;">
                <input type="hidden" name="facility_id" value="{{ $facilityId ?? '' }}">
                <div class="form-group mb-4 m-2 w-1/2 max-w-md md:w-1/6" style="display: flex; flex-direction: column; align-items: center;">
                    <label class="block text-lg font-bold text-gray-700">職員の方のIDを入力してください</label>
                    @if (session('error'))
                        <div class="alert alert-danger text-red-500 text-lg font-bold">
                            {{ session('error') }}
                        </div>
                    @endif
                    <input name="custom_id" id="custom_id" required type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm text-xl font-bold border-gray-300 rounded-md" placeholder="ID">
                </div>
                <div class="flex flex-col col-span-1">
                    <div class="text-gray-700 text-center px-4 py-2 m-2">
                      <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        登録
                      </button>
                    </div>
                </div>
            </form> 
            
            
            
               @if ($allCustomID && $allCustomID->count() > 0)
                <div class="flex flex-col items-center">
                    <label class="block text-lg font-bold text-gray-700">登録済みの職員ID</label>
                     @foreach ($allCustomID as $customID)
                        <div class="flex-row items-center justify-between p-2 border-b border-gray-300">
                            <div class="flex items-center justify-between p-2 border-b border-gray-300">
                                <!--<p class="text-gray-900 font-bold text-lg">{{ \Carbon\Carbon::parse($customID->created_at)->format('H:i') }}</p>-->
                                <p class="text-gray-900 font-bold text-2xl ml-3">{{ $customID->custom_id }}</p>
                            </div>
                            
                            <form action="{{ route('custom_id.delete', ['id'=>$customID->id]) }}" method="POST">
                                @csrf
                                <button type="button" class="text-stone-500 delete-btn" data-id="{{ $customID->id }}" data-toggle="modal" data-target="#confirmDeleteModal">
                                    <i class="fa-solid fa-trash-can" style="font-size: 1.5em;"></i>
                                </button>
                            </form>

                        </div>
                    @endforeach
                </div> 
                @endif
                
                <div class="w-full max-w-md">
                    <a href="{{ url('/invitation_staff') }}">
                        <div class="p-6 rounded-lg shadow-lg mb-4 hover:-translate-y-2 hover:shadow-lg transition-transform bg-gradient-to-r from-red-200 via-red-50 to-pink-300 border-2 border-red-400">
                            <h2 class="text-xl font-semibold text-center">IDを登録した職員を招待する</h2>
                        </div>
                    </a>
                </div>
            </div>
        <!-- モーダルダイアログ -->
<div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center hidden" id="confirmDeleteModal">
  <div class="modal-overlay absolute w-full h-full bg-gray-600 opacity-50"></div>

  <!--<div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">-->
    <div class="modal-container bg-white w-full max-w-xs mx-auto rounded shadow-lg z-50 overflow-y-auto">
    <!-- Add margin if you want to see some of the overlay behind the modal-->
    <div class="modal-content py-4 text-left px-6">
      <!--Title-->
      <div class="flex justify-between items-center pb-3">
        <p class="text-2xl font-bold">このIDを削除しますか？</p>
        <div class="modal-close cursor-pointer z-50" data-dismiss="modal">
          <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
          </svg>
        </div>
      </div>

     <!--Footer-->
      <div class="flex justify-end pt-2">
        <button type="button" class="px-4 bg-blue-800 p-3 rounded-lg text-white hover:bg-blue-400 mr-2" data-dismiss="modal">キャンセル</button>
        <button type="button" class="px-4 bg-red-500 p-3 rounded-lg text-white hover:bg-red-400" id="deleteBtn">削除</button>
      </div>
    </div>
  </div>
</div>
 </body>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var deleteForm; // 削除するフォームを保存する変数

    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            deleteForm = this.closest('form'); // フォームを取得して保存
            document.getElementById('confirmDeleteModal').classList.remove('hidden');
        });
    });

    document.getElementById('deleteBtn').addEventListener('click', function() {
        deleteForm.submit(); // モーダルの削除ボタンがクリックされたらフォームを送信
        document.getElementById('confirmDeleteModal').classList.add('hidden');
    });

    document.querySelectorAll('[data-dismiss="modal"]').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('confirmDeleteModal').classList.add('hidden');
        });
    });
});

</script> 
   
</x-app-layout>