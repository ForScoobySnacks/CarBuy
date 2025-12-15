<x-layout>
    <x-slot name="title">
        Available Cars
    </x-slot>

    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6 text-center">Available Cars</h1>
        <form action="{{ route('cars.search') }}" method="GET" class="mb-8 p-4 bg-gray-100 rounded-lg shadow-sm">
            <h2 class="text-xl font-bold mb-4">Filter Cars</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label for="brand_id" class="block text-sm font-medium text-gray-700">Brand</label>
                    <select name="brand_id" id="brand_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="">Any</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}"
                                    {{ (string)request('brand_id') === (string)$brand->id ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                    <input type="text" name="type" id="type" placeholder="e.g., Sedan"
                           value="{{ request('type') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label for="fuel" class="block text-sm font-medium text-gray-700">Fuel</label>
                    <select name="fuel" id="fuel"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="">Any</option>
                        <option value="gas" {{ request('fuel') == 'gas' ? 'selected' : '' }}>Gas</option>
                        <option value="diesel" {{ request('fuel') == 'diesel' ? 'selected' : '' }}>Diesel</option>
                    </select>
                </div>
                <div>
                    <label for="price_min" class="block text-sm font-medium text-gray-700">Min Price</label>
                    <input type="number" name="price_min" id="price_min" placeholder="e.g., 10000"
                           value="{{ request('price_min') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label for="price_max" class="block text-sm font-medium text-gray-700">Max Price</label>
                    <input type="number" name="price_max" id="price_max" placeholder="e.g., 50000"
                           value="{{ request('price_max') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label for="horse_power" class="block text-sm font-medium text-gray-700">Horse Power</label>
                    <input type="number" name="horse_power" id="horse_power" placeholder="e.g., 200"
                           value="{{ request('horse_power') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label for="made_in" class="block text-sm font-medium text-gray-700">Year</label>
                    <input type="number" name="made_in" id="made_in" placeholder="e.g., 2020"
                           value="{{ request('made_in') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label for="door_num" class="block text-sm font-medium text-gray-700">Doors</label>
                    <select name="door_num" id="door_num"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="">Any</option>
                        <option value="2" {{ request('door_num') == '2' ? 'selected' : '' }}>2 Doors</option>
                        <option value="3" {{ request('door_num') == '3' ? 'selected' : '' }}>3 Doors</option>
                        <option value="4" {{ request('door_num') == '4' ? 'selected' : '' }}>4 Doors</option>
                        <option value="5" {{ request('door_num') == '5' ? 'selected' : '' }}>5 Doors</option>
                    </select>
                </div>
                <div>
                    <label for="newton_meter" class="block text-sm font-medium text-gray-700">Newton Meter</label>
                    <input type="number" name="newton_meter" id="newton_meter" placeholder="e.g., 300"
                           value="{{ request('newton_meter') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label for="ccm" class="block text-sm font-medium text-gray-700">CCM</label>
                    <input type="number" step="0.1" name="ccm" id="ccm" placeholder="e.g., 1.6"
                           value="{{ request('ccm') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>

            </div>
            <div class="mt-6 flex justify-end space-x-2">
                <a href="{{ route('cars.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Post a New Car
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                    Search
                </button>
                <a href="{{ route('cars.show') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                    Reset Filters
                </a>
            </div>
            @if ($errors->any())
                <div class="mt-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded relative" role="alert">
                    <strong class="font-bold">Whoops!</strong>
                    <span class="block sm:inline">There were some problems with your search input.</span>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>

        @if($cars->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-4">
                @foreach($cars as $car)
                    <x-car :car="$car"/>
                @endforeach
            </div>
        @else
            <div class="text-center text-gray-600 p-8">
                @if(request()->filled('brand_id') || request()->filled('type') || request()->filled('fuel') || request()->filled('price_min') || request()->filled('price_max') || request()->filled('horse_power') || request()->filled('made_in') || request()->filled('door_num') || request()->filled('newton_meter') || request()->filled('ccm'))
                    <h3 class="text-xl font-semibold mb-4">No cars found matching your search criteria.</h3>
                    <p class="mb-4">Try adjusting your filters or <a href="{{ route('cars.show') }}" class="text-blue-500 hover:underline">view all cars</a>.</p>
                @else
                    <h3 class="text-xl font-semibold mb-4">No cars have been posted yet. Be the first!</h3>
                    <a href="{{ route('cars.create') }}" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Post the first car!
                    </a>
                @endif
            </div>
        @endif

    </div>
</x-layout>
