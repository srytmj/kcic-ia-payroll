@extends('layout')
@php
    $penjualanPerStasiun = json_decode(json_encode($penjualanPerStasiun), true);
@endphp

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
                                <h5 class="m-b-10">Dashboard sale</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">Dashboard sale</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- amount start -->
                <div class="col-md-6 col-xl-4">
                    <div class="card amount-card overflow-hidden">
                        <div class="card-body">
                            <h2 class="f-w-400">
                                {{ 'Rp ' . number_format(optional(collect($penjualanPerSeatClass)->firstWhere('seat_class', 'Premium Economy Class'))->total_pendapatan ?? 0, 0, ',', '.') }}
                            </h2>
                            <p class="text-muted f-w-600 f-16"><span class="text-c-blue">Premium Economy</span> Class</p>
                        </div>
                        <div id="premiumeconomy-class"></div>
                    </div>
                </div>
                
                <div class="col-md-6 col-xl-4">
                    <div class="card amount-card overflow-hidden">
                        <div class="card-body">
                            <h2 class="f-w-400">
                                {{ 'Rp ' . number_format(optional(collect($penjualanPerSeatClass)->firstWhere('seat_class', 'Business Class'))->total_pendapatan ?? 0, 0, ',', '.') }}
                            </h2>
                            <p class="text-muted f-w-600 f-16"><span class="text-c-green">Business</span> Class</p>
                        </div>
                        <div id="business-class"></div>
                    </div>
                </div>
                
                <div class="col-md-12 col-xl-4">
                    <div class="card amount-card overflow-hidden">
                        <div class="card-body">
                            <h2 class="f-w-400">
                                {{ 'Rp ' . number_format(optional(collect($penjualanPerSeatClass)->firstWhere('seat_class', 'First Class'))->total_pendapatan ?? 0, 0, ',', '.') }}
                            </h2>
                            <p class="text-muted f-w-600 f-16"><span class="text-c-yellow">First</span> Class</p>
                        </div>
                        <div id="first-class"></div>
                    </div>
                </div>
                               
                <!-- amount end -->
                <!-- page statustic card start -->
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="text-c-yellow">Rp. {{ number_format(collect($penjualanPerSeatClass)->sum('total_pendapatan') ?? 0, 0, ',', '.') }}</h4>
                                    <h6 class="text-muted m-b-0">Total Pendapatan</h6>
                                </div>
                                <div class="col-4 text-right">
                                    <i class="feather icon-bar-chart-2 f-28"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-c-yellow">
                            <div class="row align-items-center">
                                <div class="col-9">
                                    <p class="text-white m-b-0">% change</p>
                                </div>
                                <div class="col-3 text-right">
                                    <i class="feather icon-trending-up text-white f-16"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="text-c-green">
                                        {{ collect($penjualanPerStasiun)->firstWhere('stasiun', 'Halim')['total_keberangkatan'] ?? 0 }}
                                    </h4>
                                    <h6 class="text-muted m-b-0">Halim</h6>
                                </div>
                                <div class="col-4 text-right">
                                    <i class="feather icon-file-text f-28"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-c-green">
                            <div class="row align-items-center">
                                <div class="col-9">
                                    <p class="text-white m-b-0">% change</p>
                                </div>
                                <div class="col-3 text-right">
                                    <i class="feather icon-trending-up text-white f-16"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="text-c-red">
                                        {{ collect($penjualanPerStasiun)->firstWhere('stasiun', 'Padalarang')['total_keberangkatan'] ?? 0 }}
                                    </h4>
                                    <h6 class="text-muted m-b-0">Padalarang</h6>
                                </div>
                                <div class="col-4 text-right">
                                    <i class="feather icon-calendar f-28"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-c-red">
                            <div class="row align-items-center">
                                <div class="col-9">
                                    <p class="text-white m-b-0">% change</p>
                                </div>
                                <div class="col-3 text-right">
                                    <i class="feather icon-trending-down text-white f-16"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="text-c-blue">
                                        {{collect($penjualanPerStasiun)->firstWhere('stasiun', 'Tegalluar')->total_keberangkatan ?? 0}}
                                    </h4>
                                    <h6 class="text-muted m-b-0">Tegalluar Summarecon</h6>
                                </div>
                                <div class="col-4 text-right">
                                    <i class="feather icon-thumbs-down f-28"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-c-blue">
                            <div class="row align-items-center">
                                <div class="col-9">
                                    <p class="text-white m-b-0">% change</p>
                                </div>
                                <div class="col-3 text-right">
                                    <i class="feather icon-trending-down text-white f-16"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
                <!-- page statustic card end -->
                <!-- Data Pejualan Perhari end -->
                <div class="col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Data Pejualan Perhari</h5>
                        </div>
                        <div class="card-body">
                            <div class="row my-2">
                                <div class="col-auto">
                                    <h4 class="m-0">
                                        {{ collect($penjualanPerHari)->sum('total_tiket_terjual') ?? 0 }}
                                        {{-- <i class="feather icon-arrow-up text-c-green"></i> --}}
                                    </h4>
                                    <span>Total Penumpang</span>
                                </div>
                                <div class="col-auto">
                                    <h4 class="m-0">
                                        {{ round(collect($penjualanPerHari)->avg('total_tiket_terjual')) ?? 0 }}
                                        {{-- <i class="feather icon-arrow-down text-c-red"></i> --}}
                                    </h4>
                                    <span>Penumpang per hari</span>
                                </div>
                            </div>
                            <div id="realtime-visit-chart"></div>
                        </div>
                    </div>
                </div>
                <!-- Data Pejualan Perhari end -->
                <!-- Traffic-section start -->
                {{-- <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Seat Class</h5>
                        </div>
                        <div class="card-body">
                            <div id="traffic-chart1"></div>
                        </div>
                    </div>
                </div> --}}
                <!-- Traffic-section end -->

            </div>
            <!-- [ Main Content ] end -->

        </div>
    </div>
    <!-- [ Main Content ] end -->


    <!-- Button trigger modal -->

    <!-- [ Main Content ] end -->

    <!-- Warning Section Ends -->
@endsection
