<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    use Translatable;

    // ToDo: Задать значение по умолчанию
    const TYPE_GLOBAL = null; // id департамента по умолчанию

    public array $translatedAttributes = [
        'name',
    ];

    public function employees()
    {
        return $this->belongsToMany(
            User::class,
            'department_employee',
            'department_id',
            'employee_id'
        );
    }
}
