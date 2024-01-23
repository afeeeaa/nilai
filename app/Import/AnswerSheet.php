<?php

namespace App\Import;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AnswerSheet implements ToCollection, WithHeadingRow {
    public function collection(Collection $rows) {
        // TODO: kalkulasi data dari masing masing row, lalu simpan ke database
        // untuk melihat $rows itu seperti apa bisa pakai dd($row) seperti di bawah ini
        // dd($rows);

        $results = "";
        foreach($rows as $row) {
            $name = $row->get('name');
            var_dump($name);
        }
    }
}
