<x-app-layout>

    <!--ヘッダー[START]-->
<body>
  <div class="flex items-center justify-center" style="padding: 20px 0;">
    <div class="flex flex-col items-center">
     <form action="{{ url('people' ) }}" method="POST" class="w-full max-w-lg">
                        @method('PATCH')
                        @csrf
    
      <style>
      body {
            font-family: 'Noto Sans JP', sans-serif; /* フォントをArialに設定 */
          background: rgb(253, 219, 146,0.2);
          }
        h2 {
          font-family: Arial, sans-serif; /* フォントをArialに設定 */
          font-size: 20px; /* フォントサイズを20ピクセルに設定 */
          font-weight: bold;
          text-decoration: underline;
        }
      </style>
        <h2>{{$person->person_name}}さんの記録</h2>
     </form>
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
    
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
     <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
     
@php
$today = now()->format('Y-m-d'); // 今日の日付を取得（例：2023-08-07）
@endphp

<table style="padding: 10px;">
  <thead>
    <tr>
      <th style="width: 180px;">体温 <i class="fa-solid fa-thermometer text-gray-500 hover:text-white" style="font-size: 1.7em; padding: 0 5px;"></i></th>
    </tr>
  </thead>
  <tbody>
    @foreach($temperatures as $temperature)
    @if(\Carbon\Carbon::parse($temperature->created_at)->format('Y-m-d') === $today)
    <tr>
      <td>{{ \Carbon\Carbon::parse($temperature->created_at)->format('H:i') }}</td>
      <td>{{ $temperature->temperature }}℃</td>
    </tr>
    @endif
    @endforeach
  </tbody>
</table>


<table>
  <thead>
    <tr>
      <!--<th>Date</th>-->
      <th style="width: 180px;">食事量<i class="fa-solid fa-bowl-rice text-gray-500 hover:text-white" style="font-size: 1.7em; padding: 0 7px; transition: transform 0.2s;"></i></th>
    </tr>
  </thead>
  <tbody>
    @foreach($foods as $food)
    @if(\Carbon\Carbon::parse($food->created_at)->format('Y-m-d') === $today)
    <tr>
      <td>{{ \Carbon\Carbon::parse($food->created_at)->format('H:i') }}</td>
      <td>主食（ごはん）は{{ $food->staple_food }}割、副食（おかず）は{{ $food->side_dish }}割でした。</td>
      
      <!--<td>薬の服用は{{ $food->medicine == 'yes' ? 'あり' : 'なし' }}。</td>-->
    </tr>
    @endif
    @endforeach
  </tbody>
</table>

<table>
  <thead>
    <tr>
      <!--<th>Date</th>-->
      <th style="width: 180px;">トイレ<i class="fa-solid fa-toilet-paper text-gray-500" style="font-size: 1.7em; padding: 0 7px;"></i></th>
    </tr>
  </thead>
  <tbody>
    @foreach($toilets as $toilet)
    @if(\Carbon\Carbon::parse($toilet->created_at)->format('Y-m-d') === $today)
    <tr>
      <td>{{ \Carbon\Carbon::parse($toilet->created_at)->format('H:i') }}</td>
      <td>尿：{{ $toilet->urine_one }}{{ $toilet->urine_two }}{{ $toilet->urine_three }}便：{{ $toilet->ben_one }}{{ $toilet->ben_two }}{{ $toilet->ben_three }}</td>
    </tr>
    @endif
    @endforeach
  </tbody>
</table>

<table>
  <thead>
    <tr>
      <!--<th>Date</th>-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
      <th style="padding-bottom: 10px;">活動の記録<i class="material-icons text-gray-500" id="face" style="font-size: 1.7em; margin-top: 10px; margin-left: 7px;">face</i></th>
    </tr>
  </thead>
  <tbody>
    @foreach($speeches as $speech)
    @if(\Carbon\Carbon::parse($speech->created_at)->format('Y-m-d') === $today)
    <tr>
      <td>{{ $speech->activity }}</td>
    </tr>
    @endif
    @endforeach
  </tbody>
</table>
</body>
{{-- 追加した Blade ディレクティブ --}}
</x-app-layout>