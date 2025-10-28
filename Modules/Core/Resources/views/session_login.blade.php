<!doctype html>

<!--[if lt IE 7]>
<html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>
<html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>
<html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->

<head>
    <title>{{ config('app.name', 'InvoicePlane') }} - @lang('core::messages.login')</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">
    <meta name="robots" content="NOINDEX,NOFOLLOW">

    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 dark:bg-gray-900">

<noscript>
    <div class="p-4 mb-4 text-red-700 dark:text-red-200 bg-red-100 dark:bg-red-900/50 border border-red-200 dark:border-red-800 rounded-lg no-margin">
        @lang('core::messages.please_enable_js')
    </div>
</noscript>

<br>

<div class="container mx-auto px-4">

    <div id="login" class="w-full md:w-1/2 mx-auto">

        @if($login_logo)
            <img src="{{ asset('uploads/' . $login_logo) }}" class="login-logo mx-auto mb-6 max-w-md">
        @else
            <h1 class="text-3xl font-bold text-center mb-6 text-gray-900 dark:text-gray-100">
                @lang('core::messages.login')
            </h1>
        @endif

        <div class="mb-4">
            @if(session('alert_error'))
                <div class="p-4 mb-4 text-red-700 dark:text-red-200 bg-red-100 dark:bg-red-900/50 border border-red-200 dark:border-red-800 rounded-lg">
                    {{ session('alert_error') }}
                </div>
            @endif

            @if(session('alert_success'))
                <div class="p-4 mb-4 text-green-700 dark:text-green-200 bg-green-100 dark:bg-green-900/50 border border-green-200 dark:border-green-800 rounded-lg">
                    {{ session('alert_success') }}
                </div>
            @endif
        </div>

        <form method="post" action="{{ route('sessions.login.post') }}" class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">

            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    @lang('core::messages.email')
                </label>
                <input type="email" name="email" id="email" 
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400 sm:text-sm transition-colors"
                    placeholder="@lang('core::messages.email')" required autofocus
                >
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    @lang('core::messages.password')
                </label>
                <input type="password" name="password" id="password" 
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400 sm:text-sm transition-colors"
                    placeholder="@lang('core::messages.password')" required
                >
            </div>

            <input type="hidden" name="btn_login" value="true">

            <div class="flex gap-4 flex-wrap">
                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 dark:bg-blue-500 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    <i class="fa fa-unlock fa-margin"></i> @lang('core::messages.login')
                </button>
                <a href="{{ route('sessions.passwordreset') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    @lang('core::messages.forgot_your_password')
                </a>
            </div>

        </form>

    </div>
</div>

</body>
</html>
