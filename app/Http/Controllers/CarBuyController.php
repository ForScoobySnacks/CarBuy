<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CarBuyController extends Controller
{
    public function index(){
        return view('home');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'brand_id' => ['required','exists:brands,id'],
            'horse_power' => ['required','integer','max:1500'],
            'made_in' => ['required','integer','min:1900'],
            'newton_meter' => ['required','integer','min:10','max:1200'],
            'type' => ['required','string','max:50','min:2'],
            'fuel' => ['required','string','in:gas,diesel'],
            'door_num' => ['required','integer','in:3,5'],
            'ccm' => ['required','decimal:1','max:10'],
            'price' => ['required','integer'],
            'description' => ['required','string','max:600'],
            'images.*' => ['nullable','image','mimes:jpeg,png,jpg,gif','max:2048']
        ]);

        $car = Auth::user()->car()->create($validatedData);

        if($request->hasFile('images')){
            foreach($request->file('images') as $image){
                if($image){
                    $imagePath = $image->store('cars/' . $car->id,'public');
                    $car->pictures()->create([
                        'path' => $imagePath
                    ]);
                }
            }
        }

        return redirect('/cars')->with('success','New car been posted!');
    }

    public function create(){
        $brands = Brand::get();
        return view('cars/create', compact('brands'));
    }

    public function show(){
        $cars = Car::with(['user','pictures','brand'])->latest()->take(50)->get();
        $brands = Brand::get();
        return view('cars/cars',['cars' => $cars, 'brands' => $brands]);
    }

    public function search(Request $request){

        $validatedData = $request->validate([
            'brand_id' => ['nullable','exists:brands,id'],
            'horse_power' => ['nullable','integer','max:1500'],
            'made_in' => ['nullable','integer','min:1900'],
            'newton_meter' => ['nullable','integer','min:10','max:1200'],
            'type' => ['nullable','string','max:50','min:2'],
            'fuel' => ['nullable','string','in:gas,diesel'],
            'door_num' => ['nullable','integer','in:3,5'],
            'ccm' => ['nullable','numeric','min:0.1','max:10000'],
            'price_max' => ['nullable','integer','min:0','gte:price_min'],
            'price_min' => ['nullable','integer','min:0','lte:price_max']
        ]);

        $query = Car::with(['user','pictures','brand']);

        foreach($validatedData as $key => $value){
            if(isset($value)){
                if($key == 'price_min'){
                    $query->where('price', '>=', $value);
                } else if($key == 'price_max'){
                    $query->where('price', '<=', $value);
                } else {
                    if(in_array($key, ['type','fuel'])){
                        $query->where($key, 'like', '%' . $value . '%'); // Partial string match
                    } else {
                        $query->where($key,$value);
                    }
                }
            }
        }

        $cars = $query->latest()->get();
        $brands = Brand::get();

        return view('cars.cars', compact('cars','brands'));
    }

    public function update(Request $request, Car $car){
        $this->authorize('update',$car);

        $validatedData = $request->validate([
            'brand_id' => ['nullable','exists:brands,id'],
            'horse_power' => ['nullable','integer','max:1500'],
            'made_in' => ['nullable','integer','min:1900'],
            'newton_meter' => ['nullable','integer','min:10','max:1200'],
            'type' => ['nullable','string','max:50','min:2'],
            'fuel' => ['nullable','string','in:gas,diesel'],
            'door_num' => ['nullable','integer','in:3,5'],
            'ccm' => ['nullable','numeric','min:0.1','max:10000'],
            'price' => ['nullable','integer','min:0','max:10000000'],
            'description' => ['nullable','string','max:600'],
            'images.*' => ['nullable','image','mimes:jpeg,png,jpg,gif','max:2048'],
            'deleted_images' => ['nullable', 'json'],
        ]);

        $fillableData = collect($validatedData)->except(['images', 'deleted_images'])->filter(function ($value) {
            return !is_null($value);
        })->toArray();

        $hasChanges = false;
        foreach ($fillableData as $key => $value) {
            if ($car->{$key} != $value) {
                $hasChanges = true;
                break;
            }
        }

        $hasNewImages = $request->hasFile('images');

        $deletedImageIds = [];
        if (isset($validatedData['deleted_images'])) {
            $deletedImageIds = json_decode($validatedData['deleted_images'], true);
            if (!is_array($deletedImageIds)) {
                $deletedImageIds = [];
            }
        }
        $hasImagesToDelete = !empty($deletedImageIds);

        if (!$hasChanges && !$hasNewImages && !$hasImagesToDelete) {
            return redirect()->back()->with('error', 'No changes detected for the car details or images!');
        }

        if ($hasChanges) {
            $car->update($fillableData);
        }

        if ($hasImagesToDelete) {
            $picturesToDelete = $car->pictures()->whereIn('id', $deletedImageIds)->get();
            foreach ($picturesToDelete as $picture) {
                Storage::disk('public')->delete($picture->path);
                $picture->delete();
            }
        }

        if ($hasNewImages) {
            foreach($request->file('images') as $image){
                if($image && $image->isValid()){
                    $imagePath = $image->store('cars/' . $car->id,'public');
                    $car->pictures()->create([
                        'path' => $imagePath
                    ]);
                }
            }
        }

        return redirect('/cars')->with('success','Car updated successfully!');
    }

    public function destroy(Car $car){
        $this->authorize('delete',$car);

        if(Storage::disk('public')->exists('cars/' . $car->id))
            Storage::disk('public')->deleteDirectory('cars/' . $car->id);

        $car->delete();

        return redirect('/cars')->with('success','Car deleted!');
    }

    public function edit(Car $car){
        $this->authorize('update',$car);

        $brands = Brand::get();
        return view('cars/edit',['car' => $car, 'brands' => $brands]);
    }

    public function view_details(Car $car){
        return view('cars/view_details',['car' => $car]);
    }
}
