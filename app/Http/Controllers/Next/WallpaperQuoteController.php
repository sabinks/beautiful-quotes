<?php

namespace App\Http\Controllers\Next;

use App\Http\Controllers\Controller;
use App\Models\WallpaperQuote;
use Illuminate\Http\Request;

class WallpaperQuoteController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $order_by = $request->has('order_by') ? $request->input('order_by') : 'created_at';
        $order = $request->has('order') ?  $request->input('order') : 'desc';
        $pagination = $request->has('pagination') ? $request->input('pagination') : 10;
        $paginatedData = WallpaperQuote::latest()->paginate($pagination);

        return response()->json([
            'paginatedData' => $paginatedData,
            'domain' => config('app.url') . "/storage/wallpaper-quotes"
        ], 200);
    }
}
