<x-guest-layout>
    <form action="{{ route('hogoshanumber.store') }}" method="POST">
        @csrf
       @if (isset($error))
    <div style="color: red;">
        {!! $error !!}
    </div>
@endif
        <div class="flex items-center justify-center">
             <!-- ユーザー情報の隠しフィールド -->
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        </div>
         
     <!-- Name -->
        <div class="flex flex-col items-center justify-center">
        <p class="text-gray-900 font-bold text-xl">ご家族の受給者証番号</p>
        <textarea id="jukyuusha_number" name="jukyuusha_number" class="w-3/4 max-w-lg font-bold" style="height: 200px;"></textarea>
        </div>
        
        <div class="my-2" style="display: flex; justify-content: center; align-items: center; max-width: 300px;">
          <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
            送信
          </button>
        </div>
     </form>
</x-guest-layout>