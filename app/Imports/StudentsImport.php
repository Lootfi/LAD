<?php

namespace App\Imports;

use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class StudentsImport implements ToCollection, WithCustomCsvSettings, SkipsOnError, WithHeadingRow
{
    use SkipsErrors, Importable;

    public Course $course;

    function __construct(Course $course) {
        $this->course = $course;
      }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            $user = User::query()
            ->firstOrCreate([
                'email'    => $row['email'],
            ],
            [
                'name'     => $row['name'],
                'password' => isset($row['password']) ? \Hash::make($row['Password']) : \Hash::make('password'),
             ]
            );

            CourseStudent::query()
            ->firstOrCreate([
                'student_id' => $user->id,
                'course_id' => $this->course->id,
            ]);

        }
    }
}
