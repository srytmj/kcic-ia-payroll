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
        $datas = DB::table('dokumen_bak')->get();

        // Ambil daftar periode unik dari tabel dokumen_bak
        $periodeList = DB::table('dokumen_bak')
                 ->select('periode')
                 ->distinct()
                 ->orderBy('periode', 'asc')
                 ->pluck('periode')
                 ->toArray();


        return view('rekapitulasi.bak', [
            'datas' => $datas,
            'periodeList' => $periodeList,
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
}
