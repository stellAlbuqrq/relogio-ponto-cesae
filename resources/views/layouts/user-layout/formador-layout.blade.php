<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <title>Layout acesso users</title>


</head>

<body>

    <link rel="preconnect" href="https://rsms.me/">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <style>
        :root {
            font-family: 'Inter', sans-serif;
        }

        @supports (font-variation-settings: normal) {
            :root {
                font-family: 'Inter var', sans-serif;
            }
        }
    </style>


    <div
        class="bg-slate-100 overflow-y-scroll w-screen h-screen antialiased text-slate-300 selection:bg-green-600 selection:text-white">
        <div class="flex flex-col relative w-screen">
            <div id="menu"
                class="bg-gray-900 min-h-screen z-10 text-slate-300 w-64 fixed left-0 h-screen overflow-y-scroll">
                <div id="logo" class="my-4 px-6">
                    <h1 class="text-lg md:text-2xl font-bold text-white">Dash<span class="text-green-500">8</span>.</h1>
                    <p class="text-slate-500 text-sm">Manage your actions and activities</p>
                </div>
                <div id="profile" class="px-6 py-10">
                    <p class="text-slate-500">Welcome back,</p>
                    <a href="#" class="inline-flex space-x-2 items-center">
                        <span>
                            <img class="rounded-full w-8 h-8"
                                src="https://images.unsplash.com/photo-1542909168-82c3e7fdca5c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=128&q=80"
                                alt="">
                        </span>
                        <span class="text-sm md:text-base font-bold">
                            {{ auth()->user()->nome }}
                        </span>
                    </a>
                </div>
                <div id="nav" class="w-full px-6">
                    <a href="{{ route('formador.pin') }}"
                        class="w-full px-2 inline-flex space-x-2 items-center border-b border-slate-700 py-3 bg-green-800 hover:bg-white/5 transition ease-linear duration-150">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                            </svg>

                        </div>
                        <div class="flex flex-col">
                            <span class="text-lg font-bold leading-5 text-white">Disparar PIN</span>
                        </div>
                    </a>
                    <a href="{{ route('formador.justificacoes') }}"
                        class="w-full px-2 inline-flex space-x-2 items-center border-b border-slate-700 py-3 hover:bg-white/5 transition ease-linear duration-150">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-lg text-slate-300 font-bold leading-5">Justificativas</span>
                            <span class="text-sm text-slate-500 hidden md:block"></span>
                        </div>
                    </a>

                    <!-- Log Out -->
                    <form method="POST" action="{{ route('logout') }}" class="w-full px-2">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center space-x-2 border-b border-slate-700 py-3 hover:bg-white/5 transition ease-linear duration-150">
                            <div>
                                <svg class="w-6 h-6 fill-white" viewBox="0 0 512 512"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-lg font-bold text-white leading-5">Logout</span>
                            </div>
                        </button>
                    </form>
                </div>

            </div>
            <div class="min-h-screen flex items-center justify-center">
                @yield('content')
            </div>


        </div>
    </div>

</body>

</html>
