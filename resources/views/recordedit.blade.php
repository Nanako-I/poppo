
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
        <a href="{{ route('pdf', ['people_id' => $person->id, 'selected_date' => $selectedDate]) }}">
              @csrf
          <button class="inline-flex items-center px-4 py-2 mr-5 mb-1 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
              ダウンロード
          </button>
        </a>
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

   @if ($foodsOnSelectedDate->count() > 0)
   <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
         
            <i class="fa-solid fa-bowl-rice text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
         </div>
        <div class="flex-grow p-4" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="204971" _msthidden="1" _msthash="743">食事</h2>
          
          @foreach ($foodsOnSelectedDate as $index => $food)
            <div class="flex justify-start text-left items-start">
                <p class="text-gray-900 font-bold text-xl px-3">{{ $food->lunch == 'あり' ? '昼食' : ($food->lunch != 'なし' ? $food->lunch : '') }}</p>
                <p class="text-gray-900 font-bold text-xl px-3">{{ $food->lunch_bikou }}</p>
            </div>
            
            <div class="flex justify-start text-left items-start">
                <p class="text-gray-900 font-bold text-xl px-3">{{ $food->oyatsu == 'あり' ? '間食' : ($lastFood->oyatsu != 'なし' ? $food->oyatsu : '') }}</p>
                <p class="text-gray-900 font-bold text-xl px-3">{{ $food->oyatsu_bikou }}</p>
            </div>
          @endforeach
        </div>
        <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
      </div>
    @endif

    @if($temperaturesOnSelectedDate->count() > 0)
      <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
            <i class="fa-solid fa-thermometer text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
        </div>
        <div class="flex-grow" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="232921" _msthidden="1" _msthash="740">体温</h2>
          
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
        </div>
       <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
    </div>
      @endif  

    @if ($bloodpressuresOnSelectedDate->count() > 0)
    <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
            <i class="fa-solid fa-heart-pulse text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
        </div>
        <div class="flex-grow" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="232921" _msthidden="1" _msthash="740">血圧・脈・SpO2</h2>
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
        </div>
       <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
    </div>
    @endif

    
    @if ($watersOnSelectedDate->count() > 0)
    <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
            <i class="fa-solid fa-glass-water text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
        </div>
        <div class="flex-grow" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="232921" _msthidden="1" _msthash="740">水分</h2>
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
         </div>
       <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
    </div>
  @endif  

  @if($medicinesOnSelectedDate->count() > 0)
  <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
            <i class="fa-solid fa-prescription-bottle-medical text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
        </div>
        <div class="flex-grow" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="232921" _msthidden="1" _msthash="740">内服</h2>
          
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
        </div>
       <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
      </div>
      @endif

    @if ($tubesOnSelectedDate->count() > 0)
    <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
            <i class="fa-solid fa-prescription-bottle-medical text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
        </div>
        <div class="flex-grow" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="232921" _msthidden="1" _msthash="740">注入</h2>
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
        </div>
       <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
    </div>
    @endif


    @if ($toiletsOnSelectedDate->count() > 0)
    <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
            <i class="fa-solid fa-toilet-paper text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
        </div>
        <div class="flex-grow" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="232921" _msthidden="1" _msthash="740">トイレ</h2>
          @foreach ($toiletsOnSelectedDate as $index => $toilet)
           <div class="flex items-center justify-around">
                <div class="px-2">
                    <p class="text-gray-900 font-bold text-lg">{{ $toilet->created_at->format('H:i') }}</p>
                </div>
        　　　　    <div class="px-2">
        　　　　        <p class="text-gray-900 font-bold text-base">尿:</p>
                    <p class="text-gray-900 font-bold text-2xl">{{ $toilet->urine_amount }}</p>
                </div>
                <div class="px-2">
        　　　　        <p class="text-gray-900 font-bold text-base">便:</p>
                    <p class="text-gray-900 font-bold text-2xl">{{ $toilet->ben_amount }}</p>
                </div>
                <div class="px-2">
        　　　　        <p class="text-gray-900 font-bold text-base">便状態:</p>
                    <p class="text-gray-900 font-bold text-2xl">{{ $toilet->ben_condition }}</p>
                </div>
                @if($toilet->filename && $toilet->path)
                  <img alt="team" class="w-52 h-44" src="{{ asset('storage/sample/toilet_photo/' . $toilet->filename) }}">
                @endif
            </div>
                <div class="px-2">
                    <p class="text-gray-900 font-bold text-xl">{{ $toilet->bikou }}</p>
                </div>
              <div class="pt-2">
                <!-- 最後の要素でない場合のみ <hr> を表示 -->
                @if(!$loop->last)
                  <hr style="border: 1px dashed #666; margin: 0 auto; width: 100%;">
                @endif
              </div>
          @endforeach
        </div>
       <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
    </div>
    @endif


    @if ($kyuuinsOnSelectedDate->count() > 0)
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
        </div>
       <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
    </div>
    @endif  

    @if ($hossasOnSelectedDate->count() > 0)
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
        </div>
       <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
    </div>
   @endif  

   @if ($speechesOnSelectedDate->count() > 0)
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
        </div>
       <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
    </div>
    @endif   
    
      
    @if($lastTraining)
    <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
            <i class="fa-solid fa-person-walking text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
        </div>
        <div class="flex-grow p-4" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="204971" _msthidden="1" _msthash="743">トレーニング</h2>
            <div class="flex justify-around text-left items-start">
             
              
              @php
                  $communicationData = json_decode($lastTraining->communication);
                  $exerciseData = json_decode($lastTraining->exercise);
                  $reading_writingData = json_decode($lastTraining->reading_writing);
                  $calculationData = json_decode($lastTraining->calculation);
                  $homeworkData = json_decode($lastTraining->homework);
                  $shoppingData = json_decode($lastTraining->shopping);
                  $training_otherData = json_decode($lastTraining->training_other);
              @endphp
              
                @if(!empty($communicationData) && is_array($communicationData) && count($communicationData) > 0)
                    <p class="text-gray-900 font-bold text-xl px-3">コミュニケーション</p>
                @endif
                
                @if(!empty($exerciseData) && is_array($exerciseData) && count($exerciseData) > 0)
                    <p class="text-gray-900 font-bold text-xl px-3">運動</p>
                @endif
                
                @if(!empty($reading_writingData) && is_array($reading_writingData) && count($reading_writingData) > 0)
                    <p class="text-gray-900 font-bold text-xl px-3">読み書き</p>
                @endif
                
                @if(!empty($calculationData) && is_array($calculationData) && count($calculationData) > 0)
                    <p class="text-gray-900 font-bold text-xl px-3">計算</p>
                @endif
                
                @if(!empty($homeworkData) && is_array($homeworkData) && count($homeworkData) > 0)
                    <p class="text-gray-900 font-bold text-xl px-3">宿題</p>
                @endif
                
                @if(!empty($shoppingData) && is_array($shoppingData) && count($shoppingData) > 0)
                    <p class="text-gray-900 font-bold text-xl px-3">買い物</p>
                @endif
                
                @if(!empty($training_otherData) && is_array($training_otherData) && count($training_otherData) > 0)
                    <p class="text-gray-900 font-bold text-xl px-3">その他</p>
                @endif
                <p class="text-gray-900 font-bold text-xl px-3">を行いました。</p>
            </div>
              @if($lastTraining->training_other_sentence !== null)
                <p class="text-gray-900 font-bold text-xl px-3">{{ $lastTraining->training_other_sentence }}</p>
              @endif
        </div>
        <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
        </div>
      @endif

      @if($lastLifestyle)
      <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
            <i class="fa-solid fa-broom text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
        </div>
        <div class="flex-grow p-4" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="204971" _msthidden="1" _msthash="743">生活習慣</h2>
            <div class="flex justify-around text-left items-start">
              @php
                  $baggageData = json_decode($lastLifestyle->baggage);
                  $cleanData = json_decode($lastLifestyle->clean);
                  $otherData = json_decode($lastLifestyle->other);
              @endphp
              
                @if(!empty($baggageData) && is_array($baggageData) && count($baggageData) > 0)
                    <p class="text-gray-900 font-bold text-xl px-3">荷物整理</p>
                @endif
                
                @if(!empty($cleanData) && is_array($cleanData) && count($cleanData) > 0)
                    <p class="text-gray-900 font-bold text-xl px-3">掃除</p>
                @endif
                
                @if(!empty($otherData) && is_array($otherData) && count($otherData) > 0)
                    <p class="text-gray-900 font-bold text-xl px-3">その他</p>
                @endif
                <p class="text-gray-900 font-bold text-xl px-3">を行いました。</p>
            </div>
            @if($lastLifestyle->bikou !== null)
                <p class="text-gray-900 font-bold text-xl px-3">{{ $lastLifestyle->bikou }}</p>
            @endif
        </div>
        <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
        </div>
      @endif  
                
      
      
      @if($lastCreative)
      <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
            <i class="fa-solid fa-brush text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
        </div>
        <div class="flex-grow p-4" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="204971" _msthidden="1" _msthash="743">創作活動</h2>
            <div class="flex justify-around text-left items-start">
              
                @php
                    $craftData = json_decode($lastCreative->craft);
                    $cookingData = json_decode($lastCreative->cooking);
                    $otherData = json_decode($lastCreative->other);
                @endphp
                
                @if(!empty($craftData) && is_array($craftData) && count($craftData) > 0)
                    <p class="text-gray-900 font-bold text-xl px-3">図画工作</p>
                @endif
                
                @if(!empty($cookingData) && is_array($cookingData) && count($cookingData) > 0)
                    <p class="text-gray-900 font-bold text-xl px-3">料理</p>
                @endif
                
                @if(!empty($otherData) && is_array($otherData) && count($otherData) > 0)
                    <p class="text-gray-900 font-bold text-xl px-3">その他</p>
                @endif
                <p class="text-gray-900 font-bold text-xl px-3">を行いました。</p>
            </div>
            @if($lastCreative->bikou !== null)
                <p class="text-gray-900 font-bold text-xl px-3">{{ $lastCreative->bikou }}</p>
            @endif
         </div>
        <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
      </div>
      @endif

      @if($lastActivity) 
      <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
            <i class="fa-solid fa-person text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
        </div>
        <div class="flex-grow p-4" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="204971" _msthidden="1" _msthash="743">個人活動</h2>
            <div class="flex justify-around text-left items-start">
             
              @php
                  $kadaiData = json_decode($lastActivity->kadai);
                  $restData = json_decode($lastActivity->rest);
                  $self_activity_otherData = json_decode($lastActivity->self_activity_other);
              @endphp
              
              @if(!empty($kadaiData) && is_array($kadaiData) && count($kadaiData) > 0)
                  <p class="text-gray-900 font-bold text-xl px-3">課題</p>
              @endif
              
              @if(!empty($restData) && is_array($restData) && count($restData) > 0)
                  <p class="text-gray-900 font-bold text-xl px-3">余暇</p>
              @endif
              
              @if(!empty($self_activity_otherData) && is_array($self_activity_otherData) && count($self_activity_otherData) > 0)
                  <p class="text-gray-900 font-bold text-xl px-3">その他</p>
              @endif
              <p class="text-gray-900 font-bold text-xl px-3">を行いました。</p>
          </div>
          @if($lastActivity->self_activity_bikou !== null)
            <p class="text-gray-900 font-bold text-xl px-3">{{ $lastActivity->self_activity_bikou }}</p>
          @endif
        </div>
        <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
      </div>
      @endif  
      
      @if($lastActivity)
      <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
            <i class="fa-solid fa-people-group text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
        </div>
        <div class="flex-grow p-4" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="204971" _msthidden="1" _msthash="743">集団活動</h2>
            <div class="flex justify-around text-left items-start">
              
              @php
                  $recreationData = json_decode($lastActivity->recreation);
                  $region_exchangeData = json_decode($lastActivity->region_exchange);
                  $group_activity_otherData = json_decode($lastActivity->group_activity_other);
              @endphp
              
              @if(!empty($recreationData) && is_array($recreationData) && count($recreationData) > 0)
                  <p class="text-gray-900 font-bold text-xl px-3">レクリエーション</p>
              @endif
              
              @if(!empty($region_exchangeData) && is_array($region_exchangeData) && count($region_exchangeData) > 0)
                  <p class="text-gray-900 font-bold text-xl px-3">地域交流</p>
              @endif
              
              @if(!empty($self_activity_otherData) && is_array($self_activity_otherData) && count($self_activity_otherData) > 0)
                  <p class="text-gray-900 font-bold text-xl px-3">その他</p>
              @endif
              <p class="text-gray-900 font-bold text-xl px-3">を行いました。</p>
          </div>
          @if($lastActivity->group_activity_bikou !== null)
              <p class="text-gray-900 font-bold text-xl px-3">{{ $lastActivity->group_activity_bikou }}</p>
          @endif
        </div>
        <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
      </div>
    @endif

    <form action="{{ url('record/'.$person->id.'/edit') }}" method="POST">  
      <p class="text-gray-900 font-bold text-xl px-3">確認後、お名前をご記入いただき「押印する」ボタンを押してください↓</p>
      <div style="display: flex; flex-direction: column; justify-content: flex-start; margin: 10px 0;">
        @csrf
        <input type="hidden" name="people_id" value="{{ $person->id }}"> <!-- ここで people_id を含める -->
        <input type="hidden" name="kiroku_date" value="{{ $selectedDate }}"> <!-- $selectedDate を含める -->
       <textarea id="hanko-area" name="hanko_name" type="text" class="w-full max-w-lg font-bold" style="width: 150px; height: 50px; color: black; font-size: 20px; text-align: center;" placeholder="お名前"></textarea>
        
        <button id="hanko-btn" type="submit" class="inline-flex items-center w-32 px-6 py-3 mt-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
          押印する
        </button>
    </form>
       @php        
          $hankoName = '';
      @endphp
        <div class="oya-stamp-box">
          <div class="stamp-box mt-3">
            <div id="hanko">
              <span>確認済</span>
            <hr noshade>
            <span>{{ $today }}</span>
            <hr noshade>
            <span id="hanko-name">{{ $hankoName }}</span>
          </div>
          </div>
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