<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\OvertimeService;
use Illuminate\Http\Request;

class OvertimeController extends Controller
{
    //
    protected $overtimeService;

    public function __construct(OvertimeService $overtimeService)
    {
        $this->overtimeService = $overtimeService;
    }

    public function storeOvertime(Request $request)
    {
        $response = $this->overtimeService->storeOvertime($request->all());

        return $response;
    }

    public function getOvertimePay(Request $request)
    {
        // dd($request->all());
        $response = $this->overtimeService->getOvertimePay($request->all());

        return $response;
    }
}
