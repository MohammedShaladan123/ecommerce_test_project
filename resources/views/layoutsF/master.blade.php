<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Home')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f9;
        }
    </style>

    @yield('styles')
</head>

<body class="bg-gray-100 text-gray-900">

    @include('partials.header')

    <main class="container mx-auto py-10">
        @yield('content')
    </main>

5    @include('partials.footer')

    @yield('scripts')

</body>

</html>
