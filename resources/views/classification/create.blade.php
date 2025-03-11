    @extends('layout')

    @section('content')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            if (typeof jQuery === 'undefined') {
                console.error('jQuery is not loaded!');
            } else {
                console.log('jQuery is loaded!');
            }
        </script>

        <!-- [ Main Content ] start -->
        <section class="pcoded-main-container">
            <div class="pcoded-content">

                <!-- [ breadcrumb ] start -->
                <div class="page-header">
                    <div class="page-block">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="page-header-title">
                                    <h5 class="m-b-10">Form Input Data</h5>
                                </div>
                                {{-- <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#!">Form</a></li>
                                    <li class="breadcrumb-item"><a href="#!">Input Data</a></li>
                                </ul> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ breadcrumb ] end -->

                <!-- [ Main Content ] start -->
                <div class="row" style="height: 100vh; display: flex; flex-wrap: nowrap;">
                    <!-- Left Section (PDF Viewer + Form Input) -->
                    <div class="col-lg-5 col-md-6"
                        style="display: flex; flex-direction: column; height: 100%; overflow: hidden;">
                        <!-- PDF Viewer -->
                        <div class="card shadow-sm" style="flex: 1; overflow: hidden;">
                            <div class="card-body" style="padding: 0;">
                                <h5 class="card-title" style="padding: 1rem;">Preview Document</h5>
                                <object data="/storage/{{ $data->file_path }}" type="application/pdf" width="100%"
                                    height="600px">
                                </object>
                            </div>
                        </div>

                        <!-- Form Input -->
                        <div class="card shadow-sm" style="overflow: auto;">
                            <div class="card-body">
                                <h5 class="card-title">Form Input</h5>
                                <form method="POST" action="{{ route('classification.store') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $data->id }}">

                                    <!-- No Dokumen dan Tanggal Dokumen -->
                                    <div class="form-row">
                                        <div class="form-group col-">
                                            <label for="no_dokumen">No Dokumen</label>
                                            <input type="text" class="form-control" id="no_dokumen" name="no_dokumen"
                                                value="{{ old('no_dokumen', $data->no_dokumen) }}"
                                                @if ($data->no_dokumen) readonly @endif>
                                        </div>
                                        <div class="form-group col-sm">
                                            <label for="tanggal_dokumen">Tanggal Dokumen</label>
                                            <input type="date" class="form-control" id="tanggal_dokumen"
                                                name="tanggal_dokumen"
                                                value="{{ old('tanggal_dokumen', $data->tanggal_dokumen) }}"
                                                @if ($data->tanggal_dokumen) readonly @endif>
                                        </div>
                                        <div class="form-group col-sm">
                                            <label for="nama_pihak_kedua">Nama Pihak Kedua</label>
                                            <input type="text" class="form-control" id="nama_pihak_kedua"
                                                name="nama_pihak_kedua"
                                                value="{{ old('nama_pihak_kedua', $data->nama_pihak_kedua) }}"
                                                @if ($data->nama_pihak_kedua) readonly @endif>
                                        </div>
                                    </div>


                                    <!-- Manifest dan Bukti Transfer -->
                                    <div class="form-row align-items-start">
                                        <div class="form-group col-md-2">
                                            <label>Manifest</label><br>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="manifest_yes"
                                                    name="manifest" value="1"
                                                    @if ($data->manifest == 1) checked @endif
                                                    {{-- @if ($data->manifest !== null) disabled @endif> --}}
                                                    >
                                                <label class="form-check-label" for="manifest_yes">Ada</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="manifest_no"
                                                    name="manifest" value="0"
                                                    @if ($data->manifest == 0) checked @endif
                                                    {{-- @if ($data->manifest !== null) disabled @endif> --}}
                                                    >
                                                <label class="form-check-label" for="manifest_no">Tidak Ada</label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label>Bukti Transfer</label><br>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="bukti_transfer_yes"
                                                    name="bukti_transfer" value="1"
                                                    @if ($data->bukti_transfer == 1) checked @endif
                                                    {{-- @if ($data->bukti_transfer !== null) disabled @endif --}}
                                                    >
                                                <label class="form-check-label" for="bukti_transfer_yes">Ada</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="bukti_transfer_no"
                                                    name="bukti_transfer" value="0"
                                                    @if ($data->bukti_transfer == 0) checked @endif
                                                    {{-- @if ($data->bukti_transfer !== null) disabled @endif --}}
                                                    >
                                                <label class="form-check-label" for="bukti_transfer_no">Tidak Ada</label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-8">
                                            <label for="keterangan">Keterangan</label>
                                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Masukkan keterangan"
                                                @if ($data->keterangan) readonly @endif>{{ old('keterangan', $data->keterangan) }}</textarea>
                                        </div>
                                    </div>


                                    <!-- Tanggal Keberangkatan -->
                                    <div class="form-group">
                                        <label for="tanggal_keberangkatan">Tanggal Keberangkatan</label>
                                        <div id="tanggal-keberangkatan-container">
                                            @foreach ($dates as $date)
                                                <div class="input-group mb-2">
                                                    <input type="date" class="form-control"
                                                        name="tanggal_keberangkatan[]"
                                                        value="{{ $date->tanggal_keberangkatan }}" readonly>
                                                    <!-- Readonly jika sudah ada data -->
                                                    <button type="button" class="btn btn-danger remove-date-btn"
                                                        @if (!$dates->isEmpty()) style="display: none;" @else style="display: block;" @endif>
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            @endforeach

                                            <!-- Tampilkan input dan tombol tambah hanya jika tidak ada tanggal yang terisi -->
                                            @if ($dates->isEmpty())
                                                <div class="input-group mb-2">
                                                    <input type="date" class="form-control"
                                                        name="tanggal_keberangkatan[]">
                                                    <button type="button" class="btn btn-success add-date-btn">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    @if (empty($data->nama_pihak_kedua))
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    @endif
                                </form>

                                <script>
                                    document.querySelector('.add-date-btn').addEventListener('click', function() {
                                        const newDateInput = document.createElement('div');
                                        newDateInput.classList.add('input-group', 'mb-2');
                                        newDateInput.innerHTML = `
                                            <input type="date" class="form-control" name="tanggal_keberangkatan[]">
                                            <button type="button" class="btn btn-danger remove-date-btn">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        `;
                                        document.getElementById('tanggal-keberangkatan-container').appendChild(newDateInput);
                                    });

                                    document.getElementById('tanggal-keberangkatan-container').addEventListener('click', function(e) {
                                        if (e.target.classList.contains('remove-date-btn')) {
                                            e.target.closest('.input-group').remove();
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>

                    <!-- Right Section (Checkbox Selection) -->
                    <div class="col-lg-7 col-md-6"
                        style="display: flex; flex-direction: column; height: 100%; overflow: auto;">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="card-header">
                                    <h5 class="card-title">Checkbox Selection</h5>
                                </div>
                                <div class="dt-responsive table-responsive">



                                    <div id="noDataMessage" class="text-center" style="display: none;">
                                        Silakan isi data detail BAK terlebih dahulu.
                                    </div>
                                    @if (!empty($ticketSales) && is_iterable($ticketSales) && $data->status != 'checked')
                                        <div id="loader" class="text-center" style="display: none;">
                                            <div class="spinner-border text-primary" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>
                                        <table id="checkbox-select" class="table table-striped table-bordered nowrap"
                                            style="display: none;">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>ID</th>
                                                    <th>Passenger Name</th>
                                                    <th>Order No</th>
                                                    <th>Origin</th>
                                                    <th>Departure Time</th>
                                                    <th>Destination</th>
                                                    <th>Arrival Time</th>
                                                </tr>
                                            </thead>
                                            <tbody> <!-- Rows here -->
                                                @foreach ($ticketSales as $item)
                                                    <tr>
                                                        <td></td>
                                                        <td>{{ $item->id }}</td>
                                                        <td>{{ $item->passenger_name }}</td>
                                                        <td>{{ $item->order_no }}</td>
                                                        <td>{{ $item->origin }}</td>
                                                        <td>{{ $item->departure_time }}</td>
                                                        <td>{{ $item->destination }}</td>
                                                        <td>{{ $item->arrival_time }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <div class="dt-plugin-buttons"></div>
                                    @else
                                        <table id="search-api" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Passenger Name</th>
                                                    <th>Order No</th>
                                                    <th>Origin</th>
                                                    <th>Departure Time</th>
                                                    <th>Destination</th>
                                                    <th>Arrival Time</th>
                                                </tr>
                                            </thead>
                                            <tbody> <!-- Rows here -->
                                                @foreach ($ticketSales as $item)
                                                    <tr>
                                                        <td>{{ $item->id }}</td>
                                                        <td>{{ $item->passenger_name }}</td>
                                                        <td>{{ $item->order_no }}</td>
                                                        <td>{{ $item->origin }}</td>
                                                        <td>{{ $item->departure_time }}</td>
                                                        <td>{{ $item->destination }}</td>
                                                        <td>{{ $item->arrival_time }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ Main Content ] end -->

            </div>
        </section>
        <!-- [ Main Content ] end -->

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const loader = document.getElementById('loader');
                const noDataMessage = document.getElementById('noDataMessage');
                const ticketTable = document.getElementById('checkbox-select');

                // Mengambil data ticketSales dari Blade
                const ticketSales =
                    @json($ticketSales); // Pastikan ini sesuai dengan variabel yang kamu kirim dari controller

                // console.log(ticketSales); // Untuk memverifikasi data yang diterima

                // Fungsi untuk memulai loading
                function startLoading() {
                    loader.style.display = 'block'; // Tampilkan loader
                    ticketTable.style.display = 'none'; // Sembunyikan tabel
                    noDataMessage.style.display = 'none'; // Sembunyikan pesan
                }

                // Fungsi untuk menghentikan loading
                function stopLoading() {
                    loader.style.display = 'none'; // Sembunyikan loader
                    ticketTable.style.display = 'table'; // Tampilkan tabel
                }

                // Fungsi untuk handle tampilan awal
                function handleDataDisplay() {
                    if (!ticketSales || ticketSales.length === 0) {
                        // Jika data kosong/null
                        noDataMessage.style.display = 'block'; // Tampilkan pesan
                        ticketTable.style.display = 'none'; // Sembunyikan tabel
                        loader.style.display = 'none'; // Sembunyikan loader
                    } else {
                        // Jika ada data
                        startLoading();
                        setTimeout(() => {
                            stopLoading(); // Sembunyikan loader setelah data selesai
                        }, 2000); // Simulasi waktu loading
                    }
                }

                // Jalankan fungsi saat halaman siap
                handleDataDisplay();
            });
        </script>
    @endsection
