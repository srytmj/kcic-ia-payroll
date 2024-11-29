<?php

namespace App\Http\Controllers\Document;

use App\Models\RekeningKoran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class RekeningkoranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = RekeningKoran::all();

        // Jika data ada, ambil kolom dari data pertama
        if (!$datas->isEmpty()) {
            $columns = array_keys($datas[0]->getAttributes());
        } else {
            $columns = (new RekeningKoran())->getFillable(); 
        }

        return view('document.rekeningkoran.read', [
            'type' => 'document',
            'table' => 'rekeningkoran',
            'datas' => $datas,
            'columns' => $columns,
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
            'nomor_rekening' => 'required|string|max:255',
        ]);

        $periode = $validatedData['periode'];

        // Tentukan path folder berdasarkan periode
        $folderPath = "rekeningkoran/{$periode}";

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
            RekeningKoran::create([
                'periode' => $periode,
                'nomor_rekening' => $validatedData['nomor_rekening'],
                'file_name' => $fileName,
                'file_path' => $filePath,
            ]);
        }

        // return all error log whenever its successful or not
        Log::info('Files uploaded successfully', ['periode' => $periode, 'nomor_rekening' => $validatedData['nomor_rekening']]);
        // return response()->json(['message' => 'Files uploaded successfully']);
        return redirect()->route('bak.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $file = RekeningKoran::findOrFail($id);

        return response()->json([
            'id' => $file->id,
            'periode' => $file->periode,
            'nomor_rekening' => $file->nomor_rekening,
            'file_name' => $file->file_name,
            'file_path' => Storage::url($file->file_path),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'file_name' => 'required|string|max:255',
            'periode' => 'required|date_format:Y-m',
            'nomor_rekening' => 'required|string|max:255',
        ]);

        $file = RekeningKoran::findOrFail($id);

        $newPeriode = $request->periode;
        $newFileName = $request->file_name;
        $newFolderPath = 'rekeningkoran/' . $newPeriode;
        $oldFilePath = 'rekeningkoran/' . $file->periode . '/' . $file->file_name;
        $newFilePath = $newFolderPath . '/' . $newFileName;

        if (Storage::exists($oldFilePath)) {
            // Pindahkan file ke folder baru dan rename
            if (!Storage::exists($newFolderPath)) {
                Storage::makeDirectory($newFolderPath);
            }
            Storage::move($oldFilePath, $newFilePath);
            $file->file_name = $newFileName;
            $file->periode = $newPeriode;
            $file->file_path = $newFilePath;
        } else {
            return response()->json(['error' => 'File tidak ditemukan'], 404);
        }

        $file->save();
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $file = RekeningKoran::findOrFail($id);
        $filePath = $file->file_path;

        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
            $file->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'File tidak ditemukan.'], 404);
        }
    }

    public function download($id)
    {
        $document = RekeningKoran::findOrFail($id);

        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $document->file_name . '"',
        ];

        return Response::make(Storage::get($document->file_path), 200, $headers);
    }
}
