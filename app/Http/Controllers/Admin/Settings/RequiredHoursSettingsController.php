<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RequiredHoursSettingsController extends Controller
{

    public function show(Settings $settings)
    {
        $required_hours=Settings::value('required_hours');
        return view('admin.settings.required-hours',compact('required_hours'));
    }

    public function edit(Settings $settings)
    {
        $required_hours=Settings::value('required_hours');
        return view('admin.settings.required-hours-edit',compact('required_hours'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'required_hours'=>'required|numeric|min:0'
        ]);
        DB::table('settings')->update([
            'required_hours'=>$request->required_hours
        ]);
        return redirect(route('required_hours/show'))->with('success','Required Hours Updated Successfuly');
    }

}
