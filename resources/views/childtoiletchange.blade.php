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
        p {
            font-family: Arial, sans-serif; /* フォントをArialに設定 */
            font-size: 25px; /* フォントサイズを20ピクセルに設定 */
            font-weight: bold;
          }
      </style>
      <div class="mx-1.5">
        <h2>{{$person->person_name}}さんの最終時間</h2>
        @php
           $lastFood = $person->child_foods->last();
        @endphp
        
      </div>
    </form>
   </div>
  </div>
    <!--ヘッダー[END]-->
            
        <!-- バリデーションエラーの表示に使用-->
       <!-- resources/views/components/errors.blade.php -->
       
<form action="{{ url('childfoodchange/'.$person->id) }}" method="POST">
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
        
        
        <div style="display: flex; flex-direction: column; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
            <input type="datetime-local" name="food_created_at" id="scheduled-time" value="{{ $lastFood->food_created_at}}">
        </div>
        
        <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
        <h3>おやつの有無</h3>
          <select name="oyatsu" class="mx-1 my-1.5" style="width: 6rem;">
             <option value="{{ $lastFood->oyatsu }}">{{ $lastFood->oyatsu }}</option>
            <option value="あり">あり</option>
            <option value="なし">なし</option>
          </select>
      </div>
      
    
    
    <div style="display: flex; align-items: center; margin-left: auto; margin-right: auto; max-width: 300px;" class="my-2">
      <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
        修正
      </button>
    </div>
  </div>
</body>
</form>
</x-app-layout>