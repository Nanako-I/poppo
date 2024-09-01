
<x-app-layout>

    <!--ヘッダー[START]-->
<body>
  <div class="flex items-center justify-center" style="padding: 20px 0;">
    <div class="flex flex-col items-center">
      <form method="get" action="{{ route('record.edit', $person->id) }}">
     <!--<form action="{{ url('people' ) }}" method="POST" class="w-full max-w-lg">-->
                        @method('PATCH')
                        @csrf
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
     <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
     
      <style>
      body {
            font-family: 'Noto Sans JP', sans-serif; /* フォントをArialに設定 */
          background: rgb(253, 219, 146,0.2);
          }
        h2 {
          font-family: Arial, sans-serif; /* フォントをArialに設定 */
          font-size: 25px; /* フォントサイズを20ピクセルに設定 */
          font-weight: bold;
          /*text-decoration: underline;*/
        }
   .oya-stamp-box {
      float: right;
      margin-right: 70px;
      margin-top: 10px;
    /*display: flex; /* flexコンテナーとして設定 */
    /*justify-content: flex-end; /* 右端に寄せる */
  }
    .stamp-box {
          width: 120px; /* はんこより少し大きめに設定 */
          height: 120px; /* はんこより少し大きめに設定 */
          border: 1px solid #000; /* 黒い実線のボーダー */
          display: flex;
          justify-content: center;
          align-items: center;
           /*display: none; */
        }
        /*.stamp-box .hanko {*/
          #hanko {
            font-size: 16px; /* Sassの変数は使用できないため、直接指定 */
            border: 3px double #f00; /* Sassの変数と算術演算子を展開して直接指定 */
            border-radius: 50%;
            color: #f00;
            width: 100px; /* Sassの変数は使用できないため、直接指定 */
            height: 100px; /* Sassの変数は使用できないため、直接指定 */
            display: none; /* 最初は非表示にする */ 
            /* display: flex;*/ 
            flex-direction: column;
            justify-content: center;
            text-align: center; /* 中央揃え */
            align-items: center;
          }
          /*.stamp-box .hanko hr {*/
          #hanko hr {
            width: 100%;
            margin: 0;
            border-color: #f00;
            /* display: none; /* 最初は非表示にする */
          }
          .icon-container {
            position: relative;
          }
          
          .icon-container::after {
            content: "ご家族とチャットする";
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(0, 0, 0, 0.8);
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            white-space: nowrap;
            font-size: 14px;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s, transform 0.2s;
          }
          
          .icon-container:hover::after {
            opacity: 1;
            transform: translate(-50%, -5px);
          }

    </style>
      
      @php
        $today = now()->format('Y-m-d'); // 今日の日付を取得（例：2023-08-07）
      @endphp
      
      <div class="flex items-center justify-center" style="padding: 20px 0;">
        <div class="flex flex-col items-center">

        <h2>{{$person->person_name}}さん</h2>
        <h3 class="text-gray-900 font-bold text-xl">{{ $selectedDate }}の記録</h3>
        </div>
      </div>
        <label for="selected_date"  class="text-gray-900 font-bold text-xl">日付選択：</label>
          <input type="date" name="selected_date" id="selected_date" value="{{ $selectedDate }}">
          <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
            表示
          </button>
        
     </form> 
    </div>
  </div>
  
   
      <div class="flex justify-end "> 
        <div class="flex-col"> 
       
        <a href="{{ url('chat/'.$person->id) }}" class="relative ml-2" style="display: flex; align-items: center;">
          <i class="fa-solid fa-comments text-sky-500 icon-container mr-5 " style="font-size: 3em; padding: 0 5px; transition: transform 0.2s;"></i>
          @csrf
        </a>
      </div> 
    </div> 
    <style>
        table {
        border-collapse: collapse; /* テーブルの罫線を結合する */
        width: 80%; /* テーブルの幅を100%に設定する */
        /*padding: 60px;*/
        margin: 0 auto;
      }
      
      th, td {
        border: 1px solid black; /* 罫線を追加する */
        padding: 8px; /* セル内の余白を設定する */
        text-align: left; /* セル内のテキストを左寄せにする */
      }
    </style>
<section class="text-gray-600 body-font mx-auto" _msthidden="10">
  <div class="container px-5 pb-24 mx-auto flex flex-wrap" _msthidden="10">
   <div class="flex flex-col flex-wrap lg:py-6 -mb-10 lg:w-1/2 lg:pl-12 lg:text-left text-center" _msthidden="9">
      
      <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
            <i class="fa-solid fa-bowl-rice text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
        </div>
        <div class="flex-grow" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="232921" _msthidden="1" _msthash="740">食事</h2>
          @if ($foodsOnSelectedDate->count() > 0)
          @foreach ($foodsOnSelectedDate as $index => $foods)
          <p class="text-gray-900 font-bold text-lg">{{ $foods->created_at->format('H:i') }}</p>
          <p class="text-gray-900 font-bold text-xl">{{ $foods->staple_food }}割食べました</p>
          <p class="text-gray-900 font-bold text-xl">{{ $foods->medicine == 'あり' ? '服用：あり' : ($foods->medicine != 'なし' ? $foods->medicine : '') }}</p>
          <p class="text-gray-900 font-bold text-xl">{{ $foods->medicine_name }}</p>
          <p class="text-gray-900 font-bold text-xl">{{ $foods->bikou }}</p>
          <div class="pt-2">
            <!-- 最後の要素でない場合のみ <hr> を表示 -->
            @if(!$loop->last)
              <hr style="border: 1px dashed #666; margin: 0 auto; width: 100%;">
            @endif
          </div>
        @endforeach
      @endif
          
        </div>
       <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
    </div>
    
      <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
            <i class="fa-solid fa-thermometer text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
        </div>
        <div class="flex-grow" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="232921" _msthidden="1" _msthash="740">体温</h2>
          @if($temperaturesOnSelectedDate->count() > 0)
          @foreach ($temperaturesOnSelectedDate as $index => $temperature)
            <div class="flex justify-around text-left items-start">
              <p class="text-gray-900 font-bold text-xl px-3">{{ $temperature->created_at->format('H:i') }}</p>
              <p class="text-gray-900 font-bold text-xl px-3">{{ $temperature->temperature }}℃</p>
            </div>
          
              @if($temperature->bikou !== null)
                <p class="text-gray-900 font-bold text-xl px-3">{{ $temperature->bikou }}</p>
              @endif
            <div class="pt-2">
              <!-- 最後の要素でない場合のみ <hr> を表示 -->
              @if(!$loop->last)
                <hr style="border: 1px dashed #666; margin: 0 auto; width: 100%;">
              @endif
            </div>
        @endforeach
      @endif
          
        </div>
       <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">

      </div>
      
    <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
            <i class="fa-solid fa-heart-pulse text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
        </div>
        <div class="flex-grow" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="232921" _msthidden="1" _msthash="740">血圧・脈・SpO2</h2>
          @if ($bloodpressuresOnSelectedDate->count() > 0)
          @foreach ($bloodpressuresOnSelectedDate as $index => $bloodpressure)
          
            <div class="flex items-center justify-around">
                <div class="px-2">
                    <p class="text-gray-900 font-bold text-lg">{{ $bloodpressure->created_at->format('H:i') }}</p>
                </div>
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
            </div>
              <div class="pt-2">
                <!-- 最後の要素でない場合のみ <hr> を表示 -->
                @if(!$loop->last)
                  <hr style="border: 1px dashed #666; margin: 0 auto; width: 100%;">
                @endif
              </div>
          @endforeach
          @endif
        </div>
       <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
    </div>
      
    <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
            <i class="fa-solid fa-glass-water text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
        </div>
        <div class="flex-grow" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="232921" _msthidden="1" _msthash="740">水分</h2>
          @if ($watersOnSelectedDate->count() > 0)
            @foreach ($watersOnSelectedDate as $index => $water)
              <p class="text-gray-900 font-bold text-lg">{{ $water->created_at->format('H:i') }}</p>
              <p class="text-gray-900 font-bold text-lg">{{ $water->water_bikou }}</p>
            <div class="pt-2">
              <!-- 最後の要素でない場合のみ <hr> を表示 -->
              @if($index < $watersOnSelectedDate->count() - 1)
                <hr style="border: 1px dashed #666; margin: 0 auto; width: 100%; ">
              @endif
            </div>
            @endforeach
          @endif
        </div>
       <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
    </div>
    
    <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
            <i class="fa-solid fa-prescription-bottle-medical text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
        </div>
        <div class="flex-grow" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="232921" _msthidden="1" _msthash="740">内服</h2>
          @if($medicinesOnSelectedDate->count() > 0)
          @foreach ($medicinesOnSelectedDate as $index => $medicine)
            <div class="flex justify-around text-left items-start">
              <p class="text-gray-900 font-bold text-xl px-3">{{ $medicine->created_at->format('H:i') }}</p>
              <p class="text-gray-900 font-bold text-xl px-3">{{ $medicine->medicine_bikou }}</p>
            </div>
            <div class="pt-2">
              <!-- 最後の要素でない場合のみ <hr> を表示 -->
              @if(!$loop->last)
                <hr style="border: 1px dashed #666; margin: 0 auto; width: 100%;">
              @endif
            </div>
        @endforeach
      @endif
        </div>
       <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
      </div>
    
    <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
            <i class="fa-solid fa-prescription-bottle-medical text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
        </div>
        <div class="flex-grow" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="232921" _msthidden="1" _msthash="740">注入</h2>
          @if ($tubesOnSelectedDate->count() > 0)
          @foreach ($tubesOnSelectedDate as $index => $tube)
          <p class="text-gray-900 font-bold text-lg">{{ $tube->created_at->format('H:i') }}</p>
            <div class="flex justify-around text-left items-start">
                <p class="text-gray-900 font-bold text-xl px-3">{{ $tube->tube_bikou }}</p>
            </div>
              @if($tube->filename && $tube->path)
                  <img alt="team" class="w-80 h-64" src="{{ asset('storage/sample/tube_photo/' . $tube->filename) }}">
              @endif
              <div class="pt-2">
                <!-- 最後の要素でない場合のみ <hr> を表示 -->
                @if(!$loop->last)
                  <hr style="border: 1px dashed #666; margin: 0 auto; width: 100%;">
                @endif
              </div>
          @endforeach
          @endif
        </div>
       <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
    </div>
    
    <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
            <i class="fa-solid fa-toilet-paper text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
        </div>
        <div class="flex-grow" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="232921" _msthidden="1" _msthash="740">トイレ</h2>
          @if ($toiletsOnSelectedDate->count() > 0)
          @foreach ($toiletsOnSelectedDate as $index => $toilet)
          <p class="text-gray-900 font-bold text-lg">{{ $toilet->created_at->format('H:i') }}</p>
            <div class="flex justify-around text-left items-start">
                <p class="text-gray-900 font-bold text-xl px-3">尿</p>
                <p class="text-gray-900 font-bold text-xl px-3">{{ $toilet->urine_amount }}</p>
            </div>
            
            <div class="flex justify-around text-left items-start">
                <p class="text-gray-900 font-bold text-xl px-3">便</p>
                <p class="text-gray-900 font-bold text-xl px-3">{{ $toilet->ben_amount }}</p>
            </div>
            
            <div class="flex justify-around text-left items-start">
                <p class="text-gray-900 font-bold text-xl px-3">便状態</p>
                <p class="text-gray-900 font-bold text-xl px-3">{{ $toilet->ben_condition }}</p>
            </div>
            
            <div class="flex justify-around text-left items-start">
                <p class="text-gray-900 font-bold text-xl px-3">備考</p>
                <p class="text-gray-900 font-bold text-xl px-3">{{ $toilet->bikou }}</p>
            </div>
            
              @if($toilet->filename && $toilet->path)
                  <img alt="team" class="w-80 h-64" src="{{ asset('storage/sample/toilet_photo/' . $toilet->filename) }}">
              @endif
              <div class="pt-2">
                <!-- 最後の要素でない場合のみ <hr> を表示 -->
                @if(!$loop->last)
                  <hr style="border: 1px dashed #666; margin: 0 auto; width: 100%;">
                @endif
              </div>
          @endforeach
          @endif
        </div>
       <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
    </div>
    
    <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
            <i class="fa-solid fa-droplet text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
        </div>
        <div class="flex-grow" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="232921" _msthidden="1" _msthash="740">吸引</h2>
          @php
           $today = \Carbon\Carbon::now()->toDateString();
           $todaysKyuuins = $person->kyuuins->where('created_at', '>=', $today)
           ->where('created_at', '<', $today . ' 23:59:59');
          @endphp
      
          @if ($kyuuinsOnSelectedDate->count() > 0)
          @foreach ($kyuuinsOnSelectedDate as $index => $kyuuin)
          <p class="text-gray-900 font-bold text-lg">{{ $kyuuin->created_at->format('H:i') }}</p>
          <p class="text-gray-900 font-bold text-xl">{{ $kyuuin->bikou }}</p>
  
            
              @if($kyuuin->filename && $kyuuin->path)
                  <img alt="team" class="w-80 h-64" src="{{ asset('storage/sample/kyuuin_photo/' . $kyuuin->filename) }}">
              @endif
              <div class="pt-2">
                <!-- 最後の要素でない場合のみ <hr> を表示 -->
                @if(!$loop->last)
                  <hr style="border: 1px dashed #666; margin: 0 auto; width: 100%;">
                @endif
              </div>
        @endforeach
      @endif
        </div>
       <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
    </div>
    
    <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
            <i class="fa-solid fa-circle-exclamation text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
        </div>
        <div class="flex-grow" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="232921" _msthidden="1" _msthash="740">発作</h2>
          @php
           $today = \Carbon\Carbon::now()->toDateString();
           $todaysHossas = $person->hossas->where('created_at', '>=', $today)
           ->where('created_at', '<', $today . ' 23:59:59');
          @endphp
      
          @if ($hossasOnSelectedDate->count() > 0)
          @foreach ($hossasOnSelectedDate as $index => $hossa)
          <p class="text-gray-900 font-bold text-lg">{{ $hossa->created_at->format('H:i') }}</p>
          <p class="text-gray-900 font-bold text-xl">{{ $hossa->hossa_bikou }}</p>
  
            @if($hossa->filename && $hossa->path)
              <video controls class="h-64" src="{{ asset('storage/sample/hossa_photo/'.$hossa->filename) }}" muted class="contents_width"></video>
              @endif
              <div class="pt-2">
                <!-- 最後の要素でない場合のみ <hr> を表示 -->
                @if(!$loop->last)
                  <hr style="border: 1px dashed #666; margin: 0 auto; width: 100%;">
                @endif
              </div>
        @endforeach
      @endif
          
        </div>
       <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
    </div>
    
    <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
            <i class="fa-solid fa-sun text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
        </div>
        <div class="flex-grow" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="232921" _msthidden="1" _msthash="740">1日の活動</h2>
          @php
           $today = \Carbon\Carbon::now()->toDateString();
           $todaysSpeeches = $person->speeches->where('created_at', '>=', $today)
           ->where('created_at', '<', $today . ' 23:59:59');
          @endphp
      
          @if ($speechesOnSelectedDate->count() > 0)
          @foreach ($speechesOnSelectedDate as $index => $speeches)
          <p class="text-gray-900 font-bold text-lg">{{ $speeches->created_at->format('H:i') }}</p>
          <p class="text-gray-900 font-bold text-xl">{{ $speeches->morning_activity }}</p>
  
           
              <div class="pt-2">
                <!-- 最後の要素でない場合のみ <hr> を表示 -->
                @if(!$loop->last)
                  <hr style="border: 1px dashed #666; margin: 0 auto; width: 100%;">
                @endif
              </div>
        @endforeach
      @endif
          
        </div>
       <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
    </div>
    
      </div>
      
      
        
      </div>
      </div>  
    
</section>
<!--</form>-->
</body>
<script>


document.getElementById("hanko-btn").addEventListener("click", function() {
    var hankoAreaValue = document.getElementById("hanko-area").value;
    // テキストエリアの値を直接代入する
    document.getElementById("hanko-name").innerHTML = hankoAreaValue;
    document.getElementById("hanko").style.display = "flex";
});

 function submitForm() {
        // フォームの送信を防止
        event.preventDefault();
        
        // ここで任意の処理を追加する（例えば、確認ダイアログを表示するなど）
        
        // フォームのデータを取得
        var form = document.querySelector("form");
        
        // フォームを送信
        form.submit();
        
        // フォームの送信を有効にするためにtrueを返す
        return true;
    }
</script>
</x-app-layout>