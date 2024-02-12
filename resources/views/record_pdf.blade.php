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
                        
    <style> body { font-family: ipaexm; } </style>
   

    <style>
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
    
    </style>
          
      
      @php
        $today = now()->format('Y-m-d'); // 今日の日付を取得（例：2023-08-07）
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
      <th colspan="3" style="width: 180px;">食事量</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      @if(isset($lastFood))
      <td style="width: 20%">{{ $lastFood->created_at->format('H:i') }}</td>
      <td style="width: 60%">食事は{{ $lastFood->staple_food }}割食べました。</td>
      <td style="width: 20%">薬の服用：{{ $lastFood->medicine == 'yes' ? 'あり' : 'なし' }}</td>
      @endif
    </tr>
  </tbody>
</table>

<table>
  <thead>
    <tr>
      <!--<th>Date</th>-->
      <th style="width: 180px;">食事　備考</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      @if(isset($lastFood))
      <td>{{ optional($lastFood)->bikou }}</td>
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
      <th style="padding-bottom: 10px;">午前の活動</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      @if(isset($lastMorningActivity))
      <td>{{ optional($lastMorningActivity)->morning_activity }}</td>
      @endif
    </tr>
  </tbody>
</table>


<table>
  <thead>
    <tr>
      <th style="padding-bottom: 10px;">午後の活動</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      @if(isset($lastAfternoonActivity))
      <td>{{ optional($lastAfternoonActivity)->afternoon_activity }}</td>
      @endif
    </tr>
  </tbody>
</table>

<!--</form>-->
</body>
</html>
{{-- 追加した Blade ディレクティブ --}}
</x-app-layout>
<!--</x-guest-layout>-->