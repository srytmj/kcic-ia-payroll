<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'penjualanPerPeriode' => $this->totalPenjualanPerPeriode()->original,
            'penjualanPerHari' => $this->totalPenjualanPerHari()->original,
            'penjualanPerSeatClass' => $this->totalPenjualanPerSeatClass()->original,
            'penjualanPerStasiun' => $this->countPenjualanPerStasiun()->original,
        ]);
    }
    public function test()
    {
        return response()->json([
            'penjualanPerPeriode' => $this->totalPenjualanPerPeriode()->original,
            'penjualanPerHari' => $this->totalPenjualanPerHari()->original,
            'penjualanPerSeatClass' => $this->totalPenjualanPerSeatClass()->original,
            'penjualanPerStasiun' => $this->countPenjualanPerStasiun()->original,
        ]);
    }

    public function totalPenjualanPerPeriode()
    {
        $data = DB::table('data_ticketsales')
            ->select('periode', 
                DB::raw('COUNT(ticket_no) AS total_tiket_terjual'),
                DB::raw('SUM(after_tax_price) AS total_pendapatan'))
            ->groupBy('periode')
            ->orderByDesc('periode')
            ->get();

        return response()->json($data);
    }

    public function totalPenjualanPerHari()
    {
        $data = DB::table('data_ticketsales')
            ->select('purchase_date', 
                DB::raw('COUNT(ticket_no) AS total_tiket_terjual'))
                // DB::raw('SUM(after_tax_price) AS total_pendapatan'))
            ->groupBy('purchase_date')
            ->orderByDesc('purchase_date')
            ->get();

        return response()->json($data);
    }

    public function totalPenjualanPerSeatClass()
    {
        $data = DB::table('data_ticketsales')
            ->select('seat_class', 
                DB::raw('COUNT(ticket_no) AS total_tiket_terjual'),
                DB::raw('SUM(after_tax_price) AS total_pendapatan'))
            ->groupBy('seat_class')
            ->orderByDesc(DB::raw('SUM(after_tax_price)'))
            ->get();

        return response()->json($data);
    }

    public function countPenjualanPerStasiun()
    {
        $data = DB::table('data_ticketsales')
            ->select('origin AS stasiun', DB::raw('COUNT(*) AS total_keberangkatan'))
            ->groupBy('origin')
            ->get();

        return response()->json($data);
    }
}
