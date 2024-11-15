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
        // The validation is already handled in the StorebakRequest

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
        return redirect()->route('bak.index');
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
        $ids = $request->input('ids');

        try {
            // Hapus data berdasarkan ID yang dipilih
            Bak::whereIn('id', $ids)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ]);
        }
    }
}
