<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>
            @if(count($users) == 0)
            <!-- Post nom -->
            <div>
                <x-label for="name" :value="__('Post nom')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="postnom" :value="old('name')" required autofocus />
            </div>
            @endif

            <!-- Prénom -->
            <div>
                <x-label for="name" :value="__('Prénom')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="prenom" :value="old('name')" required autofocus />
            </div>

            <!-- Sexe -->
            <div>
                <x-label for="name" :value="__('Sexe')" />

                <select id="name" class="block mt-1 w-full" type="text" name="sexe" :value="old('name')" required autofocus />
                    <option value="homme">Homme</option>
                    <option value="femme">Femme</option>
                <select>
            </div>
            @if(count($users) == 0)
            <!-- Etat civil -->
            <div>
                <x-label for="name" :value="__('Etat civil')" />

                <select id="name" class="block mt-1 w-full" type="text" name="etat_civil" :value="old('name')" required autofocus />
                    <option value="célibataire">Célibataire</option>
                    <option value="marié(e)">Marié(e)</option>
                    <option value="divorcé(e)">Divorcé(e)</option>
                    <option value="veuf(ve)">Veuf(ve)</option>
                <select>
            </div>
            @endif

            <!-- Contact 1 -->
            <div>
                <x-label for="name" :value="__('Contact')" />

                <x-input id="name" class="block mt-1 w-full" type="number" name="contact_whatsapp" :value="old('contact')" required autofocus />
            </div>

            @if(count($users) == 0)
            <!-- Contact 2 -->
            <div>
                <x-label for="name" :value="__('Contact 2')" />

                <x-input id="name" class="block mt-1 w-full" type="number" name="contact" :value="old('contact 2')" required autofocus />
            </div>
            @endif
            @if(count($users) == 0)
            <!-- Numéro -->
            <div>
                <x-label for="name" :value="__('Numéro Résidence')" />

                <x-input id="name" class="block mt-1 w-full" type="number" name="numero" :value="old('Numero')" required autofocus />
            </div>

            <!-- Avenue -->
            <div>
                <x-label for="name" :value="__('Avenue')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="avenue" :value="old('avenue')" required autofocus />
            </div>

            <!-- Quartier -->
            <div>
                <x-label for="name" :value="__('Quartier')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="quartier" :value="old('contact 2')" required autofocus />
            </div>

            <!-- Commune -->
            <div>
                <x-label for="name" :value="__('Etat civil')" />

                <select id="name" class="block mt-1 w-full" type="text" name="commune" :value="old('name')" required autofocus />
                    <option desable>Commune</option>
                    @foreach($communes as $commune)
                    <option value="{{ $commune }}">{{ $commune }}</option>
                    @endforeach
                <select>
            </div>
            @endif
            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
