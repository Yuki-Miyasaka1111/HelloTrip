<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\Prefecture;
use App\Models\HotelImage;
use App\Models\CampaignImage;
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

    public function createCampaign($hotel_id, $campaign_id = null, $imageSlots = 1)
    {
        if (Auth::guard('client')->check()) {
            $client = Auth::user();
            $selected_hotel = Hotel::where('client_id', $client->id)
                ->where('id', $hotel_id)
                ->firstOrFail();
            $campaign = new Campaign;
            return view('client.campaign.createCampaign', compact('selected_hotel', 'campaign_id', 'campaign', 'imageSlots'));
        } else {
            return redirect()->route('client.login');
        }
    }

    public function storeCampaign(Request $request, $hotel_id)
    {
        $request->validate([
            'campaign_images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'immediate_publication_set' => 'boolean',
            'end_publication_set' => 'boolean',
            'publication_date' => 'required_if:immediate_publication_set,0|date',
            'publication_time' => 'required_if:immediate_publication_set,0|date_format:H:i',
            'end_publication_date' => 'required_if:end_publication_set,1|date|date_greater_than:publication_date',
            'end_publication_time' => 'required_if:end_publication_set,1|date_format:H:i',
            'publish_status' => 'boolean',
            'campaign_start_date' => 'nullable|date',
            'campaign_end_date' => 'nullable|date|date_greater_than:campaign_start_date',
            'title' => 'string',
            'content' => 'nullable|string',
        ]);

        $client = Auth::user();
        $selected_hotel = Hotel::where('client_id', $client->id)
                ->where('id', $hotel_id)
                ->firstOrFail();
    
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
        $campaign->campaign_start_date = $request->campaign_start_date;
        $campaign->campaign_end_date = $request->campaign_end_date;
        $campaign->content = $request->content;
        $campaign->hotel_id = $selected_hotel->id;

        $campaign->save();

        // 画像ファイルのアップロード処理
        if ($request->hasFile('campaign_images')) {
            foreach ($request->file('campaign_images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $path = $image->store('img/campaign_images', 'public');
                $hash = hash_file('sha256', storage_path('app/public/' . $path));

                $campaignImage = new CampaignImage;
                $campaignImage->campaign_id = $campaign->id;
                $campaignImage->filename = $filename;
                $campaignImage->path = $path;
                $campaignImage->hash = $hash;
                $campaignImage->save();
            }
        }
    
        return redirect()->route('project.campaign.manageCampaign', ['hotel_id' => $selected_hotel->id, 'campaign_id' => $campaign->id])
            ->with('success', 'キャンペーンを登録しました');
    }

    public function editCampaign($hotel_id, $campaign_id = null, $imageSlots = 1)
    {
        if (Auth::guard('client')->check()) {
            $client = Auth::user();
            $selected_hotel = Hotel::where('client_id', $client->id)
                ->where('id', $hotel_id)
                ->firstOrFail();
            $selected_campaign = Campaign::where('client_id', $client->id)
                ->where('id', $campaign_id)
                ->firstOrFail();
            $campaignImages = CampaignImage::where('campaign_id', $campaign_id)->take($imageSlots)->get();
            return view('client.campaign.editCampaign', compact('selected_hotel', 'selected_campaign', 'campaign_id', 'campaignImages', 'imageSlots'));
        } else {
            return redirect()->route('client.login');
        }
    }

    public function updateCampaign(Request $request, $hotel_id, $campaign_id)
    {
        $request->validate([
            'campaign_images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'immediate_publication_set' => 'boolean',
            'end_publication_set' => 'boolean',
            'publication_date' => 'required_if:immediate_publication_set,0|date',
            'publication_time' => 'required_if:immediate_publication_set,0|date_format:H:i',
            'end_publication_date' => 'required_if:end_publication_set,1|date|date_greater_than:publication_date',
            'end_publication_time' => 'required_if:end_publication_set,1|date_format:H:i',
            'publish_status' => 'boolean',
            'campaign_start_date' => 'nullable|date',
            'campaign_end_date' => 'nullable|date|date_greater_than:campaign_start_date',
            'title' => 'string',
            'content' => 'nullable|string',
        ]);
    
        $hotel = Hotel::find($request->hotel_id);
        $campaign = Campaign::find($request->campaign_id);

        // 画像ファイルのアップロード処理
        $campaignImage = null;
        if ($request->hasFile('campaign_images')) {
            $existingImages = CampaignImage::where('campaign_id', $campaign->id)->get();

            foreach ($request->file('campaign_images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $path = $image->store('img/campaign_images', 'public');
                $hash = hash_file('sha256', storage_path('app/public/' . $path));

                // データベースに同じ画像が保存してあるかの確認
                $duplicate = false;
                foreach ($existingImages as $existingImage) {
                    if ($existingImage->hash === $hash) {
                        $duplicate = true;
                        break;
                    }
                }

                // データベースに同じ画像が保存してなかった場合の処理
                if (!$duplicate) {
                    $campaignImage = new CampaignImage;
                    $campaignImage->campaign_id = $campaign->id;
                    $campaignImage->filename = $filename;
                    $campaignImage->path = $path;
                    $campaignImage->hash = $hash;
                    $campaignImage->save();
                }
            }
        }
        
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
        $campaign->content = $request->input('content');
    
        $campaign->save();
    
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
            $selected_campaigns = Campaign::where('client_id', $client->id)
                ->where('hotel_id', $hotel_id)
                ->get();
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
