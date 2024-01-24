<?php

namespace App\Import;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AnswerSheet implements ToCollection, WithHeadingRow {
    public function collection(Collection $rows) {
        $results = [];
        foreach($rows->toArray() as $row) {
            $averageScoreI = $this->calculateAveragePercentage($row, 'score', 4, 18);
            $averageScoreE = $this->calculateAveragePercentage($row, 'score', 19, 33);
            $averageScoreS = $this->calculateAveragePercentage($row, 'score', 34, 48);
            $averageScoreN = $this->calculateAveragePercentage($row, 'score', 49, 63);
            $averageScoreT = $this->calculateAveragePercentage($row, 'score', 64, 78);
            $averageScoreF = $this->calculateAveragePercentage($row, 'score', 79, 93);
            $averageScoreJ = $this->calculateAveragePercentage($row, 'score', 94, 108);
            $averageScoreP = $this->calculateAveragePercentage($row, 'score', 109, 123);

            $result1 = $averageScoreI > $averageScoreE ? 'I' : 'E';
            $result2 = $averageScoreS > $averageScoreN ? 'S' : 'N';
            $result3 = $averageScoreT > $averageScoreF ? 'T' : 'F';
            $result4 = $averageScoreJ > $averageScoreP ? 'J' : 'P';
        
            $results[] = [
                'resultI' => $averageScoreI,
                'resultE' => $averageScoreE,
                'resultS' => $averageScoreS,
                'resultN' => $averageScoreN,
                'resultT' => $averageScoreT,
                'resultF' => $averageScoreF,
                'resultJ' => $averageScoreJ,
                'resultP' => $averageScoreP,
                'result1' => $result1,
                'result2' => $result2,
                'result3' => $result3,
                'result4' => $result4,
            ];
        }

            dd($results);
    }
    
    public function headingRow(): int{
        return 6;
    }

    public function calculateAveragePercentage($row, $columnName, $startColumn, $endColumn)
{
    $totalScore = 0;

    for ($i = $startColumn; $i <= $endColumn; $i++) {
        $totalScore += $row[$columnName . $i];
    }

    // menghitung persentase
    $averagePercentage = $totalScore / ($endColumn - $startColumn + 1);

    return $averagePercentage;
}

}