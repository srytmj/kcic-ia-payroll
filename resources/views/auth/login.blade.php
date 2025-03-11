<x-guest-layout>
    <img class="img-radius" src="{{asset('assets/images/logo_hui.png')}}" alt="User-Profile-Image" style="width: 50%; height: auto; display: block; margin: auto;">

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-red-600" />
            <input type="text" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="block mt-1 w-full border-red-600 focus:border-red-700 focus:ring-red-700" style="border-radius: 20px">
            {{-- <x-text-input id="email" class="block mt-1 w-full border-red-600 focus:border-red-700 focus:ring-red-700" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" /> --}}
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-red-600" />
            <input type="password" id="password" name="password" required autocomplete="current-password" class="block mt-1 w-full border-red-600 focus:border-red-700 focus:ring-red-700" style="border-radius: 20px">
            {{-- <x-text-input id="password" class="block mt-1 w-full border-red-600 focus:border-red-700 focus:ring-red-700"
                            type="password"
                            name="password"
                            required autocomplete="current-password" /> --}}
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-red-600 text-red-600 shadow-sm focus:ring-red-500" name="remember">
                <span class="ms-2 text-sm text-white">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="text-sm text-white hover:text-black rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" href="/register">
                &nbsp; Sign up
            </a>            

            <x-primary-button class="ms-3 bg-red-600 hover:bg-red-700 focus:ring-red-500">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
