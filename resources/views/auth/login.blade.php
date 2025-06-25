<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faça o seu Log-in</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('imagens/cesae-digital-icone.png') }}" type="image/png">

    {{-- Tipografia --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
        rel="stylesheet">


</head>

<x-guest-layout>

        <section class="min-h-screen bg-[#4b3070] dark:bg-neutral-800">
            <div class="flex h-full items-center justify-center text-neutral-800 dark:text-neutral-200">
                <div class="w-full max-w-6xl flex rounded-lg shadow-lg overflow-hidden bg-white dark:bg-neutral-900">
                    <!-- Left Side: Form -->
                    <div class="w-full lg:w-6/12 p-12">
                        <!-- Logo -->
                        <div class="text-center mb-6">
                            <img class="mx-auto w-60" src="{{ asset('imagens/cesae-digital-logo.svg') }}"
                                alt="Logo" />
                            <h4 class="mt-4 text-xl font-semibold">Bem-vindo(a) ao Cesae Digital</h4>
                        </div>

                        <!-- Formulário -->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <p class="mb-6 text-md font-medium">Por favor, faça login com seus dados:</p>

                            <!-- Email -->
                            <div class="mb-4 font-bold">
                                <label for="email" class="block mb-2">Email</label>
                                <input type="email" id="email" name="email"
                                    class="w-full rounded-md p-3 bg-gray-100 dark:bg-neutral-800 border border-gray-300 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-600"
                                    required />
                            </div>

                            <!-- Password -->
                            <div class="mb-4 font-bold">
                                <label for="password" class="block mb-2">Senha</label>
                                <input type="password" id="password" name="password"
                                    class="w-full rounded-md p-3 bg-gray-100 dark:bg-neutral-800 border border-gray-300 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-600"
                                    required />
                            </div>

                            <!-- Botão -->
                            <div class="mt-6">
                                <button type="submit"
                                    class="w-full bg-purple-700 hover:bg-purple-800 text-white py-3 rounded-md transition duration-200">
                                    Entrar
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Right Side: Imagem -->
                    <div class="hidden lg:block bg-cover bg-center lg:w-9/12"
                        style="background-image: url('{{ asset('imagens/imagem-de-login.jpg') }}')">
                    </div>
                </div>
            </div>
        </section>





        {{-- <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="ms-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div> --}}
        {{-- </form> --}}



        <script type="text/javascript" src="../node_modules/tw-elements/dist/js/tw-elements.umd.min.js"></script>

</x-guest-layout>
