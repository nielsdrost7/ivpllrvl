<!doctype html>
<html lang="en">
<head>
    <title>{{ config('app.name', 'InvoicePlane') }} - @lang('core::messages.password_reset', ['default' => 'Password Reset'])</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="NOINDEX,NOFOLLOW">

    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">

    @filamentStyles
</head>

<body class="antialiased bg-gray-50 dark:bg-gray-900">

<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        
        <div>
            <h2 class="text-center text-3xl font-bold tracking-tight text-gray-900 dark:text-gray-100">
                @lang('core::messages.reset_password', ['default' => 'Reset your password'])
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600 dark:text-gray-400">
                @lang('core::messages.reset_password_desc', ['default' => "Enter your email address and we'll send you a reset link."])
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

                @if(session('alert_success'))
                    <div class="rounded-lg bg-success-50 dark:bg-success-900/20 p-4">
                        <p class="text-sm text-success-700 dark:text-success-400">
                            {{ session('alert_success') }}
                        </p>
                    </div>
                @endif

                <form method="post" action="{{ route('sessions.passwordreset.post') }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="btn_reset" value="true">

                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">
                            @lang('core::messages.email', ['default' => 'Email address'])
                        </label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            required 
                            autofocus
                            autocomplete="email"
                            placeholder="@lang('core::messages.email')"
                            class="block w-full rounded-lg border-0 py-2 px-3 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-white/10 placeholder:text-gray-400 dark:placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-primary-600 dark:focus:ring-primary-500 bg-white dark:bg-white/5 sm:text-sm sm:leading-6 transition"
                        >
                    </div>

                    <div class="flex flex-col gap-3">
                        <button 
                            type="submit" 
                            class="w-full inline-flex justify-center items-center gap-2 rounded-lg bg-primary-600 dark:bg-primary-500 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-primary-500 dark:hover:bg-primary-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600 dark:focus-visible:outline-primary-500 transition"
                        >
                            @lang('core::messages.send_reset_link', ['default' => 'Send reset link'])
                        </button>
                        
                        <div class="text-center">
                            <a 
                                href="{{ route('sessions.login') }}" 
                                class="text-sm font-medium text-primary-600 dark:text-primary-400 hover:text-primary-500 dark:hover:text-primary-300 transition"
                            >
                                @lang('core::messages.back_to_login', ['default' => 'Back to login'])
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </x-filament::section>

    </div>
</div>

@filamentScripts

</body>
</html>
