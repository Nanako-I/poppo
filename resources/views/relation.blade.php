@vite(['resources/css/app.css', 'resources/js/app.js'])
<x-app-layout>

    <!--ヘッダー[START]-->
     <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="width: 100%;">
            {{ __('新規登録する') }}
        </h2>
    </x-slot>
    
    <form method="post" action="{{route('club.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <select name="club_id" class="block appearance-none bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" required>
                            @foreach($clubs as $club)
                                <option value="{{$club->id}}">{{$club->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="note" class="block text-gray-700 text-sm font-bold mb-2">ユーザーにとっての位置づけ</label>
                        <input class="shadow appearance-none border rounded py-2 px-3 text-gray-700" type="text" name="note" class="form-control" id="note" value="{{old('note')}}" placeholder="位置づけ">
                    </div>
 
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        送信する
                    </button>
                </form>
                
 </x-app-layout>