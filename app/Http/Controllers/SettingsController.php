<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:general_setting')->only(['index', 'store']);
    }
    
    public function index() 
    {
        $setting = Setting::first();
        return view('pages.admin.settings.index', compact('setting'));
    }

    public function store(Request $request) 
    {
        $data = $request->all();
        if($request->has('active_sms')) 
            $data['active_sms'] = 1;
        else
            $data['active_sms'] = 0;

        if($request->has('is_maitanence_mood')) 
            $data['is_maitanence_mood'] = 1;
        else
            $data['is_maitanence_mood'] = 0;
        $setting = Setting::first();
        $setting->update($data);
        return redirect()->route('settings.general')->with('updated', 'Setting update successfull!');
    }

}
