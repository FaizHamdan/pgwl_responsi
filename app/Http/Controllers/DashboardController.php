<?php

namespace App\Http\Controllers;

use App\Models\Points;
use App\Models\Polylines;
use App\Models\Polygons;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->points = new Points();
        $this->polylines = new Polylines();
    }

    public function index()
    {
        // Path ke file GeoJSON polyline
        $pathPolyline = 'D:\Praktikum\Semester 4\Praktikum PGWL\PGWL\public\storage\geojson\Jalan_TJ.geojson';
        // Membaca file GeoJSON
        $geojsonPolyline = json_decode(file_get_contents($pathPolyline), true);
        // Hitung total polylines
        $total_polylines = count($geojsonPolyline['features']);
        
        $data = [
            "title" => "Dashboard",
            "total_points" => $this->points->count(),
            "total_polylines" => $total_polylines,
        ];
        
        return view('dashboard', $data);
    }
}
