<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {


        $groups = Setting::select('group')->distinct()->pluck('group');
        $settings = Setting::all()->groupBy('group');

        return view('admin.settings.index', compact('groups', 'settings'));
    }

    public function update(Request $request)
    {
       

        $data = $request->except('_token');

        foreach ($data as $key => $value) {
            if ($request->hasFile($key)) {
                $folder = public_path('StockPiece/settings');
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }

                $file = $request->file($key);
                $filename = time() . '_' . uniqid() . '.' . $file->extension();
                $file->move($folder, $filename);
                $value = $filename;
            }

            Setting::setValue($key, $value);
        }

        return redirect()->route('settings.index')
            ->with('success', 'Paramètres mis à jour avec succès');
    }

    public function byGroup($group)
    {


        $settings = Setting::where('group', $group)->get();

        return view('admin.settings.group', compact('group', 'settings'));
    }
}
