  <x-app-layout>

    <!--ヘッダー[START]-->
      　<div class="flex items-center justify-center" style="padding: 20px 0;">
            <div class="flex flex-col items-center">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
                <form method="get" action="{{ route('kyuuin.edit', $person->id) }}">
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
                        <h3 class="text-gray-900 font-bold text-xl">{{ $selectedDate }}の吸引記録</h3>
                    </div>
                </div>
                    <!--<label for="selected_date"  class="text-gray-900 font-bold text-xl">日付選択：</label>-->
                <input type="date" name="selected_date" id="selected_date" value="{{ $selectedDate }}">
                  <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    表示
                  </button>
            </div>
        </div>
    </form>
                    @php
                       $today = \Carbon\Carbon::now()->toDateString();
                       $todaysKyuuins = $person->kyuuins->where('created_at', '>=', $today)
                       ->where('created_at', '<', $today . ' 23:59:59');
                    @endphp
                    @if ($todaysKyuuins->count() > 0)
                    <!--<div class="flex flex-col">-->
                    <div class ="flex items-center justify-center"  style="padding: 20px 0;">
                        <div class="flex flex-col items-center">
                            <p class="text-gray-900 font-bold text-lg">吸引した時間</p>
                            <!-- 日ごとの吸引リスト -->
                            @foreach ($kyuuinsOnSelectedDate as $kyuuin)
                                    <div class="flex-row items-center justify-between p-2 border-b border-gray-300">
                                        <p class="text-gray-900 font-bold text-lg">{{ $kyuuin->created_at->format('H:i') }}</p>
                                        <p class="text-gray-900 font-bold text-lg">{{ $kyuuin->bikou }}</p>
                                        @if($kyuuin->filename && $kyuuin->path)
                                            <img alt="team" class="w-80 h-64" src="{{ asset('storage/sample/kyuuin_photo/' . $kyuuin->filename) }}">
                                        @endif
                                        <a href="{{ route('kyuuin.change', ['people_id' => $person->id, 'id' => $kyuuin->id]) }}" class="text-stone-500">
                                            <i class="fa-solid fa-pencil" style="font-size: 1.5em;"></i>
                                        </a>
                                        <form action="{{ route('kyuuin.delete', ['id'=>$kyuuin->id]) }}" method="POST">
                                        @csrf
                                            <button type="submit" class="text-stone-500">
                                                <i class="fa-solid fa-trash-can" style="font-size: 1.5em;"></i>
                                            </button>
                                        </form>
                                    </div>
                            @endforeach
                        @endif
                        </div>
                    </div>
            </div>
    
          

</x-app-layout>
