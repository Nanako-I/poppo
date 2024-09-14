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
                    <h2>{{$person->person_name}}さんの個人・集団活動</h2>
                    @php
                    $lastActivity= $person->activities->last();
                    @endphp
                    @if(!is_null($lastActivity))
                        （{{$lastActivity->created_at->format('n/jG：i')}}に登録した内容）
                    @endif
                </div>
            </div>
        </form>
          <form action="{{ url('activitychange/'.$person->id) }}" method="POST">
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
                                @if (!is_null($lastActivity))
                                    
                            </div>
                        
                        @php
                            $kadaiData = json_decode($lastActivity->kadai);
                            $restData = json_decode($lastActivity->rest);
                            $self_activity_otherData = json_decode($lastActivity->self_activity_other);
                            $recreationData = json_decode($lastActivity->recreation);
                            $region_exchangeData = json_decode($lastActivity->region_exchange);
                            $group_activity_otherData = json_decode($lastActivity->group_activity_other);
                            
                        @endphp
                        <div class="items-center justify-center p-4">
                            <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                            
                                                            
                                <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                    <input type="checkbox" name="kadai[]" value="課題" @if(!empty($kadaiData)) checked @endif class="w-6 h-6">
                                    <p class="text-gray-900 font-bold text-xl px-1.5">課題</p>
                                </div>
                                
                                <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                    <input type="checkbox" name="rest[]" value="余暇" @if(!empty($restData)) checked @endif class="w-6 h-6">
                                    <p class="text-gray-900 font-bold text-xl px-1.5">余暇</p>
                                </div>
                                
                                <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                    <input type="checkbox" name="self_activity_other[]" value="その他" @if(!empty($self_activity_otherData)) checked @endif class="w-6 h-6">
                                    <p class="text-gray-900 font-bold text-xl px-1.5">その他</p>
                                </div>
                          
                                <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                    <p class="text-gray-900 font-bold text-xl">個人活動の内容など<p>
                                    <textarea id="result-speech" name="self_activity_bikou" class="w-full max-w-lg" style="height: 300px;">{{ $lastActivity->self_activity_bikou }}</textarea>
                                </div>
                                
                                <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                    <input type="checkbox" name="recreation[]" value="レクリエーション" @if(!empty($recreationData)) checked @endif class="w-6 h-6">
                                    <p class="text-gray-900 font-bold text-xl px-1.5">レクリエーション</p>
                                </div>
                                
                                <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                    <input type="checkbox" name="region_exchange[]" value="地域交流" @if(!empty($region_exchangeData)) checked @endif class="w-6 h-6">
                                    <p class="text-gray-900 font-bold text-xl px-1.5">地域交流</p>
                                </div>
                                
                                <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                    <input type="checkbox" name="group_activity_other[]" value="その他" @if(!empty($group_activity_otherData)) checked @endif class="w-6 h-6">
                                    <p class="text-gray-900 font-bold text-xl px-1.5">その他</p>
                                </div>
                          
                                <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                                    <p class="text-gray-900 font-bold text-xl">集団活動の内容など<p>
                                    <textarea id="result-speech" name="bikou" class="w-full max-w-lg" style="height: 300px;">{{ $lastActivity->group_activity_bikou }}</textarea>
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
