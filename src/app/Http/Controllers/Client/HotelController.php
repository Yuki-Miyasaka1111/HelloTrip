<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Category;
use App\Models\Prefecture;
use App\Models\HotelImage;
use App\Models\Facility;
use App\Models\Amenity;
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
     * Store a newly created resource in storage.
     */
    public function storeBasicInformation(Request $request)
    {
        $request->validate([
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'name' => 'required|max:20',
            'facility_scale' => 'required|integer',
            'category_id' => 'required|integer',
            'prefecture_id' => 'required|integer',
            'area_id' => 'integer',
            'catch_copy' => 'required|max:40',
            'minimum_price' => 'integer',
            'postal_code' => 'required|max:7',
            'address_1' => 'required|max:40',
            'address_2' => 'required|max:40',
            'address_3' => 'max:40',
            'phone_number' => 'required|max:20',
            'url' => 'required|max:140',
            'access' => 'max:140',
            'check_in' => 'required|max:140',
            'check_out' => 'required|max:140',
            'parking_information' => 'max:40',
            'monthly_holiday' => 'max:40',
            'temporary_holiday' => 'max:40',
            'other_information' => 'max:40',
            'other_facility_information' => 'max:140',
        ]);
    
        // ホテルデータの保存処理
        $hotel = new Hotel;
        $hotel->name = $request->name;
        $hotel->facility_scale = $request->facility_scale;
        $hotel->category_id = $request->category_id;
        $hotel->prefecture_id = $request->prefecture_id;
        $hotel->area_id = $request->area_id;
        $hotel->minimum_price = $request->minimum_price;
        $hotel->postal_code = $request->postal_code;
        $hotel->address_1 = $request->address_1;
        $hotel->address_2 = $request->address_2;
        $hotel->address_3 = $request->address_3;
        $hotel->phone_number = $request->phone_number;
        $hotel->url = $request->url;
        $hotel->access = $request->access;
        $hotel->check_in = $request->check_in;
        $hotel->check_out = $request->check_out;
        $hotel->parking_information = $request->parking_information;
        $hotel->monthly_holiday = $request->monthly_holiday;
        $hotel->temporary_holiday = $request->temporary_holiday;
        $hotel->other_information = $request->other_information;
        $hotel->other_facility_information = $request->other_facility_information;
        $hotel->client_id = Auth::guard('client')->user()->id;
        $hotel->save();

        // 画像ファイルのアップロード処理
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $path = Storage::putFileAs('public/img/hotel_images', $image, $filename);
    
                $hotelImage = new HotelImage;
                $hotelImage->hotel_id = $hotel->id;
                $hotelImage->filename = $filename;
                $hotelImage->path = $path;
    
                $hotelImage->save();
            }
        }
    
        return redirect()->route('project.hotel.editBasicInformation', ['hotel_id' => $hotel->id])
            ->with('success');
    }

    public function storeConcept(Request $request)
    {
        $request->validate([
            'concept' => 'required|max:140',
        ]);
    
        // ホテルデータの保存処理
        $hotel = new Hotel;
        $hotel->concept = $request->concept;
        $hotel->client_id = Auth::guard('client')->user()->id;
        $hotel->save();
    
        return redirect()->route('project.hotel.editConcept', ['hotel_id' => $hotel->id])
            ->with('page_id',request()->page_id)
            ->with('success');
    }

    public function storeFacilities(Request $request)
    {
        $request->validate([
            'facilities' => 'array',
            'amenities' => 'array',
        ]);

        $hotel = Hotel::find($request->hotel_id);
        $hotel->facilities()->sync($request->facilities);
        $hotel->amenities()->sync($request->amenities);

        return redirect()->route('project.hotel.editFacilities', ['hotel_id' => $hotel->id])
            ->with('page_id',request()->page_id)
            ->with('success');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editBasicInformation($hotel_id, $imageSlots = 8)
    {
        if (Auth::guard('client')->check()) {
            $client = Auth::user();
            $selected_hotel = Hotel::where('client_id', $client->id)
                ->where('id', $hotel_id)
                ->firstOrFail();
            $categories = Category::all();
            $prefectures = Prefecture::all();
            $hotelImages = HotelImage::where('hotel_id', $hotel_id)->take($imageSlots)->get();
    
            return view('client.hotel.editBasicInformation', compact('selected_hotel', 'categories', 'prefectures', 'hotelImages', 'imageSlots'));
        } else {
            return redirect()->route('client.login');
        }
    }    

    public function editConcept($hotel_id)
    {
        if (Auth::guard('client')->check()) {
            $client = Auth::user();
            $selected_hotel = Hotel::where('client_id', $client->id)
                ->where('id', $hotel_id)
                ->firstOrFail();
            return view('client.hotel.editConcept', compact('selected_hotel'));
        } else {
            return redirect()->route('client.login');
        }
    }

    public function editFacilities($hotel_id)
    {
        if (Auth::guard('client')->check()) {
            $client = Auth::user();
            $selected_hotel = Hotel::where('client_id', $client->id)
                ->where('id', $hotel_id)
                ->firstOrFail();
            $facilities = Facility::all();
            $amenities = Amenity::all();
            $selected_facilities = $selected_hotel->facilities->pluck('id')->toArray();
            $selected_amenities = $selected_hotel->amenities->pluck('id')->toArray();

            return view('client.hotel.editFacilities', compact('selected_hotel', 'facilities', 'amenities', 'selected_facilities', 'selected_amenities'));
        } else {
            return redirect()->route('client.login');
        }
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function updateBasicInformation(Request $request, Hotel $hotel)
    {
        $request->validate([
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'name' => 'required|max:20',
            'facility_scale' => 'required|integer',
            'category_id' => 'required|integer',
            'prefecture_id' => 'required|integer',
            'area_id' => 'integer',
            'catch_copy' => 'required|max:40',
            'minimum_price' => 'integer',
            'postal_code' => 'required|max:7',
            'address_1' => 'required|max:40',
            'address_2' => 'required|max:40',
            'address_3' => 'max:40',
            'phone_number' => 'required|max:20',
            'url' => 'required|max:140',
            'access' => 'max:140',
            'check_in' => 'required|max:140',
            'check_out' => 'required|max:140',
            'parking_information' => 'max:40',
            'monthly_holiday_week' => 'max:40',
            'monthly_holiday_day' => 'max:40',
            'temporary_holiday' => 'max:40',
            'other_information' => 'max:40',
            'other_facility_information' => 'max:140',
        ]);

        // ホテルデータの保存処理
        $hotel = Hotel::find($request->hotel_id);
        $hotel->name = $request->input(["name"]);
        $hotel->facility_scale = $request->input(["facility_scale"]);
        $hotel->category_id = $request->input(["category_id"]);
        $hotel->prefecture_id = $request->input(["prefecture_id"]);
        $hotel->catch_copy = $request->input(["catch_copy"]);
        $hotel->area_id = $request->input(["area_id"]);
        $hotel->minimum_price = $request->input(["minimum_price"]);
        $hotel->postal_code = $request->input(["postal_code"]);
        $hotel->address_1 = $request->input(["address_1"]);
        $hotel->address_2 = $request->input(["address_2"]);
        $hotel->address_3 = $request->input(["address_3"]);
        $hotel->phone_number = $request->input(["phone_number"]);
        $hotel->url = $request->input(["url"]);
        $hotel->access = $request->input(["access"]);
        $hotel->check_in = $request->input(["check_in"]);
        $hotel->check_out = $request->input(["check_out"]);
        $hotel->parking_information = $request->input(["parking_information"]);
        $hotel->other_information = $request->input(["other_information"]);
        $hotel->other_facility_information = $request->input(["other_facility_information"]);
        $hotel->save();

        // 既存の月定休日データを全て削除
        $hotel->monthlyHolidays()->delete();
        // 新しく送られてきた月定休日データを保存
        for ($i = 0; $i < count($request->monthly_holiday_week); $i++) {
            $monthlyHoliday = [
                'week' => $request->monthly_holiday_week[$i],
                'day' => $request->monthly_holiday_day[$i],
            ];
            $hotel->monthlyHolidays()->create($monthlyHoliday);
        }

        // すべての臨時定休日を削除
        $hotel->temporaryHolidays()->delete();

        // 新しい臨時定休日を追加
        foreach ($request->temporary_holiday as $holiday) {
            $temporaryHoliday = [
                'date' => $holiday,
            ];
            $hotel->temporaryHolidays()->create($temporaryHoliday);
        }

        // 画像ファイルのアップロード処理
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $path = $image->store('img/hotel_images', 'public');
    
                $hotelImage = new HotelImage;
                $hotelImage->hotel_id = $hotel->id;
                $hotelImage->filename = $filename;
                $hotelImage->path = $path;
                $hotelImage->save();
            }
        }
        // dd($hotelImage);
        return redirect()->route('project.hotel.editBasicInformation', ['hotel_id' => $hotel->id])
            ->with('page_id',request()->page_id)
            ->with('hotelImage', $hotelImage)
            // ->with('img_path', $hotelImage->path)
            ->with('success', '保存しました。');
    }

    public function updateConcept(Request $request, Hotel $hotel)
    {
        $request->validate([
            'concept' => 'max:250'
        ]);

        // ホテルデータの保存処理
        $hotel = Hotel::find($request->hotel_id);
        $hotel->concept = $request->input(["concept"]);
        $hotel->save();

        return redirect()->route('project.hotel.editConcept', ['hotel_id' => $hotel->id])
        ->with('page_id',request()->page_id)
        ->with('success', '保存しました。');
    }

    public function updateFacilities(Request $request)
    {
        $request->validate([
            'facilities' => 'array',
            'amenities' => 'array',
        ]);
    
        $hotel = Hotel::find($request->hotel_id);
        $hotel->facilities()->sync($request->facilities);
        $hotel->amenities()->sync($request->amenities);
    
        return redirect()->route('project.hotel.editFacilities', ['hotel_id' => $hotel->id])
            ->with('page_id',request()->page_id)
            ->with('success', '設備情報を保存しました。');
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
