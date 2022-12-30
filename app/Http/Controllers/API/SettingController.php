<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\SettingService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    //
    protected $settingService;

    // Constructor Service
    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function updateSetting(Request $request)
    {
        $response = $this->settingService->updateSetting($request->all());
        // dd("opk");
        // return response()->json($response);
        return $response;
    }
}
