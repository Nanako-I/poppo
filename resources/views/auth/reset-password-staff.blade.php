<x-guest-layout>
    @if ($errors->any())
        <div class="alert alert-danger" style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            @if (isset($errors->get('custom_id')[0]) && $errors->get('custom_id')[0] === __('このURLは期限切れです。'))
                <x-primary-button>
                    <a href="{{ route('password.request') }}" class="btn btn-primary mt-3" style="font-size: 1.25em;">
                    {{ __('パスワード再設定メールを再送する') }}
                    </a>
                </x-primary-button>
            @endif
        </div>
    @endif
    <form method="POST" action="{{ route('password-staff.store', ['token' => $request->token]) }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->token }}">

        
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('事業所のメールアドレス')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', request('email'))" required autofocus autocomplete="username" />
        </div>
        
        <div>
            <x-input-label for="custom_id" :value="__('ID')" />
            <x-text-input id="custom_id" class="block mt-1 w-full" type="text" name="custom_id" :value="old('custom_id', $request->custom_id)" required autofocus autocomplete="username" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
