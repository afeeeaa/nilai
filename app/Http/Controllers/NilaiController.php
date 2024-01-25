<?php

namespace App\Http\Controllers;

use DB;
use App\Models\nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use App\Import\AnswerSheet;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $keyword = $request->keyword;

    // Menangani pengurutan
    $sort = $request->input('sort', 'id');
    $order = $request->input('order', 'asc');

    $data = Nilai::orderBy($sort, $order);

    if (strlen($keyword)) {
        $data->where('no_reg', 'like', "%$keyword%");
    }

    $data = $data->paginate(10);

    // Menggunakan json_decode untuk setiap item pada array results
    foreach ($data as $item) {
        $item->results = json_decode($item->results, true);
    }    

    return view('nilai.index', compact('data', 'sort', 'order', 'keyword'));
}

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('nilai.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_reg' => 'required|numeric|unique:nilai,no_reg',
            'email' => 'required',
            'nama' => 'required',
            'dokumen' => 'required',
        ]);

        $file = $request->file('dokumen');

        if ($file && $file->isValid()) {
            // baca data dari excel dan kalkulasi
           $rows= Excel::toArray(new AnswerSheet, $file);
           if (count($rows) > 0 && count($rows[0]) > 0) {
            $results = [];
            foreach ($rows[0] as $row) {
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
                
            $originalFileName = $file->getClientOriginalName();

            // Menyimpan file ke direktori 'upload'
            $filePath = Storage::disk('upload')->putFile('', $file);

            $data = [
                'no_reg' => $request->no_reg,
                'email' => $request->email,
                'nama' => $request->nama,
                'dokumen' => $filePath,
                'original_filename' => $originalFileName,
                'results' => json_encode($results), // Mengonversi array ke JSON
            ];
            
            foreach ($results as $key => $result) {
                $data['resultI'][$key] = $result['resultI'];
                $data['resultE'][$key] = $result['resultE'];
                $data['resultS'][$key] = $result['resultS'];
                $data['resultN'][$key] = $result['resultN'];
                $data['resultT'][$key] = $result['resultT'];
                $data['resultF'][$key] = $result['resultF'];
                $data['resultJ'][$key] = $result['resultJ'];
                $data['resultP'][$key] = $result['resultP'];
                $data['result1'][$key] = $result['result1'];
                $data['result2'][$key] = $result['result2'];
                $data['result3'][$key] = $result['result3'];
                $data['result4'][$key] = $result['result4'];
            }

            Nilai::create($data);
            return redirect()->to('nilai')->with('success', 'Berhasil menambahkan data');
        }

    }
        return redirect()->back()->with('error', 'File tidak ditemukan atau tidak valid');
    }
    

    public function calculateAveragePercentage($row, $columnName, $startColumn, $endColumn)
    {
        $totalScore = 0;
    
        for ($i = $startColumn; $i <= $endColumn; $i++) {
            // Periksa apakah kolom ada sebelum mengaksesnya
            if (array_key_exists($columnName . $i, $row)) {
                $totalScore += $row[$columnName . $i];
            } else {
                // Jika kolom tidak ada, lewati perhitungan untuk iterasi ini
                continue;
            }
        }
    
        // menghitung persentase
        $averagePercentage = $totalScore / ($endColumn - $startColumn + 1);
    
        return $averagePercentage;
    }

    public function search(Request $request)
    {
        if ($request->has('search')) {
            $nilai = Nilai::where('no_reg', 'LIKE', '%' . $request->search . '%')->get();
        } else {
            $nilai = Nilai::all();
        }
        return view('nilai.index', ['nilai' => $nilai]);
    }

    public function download($id)
    {
        $data = DB::table('nilai')->where('id', $id)->first();
        $filepath = storage_path("app/upload/{$data->dokumen}");
        return response()->download($filepath, $data->original_filename);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = Nilai::findOrFail($id);

        return view('nilai.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
