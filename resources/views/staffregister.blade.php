<x-guest-layout>
    
    @if (isset($error))
        <div style="color: red; font-size: 2em;">
            {!! $error !!}
        </div>
    @endif

    <form action="{{ url('/staffregister') }}" method="post">
        @csrf

        
        
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-lg" />
        </div>
        
        <div>
            <x-input-label for="custom_id" :value="__('ID')" />
            <x-text-input id="custom_id" class="block mt-1 w-full" type="text" name="custom_id" :value="old('custom_id')" required autofocus autocomplete="custom_id" />
            <x-input-error :messages="$errors->get('custom_id')" class="mt-2 text-lg" />
        </div>

         <!--Email Address -->
        <!--<div class="mt-4">-->
        <!--    <x-input-label for="email" :value="__('Email')" />-->
        <!--    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />-->
        <!--    <x-input-error :messages="$errors->get('email')" class="mt-2" />-->
        <!--</div>-->

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('パスワード（英語大文字小文字・数字を含む8文字以上）')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-lg" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-lg" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
@if (Route::has('login'))
    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
        @auth
            <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
            @endif
        @endauth
    </div>
@endif
