@extends('layout')

@section('content')
    <!-- [ Main Content ] start -->
    <section class="pcoded-main-container">
        <div class="pcoded-content">

            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">API DataTable</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">Data Table</a></li>
                                <li class="breadcrumb-item"><a href="#!">API Initialization</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            <div class="row">

                <!-- Alternative Pagination table start -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Alternative Pagination</h5>
                        </div>
                        <div class="card-body">
                            <div class="dt-responsive table-responsive">
                                <table id="search-api" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Periode</th>
                                            <th>No. Dokumen</th>
                                            <th>Nama Pihak Kedua</th>
                                            <th>Tanggal Dokumen</th>
                                            <th>Bukti Transfer</th>
                                            <th>Manifest</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($datas as $data)
                                            <tr>
                                                {{-- Columns start --}}
                                                <td class="id">{{ $data->id }}</td>
                                                <td class="periode">{{ $data->periode }}</td>
                                                <td class="status">{{ $data->no_dokumen }}</td>
                                                <td class="file_name">{{ $data->nama_pihak_kedua }}</td>
                                                <td class="status">{{ $data->tanggal_dokumen }}</td>
                                                <td class="status">{{ $data->bukti_transfer }}</td>
                                                <td class="status">{{ $data->manifest }}</td>
                                                <td class="status">{{ $data->keterangan }}</td>
                                                {{-- Columns end --}}
                                            </tr>
                                        @endforeach
                                    </tbody>

                                    {{-- <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                        </tr>
                                    </tfoot> --}}
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->

        </div>
    </section>
    <!-- [ Main Content ] end -->
@endsection
