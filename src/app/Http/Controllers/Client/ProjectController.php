<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Category;
use App\Models\Prefecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Diglactic\Breadcrumbs\Breadcrumbs;

class ProjectController extends Controller
{
    public function index()
    {
        if (Auth::guard('client')->check()) {
            $client = Auth::user();
            if ($client->email === 'info@micado.jp') {
                $hotels = Hotel::latest()->paginate(5);
            } else {
                $hotels = Hotel::where('client_id', $client->id)->latest()->paginate(5);
            }
            $client_name = $client->name;
    
            // Breadcrumbs::render()に適切な名前を渡します。
            $breadcrumbs = Breadcrumbs::render('project.hotel.index');
    
            return view('client.index',compact('hotels', 'breadcrumbs'))
                ->with('page_id',request()->page)
                ->with('client_name', $client_name)
                ->with('i', (request()->input('page', 1) - 1) * 5);
        } else {
            return redirect()->route('client.login');
        }
    }

    // public function createProject()
    // {
    //     if (Auth::guard('client')->check()) {
    //         $client = Auth::user();
    //         if ($client->email === 'info@micado.jp') {
    //             $hotels = Hotel::latest()->paginate(5);
    //         } else {
    //             $hotels = Hotel::where('client_id', $client->id)->latest()->paginate(5);
    //         }
    //         $client_name = $client->name;
    
    //         // Breadcrumbs::render()に適切な名前を渡します。
    //         $breadcrumbs = Breadcrumbs::render('project.hotel.index');
    
    //         return view('client.index',compact('hotels', 'breadcrumbs'))
    //             ->with('page_id',request()->page)
    //             ->with('client_name', $client_name)
    //             ->with('i', (request()->input('page', 1) - 1) * 5);
    //     } else {
    //         return redirect()->route('client.login');
    //     }
    // }

    public function storeProject(Request $request)
    {
        $request->validate([
            'thumbnail.*' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'name' => 'required|max:20'
        ]);
    
        // ホテルデータの保存処理
        $hotel = new Hotel;
        $hotel->name = $request->name;
        $hotel->client_id = Auth::guard('client')->user()->id;

        // 画像ファイルのアップロード処理
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
        
            // publicディレクトリにファイルを保存し、そのパスを取得
            $path = $file->store('public/img/hotel_images');
            // 'public/'から始まるパスを取り除き、その結果をデータベースに保存
            $image_url = str_replace('public/', '', $path);
            $hotel->thumbnail = $image_url;
        }

        $hotel->save();
    
        return redirect()->route('project.index')
            ->with('success');
    }
}
