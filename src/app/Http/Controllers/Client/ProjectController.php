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

    public function createProject()
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
}
