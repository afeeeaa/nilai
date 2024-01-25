<?php

namespace App\Import;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AnswerSheet implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
    }

    public function headingRow(): int
    {
        return 6;
    }
}
