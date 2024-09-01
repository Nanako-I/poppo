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
                    <h2>{{$person->person_name}}さんの注入</h2>
                </div>
            </div>
        </form>
         <!-- エラーメッセージ表示 -->
            @if ($errors->any())
                <div style="color: red; font-weight: bold; font-size: 1.2em;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li style="color: red; padding-bottom: 10px;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ url('tubechange/' . $person->id . '/' . $tube->id) }}" method="POST"  enctype="multipart/form-data">

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
                                <input type="datetime-local" name="created_at" id="scheduled-time" value="{{ $tube->created_at}}">
                            </div>
                        </div>

                        <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                            <p class="text-gray-900 font-bold text-xl">備考<p>
                            <textarea id="" name="tube_bikou" class="w-full max-w-lg" style="height: 300px;">{{ $tube->tube_bikou }}</textarea>
                        </div>
                        <div style="display: flex; flex-direction: column; align-items: center; margin: 10px 0;">
                            <img alt="team" class="w-80 h-64" src="{{ asset('storage/sample/tube_photo/' . $tube->filename) }}">
                        </div>
                        <label class="block text-lg font-bold text-gray-700">他の写真を登録する</label>
                        <div style="margin-left: 10px;">
                            <input name="filename" id="filename" type="file" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm text-lg border-gray-300 rounded-md ml-20">
                        </div>
                                                                            
                        <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                              修正
                        </button>
                 </div>
            </form>
            </div>
        </div>
</x-app-layout>
