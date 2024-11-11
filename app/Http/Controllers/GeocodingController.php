<?php

namespace App\Http\Controllers;

use App\Services\GeocodingService;
use Illuminate\Http\Request;

class GeocodingController extends Controller
{
    protected $geocodingService;

    public function __construct(GeocodingService $geocodingService)
    {
        $this->geocodingService = $geocodingService;
    }

    public function getAddressFromCoordinates(Request $request)
    {
        $lat = $request->query('lat');
        $lng = $request->query('lng');
        $address = $this->geocodingService->getAddressFromCoordinates($lat, $lng);

        return response()->json($address);
    }
}