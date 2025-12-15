<x-layout>
    <x-slot:title>
        Sign In
    </x-slot:title>

    <div class="min-h-screen flex items-center justify-center bg-black">
        <div class="w-full max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-4xl font-extrabold text-center text-black mb-8">Welcome Back</h1>

            <form method="POST" action="/login">
                @csrf

                <div class="mb-6">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        Email
                    </label>
                    <input id="email"
                           type="email"
                           name="email"
                           placeholder="email@example.com"
                           value="{{ old('email') }}"
                           class="w-full px-5 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-black @error('email') border-red-500 @enderror"
                           required
                           autofocus>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        Password
                    </label>
                    <input id="password"
                           type="password"
                           name="password"
                           placeholder="••••••••"
                           class="w-full px-5 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-black @error('password') border-red-500 @enderror"
                           required>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="form-checkbox h-4 w-4 text-black transition duration-150 ease-in-out border-gray-300 rounded focus:ring-black">
                        <span class="ml-2 text-sm text-gray-700">Remember me</span>
                    </label>
                </div>

                <div>
                    <button type="submit" class="w-full bg-black text-white py-3 rounded-lg text-lg font-semibold hover:bg-gray-800 transition duration-300">
                        Sign In
                    </button>
                </div>
            </form>

            <div class="relative flex py-8 items-center">
                <div class="flex-grow border-t border-gray-300"></div>
                <span class="flex-shrink mx-4 text-gray-500">OR</span>
                <div class="flex-grow border-t border-gray-300"></div>
            </div>

            <p class="text-center text-sm text-gray-600">
                Don't have an account?
                <a href="/register" class="font-semibold text-black hover:underline">Register</a>
            </p>
        </div>
    </div>
</x-layout>
