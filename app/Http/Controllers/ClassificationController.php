<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classification;
use App\Models\Bak;
use App\Models\Bakdetail;
use App\Models\TicketSales;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreClassificationRequest;
use App\Http\Requests\UpdateClassificationRequest;

class ClassificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Bak::all();

        return view('classification.read', [
            'datas' => $datas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        // Ambil data BAK berdasarkan ID
        $data = Bak::find($id);

        // Ambil tanggal keberangkatan dari Bakdetail yang terkait
        $dates = Bakdetail::where('dokumen_bak_id', $id)->get();

        if (!$data) {
            return response()->json(['message' => 'Data not found'], 404); // Jika data tidak ditemukan
        }

        // Ambil tanggal keberangkatan dari Bakdetail
        $departureDates = $dates->pluck('tanggal_keberangkatan')->toArray();

        $ticketSalesDatas = TicketSales::where('bak', $id)->get();

        // Ambil ticket sales berdasarkan tanggal keberangkatan yang diambil dari Bakdetail
        if ($ticketSalesDatas->count() > 0) {
            $ticketSales = $ticketSalesDatas;    // Jika tidak ada tanggal keberangkatan, set ticketSales jadi array kosong
        } elseif (!empty($departureDates)) {
            $ticketSales = $ticketSales = TicketSales::whereIn('departure_date', $departureDates)
                ->whereNull('bak')
                ->get();
        } else {
            $ticketSales = []; // Jika tidak ada tanggal keberangkatan, set ticketSales jadi array kosong
        }

        // // Return data ke view atau sebagai JSON
        // return response()->json([
        //     'bak' => $data,
        //     'dates' => $dates,
        //     'ticketSales' => $ticketSales,
        // ]);


        return view('classification.create', compact('data', 'ticketSales', 'dates')); // Kirim data ke view

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi Input
        $request->validate([
            'id' => 'required|exists:dokumen_bak,id',
            'no_dokumen' => 'required|string|max:255',
            'tanggal_dokumen' => 'required|date',
            'nama_pihak_kedua' => 'nullable|string|max:255',
            'manifest' => 'required|boolean',
            'bukti_transfer' => 'required|boolean',
            'keterangan' => 'nullable|string',
            'tanggal_keberangkatan' => 'nullable|array',
            'tanggal_keberangkatan.*' => 'date', // Validasi setiap elemen dalam array
        ]);

        // Ambil data dokumen berdasarkan ID
        $dokumenBak = Bak::findOrFail($request->id);

        // Update data di dokumen_bak (kecuali periode, file_name, file_path, dan status)
        $dokumenBak->no_dokumen = $request->no_dokumen;
        $dokumenBak->tanggal_dokumen = $request->tanggal_dokumen;
        $dokumenBak->nama_pihak_kedua = $request->nama_pihak_kedua;
        $dokumenBak->manifest = $request->manifest;
        $dokumenBak->bukti_transfer = $request->bukti_transfer;
        $dokumenBak->keterangan = $request->keterangan;

        // Simpan perubahan di dokumen_bak
        $dokumenBak->save();

        // Simpan data tanggal keberangkatan ke tabel dokumen_bak_detail
        if (!empty($request->tanggal_keberangkatan)) {
            // Hapus tanggal keberangkatan lama jika ada (opsional)
            Bakdetail::where('dokumen_bak_id', $dokumenBak->id)->delete();

            // Menyimpan tanggal keberangkatan yang baru
            foreach ($request->tanggal_keberangkatan as $tanggal) {
                Bakdetail::create([
                    'dokumen_bak_id' => $dokumenBak->id, // Foreign key
                    'tanggal_keberangkatan' => $tanggal,
                ]);
            }
        }

        // Redirect atau response
        return redirect('classification/create/' . $request->id)
            ->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classification $classification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classification $classification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassificationRequest $request, Classification $classification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classification $classification)
    {
        //
    }

    public function processSelectedData(Request $request)
    {
        // Ambil data IDs yang dikirim
        $ids = $request->input('ids');

        if (empty($ids)) {
            return response()->json([
                'message' => 'No data selected!',
                'status' => 'error',
            ], 400);
        }

        // Lakukan sesuatu dengan data IDs
        // Contoh: Ambil data terkait dari database
        $selectedData = TicketSales::whereIn('id', $ids)->get();

        return response()->json([
            'message' => 'Data processed successfully!',
            'data' => $selectedData,
            'status' => 'success',
        ]);
    }

    public function updateTicketSales(Request $request)
    {
        $validated = $request->validate([
            'selected_ids' => 'required|array',
            'bak_id' => 'required|integer',
        ]);

        try {
            DB::table('data_ticketsales')
                ->whereIn('id', $validated['selected_ids'])
                ->update(['bak' => $validated['bak_id']]);

            Bak::where('id', $validated['bak_id'])->update(['status' => 'checked']);

            return redirect('classification/create/' . $request->id)->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update data.', 'error' => $e->getMessage()], 500);
        }
    }
}
