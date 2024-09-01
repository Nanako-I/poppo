<x-guest-layout>
    <form action="{{ route('facilityregister.store') }}" method="POST">
        @csrf
        
        <div class="flex items-center justify-center">
             <!-- ユーザー情報の隠しフィールド -->
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        </div>
         
     <!-- Name -->
     <div class="flex flex-col items-center justify-center">
        <div class="flex flex-col items-center justify-center">
        <p class="text-gray-900 font-bold text-xl">事業所名</p>
        <!--事業所名を登録↓-->
        <textarea id="facility_name" name="facility_name" class="w-full max-w-lg font-bold text-xl" style="height: 100px;"></textarea>
        </div>
        
        <div class="my-2" style="display: flex; justify-content: center; align-items: center; max-width: 300px;">
          <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
            送信
          </button>
        </div>
    </div>
     </form>
</x-guest-layout>