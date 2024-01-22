<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


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
            $originalFileName = $file->getClientOriginalName();
    
            // Menyimpan file ke direktori 'upload'
            $filePath = Storage::disk('upload')->putFile('', $file);
    
            $data = [
                'no_reg' => $request->no_reg,
                'email' => $request->email,
                'nama' => $request->nama,
                'dokumen' => $filePath,
                'original_filename' => $originalFileName,
            ];
    
            Nilai::create($data);
    
            return redirect()->to('nilai')->with('success', 'Berhasil menambahkan data');
        }
    
        return redirect()->back()->with('error', 'File tidak ditemukan atau tidak valid');
    }
    

    public function search(Request $request){
        if($request->has('search')){
            $nilai = Nilai::where('no_reg','LIKE','%'.$request->search.'%')->get();
        }else{
            $nilai = Nilai::all();
        }
        return view('nilai.index',['nilai'=> $nilai]);
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
    public function show(string $id)
    {
        //
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
