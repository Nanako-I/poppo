@vite(['resources/css/app.css', 'resources/js/app.js'])
<x-app-layout>

    <!--ヘッダー[START]-->
<body>
  <!--<div class="flex items-center justify-center" style="padding: 20px 0;">-->
　 <!--<div class="flex flex-direction: row; flex-wrap: wrap; justify-center max-w-screen-xl mx-auto" style="padding: 20px 0;">-->
　 <div class="flex flex-direction: row; flex-wrap: wrap; max-w-screen-xl mx-auto" style="padding: 20px 0;">
　　<div class="flex flex-col items-center">
     　 <form action="{{ url('people' ) }}" method="POST" class="w-full max-w-lg">
                        @method('PATCH')
                        @csrf
            <style>
              body {
                    font-family: 'Noto Sans JP', sans-serif; /* フォントをArialに設定 */
                  background: rgb(255, 255, 255);
                  }
                h2 {
                  font-family: Arial, sans-serif; /* フォントをArialに設定 */
                  font-size: 20px; /* フォントサイズを20ピクセルに設定 */
                  font-weight: bold;
                  text-decoration: underline;
                }
          　</style>
            <h2 class="text-center">{{$person->person_name}}さんの記録</h2>
        </form>
     　 <div class="flex flex-wrap">
            <!--<div>-->
            <!--    <canvas id="myChart"></canvas>-->
            <!--</div>-->
            <!--<div>-->
            <!--    <canvas id="sampleChart"></canvas>-->
            <!--</div>-->
            <div class="w-1/2 p-4 flex items-center justify-center">
                <!--json_encode 関数を使用-->
                <!--PHPの変数 $labels と $data がJSON形式でJavaScriptに渡される↓-->
                <canvas id="temperatureChart" data-labels="{{ json_encode($labels) }}" data-data="{{ json_encode($data) }}" class="w-96 h-72"></canvas>
            </div>
             <div class="w-1/2 p-4 flex items-center justify-center">
                <!--json_encode 関数を使用-->
                <!--PHPの変数 $labels と $data がJSON形式でJavaScriptに渡される↓-->
                <canvas id="temperatureChart" data-labels="{{ json_encode($labels) }}" data-data="{{ json_encode($data) }}" class="w-96 h-72"></canvas>
            </div>
        　　<div class="w-1/2 p-4 flex items-center justify-center">
                <!--json_encode 関数を使用-->
                <!--PHPの変数 $labels と $data がJSON形式でJavaScriptに渡される↓-->
               <canvas id="benChart" data-ben-labels="{{ json_encode($toilet_labels) }}" data-ben-data="{{ json_encode($ben_data) }}" data-ben-bentsuu="{{ json_encode($bentsuu) }}" class="w-96 h-72"></canvas>
            </div>
            <div class="w-1/4 p-4">
                <!--json_encode 関数を使用-->
                <!--PHPの変数 $labels と $data がJSON形式でJavaScriptに渡される↓-->
               <canvas id="benConditionChart"  data-ben-labels="{{ json_encode($toilet_labels) }}" data-ben-condition="{{ json_encode($ben_condition) }}"></canvas>
            </div>
            <div class="w-1/2 p-4">
                <!--json_encode 関数を使用-->
                <!--PHPの変数 $labels と $data がJSON形式でJavaScriptに渡される↓-->
               <canvas id="foodChart" data-food-labels="{{ json_encode($food_labels) }}" data-staple_food="{{ json_encode($staple_food) }}" data-side_dish="{{ json_encode($side_dish) }}" class="w-96 h-72"></canvas>
            </div>
        </div>
    </div>
  </div>
  <!--</div>-->
 </body>
  
<script>
    
 </script>
    
 </x-app-layout>
  
{{-- 追加した Blade ディレクティブ --}}