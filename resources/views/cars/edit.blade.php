<!-- resources/views/cars/edit.blade.php -->

<x-layout>
    <x-slot:title>
        Edit Car: {{ $car->brand->name }}
    </x-slot:title>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <div class="container mx-auto px-4 py-8 max-w-2xl">
        <h1 class="text-3xl font-bold text-gray-900 mb-6 text-center">Edit Car: {{ $car->brand->name }}</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <form action="{{ route('cars.update', $car) }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="brand_id" class="block text-sm font-semibold text-gray-700 mb-1">Brand:</label>
                <select name="brand_id" id="brand_id"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Select Brand</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}"
                                {{ old('brand_id', $car->brand_id) == $brand->id ? 'selected' : '' }}>
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
                       value="{{ old('horse_power', $car->horse_power) }}" required max="1500">
                @error('horse_power')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="made_in" class="block text-sm font-semibold text-gray-700 mb-1">Year Made:</label>
                <input type="number" name="made_in" id="made_in"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('made_in', $car->made_in) }}" required min="1900" max="{{ date('Y') + 1 }}">
                @error('made_in')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="newton_meter" class="block text-sm font-semibold text-gray-700 mb-1">Newton Meter (Torque):</label>
                <input type="number" name="newton_meter" id="newton_meter"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('newton_meter', $car->newton_meter) }}" required min="10" max="1200">
                @error('newton_meter')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="type" class="block text-sm font-semibold text-gray-700 mb-1">Body Type:</label>
                <input type="text" name="type" id="type"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('type', $car->type) }}" required minlength="2" maxlength="50">
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
                    <option value="gas" {{ old('fuel', $car->fuel) == 'gas' ? 'selected' : '' }}>Gas</option>
                    <option value="diesel" {{ old('fuel', $car->fuel) == 'diesel' ? 'selected' : '' }}>Diesel</option>
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
                    <option value="3" {{ old('door_num', $car->door_num) == '3' ? 'selected' : '' }}>3 Doors</option>
                    <option value="5" {{ old('door_num', $car->door_num) == '5' ? 'selected' : '' }}>5 Doors</option>
                </select>
                @error('door_num')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="ccm" class="block text-sm font-semibold text-gray-700 mb-1">Engine Displacement (CCM):</label>
                <input type="number" step="0.01" name="ccm" id="ccm"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('ccm', $car->ccm) }}" required max="10000"> {{-- Adjusted max for CCM --}}
                @error('ccm')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="price" class="block text-sm font-semibold text-gray-700 mb-1">Price (€):</label>
                <input type="number" name="price" id="price"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('price', $car->price) }}" required min="0">
                @error('price')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Description:</label>
                <textarea name="description" id="description" rows="5"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                          required>{{ old('description', $car->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6 border-t pt-6 border-gray-200" x-data="{ deletedImageIds: [] }">
                <h3 class="text-lg font-bold text-gray-900 mb-3">Current Car Pictures</h3>
                @if ($car->pictures->isNotEmpty())
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach ($car->pictures as $picture)
                            <div class="relative group border border-gray-200 rounded-lg overflow-hidden"
                                 x-show="!deletedImageIds.includes({{ $picture->id }})">
                                <img src="{{ asset('storage/' . $picture->path) }}"
                                     alt="Car Image"
                                     class="w-full h-32 object-cover">
                                <button type="button"
                                        @click="deletedImageIds.push({{ $picture->id }})"
                                        class="delete-image-btn absolute top-1 right-1 bg-red-600 hover:bg-red-700 text-white rounded-full p-1 text-xs opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center"
                                        title="Delete Image">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    </div>
                    <input type="hidden" name="deleted_images" :value="JSON.stringify(deletedImageIds)">
                @else
                    <p class="text-gray-500">No images currently uploaded for this car.</p>
                @endif
            </div>


            <div class="mb-6 border-t pt-6 border-gray-200"
                 x-data="{ newPictures: [{ id: 1 }] }">
                <h3 class="text-lg font-bold text-gray-900 mb-3">Upload New Pictures (Optional)</h3>
                <div id="new-image-upload-fields">
                    <template x-for="(newPicture, index) in newPictures" :key="newPicture.id">
                        <div class="flex items-center space-x-2 mb-2">
                            <input type="file" name="images[]"
                                   class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none @error('images.*') border-red-500 @enderror">
                            <button type="button" @click="newPictures.splice(index, 1)" x-show="newPictures.length > 1"
                                    class="text-red-600 hover:text-red-800 focus:outline-none p-2 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm6 0a1 1 0 11-2 0v6a1 1 0 112 0V8z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </template>
                    @error('images.*') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <button type="button" @click="newPictures.push({ id: newPictures.length + 1 })"
                        class="mt-4 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Add Another Picture Field
                </button>
            </div>

            <div class="mt-8 flex justify-between items-center">
                <a href="{{ route('cars.show') }}" class="text-gray-600 hover:text-gray-900 px-4 py-2 rounded-lg">Cancel</a>
                <button type="submit"
                        class="bg-green-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 text-lg">
                    Update Car
                </button>
            </div>
        </form>
    </div>
</x-layout>
