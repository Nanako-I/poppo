<x-app-layout>

    <!--ヘッダー[START]-->
    
  <div class="flex items-center justify-center">
   <div class="flex flex-col items-center">
     <form action="{{ url('people' ) }}" method="POST" class="w-full max-w-lg">
                        @method('PATCH')
                        @csrf
                        
        <style>
         body {
              font-family: 'Noto Sans JP', sans-serif; /* フォントをArialに設定 */
              background: linear-gradient(135deg, rgb(253, 219, 146,0), rgb(209, 253, 255,1));
              }
            h2 {
              font-family: Arial, sans-serif; /* フォントをArialに設定 */
              font-size: 20px; /* フォントサイズを20ピクセルに設定 */
              text-decoration: underline;
            }
          </style>
          
   <div class="center-container">
       <div class="flex items-center justify-center my-2 font-bold text-2xl">                     
            <div class="mx-1.5">
                <h2>{{$person->person_name}}さんのマニュアル動画</h2>
             </div>                    
    </form>
        </div>
  
  
  <form action="{{ url('videos/'.$person->id) }}" method="POST" enctype="multipart/form-data">
    @csrf  
    
       
    </div>
   @php
    $videos = $person->videos;

    if ($videos && $videos->count() > 0) {
        $lastVideo = $videos->last();
         
    } else {
        
    }
@endphp
   <div class="mt-1">
     @if(!is_null($lastVideo))
        <video controls width="900" hight ="600" src="{{asset('storage/sample/'.$lastVideo->filename)}}" muted class="contents_width">
        </video>
    @endif
   </div>
   <div class="posts_item my-1.5 flex items-center justify-end">
        <p class="font-bold text-lg mx-1">新しいマニュアル動画に差し替える→</p>
            
         <div class="my-1.5 flex items-center">
            <label class="posts_file_input">
                <input name="filename" id="filename" type="file" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm text-lg border-gray-300 rounded-md">
            </label>
      <button type="submit" class="inline-flex items-center px-5 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
       送信
     </button>
    </div> 
    </div> 


     <!--<iframe alt="team" class="w-300 h-300 bg-gray-100 object-cover object-center flex-shrink-0 rounded-full mr-4" src="{{ asset('storage/sample/' . $person->filename) }}"></iframe>-->
     
</form>

</x-app-layout>