<?php

namespace App\Http\Controllers\Data;

use App\Models\Ticketsales;
use App\Http\Requests\StoreticketsalesRequest;
use App\Http\Requests\UpdateticketsalesRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class TicketsalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Ticketsales::all();

        // Jika data ada, ambil kolom dari data pertama
        if (!$datas->isEmpty()) {
            // Ambil kolom dari data pertama jika ada
            $columns = array_keys($datas[0]->getAttributes());
        } else {
            // Jika data kosong, ambil kolom dari struktur tabel (menggunakan model)
            $columns = (new Ticketsales())->getFillable(); // Mengambil kolom yang bisa diisi dari model
        }

        return view('data.ticketsales.read', [
            'table' => 'ticketsales',
            'type' => 'data',
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
         $validator = Validator::make($request->all(), [
             'periode' => 'required|date_format:Y-m',
             'csv_file' => 'required|file|mimes:csv,txt|max:2048',
         ]);
     
         if ($validator->fails()) {
             return redirect()->back()->withErrors($validator)->withInput();
         }
     
         $periode = $request->input('periode');
         $file = $request->file('csv_file');
     
         // Buka file CSV
         $filePath = $file->getRealPath();
         $csvData = array_map('str_getcsv', file($filePath));
     
         // Ambil header dari file CSV
         $headers = $csvData[0];
         $headers[] = 'periode';
     
         // Ambil data selain header
         $rows = array_slice($csvData, 1);
     
         // Fungsi untuk mengonversi serial date ke format Y-m-d
         function convertSerialDate($serialDate)
         {
             // Excel serial date: Mulai dari 1900-01-01
             $startDate = \Carbon\Carbon::create(1899, 12, 30); // Excel base date
             return $startDate->addDays((int)$serialDate)->format('Y-m-d');
         }
     
         foreach ($rows as $row) {
             $row[] = $periode;
             $data = array_combine($headers, $row);
     
             // Cek dan konversi format tanggal
             if (is_numeric($data['departure_date'])) {
                 $data['departure_date'] = convertSerialDate($data['departure_date']);
             }
             if (is_numeric($data['arrival_date'])) {
                 $data['arrival_date'] = convertSerialDate($data['arrival_date']);
             }
     
             try {
                 Ticketsales::create($data);
             } catch (\Exception $e) {
                 logger()->error('Gagal menyimpan data:', [
                     'row' => $data,
                     'error_message' => $e->getMessage(),
                     'trace' => $e->getTraceAsString(),
                 ]);
     
                 return redirect()->back()->with('error', "Gagal menyimpan data: {$e->getMessage()}");
             }
         }
     
         return redirect()->route('ticketsales.index')->with('success', 'Data berhasil diupload dan disimpan ke database!');
     }
     


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Coba cari file berdasarkan ID
        $data = Ticketsales::find($id);

        if ($data) {
            return response()->json($data);
        }
        // Jika file ditemukanx
        return response()->json(['message' => 'data not found.'], 404);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Find the ticket data by ID
        $ticket = Ticketsales::find($id);

        // Check if the ticket exists
        if ($ticket) {
            // Return the ticket data as JSON response (for the edit modal to populate)
            return response()->json($ticket);
        } else {
            // If ticket is not found, return an error response
            return response()->json(['message' => 'Ticket not found.'], 404);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    // Update the specified ticket in the database
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            // 'periode' => 'required|date_format:Y-m',
            'passenger_name' => 'required|string|max:255',
            'bak' => 'required|integer',
            'nationality' => 'required|string|max:100',
            'order_no' => 'required|string|max:50',
            'ticket_no' => 'required|string|max:50',
            'operator_name' => 'required|string|max:255',
            'departure_date' => 'required|date',
            'origin' => 'required|string|max:255',
            'departure_time' => 'required|date_format:H:i',
            'destination' => 'required|string|max:255',
            'arrival_date' => 'required|date',
            'arrival_time' => 'required|date_format:H:i',
            'seat_class' => 'required|string|max:100',
            'after_tax_price' => 'required|numeric',
            'payment_method' => 'required|string|max:100',
            'plat_trade_no' => 'required|string|max:50',
        ]);

        // Find the ticket by ID
        $ticket = Ticketsales::find($id);

        // Check if the ticket exists
        if ($ticket) {
            // Update the ticket with the validated data
            $ticket->update($validatedData);

            // Return a success response
            return response()->json(['message' => 'Ticket updated successfully.']);
        } else {
            // If ticket is not found, return an error response
            return response()->json(['message' => 'Ticket not found.'], 404);
        }
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
        $data = Ticketsales::findOrFail($id);
        $data->delete();
        return redirect()->route('ticketsales.index');
}
}