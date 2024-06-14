<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Polylines extends Model
{
    use HasFactory;

    protected $table = 'RUTE';

    protected $guarded = ['id'];

    public function polylines()
    {
        return $this->select(DB::raw('id, name, popupinfo, ST_AsGeoJSON(geom) as geom'))->get();
    }

    public function polyline($id)
    {
        return $this->select(DB::raw('id, name, popupinfo, ST_AsGeoJSON(geom) as geom'))->where('id', $id)->get();
    }
}