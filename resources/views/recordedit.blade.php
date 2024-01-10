@vite(['resources/css/app.css', 'resources/js/app.js'])
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
          <input type="date" name="selected_date" id="selected_date">
          <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
            表示
          </button>
        
     </form> 
    </div>
  </div>
   
      
    <section class="text-gray-600 body-font mx-auto" _msthidden="10">
  <div class="container px-5 py-24 mx-auto flex flex-wrap" _msthidden="10">
    
    <div class="flex flex-col flex-wrap lg:py-6 -mb-10 lg:w-1/2 lg:pl-12 lg:text-left text-center" _msthidden="9">
      <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
            <i class="fa-solid fa-thermometer text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
         
          
        </div>
        <div class="flex-grow" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="232921" _msthidden="1" _msthash="740">体温</h2>
          @if($lastTemperature)
            <div class="flex justify-around text-left items-start">
              <p class="text-gray-900 font-bold text-xl px-3">{{ $lastTemperature->created_at->format('H:i') }}</p>
              <p class="text-gray-900 font-bold text-xl px-3">{{ $lastTemperature->temperature }}℃</p>
            </div>
          <p class="text-gray-900 font-bold text-xl p-4">{{ $lastTemperature->bikou }}</p>
         @endif
          
        </div>
       <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">

      </div>
     
      
      <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
         
            <i class="fa-solid fa-bowl-rice text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
         </div>
        <div class="flex-grow p-4" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="204971" _msthidden="1" _msthash="743">食事</h2>
          
          @if($lastFood)
            <div class="flex justify-around text-left items-start">
                <p class="text-gray-900 font-bold text-xl px-3">{{ $lastFood->lunch == 'あり' ? '昼食' : ($lastFood->lunch != 'なし' ? $lastFood->lunch : '') }}</p>
                <p class="text-gray-900 font-bold text-xl px-3">{{ $lastFood->lunch_bikou }}</p>
            </div>
            
            <div class="flex justify-around text-left items-start">
                <p class="text-gray-900 font-bold text-xl px-3">{{ $lastFood->oyatsu == 'あり' ? '間食' : ($lastFood->oyatsu != 'なし' ? $lastFood->oyatsu : '') }}</p>
                <p class="text-gray-900 font-bold text-xl px-3">{{ $lastFood->oyatsu_bikou }}</p>
            </div>
          @endif
          
        </div>
        <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
      </div>
      
      <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
            <i class="fa-solid fa-toilet-paper text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
            <circle cx="12" cy="7" r="4"></circle>
        </div>
        <div class="flex-grow p-4" _msthidden="3">
          
          @if($lastToilet)
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="96746" _msthidden="1" _msthash="746">トイレ</h2>
            <div class="flex justify-around text-left items-start">
                <p class="text-gray-900 font-bold text-xl px-3">尿</p>
                <p class="text-gray-900 font-bold text-xl px-3">{{ $lastToilet->urine }}</p>
            </div>
            
            <div class="flex justify-around text-left items-start">
                <p class="text-gray-900 font-bold text-xl px-3">便</p>
                <p class="text-gray-900 font-bold text-xl px-3">{{ $lastToilet->ben }}</p>
            </div>
            <p class="text-gray-900 font-bold text-xl p-4">{{ $lastToilet->bikou }}</p>
          @endif  
          </div>
        <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
      </div>
      
      <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
            <i class="fa-solid fa-person-walking text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
        </div>
        <div class="flex-grow p-4" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="204971" _msthidden="1" _msthash="743">トレーニング</h2>
            <div class="flex justify-around text-left items-start">
              @if($lastTraining)
              
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
                <p class="text-gray-900 font-bold text-xl px-3">{{ $lastTraining->training_other_sentence }}</p>
                
              @endif
            </div>
        </div>
        <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
        </div>
      
      <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
            <i class="fa-solid fa-broom text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
        </div>
        <div class="flex-grow p-4" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="204971" _msthidden="1" _msthash="743">生活習慣</h2>
            <div class="flex justify-around text-left items-start">
              
              @if($lastLifestyle)
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
                <p class="text-gray-900 font-bold text-xl px-3">{{ $lastLifestyle->bikou }}</p>
                
              @endif
            </div>
        </div>
        <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
        </div>
        
                
      
      
      <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
            <i class="fa-solid fa-brush text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
        </div>
        <div class="flex-grow p-4" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="204971" _msthidden="1" _msthash="743">創作活動</h2>
            <div class="flex justify-around text-left items-start">
              @if($lastCreative)
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
                <p class="text-gray-900 font-bold text-xl px-3">{{ $lastCreative->bikou }}</p>
              @endif
            </div>
         </div>
        <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
      </div>
      
      <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
            <i class="fa-solid fa-person text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
        </div>
        <div class="flex-grow p-4" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="204971" _msthidden="1" _msthash="743">個人活動</h2>
            <div class="flex justify-around text-left items-start">
            @if($lastActivity)  
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
            </div>
             <p class="text-gray-900 font-bold text-xl p-4">{{ $lastActivity->self_activity_bikou }}</p>
            @endif
        </div>
        <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
      </div>
      
      
      <div class="flex flex-col mb-10 lg:items-start items-center" _msthidden="3">
        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5">
            <i class="fa-solid fa-people-group text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
        </div>
        <div class="flex-grow p-4" _msthidden="3">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3" _msttexthash="204971" _msthidden="1" _msthash="743">集団活動</h2>
            <div class="flex justify-around text-left items-start">
              @if($lastActivity)
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
            @endif
            </div>
             <p class="text-gray-900 font-bold text-xl p-4">{{ $lastActivity->group_activity_bikou }}</p>
        </div>
        <hr style="border: 1px solid #666; margin: 0 auto; width: 100%;">
      </div>
      
    </div>
  </div>
</section>
<!--</form>-->
</body>
{{-- 追加した Blade ディレクティブ --}}
</x-app-layout>