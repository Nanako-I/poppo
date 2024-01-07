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
                    <h2>{{$person->person_name}}さんのトレーニング登録</h2>
                    @php
                
                     $lastTraining = $person->trainings->last();
                    @endphp
                    @if(!is_null($lastTraining))
                        （{{$lastTraining->created_at->format('n/jG：i')}}に登録した内容）
                    @endif
                </div>
            </div>
        </form>
          <form action="{{ url('trainingchange/'.$person->id) }}" method="POST">
         
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
                                @if (!is_null($lastTraining))
                                    
                            </div>
                        
                        @php
                            $communicationData = json_decode($lastTraining->communication);
                            $exerciseData = json_decode($lastTraining->exercise);
                            $reading_writingData = json_decode($lastTraining->reading_writing);
                            $calculationData = json_decode($lastTraining->calculation);
                            $homeworkData = json_decode($lastTraining->homework);
                            $shoppingData = json_decode($lastTraining->shopping);
                            $training_otherData = json_decode($lastTraining->training_other);
                        @endphp
                        <div class="items-center justify-center p-4">
                            <input type="hidden" name="people_id" value="{{ $person->id }}">
                                                            
                                                            
                                <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                    <input type="checkbox" name="communication[]" value="コミュニケーション" @if(!empty($communicationData)) checked @endif class="w-6 h-6">
                                    <p class="text-gray-900 font-bold text-xl px-1.5">コミュニケーション</p>
                                </div>
                                
                                <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                    <input type="checkbox" name="exercise[]" value="運動" @if(!empty($exerciseData)) checked @endif class="w-6 h-6">
                                    <p class="text-gray-900 font-bold text-xl px-1.5">運動</p>
                                </div>
                                
                                <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                    <input type="checkbox" name="reading_writing[]" value="読み書き" @if(!empty($reading_writingData)) checked @endif class="w-6 h-6">
                                    <p class="text-gray-900 font-bold text-xl px-1.5">読み書き</p>
                                </div>
                                
                                <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                    <input type="checkbox" name="calculation[]" value="計算" @if(!empty($calculationData)) checked @endif class="w-6 h-6">
                                    <p class="text-gray-900 font-bold text-xl px-1.5">計算</p>
                                </div>
                                
                                <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                    <input type="checkbox" name="homework[]" value="宿題" @if(!empty($homeworkData)) checked @endif class="w-6 h-6">
                                    <p class="text-gray-900 font-bold text-xl px-1.5">宿題</p>
                                </div>
                                
                                <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                    <input type="checkbox" name="shopping[]" value="買い物" @if(!empty($shoppingData)) checked @endif class="w-6 h-6">
                                    <p class="text-gray-900 font-bold text-xl px-1.5">買い物</p>
                                </div>
                                
                                <div style="display: flex; flex-direction: row; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                                    <input type="checkbox" name="training_other[]" value="その他" @if(!empty($training_otherData)) checked @endif class="w-6 h-6">
                                    <p class="text-gray-900 font-bold text-xl px-1.5">その他</p>
                                </div>
                          
                        <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                            <p class="text-gray-900 font-bold text-xl">備考<p>
                            <textarea id="result-speech" name="training_other_sentence" class="w-full max-w-lg" style="height: 300px;">{{ $lastTraining->training_other_sentence }}</textarea>
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
