  <x-app-layout>

    <!--ヘッダー[START]-->
      　<div class="flex items-center justify-center" style="padding: 20px 0;">
            <div class="flex flex-col items-center">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                <form method="get" action="{{ route('bloodpressures.edit', $person->id) }}">
                <!--<form action="{{ url('people' ) }}" method="POST" class="w-full max-w-lg">-->
                                    @method('PATCH')
                                    @csrf
                <style>
                    h2 {
                      font-family: Arial, sans-serif; /* フォントをArialに設定 */
                      font-size: 20px; /* フォントサイズを20ピクセルに設定 */
                    }
                </style>
                <div class="flex items-center justify-center" style="padding: 20px 0;">
                    <div class="flex flex-col items-center">
                        <h2>{{$person->person_name}}さん</h2>
                        <h3 class="text-gray-900 font-bold text-xl">{{ $selectedDate }}のバイタル記録</h3>
                    </div>
                </div>
                <input type="date" name="selected_date" id="selected_date" value="{{ $selectedDate }}">
                  <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    表示
                  </button>
            </div>
        </div>
    </form>
                    @php
                       $today = \Carbon\Carbon::now()->toDateString();
                       $todaysBloodpressures = $person->bloodpressures()->where('created_at', '>=', $today)
                       ->where('created_at', '<', $today . ' 23:59:59');
                    @endphp
                    @if ($todaysBloodpressures->count() > 0)
                  
                    <div class ="flex items-center justify-center" style="padding: 20px 0;">
                        <div class="flex flex-col items-center">
                            <h4 class="text-gray-900 font-bold text-lg">計測した時間</h>
                            <!-- 日ごとの吸引リスト -->
                            @foreach ($bloodpressuresOnSelectedDate as $bloodpressure)
                                      
                            <div class="flex-row items-center justify-between p-2 border-b border-gray-300">
                                <p class="text-gray-900 font-bold text-lg">{{ $bloodpressure->created_at->format('H:i') }}</p>
                            </div>
                            <div class="flex items-center justify-around">
                        　　　　    <div class="px-2">
                        　　　　        <p class="text-gray-900 font-bold text-base">血圧:</p>
                                    <p class="text-gray-900 font-bold text-2xl">{{ $bloodpressure->max_blood }}/{{ $bloodpressure->min_blood }}</p>
                                </div>
                                <div class="px-2">
                        　　　　        <p class="text-gray-900 font-bold text-base">脈:</p>
                                    <p class="text-gray-900 font-bold text-2xl">{{ $bloodpressure->pulse}}/分</p>
                                </div>
                                <div class="px-2">
                        　　　　        <p class="text-gray-900 font-bold text-base">SpO2:</p>
                                    <p class="text-gray-900 font-bold text-2xl">{{ $bloodpressure->spo2}}％</p>
                                </div>
                                <a href="{{ route('bloodpressure.change', ['people_id' => $person->id, 'id' => $bloodpressure->id]) }}" class="text-stone-500">
                                  <i class="fa-solid fa-pencil" style="font-size: 1.5em;"></i>
                                </a>
                                <form action="{{ route('bloodpressure.delete', ['id'=>$bloodpressure->id]) }}" method="POST">
                                @csrf
                                    <button type="button" class="text-stone-500 delete-btn" data-id="{{ $bloodpressure->id }}" data-toggle="modal" data-target="#confirmDeleteModal">
                                       <i class="fa-solid fa-trash-can" style="font-size: 1.5em;"></i>
                                    </button>
                                </form>
                            </div>
                                   
                            @endforeach
                        @endif
                        </div>
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
        <p class="text-2xl font-bold">本当に削除しますか？</p>
        <div class="modal-close cursor-pointer z-50" data-dismiss="modal">
          <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
          </svg>
        </div>
      </div>

      <!--Body-->
      <p class="font-bold">削除したデータは復元できません。</p>

      <!--Footer-->
      <div class="flex justify-end pt-2">
        <button type="button" class="px-4 bg-blue-800 p-3 rounded-lg text-white hover:bg-blue-400 mr-2" data-dismiss="modal">キャンセル</button>
        <button type="button" class="px-4 bg-red-500 p-3 rounded-lg text-white hover:bg-red-400" id="deleteBtn">削除</button>
      </div>
    </div>
  </div>
</div>

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
