<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="grid grid-cols-2 gap-5">

                <div>
                    <x-label for="nik" value="{{ __('NIK') }}" />
                    <x-input id="nik" pattern="[0-9]{8}" class="block mt-1 w-full" type="text" name="nik"
                        :value="old('nik')" required autofocus autocomplete="off" />
                </div>

                <div>
                    <x-label for="name" value="{{ __('Name') }}" />
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                        required autofocus autocomplete="off" />
                </div class="mt-4">

                <div class="mt-4">
                    <x-label for="tanggal_lahir" value="{{ __('Tanggal Lahir') }}" />
                    <x-input id="tanggal_lahir" class="block mt-1 w-full" type="date" name="tanggal_lahir"
                        :value="old('tanggal_lahir')" required autofocus autocomplete="off" />
                </div class="mt-4">

                <div class="mt-4">
                    <x-label for="no_hp" value="{{ __('No Hp') }}" />
                    <x-input id="no_hp" pattern="^08[0-9]{8,13}$" class="block mt-1 w-full" :value="old('no_hp')"
                        type="text" name="no_hp" required autofocus autocomplete="off" />
                </div>

                <div class="mt-4">
                    <x-label for="Golongan_darah" value="{{ __('Golongan Darah') }}" />
                    <select id="Golongan_darah" class="block mt-1 w-full" name="Golongan_darah"
                        :value="old('Golongan_darah')" required autofocus>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="AB">AB</option>
                        <option value="O">O</option>
                    </select>
                </div>

                <div class="mt-4">
                    <x-label for="jenis_kelamin" value="{{ __('Jenis Kelamin') }}" />
                    <select id="jenis_kelamin" class="block mt-1 w-full" name="jenis_kelamin"
                        :value="old('jenis_kelamin')" required autofocus>
                        <option value="L">L</option>
                        <option value="P">P</option>
                    </select>
                </div>

                <div class="mt-4">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autocomplete="off" />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="off" />
                </div>

                <div class="mt-4">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="off" />
                </div>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" href="' .
                                        route('terms.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Terms of Service') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" href="' .
                                        route('policy.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Privacy Policy') .
                                        '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
