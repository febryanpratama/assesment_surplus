<?php

namespace App\Services;

use App\Models\Setting;
use App\Utils\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SettingService
{
    protected $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function updateSetting($data)
    {
        // 
        $validator = Validator::make($data, [
            'key' => 'required|in:overtime_method',
            'value' => 'required|numeric|exists:references,id'
        ]);

        if ($validator->fails()) {
            # code...
            return Response::error($validator->errors()->first());
        }

        DB::beginTransaction();

        try {
            Setting::firstWhere('key', $data['key'])->update([
                'value' => $data['value']
            ]);

            DB::commit();

            return Response::success('Success update setting');
        } catch (\Throwable $th) {
            DB::rollBack();

            return Response::error($th->getMessage());
        }
    }
}
