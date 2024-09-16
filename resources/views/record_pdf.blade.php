<!--<x-guest-layout>-->
<x-app-layout>

    <!--ヘッダー[START]-->
<html>
  <div class="flex items-center justify-center" style="padding: 20px 0;">
    <div class="flex flex-col items-center">
     <form method="get" action="{{ route('pdf', ['people_id' => $person->id, 'selected_date' => $selectedDate]) }}">
       @csrf
        <!--<form action="{{ url('people' ) }}" method="POST" class="w-full max-w-lg">-->
                        @method('PATCH')
                        
    <style> 
    body {
      font-family: ipaexm;
      height: 100%;
      margin: 0; /* ブラウザのデフォルトマージンを除去 */
      padding: 0; /* ブラウザのデフォルトパディングを除去 */
    }
/*     x-app-layout {*/
/*  display: none;*/
/*}*/
/*@media print {*/
    /* プリント時にのみ適用されるスタイル */
    /*.no-print {*/
    /*    display: none;*/
    /*    visibility: hidden;*/
    /*}*/
/*}*/
    .centered-container {
      text-align: center; /* 水平方向の中央揃え */
      display: flex;
      flex-direction: column;
      align-items: center; /* 垂直方向の中央揃え */
      justify-content: center;
      height: 100vh; /* 画面全体の高さに対して中央に配置するため */
    }
    
    @font-face{
                font-family: ipaexm;
                font-style: normal;
                font-weight: normal;
                src: url("{{ storage_path('fonts/ipaexm.ttf')}}") format('truetype');
            }
            
            @font-face{
                font-family: ipaexm;
                font-style: bold;
                font-weight: bold;
                src: url("{{ storage_path('fonts/ipaexm.ttf')}}") format('truetype');
            }
            html,body {
                font-family: ipaexm;
            }
           
        h2 {
        font-family: ipaexm;
        font-style: normal;
        font-weight: normal;
        src: url("{{ storage_path('fonts/ipaexm.ttf')}}") format('truetype');
        
      }   
        h3 {
        font-family: ipaexm;
        font-style: normal;
        font-weight: normal;
        src: url("{{ storage_path('fonts/ipaexm.ttf')}}") format('truetype');
        
      }
      
        table {
        font-family: ipaexm;
        font-style: normal;
        font-weight: normal;
        src: url("{{ storage_path('fonts/ipaexm.ttf')}}") format('truetype');
        border-collapse: collapse; /* テーブルの罫線を結合する */
        width: 80%; /* テーブルの幅を100%に設定する */
        /*padding: 60px;*/
        margin: 0 auto;
      }
      
      th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
        
        white-space: normal; /* テキストを折り返す */
        word-wrap: break-word; /* テキストを折り返す */
        max-width: 200px; /* セル内の最大幅を設定（必要に応じて調整） */
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
            /*display: none; /* 最初は非表示にする */ 
            display: flex;
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
          /* #hanko_name {
              font-size: 24px; /* 任意の大きさに設定 
          /* } */
    </style>
    
          
      
      @php
        $today = now()->format('Y-m-d'); 
      @endphp
      
      <!--<div class="flex items-center justify-center" style="padding: 20px 0;">-->
      <!--  <div class="flex flex-col items-center">-->
      <div class="centered-container">
        <h2>{{$person->person_name}}さん</h2>
        <h3 class="text-gray-900 font-bold text-xl">{{ $selectedDate }}の記録</h3>
      </div>
      <!--  </div>-->
      <!--</div>-->
        <!--<label for="selected_date"  class="text-gray-900 font-bold text-xl">日付選択：</label>-->
        <!--  <input type="date" name="selected_date" id="selected_date" value="{{ $selectedDate }}">-->

     </form> 
    </div>
  </div>
   
  
   
    
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
     <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>

@if(isset($temperaturesOnSelectedDate))
<body>
<table style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
  <thead>
    <tr>
    <th colspan="3" style="border: 1px solid #000; text-align: left;">体温</th>
    </tr>
  </thead>
  <tbody>
  @foreach($temperaturesOnSelectedDate as $temperature)
    <tr>
      <td style="width: 20%">{{ $temperature->created_at->format('H:i') }}</td>
      <td style="width: 20%">{{ $temperature->temperature }}℃</td>
      <td style="width: 60%">{{ optional($temperature)->bikou }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endif

@if($bloodPressuresOnSelectedDate->count() > 0)
    @if($bloodPressuresOnSelectedDate->whereNotNull('max_blood')->whereNotNull('min_blood')->count() > 0)
        <table style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
            <thead>
                <tr>
                    <th colspan="2" style="width: 180px;">血圧</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bloodPressuresOnSelectedDate as $bloodpressure)
                    @if($bloodpressure->max_blood && $bloodpressure->min_blood)
                        <tr>
                            <td style="width: 20%">{{ $bloodpressure->created_at->format('H:i') }}</td>
                            <td style="width: 80%">{{ $bloodpressure->max_blood }}/{{ $bloodpressure->min_blood }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @endif

    @if($bloodPressuresOnSelectedDate->whereNotNull('pulse')->count() > 0)
        <table style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
            <thead>
                <tr>
                    <th colspan="2" style="width: 180px;">脈拍</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bloodPressuresOnSelectedDate as $bloodpressure)
                    @if($bloodpressure->pulse)
                        <tr>
                            <td style="width: 20%">{{ $bloodpressure->created_at->format('H:i') }}</td>
                            <td style="width: 80%">{{ $bloodpressure->pulse }}/分</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @endif

    @if($bloodPressuresOnSelectedDate->whereNotNull('spo2')->count() > 0)
          <table style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
            <thead>
                <tr>
                    <th colspan="2" style="width: 180px;">SpO2</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bloodPressuresOnSelectedDate as $bloodpressure)
                    @if($bloodpressure->spo2)
                        <tr>
                            <td style="width: 20%">{{ $bloodpressure->created_at->format('H:i') }}</td>
                            <td style="width: 80%">{{ $bloodpressure->spo2 }}％</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
          </table>
    @endif

    @if($bloodPressuresOnSelectedDate->whereNotNull('bikou')->count() > 0)
        <table style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
            <thead>
                <tr>
                <th colspan="2" style="width: 180px;">バイタル　備考</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bloodPressuresOnSelectedDate as $bloodpressure)
                    @if($bloodpressure->bikou)
                        <tr>
                            <td style="width: 20%">{{ $bloodpressure->created_at->format('H:i') }}</td>
                            <td style="width: 80%">{{ $bloodpressure->bikou }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @endif
@endif


@if($watersOnSelectedDate->count() > 0)
<body>
<table style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
  <thead>
    <tr>
    <th colspan="2" style="width: 180px;">水分摂取時間</th>
    </tr>
  </thead>
  <tbody>
  @foreach($watersOnSelectedDate as $water)
    <tr>
      <td style="width: 20%">{{ $water->created_at->format('H:i') }}</td>
      <td style="width: 80%">{{ $water->bikou }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endif


@if($medicinesOnSelectedDate->count() > 0)
<body>
<table style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
  <thead>
    <tr>
    <th colspan="3" style="border: 1px solid #000; text-align: left;">内服時間</th>
    </tr>
  </thead>
  <tbody>
  @foreach($medicinesOnSelectedDate as $medicine)
    <tr>
      <td style="width: 20%">{{ $medicine->created_at->format('H:i') }}</td>
      <td style="width: 80%">{{ $medicine->medicine_bikou }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endif

@if($tubesOnSelectedDate->count() > 0)
<body>
<table style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
  <thead>
    <tr>
    <th colspan="3" style="border: 1px solid #000; text-align: left;">注入時間</th>
    </tr>
  </thead>
  <tbody>
  @foreach($tubesOnSelectedDate as $tube)
    <tr>
      <td style="width: 20%">{{ $tube->created_at->format('H:i') }}</td>
      <td style="width: 80%">{{ $tube->tube_bikou }}</td>
      @if($tube->filename && $tube->path)
        <!-- <img alt="team" class="w-80 h-64" src="{{ asset('storage/sample/tube_photo/' . $tube->filename) }}"> -->
      @endif
    </tr>
  @endforeach
  </tbody>
</table>
@endif

@if($kyuuinsOnSelectedDate->count() > 0)
<body>
<table style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
  <thead>
    <tr>
    <th colspan="3" style="border: 1px solid #000; text-align: left;">吸引</th>
    </tr>
  </thead>
  <tbody>
  @foreach($kyuuinsOnSelectedDate as $kyuuin)
    <tr>
      <td style="width: 20%">{{ $kyuuin->created_at->format('H:i') }}</td>
      <td style="width: 80%">{{ $kyuuin->bikou }}</td>
      @if($kyuuin->filename && $kyuuin->path)
        <!-- <img alt="team" class="w-80 h-64" src="{{ url('storage/sample/kyuuin_photo/' . $kyuuin->filename) }}"> -->
      @endif
    </tr>
  @endforeach
  </tbody>
</table>
@endif

@if($hossasOnSelectedDate->count() > 0)
<body>
<table style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
  <thead>
    <tr>
    <th colspan="3" style="border: 1px solid #000; text-align: left;">発作が起きた時間</th>
    </tr>
  </thead>
  <tbody>
  @foreach($hossasOnSelectedDate as $hossa)
    <tr>
      <td style="width: 20%">{{ $hossa->created_at->format('H:i') }}</td>
      <td style="width: 80%">{{ $hossa->hossa_bikou }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endif

@if($foodsOnSelectedDate->count() > 0)
  @if($foodsOnSelectedDate->whereNotNull('lunch_bikou')->count() > 0)
    <table style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
      <thead>
        <tr>
          <!--<th>Date</th>-->
          <th colspan="3" style="width: 180px;">昼食</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          @foreach($foodsOnSelectedDate as $food)
            @if(is_object($food) && $food->lunch_bikou)
              <td style="width: 20%">{{ $food->created_at->format('H:i') }}</td>
              <td style="width: 80%">{{ $food->lunch_bikou }}</td>
            @endif
          @endforeach
        </tr>
      </tbody>
    </table>
  @endif
  @if($foodsOnSelectedDate->whereNotNull('oyatsu_bikou')->count() > 0)
  <table style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
    <thead>
      <tr>
        <th style="width: 180px;">おやつ</th>
      </tr>
    </thead>
    <tbody>
        <tr>
        @foreach($foodsOnSelectedDate as $food)
          @if(is_object($food) && $food->oyatsu_bikou)
            <td style="width: 20%">{{ $food->created_at->format('H:i') }}</td>
            <td style="width: 80%">{{ $food->oyatsu_bikou }}</td>
          @endif
        @endforeach
        </tr>
    </tbody> 
  </table>
  @endif
@endif

@if($toiletsOnSelectedDate->count() > 0)
  <table style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
    <thead>
      <tr>
        <th colspan="2" style="width: 180px;">トイレ</th>
      </tr>
    </thead>
    <tbody>
      @foreach($toiletsOnSelectedDate as $toilet)
        @if(is_object($toilet))
          <tr>
            <td style="width: 20%">{{ $toilet->created_at->format('H:i') }}</td>
            <td style="width: 80%">
              @if($toilet->urine_amount)
                <p>尿量：{{ $toilet->urine_amount }}</p>
              @endif
              @if($toilet->ben_amount)
                <p>便量：{{ $toilet->ben_amount }}</p>
              @endif
              @if($toilet->ben_condition)
                <p>性状：{{ $toilet->ben_condition }}</p>
              @endif
              @if($toilet->bentsuu)
                <p>便通処置：{{ $toilet->bentsuu }}</p>
              @endif
              @if($toilet->bikou)
                <p>備考：{{ optional($toilet)->bikou }}</p>
              @endif
            </td>
          </tr>
        @endif
      @endforeach
    </tbody>
  </table>
@endif


@if($lastTraining)
<table style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
  <thead>
    <tr>
      <th style="padding-bottom: 10px;">トレーニングの内容</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
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
                <p>コミュニケーション</p>
            @endif
            
            @if(!empty($exerciseData) && is_array($exerciseData) && count($exerciseData) > 0)
                <p>運動</p>
            @endif
            
            @if(!empty($reading_writingData) && is_array($reading_writingData) && count($reading_writingData) > 0)
                <p>読み書き</p>
            @endif
            
            @if(!empty($calculationData) && is_array($calculationData) && count($calculationData) > 0)
                <p>計算</p>
            @endif
            
            @if(!empty($homeworkData) && is_array($homeworkData) && count($homeworkData) > 0)
                <p>宿題</p>
            @endif
            
            @if(!empty($shoppingData) && is_array($shoppingData) && count($shoppingData) > 0)
                <p>買い物</p>
            @endif
            
            @if(!empty($training_otherData) && is_array($training_otherData) && count($training_otherData) > 0)
                <p>その他</p>
            @endif

            @if($lastTraining->training_other_sentence)
                <p>{{ optional($lastTraining)->training_other_sentence}}</p>
            @endif
      </td>
    </tr>
  </tbody>
</table>
@endif

@if($lastLifestyle)
<table style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
  <thead>
    <tr>
      <th style="padding-bottom: 10px;">生活習慣トレーニングの内容</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
          @php
              $baggageData = json_decode($lastLifestyle->baggage);
              $cleanData = json_decode($lastLifestyle->clean);
              $otherData = json_decode($lastLifestyle->other);
          @endphp
          
            @if(!empty($baggageData) && is_array($baggageData) && count($baggageData) > 0)
                <p>荷物整理</p>
            @endif
            
            @if(!empty($cleanData) && is_array($cleanData) && count($cleanData) > 0)
                <p>掃除</p>
            @endif
            
            @if(!empty($otherData) && is_array($otherData) && count($otherData) > 0)
                <p>その他</p>
            @endif

            @if($lastLifestyle->bikou)
                <p>{{ optional($lastLifestyle)->bikou}}</p>
            @endif
      </td>
     </tr>
  </tbody>
</table>
@endif

@if($lastCreative)
<table style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
  <thead>
    <tr>
      <th style="padding-bottom: 10px;">創作活動の内容</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        @php
            $craftData = json_decode($lastCreative->craft);
            $cookingData = json_decode($lastCreative->cooking);
            $otherData = json_decode($lastCreative->other);
        @endphp
        
        @if(!empty($craftData) && is_array($craftData) && count($craftData) > 0)
            <p>図画工作</p>
        @endif
        
        @if(!empty($cookingData) && is_array($cookingData) && count($cookingData) > 0)
            <p>料理</p>
        @endif
        
        @if(!empty($otherData) && is_array($otherData) && count($otherData) > 0)
            <p>その他</p>
        @endif

        @if($lastCreative->bikou)
            <p>{{ optional($lastCreative)->bikou}}</p>
        @endif
      </td>
     </tr>
  </tbody>
</table>
@endif

@if($lastActivity) 
<table style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
  <thead>
    <tr>
      <th style="padding-bottom: 10px;">個人活動の内容</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
          @php
              $kadaiData = json_decode($lastActivity->kadai);
              $restData = json_decode($lastActivity->rest);
              $self_activity_otherData = json_decode($lastActivity->self_activity_other);
          @endphp
          
          @if(!empty($kadaiData) && is_array($kadaiData) && count($kadaiData) > 0)
              <p>課題</p>
          @endif
          
          @if(!empty($restData) && is_array($restData) && count($restData) > 0)
              <p>余暇</p>
          @endif
          
          @if(!empty($self_activity_otherData) && is_array($self_activity_otherData) && count($self_activity_otherData) > 0)
              <p>その他</p>
          @endif
          @if($lastActivity->self_activity_bikou)
              <p>{{ optional($lastActivity)->self_activity_bikou}}</p>
          @endif
      </td>
     </tr>
  </tbody>
</table>
@endif

@if($lastActivity)
<table style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
  <thead>
    <tr>
      <th style="padding-bottom: 10px;">集団活動の内容</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
          @php
              $recreationData = json_decode($lastActivity->recreation);
              $region_exchangeData = json_decode($lastActivity->region_exchange);
              $group_activity_otherData = json_decode($lastActivity->group_activity_other);
          @endphp
          
          @if(!empty($recreationData) && is_array($recreationData) && count($recreationData) > 0)
              <p>レクリエーション</p>
          @endif
          
          @if(!empty($region_exchangeData) && is_array($region_exchangeData) && count($region_exchangeData) > 0)
              <p>地域交流</p>
          @endif
          
          @if(!empty($self_activity_otherData) && is_array($self_activity_otherData) && count($self_activity_otherData) > 0)
              <p>その他</p>
          @endif

          @if($lastActivity->group_activity_bikou)
              <p>{{ optional($lastActivity)->group_activity_bikou}}</p>
          @endif
      </td>
     </tr>
  </tbody>
</table>
@endif

<table style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
  <thead>
    <tr>
       <th style="width: 180px;">印鑑</th>
    </tr>
  </thead>
<tbody>
  <div class="oya-stamp-box">
      @if(isset($hankoName))
        <div class="stamp-box mt-3">
          <div id="hanko">
            <span>確認済</span>
            <hr noshade>
            <span>{{ $today }}</span>
            <hr noshade>
            <span id="hanko_name">{{ $hankoName->hanko_name }}</span>
          </div>
        </div>
      @endif
      </div>
  </tbody>
</table>
</body>

<!--</x-app-layout>-->
<!--</x-guest-layout>-->