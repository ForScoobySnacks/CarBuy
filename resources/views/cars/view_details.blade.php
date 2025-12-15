@props(['car'])

@auth
    <x-layout>
        <x-slot name="title">
            {{ $car->brand->name }}
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                @if($car->pictures->isNotEmpty())
                                    <div class="mb-4">
                                        <img src="{{ asset('storage/' . $car->pictures->first()->path) }}"
                                             alt="{{ $car->brand }} image"
                                             class="w-full h-96 object-cover rounded-lg shadow-md main-car-image">
                                    </div>
                                    @if($car->pictures->count() > 1)
                                        <div class="grid grid-cols-4 gap-2 mt-4">
                                            @foreach($car->pictures as $picture)
                                                <img src="{{ asset('storage/' . $picture->path) }}"
                                                     alt="{{ $car->brand }} thumbnail"
                                                     class="w-full h-24 object-cover rounded-lg cursor-pointer hover:opacity-75 thumbnail-image">
                                            @endforeach
                                        </div>
                                    @endif
                                @else
                                    <div class="mb-4">
                                        <img src="https://via.placeholder.com/600x400?text=No+Image+Available"
                                             alt="No image available for {{ $car->brand->name }}"
                                             class="w-full h-96 object-cover rounded-lg shadow-md">
                                    </div>
                                @endif
                            </div>
                            <div>
                                <h3 class="text-3xl font-bold text-gray-900 mb-4">{{ $car->brand->name }}</h3>
                                <p class="text-2xl font-semibold text-green-600 mb-6">Price: ${{ number_format($car->price) }}</p>

                                <div class="space-y-3 text-gray-700">
                                    <p><strong>Made In:</strong> {{ $car->made_in }}</p>
                                    <p><strong>Fuel Type:</strong> {{ $car->fuel }}</p>
                                    <p><strong>Horse Power:</strong> {{ $car->horse_power }} hp</p>
                                    <p><strong>Newton Meter:</strong> {{ $car->newton_meter }} Nm</p>
                                    <p><strong>Type:</strong> {{ $car->type }}</p>
                                    <p><strong>Number of Doors:</strong> {{ $car->door_num }}</p>
                                    <p><strong>Engine Capacity (CCM):</strong> {{ $car->ccm }}</p>
                                    <p><strong>Listed by:</strong> {{ $car->user->name }}</p>
                                </div>

                                <div class="mt-6">
                                    <h4 class="text-xl font-semibold text-gray-800 mb-2">Description:</h4>
                                    <p class="text-gray-700 leading-relaxed">{{ $car->description }}</p>
                                </div>
                                <div class="mt-8 flex space-x-4">
                                    @can('update', $car)
                                        <a href="{{ route('cars.edit', $car) }}"
                                           class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                            Edit Car
                                        </a>
                                    @endcan

                                    @can('delete', $car)
                                        <form action="{{ route('cars.destroy', $car) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this car? This action cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                Delete Car
                                            </button>
                                        </form>
                                    @endcan

                                    <a href="{{ route('cars.show') }}"
                                       class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                        Back to all cars
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-layout>
@else
    <div class="bg-white rounded-lg shadow-md p-6 text-center text-red-500 m-8">
        <h3>You have to be logged in to view car details!</h3>
        <a href="{{ route('login') }}" class="mt-4 inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded text-sm">Login</a>
    </div>
@endauth
