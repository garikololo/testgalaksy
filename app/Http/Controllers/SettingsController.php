<?php

namespace App\Http\Controllers;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function edit()
    {
        $settings = Settings::first();
        return view('settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->all();

        // upload logo
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Settings::updateOrCreate(['id' => 1], $data);

        return back()->with('success', 'Налаштування збережено');
    }
}