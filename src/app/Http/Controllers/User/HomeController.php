<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Category;
use App\Models\Prefecture;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $hotels = Hotel::latest()->paginate(5);
        $categories = Category::all();
        $user_name = '未ログイン';
        $client_name = '未ログイン';
    
        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
            $user_name = $user->name;
        } elseif (Auth::guard('client')->check()) {
            $client = Auth::guard('client')->user();
            $client_name = $client->name;
        }
    
        return view('user.top',compact('hotels', 'categories', 'user_name', 'client_name'))
            ->with('page_id',request()->page)
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $prefectures = Prefecture::all();
        return view('create')
            ->with('categories', $categories)
            ->with('prefectures', $prefectures)
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
            'prefecture_id' => 'required|integer',
            'address' => 'required|max:140',
            'description' => 'required|max:140',
            'url' => 'required|max:140',
            'phone_number' => 'required|max:20',
        ]);

        $hotel = new Hotel;
        // $hotel->name = $request->input(["name"]);
        $hotel->name = $request->name;
        $hotel->price = $request->input(["price"]);
        $hotel->category_id = $request->input(["category_id"]);
        $hotel->prefecture_id = $request->input(["prefecture_id"]);
        $hotel->address = $request->input(["address"]);
        $hotel->description = $request->input(["description"]);
        $hotel->url = $request->input(["url"]);
        $hotel->phone_number = $request->input(["phone_number"]);
        $hotel->user_id = Auth::user()->id; // ユーザーのIDをセット
        $hotel->client_id = Auth::guard('client')->user()->id; // クライアントのIDをセット
        $hotel->client_id = auth()->id();
        $hotel->save();

        return redirect()->route('hotel.index')
            ->with('page_id',request()->page_id)
            ->with('success', 'ホテルを登録しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Home $home)
    {
        $categories = Category::all();
        $prefectures = Prefecture::all();
        return view('show',compact('hotel'))
            ->with('page_id',request()->page_id)
            ->with('categories', $categories)
            ->with('prefectures', $prefectures);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Home $home)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Home $home)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Home $home)
    {
        //
    }
}
