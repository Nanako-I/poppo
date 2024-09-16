<x-app-layout>

    <!--ヘッダー[START]-->
    
  <div class="flex items-center justify-center">
   <div class="flex flex-col items-center">
     <form action="{{ url('people' ) }}" method="POST" class="w-full max-w-lg">
                        @method('PATCH')
                        @csrf
                        
        <style>
        h2 {
          font-family: Arial, sans-serif; /* フォントをArialに設定 */
          font-size: 20px; /* フォントサイズを20ピクセルに設定 */
          font-weight: bold;
          text-decoration: underline;
        }
      </style>
      <div class="mx-1.5">
        <h2>{{$person->person_name}}さんのバイタル</h2>
      </div>
    </form>
   </div>
  </div>
    <!--ヘッダー[END]-->
            
        <!-- バリデーションエラーの表示に使用-->
       <!-- resources/views/components/errors.blade.php -->
       
<form action="{{ route('bloodpressures.store', $person->id) }}" method="POST">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    @csrf
 <body>                    
<div style="display: flex; flex-direction: column;">
     <style>
     body {
          font-family: 'Noto Sans JP', sans-serif; /* フォントをArialに設定 */
          background: linear-gradient(135deg, rgb(253, 219, 146,0), rgb(209, 253, 255,1));
          }
     h3 {
          font-family: Arial, sans-serif; /* フォントをArialに設定 */
          font-size: 20px; /* フォントサイズを20ピクセルに設定 */
          /*font-weight: bold;*/
          text-decoration: underline;
        }
        </style>
        
    <div class="flex flex-col items-center justify-center">
        <p class="text-gray-900 font-bold text-xl">計測時間</p>
        <input type="time" name="created_at" id="scheduled-time">
    </div>
    
    <div style="display: flex; flex-direction: column; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
         
        
        <p class="text-gray-900 font-bold text-xl">血圧（上）</p>
        <input name="max_blood" id="text-box" class="appearance-none block text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white font-bold" type="text" placeholder="" style="width: 4rem;">
        <p class="text-gray-900 font-bold text-xl">血圧（下）</p>
        <input name="min_blood" id="text-box" class="appearance-none block text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white font-bold" type="text" placeholder=""  style="width: 4rem;">
    </div>
    
      
      
  　<div style="display: flex; flex-direction: column; align-items: center;">
  　   
  　  <!--多・普通など↓-->
      　 <p class="text-gray-900 font-bold text-xl">脈拍</p>
      　  <div class="flex items-center justify-center ml-6">
          　  <input name="pulse" type="text" id="pulse" class="h-8px flex-shrink-0 break-words mx-1" style="width: 4rem;">
          　 <p class="text-gray-900 font-bold text-xl">/分</p>
        </div> 
    </div>
  　<div style="display: flex; flex-direction: column; align-items: center; my-4;">
      <p class="text-gray-900 font-bold text-xl">酸素飽和度(SpO2)</p>
            <div class="flex items-center justify-center ml-4">
                <input name="spo2" type="text" id="spo2" class="h-8px flex-shrink-0 break-words mx-1" style="width: 4rem;">
                <p class="text-gray-900 font-bold text-xl">％</p>
            </div>
    </div>
    <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
    <p class="text-gray-900 font-bold text-xl">備考</p>
    <textarea id="result-speech" name="bikou" class="w-3/4 max-w-lg" style="height: 200px;"></textarea>
    </div>
    
    <!--<div style="display: flex; align-items: center; margin-left: auto; margin-right: auto; max-width: 300px; my-2">-->
    <div style="display: flex; align-items: center; margin-left: auto; margin-right: auto; max-width: 300px;" class="my-2">
      <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
        送信
      </button>
    </div>
  </div>
</body>
</form>
</x-app-layout>