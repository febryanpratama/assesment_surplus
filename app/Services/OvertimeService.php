<?php

namespace App\Services;

use App\Helpers\Format;
use App\Models\Employee;
use App\Models\Overtime;
use App\Models\Setting;
use App\Utils\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OvertimeService
{
    public function storeOvertime($data)
    {
        //
        $validator = Validator::make($data, [
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date_format:Y-m-d|unique:overtimes,date,NULL,id,employee_id,' . $data['employee_id'],
            'time_started' => 'required|date_format:H:i|before:time_ended',
            'time_ended' => 'required|date_format:H:i|after:time_started',
        ]);

        if ($validator->fails()) {
            // dd("err");
            return Response::error($validator->errors()->first(), 'Validation Error');
        }

        DB::beginTransaction();

        try {
            Overtime::create([
                'employee_id' => $data['employee_id'],
                'date' => $data['date'],
                'time_started' => $data['time_started'],
                'time_ended' => $data['time_ended'],
            ]);

            DB::commit();

            return Response::success('Overtime created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return Response::error($th->getMessage(), 'Error');
        }
    }

    public function getOvertimePay($data)
    {
        $validator = Validator::make($data, [
            'month' => 'required|date_format:Y-m',
        ]);

        if ($validator->fails()) {
            return Response::error($validator->errors()->first(), 'Validation Error');
        }

        DB::beginTransaction();

        try {
            $employees = Employee::with('overtime')->get();

            $data = Setting::with('reference')->first();

            $expression = $data->reference->expression;

            // dd(eval('return ' . $str . ';'));

            $sum = [];
            foreach ($employees as $employee) {
                $sum['id'] = $employee->id;
                $sum['name'] = $employee->name;
                $sum['salary'] = $employee->salary;
                $sum['overtime'] = [];

                for ($i = 0; $i < count($employee->overtime); $i++) {
                    $sum['overtime'][] = [
                        'date' => $employee->overtime[$i]->date,
                        'time_started' => $employee->overtime[$i]->time_started,
                        'time_ended' => $employee->overtime[$i]->time_ended,
                        'overtime_duration' => Format::duration($employee->overtime[$i]->time_started, $employee->overtime[$i]->time_ended),
                    ];
                }
                $sum['overtime_duration_total'] = array_sum(array_column($sum['overtime'], 'overtime_duration'));
                $sum['amount'] = number_format(round(Format::OvertimesPay($expression, $employee->salary, $sum['overtime_duration_total'])), '0');
            }

            return Response::success($sum);
        } catch (\Throwable $th) {
            return Response::error($th->getMessage(), 'Error');
        }
    }
}
