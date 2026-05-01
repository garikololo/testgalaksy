<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Bus;
use App\Models\Driver;
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin,manager');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buses = Bus::all();

        return view('bus.index', compact('buses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();

        return view('bus.create', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required',
            'brand_id' => 'required',
        ]);

        Bus::create($request->all());

        return redirect()->route('buses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function show(Bus $bus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function edit(Bus $bus)
    {
        $brands = Brand::all();
        $drivers = Driver::all();

        return view('bus.edit', compact('bus', 'brands', 'drivers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bus $bus)
    {
        $request->validate([
            'number' => 'required',
            'brand_id' => 'required',
        ]);

        $bus->update($request->all());

        return redirect()->route('buses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bus $bus)
    {
        $bus->delete();

        return back();
    }

    public function attachDriver(Request $request, Bus $bus)
    {
        $bus->drivers()->attach($request->driver_id);

        return back();
    }

    public function detachDriver(Request $request, Bus $bus)
    {
        $bus->drivers()->detach($request->driver_id);

        return back();
    }
}
