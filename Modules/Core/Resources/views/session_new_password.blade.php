<!doctype html>
<html lang="en">
<head>
    <title>{{ config('app.name', 'InvoicePlane') }} - @lang('core::messages.set_new_password', ['default' => 'Set New Password'])</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="NOINDEX,NOFOLLOW">

    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">

    @filamentStyles
    @vite(['resources/assets/sass/app.scss', 'resources/assets/js/app.js'])
</head>

<body class="antialiased bg-gray-50 dark:bg-gray-900">

<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        
        <div>
            <h2 class="text-center text-3xl font-bold tracking-tight text-gray-900 dark:text-gray-100">
                @lang('core::messages.set_new_password', ['default' => 'Set new password'])
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600 dark:text-gray-400">
                @lang('core::messages.enter_new_password', ['default' => 'Enter your new password below.'])
            </p>
        </div>

        <x-filament::section class="bg-white dark:bg-gray-800 shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10">
            <div class="space-y-4">
                @if(session('alert_error'))
                    <div class="rounded-lg bg-danger-50 dark:bg-danger-900/20 p-4">
                        <p class="text-sm text-danger-700 dark:text-danger-400">
                            {{ session('alert_error') }}
                        </p>
                    </div>
                @endif

                <form method="post" action="{{ route('sessions.passwordreset.post') }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="btn_new_password" value="true">
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="user_id" value="{{ $user_id }}">

                    <div class="space-y-2">
                        <label for="new_password" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">
                            @lang('core::messages.new_password', ['default' => 'New Password'])
                        </label>
                        <input 
                            type="password" 
                            name="new_password" 
                            id="new_password" 
                            required 
                            autofocus
                            class="block w-full rounded-lg border-0 py-2 px-3 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-white/10 placeholder:text-gray-400 dark:placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-primary-600 dark:focus:ring-primary-500 bg-white dark:bg-white/5 sm:text-sm sm:leading-6 transition"
                        >
                    </div>

                    <div>
                        <button 
                            type="submit" 
                            class="w-full inline-flex justify-center items-center gap-2 rounded-lg bg-primary-600 dark:bg-primary-500 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-primary-500 dark:hover:bg-primary-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600 dark:focus-visible:outline-primary-500 transition"
                        >
                            @lang('core::messages.update_password', ['default' => 'Update password'])
                        </button>
                    </div>
                </form>
            </div>
        </x-filament::section>

    </div>
</div>

@filamentScripts

</body>
</html>
