<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\Prefecture;
use App\Models\HotelImage;
use App\Models\Facility;
use App\Models\Amenity;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CampaignController extends Controller
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

            return view('client.campaign.index', compact('selected_hotel'))
                ->with('page_id', request()->page)
                ->with('client_name', $client_name);
        } else {
            return redirect()->route('client.login');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeRegisterCampaign(Request $request)
    {
        $request->validate([
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'immediate_publication_set' => 'boolean',
            'end_publication_set' => 'boolean',
            'publication_date' => 'nullable|date',
            'publication_time' => 'nullable|date_format:H:i',
            'end_publication_date' => 'required_if:end_publication_set,1|date',
            'end_publication_time' => 'required_if:end_publication_set,1|date_format:H:i',
            'publish_status' => 'integer',
            'campaign_start_date' => 'nullable|date',
            'campaign_end_date' => 'nullable|date',
            'title' => 'string',
            'content' => 'nullable|string',
        ]);
    
        $campaign = new Campaign;
        $campaign->title = $request->title;
        $campaign->description = $request->description;
        $campaign->start_date = $request->start_date;
        $campaign->end_date = $request->end_date;
        $campaign->client_id = Auth::guard('client')->user()->id;
        $campaign->immediate_publication_set = $request->immediate_publication_set;
        $campaign->publication_date = $request->publication_date;
        $campaign->end_publication_date = $request->end_publication_date;
        $campaign->publish_status = $request->publish_status;
        $campaign->image_url = $request->image_url;
        $campaign->campaign_start_date = $request->campaign_start_date;
        $campaign->campaign_end_date = $request->campaign_end_date;
        $campaign->content = $request->content;
        
        $campaign->save();

        $campaign->hotels()->attach($request->hotels);

        // 画像ファイルのアップロード処理
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = $image->getClientOriginalName();
                $path = Storage::putFileAs('public/campaign_images', $image, $filename);

                $campaignImage = new CampaignImage;
                $campaignImage->campaign_id = $campaign->id;
                $campaignImage->filename = $filename;
                $campaignImage->path = $path;

                $campaignImage->save();
            }
        }
    
        return redirect()->route('project.campaign.editRegisterCampaign', ['hotel_id' => $hotel->id, 'campaign_id' => $campaign->id])
            ->with('success', 'キャンペーンを登録しました');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editRegisterCampaign($hotel_id, $campaign_id = null)
    {
        if (Auth::guard('client')->check()) {
            $client = Auth::user();
            $selected_hotel = Hotel::where('client_id', $client->id)
                ->where('id', $hotel_id)
                ->firstOrFail();
            $campaign = $campaign_id ? Campaign::findOrFail($campaign_id) : new Campaign;
            $hotelImage = HotelImage::first();
            $image_url = $hotelImage ? $hotelImage->url : null;
            return view('client.campaign.editRegisterCampaign', compact('selected_hotel', 'campaign_id', 'campaign', 'image_url'));
        } else {
            return redirect()->route('client.login');
        }
    }

    public function editManageCampaign($hotel_id)
    {
        if (Auth::guard('client')->check()) {
            $client = Auth::user();
            $selected_hotel = Hotel::where('client_id', $client->id)
                ->where('id', $hotel_id)
                ->firstOrFail();
            return view('client.campaign.editManageCampaign', compact('selected_hotel'));
        } else {
            return redirect()->route('client.login');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateRegisterCampaign(Request $request, $hotel_id, $campaign_id)
    {
        $request->validate([
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'immediate_publication_set' => 'boolean',
            'end_publication_set' => 'boolean',
            'publication_date' => 'nullable|date',
            'publication_time' => 'nullable|date_format:H:i',
            'end_publication_date' => 'required_if:end_publication_set,1|date',
            'end_publication_time' => 'required_if:end_publication_set,1|date_format:H:i',
            'publish_status' => 'integer',
            'campaign_start_date' => 'nullable|date',
            'campaign_end_date' => 'nullable|date',
            'title' => 'string',
            'content' => 'nullable|string',
        ]);
    
        $hotel = Hotel::find($request->hotel_id);
        $campaign = Campaign::find($request->campaign_id);
        $campaign->immediate_publication_set = $request->input('immediate_publication_set');
    
        if ($request->input('immediate_publication_set')) {
            $campaign->publication_date = now();
        } else {
            $publication_date = Carbon::parse($request->input('publication_date'));
            $publication_time = Carbon::createFromFormat('H:i', $request->input('publication_time'));
            $campaign->publication_date = $publication_date->copy()->setTime($publication_time->hour, $publication_time->minute);
        }
    
        // if($request->input('end_publication_set')) {
            $end_publication_date = Carbon::parse($request->input('end_publication_date'));
            $end_publication_time = Carbon::createFromFormat('H:i', $request->input('end_publication_time'));
            $campaign->end_publication_date = $end_publication_date->copy()->setTime($end_publication_time->hour, $end_publication_time->minute);
        // } else {
        //     $campaign->end_publication_date = null;
        // }
    
        // Updating other fields
        $campaign->publish_status = $request->publish_status;
        $campaign->campaign_start_date = $request->campaign_start_date;
        $campaign->campaign_end_date = $request->campaign_end_date;
        $campaign->content = $request->content;
    
        $campaign->save();
    
        // Image upload process
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = $image->getClientOriginalName();
                $path = Storage::putFileAs('public/campaign_images', $image, $filename);
    
                $campaignImage = new CampaignImage;
                $campaignImage->campaign_id = $campaign->id;
                $campaignImage->filename = $filename;
                $campaignImage->path = $path;
    
                $campaignImage->save();
            }
        }
    
        return redirect()->route('project.campaign.editRegisterCampaign', ['hotel_id' => $hotel->id, 'campaign_id' => $campaign->id])
            ->with('success', 'キャンペーンを更新しました');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Campaign $campaign)
    {
        $campaign->delete();
        return redirect()->route('project.campaign.index')
            ->with('success','キャンペーン'.$campaign->name.'を削除しました');
    }
}
