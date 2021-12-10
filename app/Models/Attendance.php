<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'attendance_date',
        'attendance_month',
        'attendance_year',
        'status',
        'edit_date',
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
