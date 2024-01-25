<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Import\AnswerSheet;
use Maatwebsite\Excel\Facades\Excel;

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
        if (!$file || ($file && !$file->isValid())) {
            return redirect()->back()->with('error', 'File tidak ditemukan atau tidak valid');
        }

        // baca data dari excel dan kalkulasi
        $collection = Excel::toCollection(new AnswerSheet, $file);
        $data = $collection->first();
        // pecah per-15 untuk setiap kategori
        $categoriesWithAnswers = $data->chunk(15);

        // variable untuk menyimpan setiap hasil dari masing-masing kategori
        $mbti = [
            "average_score_i" => 0,
            "average_score_e" => 0,
            "average_score_s" => 0,
            "average_score_n" => 0,
            "average_score_t" => 0,
            "average_score_f" => 0,
            "average_score_j" => 0,
            "average_score_p" => 0,

            "result_1" => "",
            "result_2" => "",
            "result_3" => "",
            "result_4" => ""
        ];

        $categoryIndex = 0;
        foreach ($categoriesWithAnswers as $category) {
            $currentCategoryAverageScore = $category->avg("score");

            switch ($categoryIndex) {
                case 0: // I
                    $mbti["average_score_i"] = $currentCategoryAverageScore;
                    break;
                case 1: // E
                    $mbti["average_score_e"] = $currentCategoryAverageScore;
                    break;
                case 2: // S
                    $mbti["average_score_s"] = $currentCategoryAverageScore;
                    break;
                case 3: // N
                    $mbti["average_score_n"] = $currentCategoryAverageScore;
                    break;
                case 4: // T
                    $mbti["average_scores_t"] = $currentCategoryAverageScore;
                    break;
                case 5: // F
                    $mbti["average_score_f"] = $currentCategoryAverageScore;
                    break;
                case 6: // J
                    $mbti["average_score_j"] = $currentCategoryAverageScore;
                    break;
                case 7: // P
                    $mbti["average_score_p"] = $currentCategoryAverageScore;
                    break;
            }

            $categoryIndex++;
        }

        // kalkulasi hasil antar kategori
        $mbti["result_1"] = $mbti["average_score_i"] > $mbti["average_score_e"] ? "I" : "E";
        $mbti["result_2"] = $mbti["average_score_s"] > $mbti["average_scores_n"] ? "S" : "N";
        $mbti["result_3"] = $mbti["average_score_t"] > $mbti["average_score_f"] ? "T" : "F";
        $mbti["result_4"] = $mbti["average_score_j"] > $mbti["average_score_p"] ? "J" : "P";

        // kalkulasi hasil quiz
        $originalFileName = $file->getClientOriginalName();

        // Menyimpan file ke direktori 'upload'
        $filePath = Storage::disk('upload')->putFile('', $file);

        $data = [
            'no_reg' => $request->no_reg,
            'email' => $request->email,
            'nama' => $request->nama,
            'dokumen' => $filePath,
            'original_filename' => $originalFileName,

            // menyimpan hasil mbti di atas
            ...$mbti // NOTE: searching aja kalau bingung ini apaan
        ];

        Nilai::create($data);
        return redirect()->to('nilai')->with('success', 'Berhasil menambahkan data');
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
