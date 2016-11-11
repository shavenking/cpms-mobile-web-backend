<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $fillable = [
        'name', // 工程名稱
        'contractor', // 承攬廠商
        'total_day', // 核定工期
        'start_date', // 開工日期
    ];
}
