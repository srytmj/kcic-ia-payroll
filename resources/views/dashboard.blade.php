@extends('layout')

@section('content')
    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Dashboard</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">Dashboard</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-4 text-center mb-3 mb-md-0">
                                    <img src="{{ asset('assets/images/kcic-logo.png') }}" alt="Logo KCIC"
                                        style="max-width: 80%; height: auto;">
                                </div>
                                <div class="col-md-8">
                                    <p>
                                        <strong>PT Kereta Cepat Indonesia China (KCIC)</strong> adalah perusahaan patungan
                                        antara konsorsium perusahaan Indonesia yang diwakili oleh <em>PT Pilar Sinergi BUMN
                                            Indonesia (PSBI)</em>, dan konsorsium perusahaan dari Tiongkok yang diwakili
                                        oleh <em>Konsorsium Beijing Yawan</em>.
                                    </p>
                                    <p>
                                        Didirikan pada tahun 2015 dengan kantor pusat di Jakarta, KCIC bertugas membangun
                                        dan mengoperasikan proyek strategis nasional, yaitu <strong>kereta cepat
                                            Jakarta–Bandung</strong>. Proyek ini menjadi layanan kereta cepat pertama di
                                        Indonesia, mempercepat waktu tempuh antar kota hanya sekitar 40 menit.
                                    </p>
                                    <p>
                                        KCIC juga mendukung pengembangan kawasan <em>Transit-Oriented Development (TOD)</em>
                                        di sekitar stasiun-stasiun yang dilewati jalur kereta cepat.
                                    </p>
                                    <p>
                                        <strong>Visi:</strong> Menjadikan kehidupan masyarakat lebih baik dengan menyediakan
                                        konektivitas pilihan utama serta menciptakan lingkungan hidup yang menyenangkan.
                                    </p>
                                    <p>
                                        <strong>Misi:</strong> Menyediakan transportasi yang paling aman, cepat, tepat
                                        waktu, nyaman, dan modern, serta menciptakan gaya hidup yang indah, bahagia, dan
                                        ramah lingkungan di sepanjang koridor yang dibangun.
                                    </p>
                                    <p class="mt-3">
                                        <strong>Website resmi:</strong> <a href="https://kcic.co.id"
                                            target="_blank">https://kcic.co.id</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-xl-6 col-md-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">Jumlah Data Ticket Sales</h5>
                        </div>
                        <div class="card-body text-center">
                            <h3>{{ $ticketSalesCount }}</h3>
                            <p>Total data ticket sales yang ada di database.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">Jumlah Dokumen BAK</h5>
                        </div>
                        <div class="card-body text-center">
                            <h3>{{ $bakCount }}</h3>
                            <p>Total dokumen BAK yang ada di database.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->


        </div>
    </div>
    <!-- [ Main Content ] end -->


    <!-- Button trigger modal -->

    <!-- [ Main Content ] end -->

    <!-- Warning Section Ends -->
@endsection
