@props(['car'])

@auth
    <div class="bg-white rounded-lg shadow-md overflow-hidden p-4 relative">
        <div class="absolute top-2 right-2 flex space-x-2">
            @can('update', $car)
                <a href="{{ route('cars.edit', $car) }}"
                   class="text-blue-500 hover:text-blue-700"
                   title="Edit Car">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </a>
            @endcan

            @can('delete', $car)
                <form action="{{ route('cars.destroy', $car) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this car?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="text-red-500 hover:text-red-700"
                            title="Delete Car">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </form>
            @endcan
        </div>

        <div class="mb-4">
            @if($car->pictures->isNotEmpty())
                <img src="{{ asset('storage/' . $car->pictures->first()->path) }}"
                     alt="{{ $car->brand }} image"
                     class="w-full h-48 object-cover rounded">
            @else
                <img src="https://via.placeholder.com/400x300?text=No+Image"
                     alt="No image available for {{ $car->brand }}"
                     class="w-full h-48 object-cover rounded">
            @endif
        </div>
        <p class="text-lg font-semibold mb-1">Brand: {{ $car->brand->name }}</p>
        <p class="text-gray-700 mb-1">Made in: {{ $car->made_in }}</p>
        <p class="text-gray-700 mb-1">Fuel: {{ $car->fuel }}</p>
        <p class="text-gray-700 mb-1">Horse power: {{ $car->horse_power }}</p>
        <p class="text-xl font-bold text-green-600">Price: ${{ number_format($car->price) }}</p>
        <a href="{{ route('cars.view_details',$car) }}" class="mt-4 inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded text-sm">View Details</a>
    </div>
@else
    <div class="bg-white rounded-lg shadow-md p-6 text-center text-red-500">
        <h3>You have to be logged in to see the cars!</h3>
    </div>
@endauth
