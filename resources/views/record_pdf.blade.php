<!--<x-guest-layout>-->
<x-app-layout>

    <!--ヘッダー[START]-->
<html>
  <!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>-->
  <div class="flex items-center justify-center" style="padding: 20px 0;">
    <div class="flex flex-col items-center">
     <form method="get" action="{{ route('pdf', ['people_id' => $person->id, 'selected_date' => $selectedDate]) }}">
       @csrf
        <!--<form action="{{ url('people' ) }}" method="POST" class="w-full max-w-lg">-->
                        @method('PATCH')
                        
    <style> body { font-family: ipaexm !important; } </style>
   

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
          }
    </style>
    
          
      
      @php
        $today = now()->format('Y-m-d'); 
      @endphp
      
      <!--<div class="flex items-center justify-center" style="padding: 20px 0;">-->
      <!--  <div class="flex flex-col items-center">-->
      <div class="centered-container">
        <h2>{{ str_replace('\u{3000}', '', $person->person_name) }}さん</h2>
        <h3 class="text-gray-900 font-bold text-xl">{{ $selectedDate }}の記録</h3>
      </div>
      
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
      <th style="width: 180px;">体温：備考</th>
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
      <th colspan="2" style="width: 180px;">トイレ</th>
    </tr>
  </thead>
  <tbody>
   <tr>
      @if(isset($lastToilet))
      <td style="width: 20%">尿</td>
      <td style="width: 80%">{{ $lastToilet->urine == 'あり' ? 'あり' : 'なし' }}</td>
      @endif
    </tr>
    <tr>
      @if(isset($lastToilet))
      <td style="width: 20%">便</td>
      <td style="width: 80%">{{ $lastToilet->ben == 'あり' ? 'あり' : 'なし' }}</td>
      @endif
    </tr>
   </tbody>
</table>

<table>
  <thead>
    <tr>
      <!--<th>Date</th>-->
      <th style="width: 180px;">トイレ：備考</th>
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
      @if(isset($lastTraining) && $lastTraining->communication !== null)
        <label><input type="checkbox" checked disabled> コミュニケーション</label>
        @else
        <label><input type="checkbox" disabled> コミュニケーション</label>
        @endif

        @if(isset($lastTraining) && $lastTraining->exercise !== null)
        <label><input type="checkbox" checked disabled> 運動</label>
        @else
        <label><input type="checkbox" disabled> 運動</label>
        @endif
        
        @if(isset($lastTraining) && $lastTraining->reading_writing !== null)
        <label><input type="checkbox" checked disabled> 読み書き</label>
        @else
        <label><input type="checkbox" disabled> 読み書き</label>
        @endif
        
        @if(isset($lastTraining) && $lastTraining->calculation !== null)
        <label><input type="checkbox" checked disabled> 計算</label>
        @else
        <label><input type="checkbox" disabled> 計算</label>
        @endif
        
        @if(isset($lastTraining) && $lastTraining->homework !== null)
        <label><input type="checkbox" checked disabled> 宿題</label>
        @else
        <label><input type="checkbox" disabled> 宿題</label>
        @endif
        
        @if(isset($lastTraining) && $lastTraining->shopping !== null)
        <label><input type="checkbox" checked disabled> 買い物</label>
        @else
        <label><input type="checkbox" disabled> 買い物</label>
        @endif
        
        @if(isset($lastTraining) && $lastTraining->training_other !== null)
        <label><input type="checkbox" checked disabled> その他</label>
        @else
        <label><input type="checkbox" disabled>その他</label>
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
        @if(isset($lastLifestyle) && $lastLifestyle->baggage !== null)
        <label><input type="checkbox" checked disabled> 荷物整理</label>
        @else
        <label><input type="checkbox" disabled> 荷物整理</label>
        @endif

        @if(isset($lastLifestyle) && $lastLifestyle->clean !== null)
        <label><input type="checkbox" checked disabled> 掃除</label>
        @else
        <label><input type="checkbox" disabled> 掃除</label>
        @endif
        
        @if(isset($lastLifestyle) && $lastLifestyle->other !== null)
        <label><input type="checkbox" checked disabled>その他</label>
        @else
        <label><input type="checkbox" disabled>その他</label>
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
        @if(isset($lastCreative) && $lastCreative->craft !== null)
        <label><input type="checkbox" checked disabled> 図画工作</label>
        @else
        <label><input type="checkbox" disabled> 図画工作</label>
        @endif

        @if(isset($lastCreative) && $lastCreative->cooking !== null)
        <label><input type="checkbox" checked disabled> 料理</label>
        @else
        <label><input type="checkbox" disabled> 料理</label>
        @endif
        
        @if(isset($lastCreative) && $lastCreative->other !== null)
        <label><input type="checkbox" checked disabled>その他</label>
        @else
        <label><input type="checkbox" disabled>その他</label>
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
        @if(isset($lastActivity) && $lastActivity->kadai !== null)
        <label><input type="checkbox" checked disabled> 課題</label>
        @else
        <label><input type="checkbox" disabled> 課題</label>
        @endif

        @if(isset($lastActivity) && $lastActivity->rest !== null)
        <label><input type="checkbox" checked disabled> 余暇</label>
        @else
        <label><input type="checkbox" disabled> 余暇</label>
        @endif
        
        @if(isset($lastActivity) && $lastActivity->self_activity_other !== null)
        <label><input type="checkbox" checked disabled> その他</label>
        @else
        <label><input type="checkbox" disabled> その他</label>
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
        @if(isset($lastActivity) && $lastActivity->recreation !== null)
        <label><input type="checkbox" checked disabled> レクリエーション</label>
        @else
        <label><input type="checkbox" disabled> レクリエーション</label>
        @endif

        @if(isset($lastActivity) && $lastActivity->region_exchange !== null)
        <label><input type="checkbox" checked disabled> 地域交流</label>
        @else
        <label><input type="checkbox" disabled> 地域交流</label>
        @endif
        
        @if(isset($lastActivity) && $lastActivity->group_activity_other !== null)
        <label><input type="checkbox" checked disabled> その他</label>
        @else
        <label><input type="checkbox" disabled> その他</label>
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
<!--</form>-->
</body>
</html>
{{-- 追加した Blade ディレクティブ --}}
<!--</x-app-layout>-->
<!--</x-guest-layout>-->