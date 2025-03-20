<?php

namespace App\Http\Controllers\Document;

use App\Models\Bak;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class BakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Bak::all();

        // Jika data ada, ambil kolom dari data pertama
        if (!$datas->isEmpty()) {
            // Ambil kolom dari data pertama jika ada
            $columns = array_keys($datas[0]->getAttributes());
        } else {
            // Jika data kosong, ambil kolom dari struktur tabel (menggunakan model)
            $columns = (new Bak())->getFillable(); // Mengambil kolom yang bisa diisi dari model
        }

        return view('document.bak.read', [
            'table' => 'bak',
            'type' => 'document',
            'datas' => $datas,
            'columns' => $columns, // Kirim kolom ke view
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

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'periode' => 'required|date_format:Y-m',
            'files.*' => 'required|file|mimes:pdf',
        ]);

        $periode = $validatedData['periode'];

        // Tentukan path folder berdasarkan periode
        $folderPath = "bak/{$periode}";

        // Pastikan folder ada, jika belum buat
        if (!Storage::exists($folderPath)) {
            Storage::makeDirectory($folderPath);
        }

        // Proses penyimpanan file
        foreach ($request->file('files') as $file) {
            $fileName = $file->getClientOriginalName();

            // Simpan file ke dalam folder yang sudah dipastikan ada
            $filePath = $file->storeAs($folderPath, $fileName);

            // Simpan informasi file di database
            Bak::create([
                'periode' => $periode,
                'file_name' => $fileName,
                'file_path' => $filePath,
            ]);
        }

        // return response()->json(['message' => 'Files uploaded successfully']);
        return redirect()->route('bak.index');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Coba cari file berdasarkan ID
        $file = Bak::find($id);

        if ($file) {
            return response()->json([
                'id' => $file->id,
                'periode' => $file->periode,
                'file_name' => $file->file_name,
                'status' => $file->status,
                'nama_pihak_kedua' => $file->nama_pihak_kedua,
                'no_dokumen' => $file->no_dokumen,
                // 'total_nominal' => $file->total_nominal,
                'tanggal_dokumen' => $file->tanggal_dokumen,
                'bukti_transfer' => $file->bukti_transfer,
                'manifest' => $file->manifest,
                'keterangan' => $file->keterangan,
                'path' => Storage::url($file->file_path),
            ]);
        }

        return response()->json(['message' => 'File not found.'], 404);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // 
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'file_name' => 'required|string|max:255',
            'periode' => 'required|date_format:Y-m',
            'status' => 'required|string',
            'nama_pihak_kedua' => 'nullable|string|max:255',
            'no_dokumen' => 'nullable|string|max:255',
            // 'total_nominal' => 'nullable|integer',
            'tanggal_dokumen' => 'nullable|date',
            'bukti_transfer' => 'nullable|in:0,1',
            'manifest' => 'nullable|in:0,1',
            'keterangan' => 'nullable|string',
        ]);

        // Cari data yang ingin diupdate
        $file = Bak::findOrFail($id);

        // Ambil data periode dan file_name yang baru
        $newPeriode = $request->periode;
        $newFileName = $request->file_name;

        // Generate path baru sesuai periode
        $newFolderPath = 'bak/' . $newPeriode;  // Tanpa 'public/storage'
        $oldFilePath = 'bak/' . $file->periode . '/' . $file->file_name;  // Tanpa 'public/storage'
        $newFilePath = $newFolderPath . '/' . $newFileName;  // Tanpa 'public/storage'

        // Log sebelum cek file ada apa nggak
        Log::info('Checking if file exists at: ' . $oldFilePath);

        if (Storage::disk('public')->exists($oldFilePath)) {
            // Pindahkan file ke folder baru dan rename
            Log::info('File exists, moving file to: ' . $newFilePath);

            // Pastikan folder tujuan ada
            if (!Storage::disk('public')->exists($newFolderPath)) {
                Storage::disk('public')->makeDirectory($newFolderPath);
                Log::info('Directory created: ' . $newFolderPath);
            }

            // Pindahkan file ke folder baru dan rename
            Storage::disk('public')->move($oldFilePath, $newFilePath);

            // Update path file di database
            $file->file_name = $newFileName;
            $file->periode = $newPeriode;
            $file->file_path = $newFilePath;

            Log::info('File moved successfully. New file path: ' . $newFilePath);
        } else {
            Log::error('File not found at path: ' . $oldFilePath);

            return response()->json(['error' => 'File tidak ditemukan'], 404);
        }


        // Update data lainnya
        $file->status = $request->status;
        $file->nama_pihak_kedua = $request->nama_pihak_kedua;
        $file->no_dokumen = $request->no_dokumen;
        // $file->total_nominal = $request->total_nominal;
        $file->tanggal_dokumen = $request->tanggal_dokumen;
        $file->bukti_transfer = $request->bukti_transfer;
        $file->manifest = $request->manifest;
        $file->keterangan = $request->keterangan;

        $file->save();

        return response()->json(['success' => true]);
    }


    /**
     * Remove the specified resource from storage.
     */ /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Cari data berdasarkan ID
        $file = Bak::findOrFail($id);

        // Periksa apakah file ada di storage dengan menggunakan path relatif
        $filePath = $file->file_path; // Sudah termasuk 'public/' dalam path yang disimpan di database

        // Pastikan menggunakan Storage yang benar
        if (Storage::exists($filePath)) {
            // Hapus file dari storage
            Storage::delete($filePath);

            // Hapus record data dari database
            $file->delete();

            // Kembalikan response sukses
            return response()->json(['success' => true]);
        } else {
            // Log atau tindakan lain jika file tidak ditemukan, opsional
            Log::warning("File {$filePath} tidak ditemukan saat menghapus record.");

            // Kembalikan response gagal (opsional)
            return response()->json(['success' => false, 'message' => 'File tidak ditemukan.'], 404);
        }
    }

    public function download($id)
    {
        // Find the document by ID
        $document = Bak::findOrFail($id);

        // Set the headers for the download response
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $document->file_name . '"',
        ];

        // Return the file content as a downloadable response
        return Response::make($document->file_content, 200, $headers);
    }
}
