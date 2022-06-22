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

            <div class="flex">
                <div style="margin: 0em 1em">
                    <!-- Nom -->
                    <div>
                        <x-label for="nom" :value="__('Nom')" />

                        <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" required
                            autofocus />
                    </div>

                    <!-- Prénom -->
                    <div class="mt-4">
                        <x-label for="prenom" :value="__('Prénoms')" />

                        <x-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" :value="old('prenom')"
                            required autofocus />
                    </div>

                    <!-- Matricule -->
                    <div class="mt-4">
                        <x-label for="matricule" :value="__('Matricule')" />

                        <x-input id="matricule" class="block mt-1 w-full" type="text" name="matricule" :value="old('matricule')"
                            required autofocus />
                    </div>

                    <!-- Numéro de téléphone -->
                    <div class="mt-4">
                        <x-label for="tel" :value="__('Téléphone')" />

                        <x-input id="tel" class="block mt-1 w-full" type="text" name="tel" :value="old('tel')" required
                            autofocus />
                    </div>
                </div>

                <div style="margin: 0em 1em">
                    <!-- Email Address -->
                    <div>
                        <x-label for="email" :value="__('Email')" />

                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                            required />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-label for="password" :value="__('Mot de passe')" />

                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="new-password" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-label for="password_confirmation" :value="__('Confirmer votre mot de passe')" />

                        <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                            name="password_confirmation" required />
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Déjà enregistré ?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('S\'enregistrer') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
