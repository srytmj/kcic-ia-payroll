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
                                            <th>File Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($datas as $data)
                                            <tr>
                                                {{-- Columns start --}}
                                                <td class="id">{{ $data->id }}</td>
                                                <td class="periode">{{ $data->periode }}</td>
                                                <td class="file_name">{{ $data->file_name }}</td>
                                                <td class="status">{{ $data->status }}</td>
                                                {{-- Columns end --}}

                                                {{-- aksi --}}
                                                <td>
                                                    <div class="btn-group mb-2 mr-2">
                                                        <!-- Dropdown untuk Edit dan Hapus -->
                                                        <button type="button"
                                                            class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item view-pdf-button" type="button"
                                                                data-toggle="modal" data-target="#pdfModal"
                                                                data-path="{{ $data->file_path }}"
                                                                data-id="{{ $data->id }}"> Lihat PDF
                                                            </a>

                                                            <a class="dropdown-item classification-button"
                                                                href="classification/create/{{$data->id}}">
                                                                Klasifikasi
                                                            </a>


                                                        </div>
                                                    </div>
                                                </td>
                                                {{-- aksi end --}}
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

    {{-- @include($type . '.' . $table . '.update')
    @include($type . '.' . $table . '.delete') --}}
    @include('classification.readmodal')
@endsection
