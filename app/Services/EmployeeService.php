<?php

namespace App\Services;

use App\Models\Employee;
use App\Utils\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EmployeeService
{
    public function storeEmployee($data)
    {
        // 
        $validator = Validator::make($data, [
            'name' => 'required|min:2|unique:employees,name',
            'salary' => 'required|numeric|between:2000000,10000000',
        ]);

        if ($validator->fails()) {
            return Response::error($validator->errors()->first(), 'Validation Error');
        }

        DB::beginTransaction();

        try {
            //code...
            Employee::create($data);
            DB::commit();

            return Response::success('Employee created successfully');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Response::error($th->getMessage(), 'Error');
        }
    }
}
