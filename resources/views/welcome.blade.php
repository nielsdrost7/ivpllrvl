<!doctype html>
<html lang="en">
<head>
    <title>{{ config('app.name', 'InvoicePlane') }} - @lang('core::messages.welcome', ['default' => 'Welcome'])</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">

    @filamentStyles
    @vite('resources/css/app.css')
</head>

<body class="antialiased bg-gray-50 dark:bg-gray-900">

<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-2xl space-y-8">
        
        <div class="text-center">
            <h1 class="text-4xl font-bold tracking-tight text-gray-900 dark:text-gray-100 sm:text-5xl">
                @lang('core::messages.welcome', ['default' => 'Welcome'])
            </h1>
            <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">
                {{ config('app.name', 'InvoicePlane') }}
            </p>
        </div>

        <x-filament::section class="bg-white dark:bg-gray-800 shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10">
            <x-slot name="heading">
                @lang('core::messages.get_started', ['default' => 'Get Started'])
            </x-slot>
            
            <div class="space-y-6">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    @lang('core::messages.welcome_message', ['default' => 'Welcome to your invoice and quote management system. Please log in to continue.'])
                </p>

                <div class="flex flex-col gap-3 sm:flex-row">
                    <a 
                        href="{{ route('sessions.login') }}" 
                        class="flex-1 inline-flex justify-center items-center gap-2 rounded-lg bg-primary-600 dark:bg-primary-500 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-primary-500 dark:hover:bg-primary-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600 dark:focus-visible:outline-primary-500 transition"
                    >
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        @lang('core::messages.login', ['default' => 'Login'])
                    </a>
                </div>
            </div>
        </x-filament::section>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
            <x-filament::section class="bg-white dark:bg-gray-800 shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10">
                <div class="text-center space-y-3">
                    <div class="flex justify-center">
                        <svg class="h-12 w-12 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                        @lang('core::messages.invoices', ['default' => 'Invoices'])
                    </h3>
                    <p class="text-xs text-gray-600 dark:text-gray-400">
                        @lang('core::messages.manage_invoices', ['default' => 'Create and manage invoices'])
                    </p>
                </div>
            </x-filament::section>

            <x-filament::section class="bg-white dark:bg-gray-800 shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10">
                <div class="text-center space-y-3">
                    <div class="flex justify-center">
                        <svg class="h-12 w-12 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                        @lang('core::messages.quotes', ['default' => 'Quotes'])
                    </h3>
                    <p class="text-xs text-gray-600 dark:text-gray-400">
                        @lang('core::messages.manage_quotes', ['default' => 'Create and manage quotes'])
                    </p>
                </div>
            </x-filament::section>

            <x-filament::section class="bg-white dark:bg-gray-800 shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10">
                <div class="text-center space-y-3">
                    <div class="flex justify-center">
                        <svg class="h-12 w-12 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                        @lang('core::messages.projects', ['default' => 'Projects'])
                    </h3>
                    <p class="text-xs text-gray-600 dark:text-gray-400">
                        @lang('core::messages.manage_projects', ['default' => 'Track your projects'])
                    </p>
                </div>
            </x-filament::section>
        </div>

    </div>
</div>

@filamentScripts
@vite('resources/js/app.js')

</body>
</html>