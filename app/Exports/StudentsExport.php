<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class StudentsExport implements FromCollection
{
    public $students;

    public function __construct($students) {
        $this->students = $students;
    }

    public function collection()
    {
        return User::whereIn('id', $this->students)->get();
    }
}