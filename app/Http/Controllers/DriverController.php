<?php

namespace App\Http\Controllers;

use App\Jobs\SendDriverRemoveEmail;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
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
        if (auth()->user()->role === 'driver') {
            return redirect()->route('drivers.profile');
        }

        $drivers = Driver::all();

        return view('drivers.index', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('drivers.create');
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'salary' => 'required',
            'birth_date' => [
                'required',
                'date',
                function ($attr, $value, $fail) {
                    if (now()->diffInYears($value) > 65) {
                        $fail('Водій не може бути старше 65 років');
                    }
                },
            ],
        ]);

        $data = $request->all();
        $data['image'] = $request->image ?? [];

        Driver::create($data);

        return redirect()->route('drivers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        return view('drivers.edit', compact('driver'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Driver $driver)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'salary' => 'required',
            'birth_date' => [
                'required',
                'date',
                function ($attr, $value, $fail) {
                    if (now()->diffInYears($value) > 65) {
                        $fail('Водій не може бути старше 65 років');
                    }
                },
            ],
        ]);

        $data = $request->all();
        $data['image'] = $request->image ?? [];

        $driver->update($data);

        return redirect()->route('drivers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver)
    {
        $driver->delete();

        $driver->buses()->detach();

        SendDriverRemoveEmail::dispatch($driver)
            ->delay(now()->addHours(24));

        return back();
    }

    public function olds()
    {
        $drivers = Driver::onlyTrashed()->get();

        return view('drivers.olds', compact('drivers'));
    }
}
