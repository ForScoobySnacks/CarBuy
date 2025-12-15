<x-layout>
    <x-slot:title>
        Register
    </x-slot:title>
    <div class="min-h-screen flex items-center justify-center bg-black">
        <div class="w-full max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-4xl font-extrabold text-center text-black mb-8">Create Account</h1>

            <form method="POST" action="/register">
                @csrf

                <div class="mb-6">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                        Name
                    </label>
                    <input type="text"
                        name="name"
                        id="name"
                        placeholder="John Doe"
                        value="{{ old('name') }}"
                        class="w-full px-5 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-black @error('name') border-red-500 @enderror"
                        required>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        Email
                    </label>
                    <input type="email"
                        name="email"
                        id="email"
                        placeholder="email@example.com"
                        value="{{ old('email') }}"
                        class="w-full px-5 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-black @error('email') border-red-500 @enderror"
                        required>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        Password
                    </label>
                    <input type="password"
                        name="password"
                        id="password"
                        placeholder="••••••••"
                        class="w-full px-5 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-black @error('password') border-red-500 @enderror"
                        required>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                        Confirm Password
                    </label>
                    <input type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        placeholder="••••••••"
                        class="w-full px-5 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-black"
                        required>
                </div>

                <div>
                    <button type="submit" class="w-full bg-black text-white py-3 rounded-lg text-lg font-semibold hover:bg-gray-800 transition duration-300">
                        Register
                    </button>
                </div>
            </form>

            <div class="relative flex py-8 items-center">
                <div class="flex-grow border-t border-gray-300"></div>
                <span class="flex-shrink mx-4 text-gray-500">OR</span>
                <div class="flex-grow border-t border-gray-300"></div>
            </div>

            <p class="text-center text-sm text-gray-600">
                Already have an account?
                <a href="/login" class="font-semibold text-black hover:underline">Sign in</a>
            </p>
        </div>
    </div>
</x-layout>
