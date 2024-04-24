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
         
            <form action="{{ url('medicinechange/' . $person->id . '/' . $medicine->id) }}" method="POST">
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
                        <!--<div class="flex items-center justify-center my-2">-->
                        <!--    <div class="flex items-center justify-between p-2 border-b border-gray-300">-->
                        <!--        <p class="text-gray-900 font-bold text-lg mr-1.5">記録者</p>-->
                        <!--        <select name="recorded_by" id="recorded_by" class="block w-full border-gray-300 focus:border-indigo-300">-->
                        <!--            @foreach ($users as $user)-->
                        <!--                <option value="{{ $user->id }}">{{ $user->name }}</option>-->
                        <!--            @endforeach-->
                        <!--        </select>-->
                        <!--    </div>-->
                        <!--</div>-->
                    
                        <div class="flex items-center justify-center">
                             <input type="hidden" name="people_id" value="{{ $person->id }}">
                        </div>
                        <div style="display: flex; flex-direction: column; align-items: center;">
                            <div class="flex items-center justify-center ml-4">
                                <input type="datetime-local" name="created_at" id="scheduled-time" value="{{ $medicine->created_at}}">
                            </div>
                        </div>
                        
                        <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                            <p class="text-gray-900 font-bold text-xl">備考<p>
                            <textarea id="" name="medicine_bikou" class="w-full max-w-lg" style="height: 300px;">{{ $medicine->bikou }}</textarea>
                        </div>
                         
                        <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                              修正
                        </button>
                 </div>
            </form>
            </div>
        </div>
</x-app-layout>
