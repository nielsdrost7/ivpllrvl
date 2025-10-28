<!doctype html>
<html lang="en">
<head>
    <title>{{ config('app.name', 'InvoicePlane') }} - @lang('core::messages.login')</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="NOINDEX,NOFOLLOW">

    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">

    @filamentStyles
    @vite(['resources/assets/sass/app.scss', 'resources/assets/js/app.js'])
</head>

<body class="antialiased bg-gray-50 dark:bg-gray-900">

<noscript>
    <div class="p-4 mb-4 text-red-700 dark:text-red-200 bg-red-100 dark:bg-red-900/50 border border-red-200 dark:border-red-800 rounded-lg">
        @lang('core::messages.please_enable_js')
    </div>
</noscript>

<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        
        @if($login_logo)
            <div class="flex justify-center">
                <img src="{{ asset('uploads/' . $login_logo) }}" class="h-16 w-auto" alt="{{ config('app.name') }}">
            </div>
        @else
            <div>
                <h2 class="text-center text-3xl font-bold tracking-tight text-gray-900 dark:text-gray-100">
                    @lang('core::messages.login')
                </h2>
            </div>
        @endif

        <x-filament::section class="bg-white dark:bg-gray-800 shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10">
            <div class="space-y-4">
                @if(session('alert_error'))
                    <div class="rounded-lg bg-danger-50 dark:bg-danger-900/20 p-4">
                        <p class="text-sm text-danger-700 dark:text-danger-400">
                            {{ session('alert_error') }}
                        </p>
                    </div>
                @endif

                @if(session('alert_success'))
                    <div class="rounded-lg bg-success-50 dark:bg-success-900/20 p-4">
                        <p class="text-sm text-success-700 dark:text-success-400">
                            {{ session('alert_success') }}
                        </p>
                    </div>
                @endif

                <form method="post" action="{{ route('sessions.login.post') }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="btn_login" value="true">

                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">
                            @lang('core::messages.email')
                        </label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            required 
                            autofocus
                            placeholder="@lang('core::messages.email')"
                            class="block w-full rounded-lg border-0 py-2 px-3 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-white/10 placeholder:text-gray-400 dark:placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-primary-600 dark:focus:ring-primary-500 bg-white dark:bg-white/5 sm:text-sm sm:leading-6 transition"
                        >
                    </div>

                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">
                            @lang('core::messages.password')
                        </label>
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            required
                            placeholder="@lang('core::messages.password')"
                            class="block w-full rounded-lg border-0 py-2 px-3 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-white/10 placeholder:text-gray-400 dark:placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-primary-600 dark:focus:ring-primary-500 bg-white dark:bg-white/5 sm:text-sm sm:leading-6 transition"
                        >
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                        <button 
                            type="submit" 
                            class="flex-1 inline-flex justify-center items-center gap-2 rounded-lg bg-primary-600 dark:bg-primary-500 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-primary-500 dark:hover:bg-primary-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600 dark:focus-visible:outline-primary-500 transition"
                        >
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            @lang('core::messages.login')
                        </button>
                        <a 
                            href="{{ route('sessions.passwordreset') }}" 
                            class="flex-1 inline-flex justify-center items-center gap-2 rounded-lg bg-white dark:bg-white/5 px-4 py-2.5 text-sm font-semibold text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-white/10 hover:bg-gray-50 dark:hover:bg-white/10 transition"
                        >
                            @lang('core::messages.forgot_your_password')
                        </a>
                    </div>
                </form>
            </div>
        </x-filament::section>

    </div>
</div>

@filamentScripts

</body>
</html>
