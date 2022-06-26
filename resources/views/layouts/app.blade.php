<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!--video youtube -->

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/iziToast.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/iziToast.min.css') }}">

    <!-- Alertas -->
    <link rel="stylesheet" href="{{ asset('css/iziToast.css') }}">

    <x-embed-styles />


</head>

<body>
    <div id="app">
        @include('layouts.menu')
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @if (session('msg_sucesso'))
        <script>
            iziToast.success({
                title: 'OK',
                message: "{{ session('msg_sucesso') }}",
                position: 'topRight',
            });
        </script>
    @endif
    @if (session('msg_erro'))
        <script>
            iziToast.error({
                title: 'Error',
                message: "{{ session('msg_erro') }}",
                position: 'topRight',
            });
        </script>
    @endif



</body>

</html>
