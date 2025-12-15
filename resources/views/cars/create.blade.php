<x-layout>
    <x-slot:title>
        Add New Car
    </x-slot:title>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <div class="container mx-auto px-4 py-8 max-w-2xl">
        <h1 class="text-3xl font-bold text-gray-900 mb-6 text-center">Post a New Car for Sale</h1>

        <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <label for="brand_id" class="block text-sm font-semibold text-gray-700 mb-1">Brand:</label>
                <select name="brand_id" id="brand_id"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                    <option value="">Select a Brand</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
                @error('brand_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="horse_power" class="block text-sm font-semibold text-gray-700 mb-1">Horse Power:</label>
                <input type="number" name="horse_power" id="horse_power"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('horse_power') }}" required max="1500">
                @error('horse_power')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="made_in" class="block text-sm font-semibold text-gray-700 mb-1">Year Made:</label>
                <input type="number" name="made_in" id="made_in"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('made_in') }}" required min="1900" max="{{ date('Y') + 1 }}">
                @error('made_in')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="newton_meter" class="block text-sm font-semibold text-gray-700 mb-1">Newton Meter (Torque):</label>
                <input type="number" name="newton_meter" id="newton_meter"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('newton_meter') }}" required min="10" max="1200">
                @error('newton_meter')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="type" class="block text-sm font-semibold text-gray-700 mb-1">Body Type:</label>
                <input type="text" name="type" id="type"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('type') }}" required minlength="2" maxlength="50">
                @error('type')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="fuel" class="block text-sm font-semibold text-gray-700 mb-1">Fuel Type:</label>
                <select name="fuel" id="fuel"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                    <option value="">Select Fuel Type</option>
                    <option value="gas" {{ old('fuel') == 'gas' ? 'selected' : '' }}>Gas</option>
                    <option value="diesel" {{ old('fuel') == 'diesel' ? 'selected' : '' }}>Diesel</option>
                </select>
                @error('fuel')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="door_num" class="block text-sm font-semibold text-gray-700 mb-1">Number of Doors:</label>
                <select name="door_num" id="door_num"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                    <option value="">Select Number of Doors</option>
                    <option value="3" {{ old('door_num') == '3' ? 'selected' : '' }}>3 Doors</option>
                    <option value="5" {{ old('door_num') == '5' ? 'selected' : '' }}>5 Doors</option>
                </select>
                @error('door_num')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="ccm" class="block text-sm font-semibold text-gray-700 mb-1">Engine Displacement (CCM):</label>
                <input type="number" step="0.01" name="ccm" id="ccm"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('ccm') }}" required max="10">
                @error('ccm')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="price" class="block text-sm font-semibold text-gray-700 mb-1">Price (€):</label>
                <input type="number" name="price" id="price"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('price') }}" required min="0">
                @error('price')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Description:</label>
                <textarea name="description" id="description" rows="5"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                          required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6 border-t pt-6 border-gray-200"
                 x-data="{ pictures: [{ id: 1 }] }">
                <h3 class="text-lg font-bold text-gray-900 mb-3">Car Pictures</h3>
                <div id="image-upload-fields">
                    <template x-for="(picture, index) in pictures" :key="picture.id">
                        <div class="flex items-center space-x-2 mb-2">
                            <input type="file" name="images[]"
                                   class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none @error('images.*') border-red-500 @enderror">
                            <button type="button" @click="pictures.splice(index, 1)" x-show="pictures.length > 1"
                                    class="text-red-600 hover:text-red-800 focus:outline-none p-2 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm6 0a1 1 0 11-2 0v6a1 1 0 112 0V8z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </template>
                    @error('images.*') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <button type="button" @click="pictures.push({ id: pictures.length + 1 })"
                        class="mt-4 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Add Another Picture
                </button>
            </div>

            <div class="mt-8">
                <button type="submit"
                        class="w-full bg-green-600 text-white font-semibold py-3 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 text-lg">
                    Post Car
                </button>
            </div>
        </form>
    </div>
</x-layout>
