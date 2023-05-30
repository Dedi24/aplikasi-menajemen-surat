<?php

namespace App\Http\Controllers;

use App\Models\KlasifikasiArsip;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class KlasifikasiArsipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $klasifikasi_arsips = KlasifikasiArsip::latest()->paginate(10);
        return view('klasifikasi-arsip.index',compact('klasifikasi_arsips'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('klasifikasi-arsip.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        KlasifikasiArsip::create($request->all());

        return redirect()->route('klasifikasi-arsip.index')
                        ->with('success','Klasifikasi Arsip created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(KlasifikasiArsip $klasifikasi_arsip)
    {
        return view('klasifikasi-arsip.show',compact('klasifikasi_arsip'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KlasifikasiArsip $klasifikasi_arsip)
    {
        return view('klasifikasi-arsip.edit',compact('klasifikasi_arsip'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KlasifikasiArsip $klasifikasi_arsip, string $id)
    {
        //
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        $klasifikasi_arsip->update($request->all());

        return redirect()->route('klasifikasi-arsip.index')
                        ->with('success','Klasifikasi Arsip updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KlasifikasiArsip $klasifikasi_arsip)
    {
        //
        $klasifikasi_arsip->delete();

        return redirect()->route('klasifikasi-arsip.index')
                        ->with('success','Klasifikasi Arsip deleted successfully');
    }
}
