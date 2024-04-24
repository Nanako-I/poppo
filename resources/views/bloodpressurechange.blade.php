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
                    <h2>{{$person->person_name}}さんの内服記録</h2>
                    
                </div>
            </div>
        </form>
         
            <form action="{{ url('bloodpressurechange/' . $person->id . '/' . $bloodpressure->id) }}" method="POST">
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
                                <input type="datetime-local" name="created_at" id="scheduled-time" value="{{ $bloodpressure->created_at}}">
                            </div>
                        </div>
                        
                        <div style="display: flex; flex-direction: column; align-items: center; margin-top: 0.5rem; margin-bottom: 0.5rem;" class="my-3">
                            <p class="text-gray-900 font-bold text-xl">血圧（上）</p>
                            <input name="max_blood" id="text-box" value="{{ $bloodpressure->max_blood }}" class="appearance-none block text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white font-bold" type="text" placeholder="" style="width: 4rem;">
                            <p class="text-gray-900 font-bold text-xl">血圧（下）</p>
                            <input name="min_blood" id="text-box" value="{{ $bloodpressure->min_blood }}" class="appearance-none block text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white font-bold" type="text" placeholder=""  style="width: 4rem;">
                        </div>
                        
                          
                          
                      　<div style="display: flex; flex-direction: column; align-items: center;">
                      　   
                      　  <!--多・普通など↓-->
                          　 <p class="text-gray-900 font-bold text-xl">脈拍</p>
                          　  <div class="flex items-center justify-center ml-6">
                              　  <input name="pulse" type="text" id="pulse "value="{{ $bloodpressure->pulse }}"  class="h-8px flex-shrink-0 break-words mx-1" style="width: 4rem;">
                              　 <p class="text-gray-900 font-bold text-xl">/分</p>
                            </div> 
                        </div>
                      　<div style="display: flex; flex-direction: column; align-items: center; my-4;">
                          <p class="text-gray-900 font-bold text-xl">酸素飽和度(SpO2)</p>
                                <div class="flex items-center justify-center ml-4">
                                    <input name="spo2" type="text" id="spo2" value="{{ $bloodpressure->spo2 }}" class="h-8px flex-shrink-0 break-words mx-1" style="width: 4rem;">
                                    <p class="text-gray-900 font-bold text-xl">％</p>
                                </div>
                        </div>
                        <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                            <p class="text-gray-900 font-bold text-xl">備考<p>
                            <textarea id="" name="bikou" class="w-full max-w-lg" style="height: 300px;">{{ $bloodpressure->bikou }}</textarea>
                        </div>
                         
                        <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                              修正
                        </button>
                 </div>
            </form>
            </div>
        </div>
</x-app-layout>
