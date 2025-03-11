<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Bak;

class Rekapitulasi extends Controller
{
    //
    public function bak()
    {
        $datas = DB::table('dokumen_bak')
            ->where('status', 'checked') // Tambahin kondisi WHERE    
            ->get();

        // Ambil daftar periode unik dari tabel dokumen_bak
        $periodeList = DB::table('dokumen_bak')
            ->select('periode')
            ->where('status', 'checked') // Tambahin kondisi WHERE
            ->distinct()
            ->orderBy('periode', 'asc')
            ->pluck('periode')
            ->toArray();

        return view('rekapitulasi.bak', [
            'datas' => $datas,
            'periodeList' => $periodeList,
        ]);
    }

    public function ticketsales()
    {
        $datas = DB::table('data_ticketsales')
            // where is not
            ->whereNotNull('bak')
            ->join('dokumen_bak', 'data_ticketsales.bak', '=', 'dokumen_bak.id')
            ->select('data_ticketsales.*', 'dokumen_bak.nama_pihak_kedua')
            ->get();

        // Ambil daftar periode unik dari tabel dokumen_rekening_koran
        $periodeList = DB::table('data_ticketsales')
            ->select('periode')
            ->whereNotNull('bak')
            ->distinct()
            ->orderBy('periode', 'asc')
            ->pluck('periode')
            ->toArray();

        return view('rekapitulasi.ticketsales', [
            'datas' => $datas,
            'periodeList' => $periodeList,
        ]);
    }

    public function refundrombongan()
    {
        $ticketsales = DB::table('data_ticketsales')->get();
        $refund = DB::table('data_refund')->get();

        // Ambil daftar periode unik dari tabel dokumen_rekening_koran
        $refundrombongan = DB::table();

        return view('rekapitulasi.refundrombongan', [
            // 'ticketsales' => $ticketsales,
            // 'refund' => $refund,
            'refundrombongan' => $refundrombongan,
        ]);
    }

    public function exportCsv(Request $request)
    {
        // Validasi input
        $request->validate([
            'start' => 'required|date',
            'to'    => 'required|date|after_or_equal:start',
        ]);

        // Ambil data berdasarkan periode yang dipilih
        $start = $request->input('start');
        $to = $request->input('to');

        $datas = Bak::whereBetween('periode', [$start, $to])->get();

        // Buat header untuk file CSV
        $csvHeader = ['Id', 'Periode', 'No. Dokumen', 'Nama Pihak Kedua', 'Tanggal Dokumen', 'Bukti Transfer', 'Manifest', 'Keterangan'];

        // Buat isi file CSV
        $csvData = [];
        foreach ($datas as $data) {
            $csvData[] = [
                $data->id,
                $data->periode,
                $data->no_dokumen,
                $data->nama_pihak_kedua,
                $data->tanggal_dokumen,
                $data->bukti_transfer,
                $data->manifest,
                $data->keterangan,
            ];
        }

        // Generate CSV menggunakan output buffer
        $filename = "export_data_" . date('Ymd_His') . ".csv";
        $handle = fopen('php://output', 'w');
        ob_start();

        // Tambahkan header ke file CSV
        fputcsv($handle, $csvHeader);

        // Tambahkan data ke file CSV
        foreach ($csvData as $row) {
            fputcsv($handle, $row);
        }

        fclose($handle);
        $csvOutput = ob_get_clean();

        // Return file CSV sebagai response download
        return Response::make($csvOutput, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ]);
    }
    public function exportCsvTicketsales(Request $request)
    {
        // Validasi input
        $request->validate([
            'start' => 'required|date',
            'to'    => 'required|date|after_or_equal:start',
        ]);

        // Ambil data berdasarkan periode yang dipilih
        $start = $request->input('start');
        $to = $request->input('to');

        $datas = DB::table('data_ticketsales')
                ->whereNotNull('data_ticketsales.bak')
                ->join('dokumen_bak', 'data_ticketsales.bak', '=', 'dokumen_bak.id')
                ->select('data_ticketsales.*', 'dokumen_bak.nama_pihak_kedua')
                ->whereBetween('dokumen_bak.periode', [$start, $to]) // Tentukan tabel sumber kolom 'periode'
                ->get();


        // Pastikan ada data sebelum membuat file CSV
        if ($datas->isEmpty()) {
            return response()->json(['message' => 'No data found for the selected period.'], 404);
        }

        // Pastikan ada data sebelum membuat file CSV
        if ($datas->isEmpty()) {
            return response()->json(['message' => 'No data found for the selected period.'], 404);
        }

        // Konversi hasil query ke array agar bisa diambil header-nya
        $firstRow = json_decode(json_encode($datas->first()), true);
        $csvHeader = array_keys($firstRow);

        // Ambil isi file CSV dari semua data
        $csvData = [];
        foreach ($datas as $data) {
            $csvData[] = json_decode(json_encode($data), true);
        }

        // // Ambil isi file CSV dari semua data
        // $csvData = [];
        // foreach ($datas as $data) {
        //     $csvData[] = array_values($data->toArray());
        // }

        // Generate CSV menggunakan output buffer
        $filename = "export_data_" . date('Ymd_His') . ".csv";
        $handle = fopen('php://output', 'w');
        ob_start();

        // Tambahkan header ke file CSV
        fputcsv($handle, $csvHeader);

        // Tambahkan data ke file CSV
        foreach ($csvData as $row) {
            fputcsv($handle, $row);
        }

        fclose($handle);
        $csvOutput = ob_get_clean();

        // Return file CSV sebagai response download
        return Response::make($csvOutput, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ]);
    }
}
