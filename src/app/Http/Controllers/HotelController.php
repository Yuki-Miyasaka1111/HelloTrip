<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Category;
use App\Models\Prefecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotels = Hotel::latest()->paginate(5);
        $user_name = '未ログイン';
        $client_name = '未ログイン';
        
        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
            $user_name = $user->name;
        } elseif (Auth::guard('client')->check()) {
            $client = Auth::guard('client')->user();
            $client_name = $client->name;
        }
        
        return view('index',compact('hotels'))
            ->with('page_id',request()->page)
            ->with('user_name', $user_name)
            ->with('client_name', $client_name)
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
        $hotel->name = $request->name;
        $hotel->price = $request->price;
        $hotel->category_id = $request->category_id;
        $hotel->prefecture_id = $request->prefecture_id;
        $hotel->address = $request->address;
        $hotel->description = $request->description;
        $hotel->url = $request->url;
        $hotel->phone_number = $request->phone_number;
        $hotel->user_id = Auth::user()->id;
        
        $hotel->save();
    
        return redirect()->route('hotel.index')
            ->with('page_id',request()->page_id)
            ->with('success', 'ホテルを登録しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel)
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
    public function edit(Hotel $hotel)
    {
        $categories = Category::all();
        $prefectures = Prefecture::all();
        return view('edit', compact('hotel'))
            ->with('page_id',request()->page_id)
            ->with('categories', $categories)
            ->with('prefectures', $prefectures);
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
            'prefecture_id' => 'required|integer',
            'address' => 'required|max:140',
            'description' => 'required|max:140',
            'url' => 'required|max:140',
            'phone_number' => 'required|max:20',
        ]);

        $hotel->name = $request->input(["name"]);
        $hotel->price = $request->input(["price"]);
        $hotel->category_id = $request->input(["category_id"]);
        $hotel->prefecture_id = $request->input(["prefecture_id"]);
        $hotel->address = $request->input(["address"]);
        $hotel->description = $request->input(["description"]);
        $hotel->url = $request->input(["url"]);
        $hotel->phone_number = $request->input(["phone_number"]);
        $hotel->save();
        return redirect()->route('hotel.index')
            ->with('page_id',request()->page_id)
            ->with('success','ホテルを更新しました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect()->route('hotel.index')
            ->with('success','ホテル'.$hotel->name.'を削除しました');
    }

    //未ログイン時にログインさせる
    // public function __construct(){
    //     $this->middleware('auth');
    // }
}
