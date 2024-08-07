<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSchedule extends Model
{
    use HasFactory;

    protected $table = "user_scheduled";
    protected $fillable = [
        'shift_name',
        'start_time',
        'end_time',
    ];
}
