<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::guard('client')->check()) {
            $client = Auth::user();
            if ($client->email === 'info@micado.jp') {
                $campaigns = Campaign::latest()->paginate(5);
            } else {
                $campaigns = Campaign::where('client_id', $client->id)->latest()->paginate(5);
            }
            $client_name = $client->name;
            return view('client.campaign.index',compact('campaigns'))
                ->with('page_id',request()->page)
                ->with('client_name', $client_name)
                ->with('i', (request()->input('page', 1) - 1) * 5);
        } else {
            return redirect()->route('client.login');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('client.campaign.create')
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:50',
            'description' => 'required|max:140',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d',
            'hotels' => 'required|array|min:1',
        ]);
    
        $campaign = new Campaign;
        $campaign->title = $request->title;
        $campaign->description = $request->description;
        $campaign->start_date = $request->start_date;
        $campaign->end_date = $request->end_date;
        $campaign->client_id = Auth::guard('client')->user()->id;
        
        $campaign->save();

        $campaign->hotels()->attach($request->hotels); // リレーションシップを保存
    
        return redirect()->route('project.campaign.index')
            ->with('page_id',request()->page_id)
            ->with('success', 'キャンペーンを登録しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Campaign $campaign)
    {
        $hotels = $campaign->hotels;

        return view('client.campaign.show',compact('campaign', 'hotels'))
            ->with('page_id',request()->page_id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Campaign $campaign)
    {
        $campaign->start_date = Carbon::parse($campaign->start_date);
        $campaign->end_date = Carbon::parse($campaign->end_date);
        $attached_hotels_ids = $campaign->hotels->pluck('id')->toArray();

        return view('client.campaign.edit', compact('campaign', 'attached_hotels_ids'))
            ->with('page_id',request()->page_id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Campaign $campaign)
    {
        $request->validate([
            'title' => 'required|max:50',
            'description' => 'required|max:140',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d',
            'hotels' => 'required|array|min:1',
        ]);

        $campaign->title = $request->input(["title"]);
        $campaign->description = $request->input(["description"]);
        $campaign->start_date = $request->input(["start_date"]);
        $campaign->end_date = $request->input(["end_date"]);
        $campaign->save();

        $campaign->hotels()->sync($request->input("hotels")); 

        return redirect()->route('project.campaign.index')
            ->with('page_id',request()->page_id)
            ->with('success','キャンペーンを更新しました');
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
