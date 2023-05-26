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
use Illuminate\Support\Facades\Log;

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
     * Show the form for editing the specified resource.
     */
    public function editCampaign($hotel_id, $campaign_id = null)
    {
        if (Auth::guard('client')->check()) {
            $client = Auth::user();
            $selected_hotel = Hotel::where('client_id', $client->id)
                ->where('id', $hotel_id)
                ->firstOrFail();
            $selected_campaign = $campaign_id ? Campaign::findOrFail($campaign_id) : new Campaign;
            $hotelImage = HotelImage::first();
            $image_url = $hotelImage ? $hotelImage->url : null;
            return view('client.campaign.editCampaign', compact('selected_hotel', 'campaign_id', 'selected_campaign', 'image_url'));
        } else {
            return redirect()->route('client.login');
        }
    }


    public function createCampaign($hotel_id, $campaign_id = null)
    {
        if (Auth::guard('client')->check()) {
            $client = Auth::user();
            $selected_hotel = Hotel::where('client_id', $client->id)
                ->where('id', $hotel_id)
                ->firstOrFail();
            $campaign = $campaign_id ? Campaign::findOrFail($campaign_id) : new Campaign;
            $hotelImage = HotelImage::first();
            $image_url = $hotelImage ? $hotelImage->url : null;
            return view('client.campaign.createCampaign', compact('selected_hotel', 'campaign_id', 'campaign', 'image_url'));
        } else {
            return redirect()->route('client.login');
        }
    }

    public function storeCampaign(Request $request, $hotel_id)
    {
        $request->validate([
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'immediate_publication_set' => 'boolean',
            'end_publication_set' => 'boolean',
            'publication_date' => 'required_if:immediate_publication_set,0|date',
            'publication_time' => 'required_if:immediate_publication_set,0|date_format:H:i',
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
        $campaign->client_id = Auth::guard('client')->user()->id;
    
        if ($request->immediate_publication_set) {
            $campaign->publication_date = now();
        } elseif($request->publication_date && $request->publication_time){
            $publication_date = Carbon::parse($request->publication_date);
            $publication_time = Carbon::createFromFormat('H:i', $request->publication_time);
            $campaign->publication_date = $publication_date->copy()->setTime($publication_time->hour, $publication_time->minute);
        }
        $campaign->immediate_publication_set = $request->immediate_publication_set;
    
        if($request->end_publication_set && $request->publication_date && $request->end_publication_time) {
            $end_publication_date = Carbon::parse($request->publication_date);
            $end_publication_time = Carbon::createFromFormat('H:i', $request->end_publication_time);
            $campaign->end_publication_date = $end_publication_date->copy()->setTime($end_publication_time->hour, $end_publication_time->minute);
            $campaign->end_publication_set = $request->end_publication_set;
        } else {
            $campaign->end_publication_date = null;
            $campaign->end_publication_set = $request->end_publication_set;
        } 
    
        $campaign->publish_status = $request->publish_status;
        $campaign->image_url = $request->image_url;
        $campaign->campaign_start_date = $request->campaign_start_date;
        $campaign->campaign_end_date = $request->campaign_end_date;
        $campaign->content = $request->content;
        
        $campaign->save();
    
        $campaign->hotels()->attach($request->hotels);
    
        $client = Auth::user();
        $selected_hotel = Hotel::where('client_id', $client->id)
                ->where('id', $hotel_id)
                ->firstOrFail();
    
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
    
        return redirect()->route('project.campaign.manageCampaign', ['hotel_id' => $selected_hotel->id, 'campaign_id' => $campaign->id])
            ->with('success', 'キャンペーンを登録しました');
    }    

    public function updateCampaign(Request $request, $hotel_id, $campaign_id)
    {
        $request->validate([
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'immediate_publication_set' => 'boolean',
            'end_publication_set' => 'boolean',
            'publication_date' => 'required_if:immediate_publication_set,0|date',
            'publication_time' => 'required_if:immediate_publication_set,0|date_format:H:i',
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
        
        if ($request->input('immediate_publication_set') != $campaign->immediate_publication_set) {
            if($request->input('immediate_publication_set')) {
                $campaign->publication_date = now();
            } else{
                if($request->input('publication_date') && $request->input('publication_time')){
                    $publication_date = Carbon::parse($request->input('publication_date'));
                    $publication_time = Carbon::createFromFormat('H:i', $request->input('publication_time'));
                    $campaign->publication_date = $publication_date->copy()->setTime($publication_time->hour, $publication_time->minute);
                }
            }
            $campaign->immediate_publication_set = $request->input('immediate_publication_set');
        } else {
            if($request->input('publication_date') && $request->input('publication_time')){
                $publication_date = Carbon::parse($request->input('publication_date'));
                $publication_time = Carbon::createFromFormat('H:i', $request->input('publication_time'));
                $campaign->publication_date = $publication_date->copy()->setTime($publication_time->hour, $publication_time->minute);
            }
        }
        
        if($request->input('end_publication_set')) {
            if($request->input('end_publication_date') && $request->input('end_publication_time')) {
                $end_publication_date = Carbon::parse($request->input('end_publication_date'));
                $end_publication_time = Carbon::createFromFormat('H:i', $request->input('end_publication_time'));
                $campaign->end_publication_date = $end_publication_date->copy()->setTime($end_publication_time->hour, $end_publication_time->minute);
            } else {
                // Handle error: Both date and time should be provided if 'end_publication_set' is checked
                // You could return with an error message or throw an exception
                return back()->withInput()->withErrors(['end_publication_time' => 'Please provide both date and time.']);
            }
            $campaign->end_publication_set = $request->input('end_publication_set');
        } else {
            $campaign->end_publication_date = null;
            $campaign->end_publication_set = $request->input('end_publication_set');
        }         
    
        $campaign->publish_status = $request->input('publish_status');
        $campaign->campaign_start_date = $request->input('campaign_start_date');
        $campaign->campaign_end_date = $request->input('campaign_end_date');
        $campaign->title = $request->input('title');
        Log::info('Received content: ' . $request->input('content'));
        $campaign->content = $request->input('content');
    
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
    
        return redirect()->route('project.campaign.editCampaign', ['hotel_id' => $hotel->id, 'campaign_id' => $campaign->id])
            ->with('immediate_publication_set', $request->input('immediate_publication_set'))
            ->with('end_publication_set', $request->input('end_publication_set'))
            ->with('success', 'キャンペーンを更新しました')
            ->withInput();
    }

    public function manageCampaign($hotel_id)
    {
        if (Auth::guard('client')->check()) {
            $client = Auth::user();
            $selected_hotel = Hotel::where('client_id', $client->id)
                ->where('id', $hotel_id)
                ->firstOrFail();
            $selected_campaigns = Campaign::where('client_id', $client->id)->get();
            return view('client.campaign.manageCampaign', compact('selected_hotel', 'selected_campaigns'));
        } else {
            return redirect()->route('client.login');
        }
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
