<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Realisasi Anggaran Belanja') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    {{-- @vite(['resources/css/app.css']) --}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @livewireStyles

</head>

<body class="relative antialiased bg-gray-100">
    <x-dialog />
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
        <header class="">
            <div class="container mx-auto py-7">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main class="container mx-w-6xl mx-auto py-4">
            {{ $slot }}
        </main>
    </div>

    <!-- Scripts -->
    @wireUiScripts
    <script src="{{ mix('js/app.js') }}" defer></script>
    @livewireScripts
</body>

</html>