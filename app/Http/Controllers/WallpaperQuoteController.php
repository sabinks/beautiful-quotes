<?php

namespace App\Http\Controllers;

use App\Models\WallpaperQuote;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class WallpaperQuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wallpaperQuotes = WallpaperQuote::get();

        return response()->json([
            'data' => $wallpaperQuotes,
            'domain' => config('app.url') . "/storage/wallpaper-quotes"
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image.*' => 'image|max:3072|mimes:jpg,jpeg,png,bmp'
        ]);
        if ($validator->fails()) {

            return response($validator->errors(), 422);
        }

        DB::beginTransaction();
        try {
            $destination_path = '/public/wallpaper-quotes/';
            $files = $request->file('image');
            $data = [];
            if ($files) {
                foreach ($files as $key => $file) {
                    $filename = time() . rand(10000, 99999) .  "." . $file->getClientOriginalExtension();
                    $original_filename = $file->getClientOriginalName();
                    $result = $file->storeAs($destination_path . '/', $filename);
                    if ($result) {
                        $data[$key]['filename'] = $filename;
                        $data[$key]['original_filename'] = $original_filename;
                        $data[$key]['created_at'] = Carbon::now();
                        $data[$key]['updated_at'] = Carbon::now();
                    }
                }
                WallpaperQuote::insert($data);
            }

            DB::commit();

            return response()->json([
                'message' => 'Wallpaper Quotes Added!',
            ], 201);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        } catch (\Throwable $th) {
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $wallpaperQuote = WallpaperQuote::find($id);
        if (!$wallpaperQuote) {
            return response()->json([
                'message' => 'Wallpaper quote not found!',
            ], 404);
        }

        $destination_path = "/public/wallpaper-quotes/";
        Storage::delete($destination_path .  $wallpaperQuote->document_name);
        $result = $wallpaperQuote->delete();
        if ($result) {
            return response()->json([
                'message' => 'Wallpaper quote Deleted!',
            ], 204);
        }
    }
}
