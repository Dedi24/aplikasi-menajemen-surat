<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\Provinsi;
use Laravolt\Indonesia\Models\Village;

class IdentitasPpsController extends Controller
{
    public function index()
    {
        $provinsi = \Indonesia::allProvinces()->sortBy('name')->pluck('name', 'id', 'code');
        $route_get_kota = route('get.kota');
        $route_get_kecamatan = route('get.kecamatan');
        $route_get_kelurahan = route('get.kelurahan');
    return view('identitas-pps.index', compact('provinsi', 'route_get_kota', 'route_get_kecamatan', 'route_get_kelurahan'));
    }

    public function create()
    {
        $villages_code = request('district_code.city_code.province_code');
        $desa = \Indonesia::findVillage($villages_code, ['district.city.province'])->villages->districts->cities->provinsi->sortBy('name')->pluck('name', 'district_code.city_code.province_code');
        return view('identitas-pps.create', compact('desa'));
    }

    public function get_kota()
    {
        $province_id = request('province_id');
        $kota = \Indonesia::findProvince($province_id, ['cities'])->cities->sortBy('name')->pluck('name', 'id', 'province_code');
        return view('identitas-pps.list_kota', compact('kota'));
    }

    public function get_kecamatan()
    {
        $city_id = request('city_id');
        $kecamatan = \Indonesia::findCity($city_id, ['districts'])->districts->sortBy('name')->pluck('name', 'id');

        return view('identitas-pps.list_kecamatan', compact('kecamatan'));
    }

    public function get_kelurahan()
    {
        $kecamatan_id = request('kecamatan_id');
        $kelurahan = \Indonesia::findDistrict($kecamatan_id, ['villages'])->villages->sortBy('name')->pluck('name', 'id');

        return view('identitas-pps.list_kelurahan', compact('kelurahan'));
    }
}
