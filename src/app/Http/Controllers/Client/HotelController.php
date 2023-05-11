<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Category;
use App\Models\Region;
use App\Models\HotelImage;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($hotel_id = null)
    {
        if (Auth::guard('client')->check()) {
            $client = Auth::user();
            $client_name = $client->name;
            $selected_hotel = Hotel::where('client_id', $client->id)
                ->where('id', $hotel_id)
                ->firstOrFail();

            return view('client.hotel.index', compact('selected_hotel'))
                ->with('page_id', request()->page)
                ->with('client_name', $client_name);
        } else {
            return redirect()->route('client.login');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $regions = Region::all();
        return view('client.hotel.create')
            ->with('categories', $categories)
            ->with('regions', $regions)
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:20',
            'price' => 'required|integer',
            'category_id' => 'required|integer',
            'region_id' => 'required|integer',
            'address' => 'required|max:140',
            'description' => 'required|max:140',
            'url' => 'required|max:140',
            'phone_number' => 'required|max:20',
        ]);
    
        $hotel = new Hotel;
        $hotel->name = $request->name;
        $hotel->price = $request->price;
        $hotel->category_id = $request->category_id;
        $hotel->region_id = $request->region_id;
        $hotel->address = $request->address;
        $hotel->description = $request->description;
        $hotel->url = $request->url;
        $hotel->phone_number = $request->phone_number;
        $hotel->client_id = Auth::guard('client')->user()->id;
        
        $hotel->save();
    
        return redirect()->route('project.hotel.index')
            ->with('page_id',request()->page_id)
            ->with('success', 'ホテルを登録しました');
    }

    public function storeConcept(Request $request)
    {
        $request->validate([
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'name' => 'required|max:20',
            'price' => 'required|integer',
            'category_id' => 'required|integer',
            'region_id' => 'required|integer',
            'address' => 'required|max:140',
            'description' => 'required|max:140',
            'url' => 'required|max:140',
            'phone_number' => 'required|max:20',
        ]);
    
        // ホテルデータの保存処理
        $hotel = new Hotel;
        $hotel->name = $request->name;
        $hotel->price = $request->price;
        $hotel->category_id = $request->category_id;
        $hotel->region_id = $request->region_id;
        $hotel->address = $request->address;
        $hotel->description = $request->description;
        $hotel->url = $request->url;
        $hotel->phone_number = $request->phone_number;
        $hotel->client_id = Auth::guard('client')->user()->id;
        $hotel->save();

        // 画像ファイルのアップロード処理
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = $image->getClientOriginalName();
                $path = Storage::putFileAs('public/hotel_images', $image, $filename);
    
                $hotelImage = new HotelImage;
                $hotelImage->hotel_id = $hotel->id;
                $hotelImage->filename = $filename;
                $hotelImage->path = $path;
    
                $hotelImage->save();
            }
        }
    
        return redirect()->route('project.hotel.editConcept', ['hotel_id' => $hotel->id])
            ->with('page_id',request()->page_id)
            ->with('success');
    }

    /**
     * Display the specified resource.
     */
    public function show($hotel_id)
    {
        if (Auth::guard('client')->check()) {
            $client = Auth::user();
            $client_name = $client->name;
            $selected_hotel = Hotel::find($hotel_id);

            return view('client.hotel.index', compact('selected_hotel'))
                ->with('page_id', request()->page)
                ->with('client_name', $client_name);
        } else {
            return redirect()->route('client.login');
        }
    }

    public function showConcept($hotel_id)
    {
        $hotel = Hotel::find($hotel_id);
        $categories = Category::all();
        $regions = Region::all();
        return view('client.hotel.editConcept', compact('hotel'))
            ->with('categories', $categories)
            ->with('regions', $regions)
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editConcept($hotel_id)
    {
        if (Auth::guard('client')->check()) {
            $client = Auth::user();
            $categories = Category::all();
            $regions = Region::all();
            $hotelImage = HotelImage::first();
            $image_url = $hotelImage ? $hotelImage->url : null;
            $selected_hotel = Hotel::where('client_id', $client->id)
                ->where('id', $hotel_id)
                ->firstOrFail();
            return view('client.hotel.editConcept', compact('selected_hotel', 'image_url'))
                ->with('categories', $categories)
                ->with('regions', $regions)
                ->with('i', (request()->input('page', 1) - 1) * 5);
        } else {
            return redirect()->route('client.login');
        }
    }

    public function editBasicInformation($hotel_id)
    {
        $hotel = Hotel::find($hotel_id);
        $categories = Category::all();
        $regions = Region::all();
        $hotelImage = HotelImage::first();
        $image_url = $hotelImage ? $hotelImage->url : null;
        return view('client.hotel.editBasicInformation', compact('hotel', 'image_url'))
            ->with('categories', $categories)
            ->with('regions', $regions)
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function editFacilities($hotel_id)
    {
        if (Auth::guard('client')->check()) {
            $client = Auth::user();
            $selected_hotel = Hotel::where('client_id', $client->id)
                ->where('id', $hotel_id)
                ->firstOrFail();
            $facilities = Facility::all();
            return view('client.hotel.editFacilities', compact('selected_hotel', 'facilities'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
        } else {
            return redirect()->route('client.login');
        }
    }

    public function editFeatures($hotel_id)
    {
        $hotel = Hotel::find($hotel_id);
        $categories = Category::all();
        $regions = Region::all();
        $hotelImage = HotelImage::first();
        $image_url = $hotelImage ? $hotelImage->url : null;
        return view('client.hotel.editFeatures', compact('hotel', 'image_url'))
            ->with('categories', $categories)
            ->with('regions', $regions)
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hotel $hotel)
    {
        $request->validate([
            'name' => 'required|max:20',
            'price' => 'required|integer',
            'category_id' => 'required|integer',
            'region_id' => 'required|integer',
            'address' => 'required|max:140',
            'description' => 'required|max:140',
            'url' => 'required|max:140',
            'phone_number' => 'required|max:20',
        ]);

        // ホテルデータの保存処理
        $hotel->name = $request->input(["name"]);
        $hotel->price = $request->input(["price"]);
        $hotel->category_id = $request->input(["category_id"]);
        $hotel->region_id = $request->input(["region_id"]);
        $hotel->address = $request->input(["address"]);
        $hotel->description = $request->input(["description"]);
        $hotel->url = $request->input(["url"]);
        $hotel->phone_number = $request->input(["phone_number"]);
        $hotel->save();

        return redirect()->route('project.hotel.index')
            ->with('page_id',request()->page_id)
            ->with('success','ホテルを更新しました');
    }

    public function updateConcept(Request $request, Hotel $hotel)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'name' => 'required|max:20',
            'price' => 'required|integer',
            'category_id' => 'required|integer',
            'region_id' => 'required|integer',
            'address' => 'required|max:140',
            'description' => 'required|max:140',
            'url' => 'required|max:140',
            'phone_number' => 'required|max:20',
        ]);

        // ホテルデータの保存処理
        $hotel->name = $request->input(["name"]);
        $hotel->price = $request->input(["price"]);
        $hotel->category_id = $request->input(["category_id"]);
        $hotel->region_id = $request->input(["region_id"]);
        $hotel->address = $request->input(["address"]);
        $hotel->description = $request->input(["description"]);
        $hotel->url = $request->input(["url"]);
        $hotel->phone_number = $request->input(["phone_number"]);
        $hotel->save();

        // 画像ファイルのアップロード処理
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = $image->getClientOriginalName();
                $path = Storage::putFileAs('public/hotel_images', $image, $filename);
    
                $hotelImage = new HotelImage;
                $hotelImage->hotel = $hotel->id;
                $hotelImage->filename = $filename;
                $hotelImage->path = $path;
    
                $hotelImage->save();
            }
        }

        return redirect()->route('project.hotel.editConcept', ['hotel_id' => $hotel->id])
        ->with('page_id',request()->page_id)
        ->with('success', '保存しました。');
    }

    public function updateFacilities(Request $request, Hotel $hotel)
    {
        $request->validate([
            'description' => 'required|max:140',
            'url' => 'required|max:140',
            'phone_number' => 'required|max:20',
        ]);

        // フォームから送信された設備のIDの配列を取得
        $selectedFacilities = $request->input('facilities');

        // ホテルデータの保存処理
        $hotel->update([
            'description' => $request->description,
            'url' => $request->url,
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->route('project.hotel.editFacilities', ['hotel_id' => $hotel->id])
        ->with('page_id',request()->page_id)
        ->with('success', '保存しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect()->route('project.hotel.index')
            ->with('success','ホテル'.$hotel->name.'を削除しました');
    }
}
