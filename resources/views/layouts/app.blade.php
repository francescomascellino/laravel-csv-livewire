<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Livewire</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite('resources/js/app.js')

</head>

<body class="bg-body-tertiary">

    <header>

        <div class="bg-secondary text-center py-2 shadow">
            <h1>Livewire Components and .csv Database Seeding</h1>
        </div>

    </header>

    <main>
        @yield('content')
    </main>

</body>

</html>
