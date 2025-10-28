<!doctype html>
<html lang="en">
<head>
    <title>{{ config('app.name', 'InvoicePlane') }} - @lang('ip.sign_in')</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">

    @filamentStyles
    @vite(['resources/assets/sass/app.scss', 'resources/assets/js/app.js'])
</head>

<body class="antialiased bg-gray-50 dark:bg-gray-900">

<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        
        <div>
            <h2 class="text-center text-3xl font-bold tracking-tight text-gray-900 dark:text-gray-100">
                @lang('ip.sign_in')
            </h2>
        </div>

        <x-filament::section class="bg-white dark:bg-gray-800 shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10">
            <div class="space-y-4">
                @include('layouts._alerts')

                {!! Form::open() !!}

                <div class="space-y-6">
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">
                            @lang('ip.email')
                        </label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            placeholder="@lang('ip.email')"
                            class="block w-full rounded-lg border-0 py-2 px-3 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-white/10 placeholder:text-gray-400 dark:placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-primary-600 dark:focus:ring-primary-500 bg-white dark:bg-white/5 sm:text-sm sm:leading-6 transition"
                        >
                    </div>

                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">
                            @lang('ip.password')
                        </label>
                        <input 
                            type="password" 
                            name="password" 
                            placeholder="@lang('ip.password')"
                            class="block w-full rounded-lg border-0 py-2 px-3 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-white/10 placeholder:text-gray-400 dark:placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-primary-600 dark:focus:ring-primary-500 bg-white dark:bg-white/5 sm:text-sm sm:leading-6 transition"
                        >
                    </div>

                    <div class="flex items-center">
                        <input 
                            type="hidden" 
                            name="remember_me" 
                            value="0"
                        >
                        <input 
                            type="checkbox" 
                            name="remember_me" 
                            value="1"
                            id="remember_me"
                            class="h-4 w-4 rounded border-gray-300 dark:border-white/10 text-primary-600 dark:text-primary-500 focus:ring-primary-600 dark:focus:ring-primary-500 bg-white dark:bg-white/5 transition"
                        >
                        <label for="remember_me" class="ml-2 block text-sm text-gray-900 dark:text-gray-100">
                            @lang('ip.remember_me')
                        </label>
                    </div>

                    <div>
                        <button 
                            type="submit" 
                            class="w-full inline-flex justify-center items-center gap-2 rounded-lg bg-primary-600 dark:bg-primary-500 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-primary-500 dark:hover:bg-primary-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600 dark:focus-visible:outline-primary-500 transition"
                        >
                            @lang('ip.sign_in')
                        </button>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </x-filament::section>

    </div>
</div>

@filamentScripts

</body>
</html>
