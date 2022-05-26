<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithStartRow;

class StudentsImport implements ToModel, WithCustomCsvSettings, SkipsOnError
{
    use SkipsErrors, Importable;

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
           'name'     => $row[1],
           'email'    => $row[2],
           'password' => \Hash::make('password'),
        ]);
    }
}
