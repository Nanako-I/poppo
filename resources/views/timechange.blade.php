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
            }
        </style>
        <div class ="flex items-center justify-center"  style="padding: 20px 0;">
            <div class="flex flex-col items-center">
                <h2>{{$person->person_name}}さんの利用時間</h2>
                @php
            
                 $lastTime = $person->times->last();
                @endphp
                @if(!is_null($lastTime))
                    （{{$lastTime->created_at->format('n/jG：i')}}に登録した内容）
                @endif
            </div>
        </div>
    </form>
      <form action="{{ url('timechange/'.$person->id. '/'.$lastTime->id) }}" method="POST">
        @csrf
         
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <script src="https://kit.fontawesome.com/de653d534a.js" crossorigin="anonymous"></script>
            <div class="flex flex-col items-center">
                <style>
                  p {
                    font-family: Arial, sans-serif; /* フォントをArialに設定 */
                    font-size: 25px; /* フォントサイズを20ピクセルに設定 */
                    font-weight: bold;
                  }
                </style>
                
                    <div class="flex items-center justify-center">
                         <input type="hidden" name="people_id" value="{{ $person->id }}">
                    </div>
                    <div style="display: flex; flex-direction: column; align-items: center;">
                        <div class="flex items-center justify-center ml-4">
                            @if (!is_null($lastTime))
                                
                        </div>
                    
                    @php
                        $pick_upData = json_decode($lastTime->pick_up);
                        $sendData = json_decode($lastTime->send);
                        
                    @endphp
                    <div class="items-center justify-center p-4">
                        <input type="hidden" name="people_id" value="{{ $person->id }}">
                        
                        <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                            <p class="text-gray-900 font-bold text-xl px-1.5">利用時間　合計時間({{ $totalUsageTime }})</p>
                        </div>
                        
                         <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                            <!--<label for="usage_date" class="text-gray-900 font-bold text-xl px-1.5">利用日:</label>-->
                            
                           <input type="date" name="date" id="usage_date" value="{{ \Carbon\Carbon::parse($lastTime->date)->format('Y-m-d') }}" required>
                        </div>

                        <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                            <input type="time" name="start_time" id="scheduled-time" value="{{ $lastTime->start_time->format('H:i') }}">
                            <p class="text-gray-900 font-bold text-xl px-1.5">～</p>
                        </div>
                        
                        <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                            <input type="time" name="end_time" id="scheduled-time" value="{{ $lastTime->end_time->format('H:i') }}">
                        </div>
                        
                        <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                            <i class="fa-solid fa-school text-gray-700" style="font-size: 1.5em; transition: transform 0.2s;"></i>
                            <p class="text-gray-900 font-bold text-xl px-1.5">学校</p>
                        </div>
                        
                            <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                <select name="school" class="mx-1 my-1.5" style="width: 6rem;">
                                    
                                    <option value="selected"{{ $lastTime->school === '登録なし' ? ' selected' : '' }}>登録なし</option>
                                    <option value="授業終了後"{{ $lastTime->school === '授業終了後' ? ' selected' : '' }}>授業終了後</option>
                                    <option value="休校"{{ $lastTime->school === '休校' ? ' selected' : '' }}>休校</option>
                                    <option value="欠席"{{ $lastTime->school === '欠席' ? ' selected' : '' }}>欠席</option>
                                </select>
                            </div>
                            
      
                            <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                <input type="checkbox" name="pick_up[]" value="迎え" @if(!empty($pick_upData)) checked @endif class="w-6 h-6">
                                <p class="text-gray-900 font-bold text-xl px-1.5">迎え</p>
                            </div>
                            
                            <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                <input type="checkbox" name="send[]" value="送り" @if(!empty($sendData)) checked @endif class="w-6 h-6">
                                <p class="text-gray-900 font-bold text-xl px-1.5">送り</p>
                            </div>
                            
                            
                      
                
                     @endif
                    <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                          修正
                    </button>
                    </div>
                </div>
                </div>
             </div>
        </div>
    </div>
</form>

</x-app-layout>
