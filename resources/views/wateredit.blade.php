  <x-app-layout>

    <!--ヘッダー[START]-->
  <div class="flex items-center justify-center">
    <div class="flex flex-col items-center">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
        <form action="{{ url('people' ) }}" method="POST" class="w-full max-w-lg">
                            @method('PATCH')
                            @csrf
            <style>
                h2 {
                  font-family: Arial, sans-serif; /* フォントをArialに設定 */
                  font-size: 20px; /* フォントサイズを20ピクセルに設定 */
                }
            </style>
            <div class ="flex items-center justify-center"  style="padding: 20px 0;">
                <div class="flex flex-col items-center">
                    <h2>{{$person->person_name}}さんの水分摂取</h2>
                    @php
                       $lastWater = $person->waters->last();
                       $today = \Carbon\Carbon::now()->toDateString();
                       $todaysWaters = $person->waters->where('created_at', '>=', $today)
                       ->where('created_at', '<', $today . ' 23:59:59');
                    @endphp
                    @if ($todaysWaters->count() > 0)
                    <div class="flex flex-col">
                        <p class="text-gray-900 font-bold text-lg">水分を摂った時間</p>
                        <!-- 今日の水分摂取リスト -->
                        @foreach ($todaysWaters as $water)
                                <div class="flex-row items-center justify-between p-2 border-b border-gray-300">
                                    <p class="text-gray-900 font-bold text-lg">{{ $water->created_at->format('H:i') }}</p>
                                    <p class="text-gray-900 font-bold text-lg">{{ $water->water_bikou }}</p>
                                    <a href="{{ route('water.change', ['people_id' => $person->id, 'id' => $water->id]) }}" class="text-stone-500">
                                      
                                        <i class="fa-solid fa-pencil" style="font-size: 1.5em;"></i>
                                    </a>
                                </div>
                        @endforeach
                    @endif
                    </div>
                </div>
            </div>
        </form>
          

</x-app-layout>
