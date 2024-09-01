<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('パスワードを変更する') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('パスワードはアルファベット大文字小文字・数字を組み合わせた8文字以上にしてください。') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="current_password" :value="__('現在のパスワード')" />
            <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('新しいパスワード')" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('新しいパスワード（確認用）')" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('変更') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-xl text-green-600 dark:text-gray-400"
                >{{ __('パスワードが正常に変更されました。') }}</p>
            @endif
        </div>
    </form>
</section>
