<?php

namespace App\Http\Controllers\Next;

use App\Http\Controllers\Controller;
use App\Models\WallpaperQuote;
use Illuminate\Http\Request;

class WallpaperQuoteController extends Controller
{
    public function index()
    {
        $wallpaperQuotes = WallpaperQuote::get();

        return response()->json([
            'data' => $wallpaperQuotes,
            'domain' => config('app.url') . "/storage/wallpaper-quotes"
        ], 200);
    }
}
