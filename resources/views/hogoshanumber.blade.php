<x-guest-layout>
    <form action="{{ route('hogoshanumber.store') }}" method="POST">
        @csrf
       @if (isset($error))
            <div style="color: red;">
                {!! $error !!}
            </div>
        @endif

        
        <div class="flex items-center justify-center">

        @if (isset($userData))
            <input type="hidden" id="name" name="name" value="{{ $userData['name'] }}">
            <input type="hidden" id="email" name="email" value="{{ $userData['email'] }}">
            <!-- パスワードは通常出力しないが、ここでは例として表示 -->
            <input type="hidden" id="password" name="password" value="{{ $userData['password'] }}">
        @endif
        </div>
         
     <!-- Name -->
        <div class="flex flex-col items-center justify-center">
            <!-- Validation Errors -->
            @if ($errors->any())
                <div style="color: red;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="flex flex-col items-center justify-center">
                <p class="text-gray-900 font-bold text-xl">ご家族の受給者証番号</p>
                <textarea id="jukyuusha_number" name="jukyuusha_number" class="w-3/4 max-w-lg font-bold text-xl" style="height: 50px;"></textarea>
            </div>
            
            <div class="flex flex-col items-center justify-center pt-2">
                <p class="text-gray-900 font-bold text-xl">ご家族の生年月日</p>
                <input name="date_of_birth" type="date" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm text-xl font-bold border-gray-300 rounded-md" placeholder="生年月日">
            </div>
            
            <div class="my-2" style="display: flex; justify-content: center; align-items: center; max-width: 300px;">
              <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                送信
              </button>
            </div>
        </div>
     </form>
</x-guest-layout>