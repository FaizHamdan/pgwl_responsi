<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Polyline;

class YourController extends Controller
{
    public function index()
    {
        // Fetch polyline data from your database
        $polylines = Polyline::all(); // Adjust this based on your model setup

        // Read GeoJSON file content
        $geojsonFile = Storage::disk('public')->get('geojson/Jalan_TJ.geojson');
        $geojson = json_decode($geojsonFile);

        // Pass polyline data and GeoJSON data to the view
        return view('your-view', [
            'polylines' => $polylines,
            'geojson' => $geojson
        ]);
    }
}
