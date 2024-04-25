<!-- resources/views/login.blade.php -->

<x-guest-layout>
@vite('resources/css/app.css')
    <x-auth-card>
        <x-slot name="logo">    
        </x-slot>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <label for="email" :value="__('Email')" />

                <input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            
            <div class="mt-4">
                <label for="password" :value="__('Password')" />

                <input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            
            <!-- <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div> -->

            <div class="flex items-center justify-end mt-4">
                <button class="ml-3">
                    {{ __('Log in') }}
                </button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
