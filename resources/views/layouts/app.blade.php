<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'My App' }}</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <!-- Navbar Component -->
    <x-navbar />

    <!-- Content -->
    <main class="p-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center p-4">
        <p>© 2025 Fahmi</p>
    </footer>
</body>

</html>
