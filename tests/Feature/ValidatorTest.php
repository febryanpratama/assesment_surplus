<?php

namespace Tests\Feature;

use App\Models\Setting;
use Tests\TestCase;

class ValidatorTest extends TestCase
{
    public function testTakeOneFromTheBox()
    {
        $sett = $this->patch('/api/settings/');
        $sett->assertStatus(400);

        $emp = $this->post('/api/employees');
        $emp->assertStatus(400);

        $over = $this->post('/api/overtimes');
        $over->assertStatus(500);

        $overPay = $this->post('/api/overtimes-pays/calculate');
        $overPay->assertStatus(404);
    }
}
