<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function show()
    {
        $setting = Setting::query()->firstOrCreate();

        $setting->map =  preg_match('/src="([^"]+)"/', $setting->map, $matches) ? $matches[1] : null;

        return successResponse(data: $setting);
    }
}
