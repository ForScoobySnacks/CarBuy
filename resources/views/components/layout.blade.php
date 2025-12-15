<!DOCTYPE html>
<html lang="en" data-theme="lofi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? $title . ' - CarBuy' : 'CarBuy' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col bg-black font-sans text-gray-800">
    <nav class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex-shrink-0">
                <a href="/" class="text-2xl font-bold text-black">CarBuy</a>
            </div>
            <div class="flex items-center space-x-4">
                @auth
                    <span class="text-sm font-medium text-gray-700">{{ auth()->user()->name }}</span>
                    <form method="POST" action="/logout" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition duration-300">Logout</button>
                    </form>
                @else
                    <a href="/login" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition duration-300">Sign In</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white bg-black rounded-md hover:bg-gray-800 transition duration-300">Sign Up</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="flex-1 container mx-auto px-4 py-8">
        {{ $slot }}
    </main>

    <footer class="bg-gray-100 py-6">
        <div class="container mx-auto px-4 text-center text-xs text-gray-600">
            <p>© 2025 CarBuy the best place for used cars!</p>
        </div>
    </footer>
</body>

</html>
