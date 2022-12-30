<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function overtime()
    {
        return $this->hasMany(Overtime::class, 'employee_id', 'id');
    }
}
