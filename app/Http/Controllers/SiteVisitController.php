<?php

namespace App\Http\Controllers;

use App\Models\SiteVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiteVisitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
    public function visitCount(Request $request)
    {
        $ipAddress = $request->ipAddress ?: "";
        $visitedCount = SiteVisit::whereIpAddress($ipAddress)->first();
        if ($visitedCount) {
            $visitedCount->count += 1;
            $visitedCount->save();
        } else {
            $siteVisit = SiteVisit::create([
                'ip_address' => $ipAddress,
                'count' => 1
            ]);
        }
    }
}
