<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Rekapitulasi extends Controller
{
    //
    public function bak()
    {
        $datas = DB::table('dokumen_bak')->get();
        return view('rekapitulasi.bak', [
            'datas' => $datas,
        ]);
    }
}
