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
     
<body>
<table>
  <thead>
    <tr>
      <th colspan="2" style="width: 180px;">体温</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      @if(isset($lastTemperature))
      <td style="width: 20%">{{ $lastTemperature->created_at->format('H:i') }}</td>
      <td style="width: 80%">{{ $lastTemperature->temperature }}℃</td>
      @endif
    </tr>
  </tbody>
</table>

<table>
  <thead>
    <tr>
      <th style="width: 180px;">体温　備考</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      @if(isset($lastTemperature))
      <td>{{ optional($lastTemperature)->bikou }}</td>
      @endif
    </tr>
    
  </tbody>
</table>

<table>
  <!--<thead>-->
  <!--  <tr>-->
      <!--<th>Date</th>-->
  <!--    <th style="width: 180px;">バイタル<i class="fa-solid fa-heart-pulse text-gray-500 hover:text-white" style="font-size: 1.7em; padding: 0 7px; transition: transform 0.2s;"></i></th>-->
  <!--  </tr>-->
  <!--</thead>-->
     <thead>
    <tr>
      <th colspan="2" style="width: 180px;">血圧</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      @if(isset($lastBloodPressure))
      <td style="width: 20%">{{ $lastBloodPressure->created_at->format('H:i') }}</td>
      <td style="width: 80%">{{ $lastBloodPressure->max_blood }}/{{ $lastBloodPressure->min_blood }}</td>
      @endif
    </tr>
   </tbody>
</table>

<table>
  <tbody>
    <thead>
      <tr>
        <th colspan="2" style="width: 180px;">脈拍</th>
      </tr>
    </thead>
    <tr>
      @if(isset($lastBloodPressure))
      <td style="width: 20%">{{ $lastBloodPressure->created_at->format('H:i') }}</td>
      <td style="width: 80%">{{ $lastBloodPressure->pulse }}/分</td>
      @endif
    </tr>
  </tbody>
</table>

<table>
  <tbody>
    <thead>
      <tr>
        <th colspan="2" style="width: 180px;">SpO2</th>
      </tr>
    </thead>
    <tr>
      @if(isset($lastBloodPressure))
      <td style="width: 20%">{{ $lastBloodPressure->created_at->format('H:i') }}</td>
      <td style="width: 80%">{{ $lastBloodPressure->spo2 }}％</td>
      @endif
    </tr>
  </tbody>
</table>

<table>
  <tbody>
    <thead>
      <tr>
        <th style="width: 180px;">バイタル　備考</th>
      </tr>
    </thead>
    <tr>
      @if(isset($lastBloodPressure))
      <td>{{ optional($lastBloodPressure)->bikou }}</td>
      @endif
    </tr>
  </tbody>
</table>


<table>
  <thead>
    <tr>
      <!--<th>Date</th>-->
      <th colspan="3" style="width: 180px;">昼食</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      @if(isset($lastFood))
      <td style="width: 20%">{{ $lastFood->created_at->format('H:i') }}</td>
      <td style="width: 60%">{{ $lastFood->lunch_bikou }}</td>
      @endif
    </tr>
  </tbody>
</table>

<table>
  <thead>
    <tr>
      <!--<th>Date</th>-->
      <th style="width: 180px;">おやつ</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      @if(isset($lastFood))
      <td>{{ optional($lastFood)->oyatsu_bikou }}</td>
      @endif
    </tr>
  </tbody>
</table>


<table>
  <thead>
    <tr>
      <!--<th>Date</th>-->
      <th colspan="2" style="width: 180px;">尿</th>
    </tr>
  </thead>
  <tbody>
   <tr>
      @if(isset($lastToilet))
      <td style="width: 20%">{{ $lastToilet->created_at->format('H:i') }}</td>
      <td style="width: 80%">{{ $lastToilet->urine_amount }}</td>
      @endif
    </tr>
   </tbody>
</table>

<table>
  <thead>
    <tr>
      <!--<th>Date</th>-->
      <th colspan="2" style="width: 180px;">便</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      @if(isset($lastToilet))
      <td style="width: 20%">{{ $lastToilet->created_at->format('H:i') }}</td>
      <td style="width: 80%">便量：{{ $lastToilet->ben_amount }}性状：{{ $lastToilet->ben_condition }}</td>
      @endif
    </tr>
  </tbody>
</table>

<table>
  <thead>
    <tr>
      <!--<th>Date</th>-->
      <th style="width: 180px;">トイレ　備考</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      @if(isset($lastToilet))
      <td>{{ optional($lastToilet)->bikou }}</td>
      @endif
    </tr>
  </tbody>
</table>


<table>
  <thead>
    <tr>
      <th style="padding-bottom: 10px;">トレーニングの内容</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
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
            @endif
      </td>
    </tr>
  </tbody>
</table>

<table>
  <thead>
    <tr>
      <!--<th>Date</th>-->
      <th style="width: 180px;">トレーニング：備考</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      @if(isset($lastTraining))
      <td>{{ optional($lastTraining)->training_other_sentence}}</td>
      @endif
    
    </tr>
  </tbody>
</table>

<table>
  <thead>
    <tr>
      <th style="padding-bottom: 10px;">生活習慣トレーニングの内容</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        @if($lastLifestyle)
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
        @endif
      </td>
     </tr>
  </tbody>
</table>

<table>
  <thead>
    <tr>
      <!--<th>Date</th>-->
      <th style="width: 180px;">生活習慣トレーニング：備考</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      @if(isset($lastLifestyle))
      <td>{{ optional($lastLifestyle)->bikou}}</td>
      @endif
    </tr>
  </tbody>
</table>

<table>
  <thead>
    <tr>
      <th style="padding-bottom: 10px;">創作活動の内容</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
       @if($lastCreative)
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
      @endif
      </td>
     </tr>
  </tbody>
</table>

<table>
  <thead>
    <tr>
      <!--<th>Date</th>-->
      <th style="width: 180px;">創作活動の備考</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      @if(isset($lastCreative))
      <td>{{ optional($lastCreative)->bikou}}</td>
      @endif
    </tr>
  </tbody>
</table>

<table>
  <thead>
    <tr>
      <th style="padding-bottom: 10px;">個人活動の内容</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        @if($lastActivity)  
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
        @endif
      </td>
     </tr>
  </tbody>
</table>

<table>
  <thead>
    <tr>
      <!--<th>Date</th>-->
      <th style="width: 180px;">個人活動の備考</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      @if(isset($lastActivity))
      <td>{{ optional($lastActivity)->self_activity_bikou}}</td>
      @endif
    </tr>
  </tbody>
</table>

<table>
  <thead>
    <tr>
      <th style="padding-bottom: 10px;">集団活動の内容</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        @if($lastActivity)
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
        @endif
      </td>
     </tr>
  </tbody>
</table>

<table>
  <thead>
    <tr>
      <!--<th>Date</th>-->
      <th style="width: 180px;">集団活動の備考</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      @if(isset($lastActivity))
      <td>{{ optional($lastActivity)->group_activity_bikou}}</td>
      @endif
    </tr>
  </tbody>
</table>

<table style="height: 100%;">
  <thead>
    <tr>
       <th style="width: 180px;">印鑑</th>
    </tr>
  </thead>
<tbody>
  <tr>
    <td>
    <div class="oya-stamp-box">
    <!--<div class="oya-stamp-box" style="display: flex; justify-content: flex-end;">-->
      <div class="stamp-box mt-3">
        <div id="hanko">
          <span>確認済</span>
          <hr noshade>
          <span>{{ $today }}</span>
          <hr noshade>
          <span id="hanko_name">{{ $hankoName->hanko_name }}</span>
        </div>
      </div>
    </div>
    </td>
  </tr>
  </tbody>
</table>
</body>

<!--</x-app-layout>-->
<!--</x-guest-layout>-->