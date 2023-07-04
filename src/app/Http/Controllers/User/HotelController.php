<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\PublishedHotel;
use App\Models\Category;
use App\Models\Prefecture;
use App\Models\HotelImage;
use App\Models\PublishedHotelImage;
use App\Models\PublishedHotelFacility;
use App\Models\PublishedHotelAmenity;
use App\Models\PublishedMonthlyHoliday;
use App\Models\PublishedTemporaryHoliday;
use App\Models\Facility;
use App\Models\Amenity;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    public function index($hotel_id)
    {
        if (Auth::guard('web')->check()) {
            $user = Auth::user();
            $user_name = $user->name;
        } else {
            $user_name = '未ログイン';
        }
        // 選択したホテルのみの情報を取得
        $publishedHotel = PublishedHotel::with('hotel')->whereHas('hotel', function ($query) use ($hotel_id) {
            $query->where('id', $hotel_id)->where('is_public', true);
        })->first();
        // 公開されているキャンペーンのみを取得
        $publishedCampaigns = Campaign::where('publish_status', true)->get();
        $publishedFacilities = PublishedHotelFacility::All();
        $publishedAmenities = PublishedHotelAmenity::All();
        $publishedHotelImages = PublishedHotelImage::All();
        $publishedAmenity = PublishedHotelAmenity::All();
        $publishedMonthlyHoliday = PublishedMonthlyHoliday::All();
        $publishedTemporaryHoliday = PublishedTemporaryHoliday::All();
        $categories = Category::All();
        $facilities = Facility::All();
        $amenities = Amenity::All();
        return view('user.hotel.index', compact('publishedHotel', 'publishedCampaigns', 'publishedFacilities', 'publishedAmenities', 'publishedHotelImages', 'publishedAmenity', 'publishedMonthlyHoliday', 'publishedTemporaryHoliday', 'categories', 'facilities', 'amenities', 'user_name'))
            ->with('page_id', request()->page)
            ->with('user_name', $user_name);
    }

    public function publication(Request $request, $hotel_id = null)
    {
        $client = Auth::user();
        $selected_hotel = Hotel::where('client_id', $client->id)
            ->where('id', $hotel_id)
            ->firstOrFail();
    
        if ($request->input('action') === 'publish') {
            $selected_hotel->is_public = true;
    
            $publishedHotel = $selected_hotel->publishedHotel ?: new PublishedHotel;
            $publishedHotel->fill($selected_hotel->toArray());
    
            // 公開前に、対象のホテルIDに紐づく全てのPublishedHotelImageを削除
            PublishedHotelImage::where('published_hotel_id', $publishedHotel->id)->delete();
    
            // 更新したホテル画像をpublished_hotel_imagesテーブルに保存
            foreach ($selected_hotel->images as $image) {
                $publishedImage = new PublishedHotelImage;
                $publishedImage->fill($image->toArray());
                $publishedImage->published_hotel_id = $publishedHotel->id;
                $publishedImage->save();
            }
    
            $selected_hotel->publishedHotel()->save($publishedHotel);
            $selected_hotel->save();
            
            return redirect()->route('project.hotel.index', ['hotel_id' => $selected_hotel->id])
                ->with('success', '公開しました。');
        } elseif ($request->input('action') === 'unpublish') {
            $selected_hotel->is_public = false;
            $selected_hotel->save();
    
            return redirect()->route('project.hotel.index', ['hotel_id' => $selected_hotel->id])
                ->with('success', '非公開に設定しました。');
        }
    }
}
