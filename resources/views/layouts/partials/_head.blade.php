<link href="{{ asset('favicon.png') }}" rel="icon" type="image/png">

@vite(['resources/assets/sass/app.scss', 'resources/assets/js/app.js'])

@if (file_exists(base_path('custom/custom.css')))
    <link href="{{ asset('custom/custom.css') }}" rel="stylesheet" type="text/css"/>
@endif
