<?php

namespace App\Http\Controllers;

use App\Models\AddSetting;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddSettingController extends Controller
{
    function create()
    {
        $setting = AddSetting::where('type', 2)->first();
        return view('admin.setting.add-setting', compact('setting'));
    }

    public function update(Request $request, $id = null)
    {
        // return $request;
        if ($id) {
            // Update existing setting
            $setting = AddSetting::find($id);
            if ($setting) {
                $this->updateSetting($setting, $request);
                Toastr::success('Add Setting updated successfully.');
            } else {
                Toastr::error('Setting not found.');
            }
        } else {
            // Add new setting
            $setting = new AddSetting;
            $this->updateSetting($setting, $request);
            Toastr::success('New Add Setting created successfully.');
        }

        return back();
    }

    private function updateSetting($setting, $request)
    {
        $setting->type = $request->type;
        $setting->price = $request->price;
        $setting->mob_bn_price = $request->mob_bn_price;
        $setting->side_bn_price = $request->side_bn_price;
        $setting->created_by = Auth::guard('admin')->user()->id;
        $setting->updated_by = Auth::guard('admin')->user()->id;
        $setting->save();
    }
}
