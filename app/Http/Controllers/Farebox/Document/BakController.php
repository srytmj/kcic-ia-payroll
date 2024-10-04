<?php

namespace App\Http\Controllers\Farebox\Document;

use App\Models\Bak;
use App\Http\Requests\StorebakRequest;
use App\Http\Requests\UpdatebakRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class BakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Bak::all();

        return view('farebox.document.bak.read', [
            'tablename' => 'bak',
            'datas' => $datas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorebakRequest $request)
    {

        // Validasi input
        $validator = Validator::make($request->all(), [
            'periode' => 'required|date_format:Y-m', // Validasi format bulan-tahun
            'files.*' => 'required|file|mimes:pdf|max:5120', // Hanya terima file PDF maksimal 5MB
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Ambil data periode
        $periode = $request->input('periode');
        $path = 'documents/bak_rombongan/' . $periode;

        // Buat folder jika belum ada
        if (!Storage::exists($path)) {
            Storage::makeDirectory($path); // Set permission dan recursive folder creation
        }

        // Loop dan simpan semua file
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                // Simpan file di storage dengan nama unik
                $fileName = $file->getClientOriginalName();
                $file->storeAs($path, $fileName, 'public'); // Simpan di disk 'public'

                // Simpan informasi ke database
                Bak::create([
                    'periode' => $periode,
                    'file_name' => $fileName,
                    'file_path' => $path . '/' . $fileName,
                ]);
            }
        }

        // Response sukses
        return response()->json(['message' => 'Files uploaded and saved to database successfully!'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(bak $bak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // get the bak by id
        $bak = Bak::findOrFail($id);

        return view('bak.edit', compact('bak'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatebakRequest $request, $id)
    {
        // validate the request and update the bak by id
        $validated = $request->validated();

        Bak::where('id_bak', $id)
            ->update($validated);

        return redirect()->route('bak.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // delete the bak by id
        $bak = Bak::findOrFail($id);
        $bak->delete();

        return redirect()->route('bak.index');
    }
    
    public function deleteSelected(Request $request)
    {
        $ids = $request->input('ids'); // Mendapatkan ID yang dipilih
        $files = $request->input('files'); // Mendapatkan file path yang dipilih

        // Loop melalui file dan hapus
        foreach ($files as $file) {
            Storage::delete($file); // Menghapus file dari storage
        }

        // Menghapus data dari database
        Bak::destroy($ids);

        return response()->json(['success' => 'Data berhasil dihapus']);
    }

}
