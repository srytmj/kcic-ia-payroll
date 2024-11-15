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
                                <h5 class="m-b-10">Data from Table: {{ ucfirst($tablename) }}</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.html"><i class="feather icon-home"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="#!">Data Table</a></li>
                                <li class="breadcrumb-item"><a href="#!">Basic Initialization</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- DataTable for User Access Menu start -->
                <div class="col-sm-12 mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Data {{ ucfirst($tablename) }}</h5>
                            <div class="card-header-right">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#createModal">Tambah Data</button>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Delete
                                    Selected</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="dt-responsive table-responsive">
                                <table id="userAccessMenuTable" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th style="width: 3%;">Id</th>
                                            <th style="width: 5%;">Periode</th>
                                            <th style="width: 70%;">BAK</th>
                                            <th style="width: 15%;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $item)
                                            <tr class="datarow" data-id="{{ $item->id }}">
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->periode }}</td>
                                                <td>{{ $item->file_name }}</td>
                                                <td>
                                                    <div class="btn-group dropstart">
                                                        <button type="button" class="btn btn-light-secondary">Split dropup</button> 
 
                                                        <button type="button" class="btn btn-light-secondary dropdown-toggle dropdown-toggle-split view-pdf-button" data-bs-toggle="dropdown" data-toggle="modal" data-target="#pdfModal" data-file="{{ asset('storage/' . $item->file_path) }}" aria-expanded="false"> Lihat PDF
                                                            <span class="visually-hidden">Toggle Dropdown</span>
                                                        </button>
                                                            type="button" class="btn btn-info view-pdf-button"
                                                           >
                                                            Lihat PDF
                                                        <div class="dropdown-menu" style="">
                                                            <a class="dropdown-item" href="#!" disabled>Aksi</a>
                                                            <a class="dropdown-item edit-button" data-toggle="modal"
                                                                data-target="#editModal" data-table="{{ $tablename }}"
                                                                data-id="{{ $item->id }}">
                                                                Edit
                                                            </a>
                                                            <a class="dropdown-item delete-button" data-toggle="modal"
                                                                data-target="#deletemodal" data-table="{{ $tablename }}"
                                                                data-id="{{ $item->id }}">
                                                                Hapus
                                                            </a>
                                                    </div>
                                                    
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            id="dropdownMenuButton{{ $item->id }}"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            Aksi
                                                        </button>
                                                        <div class="dropdown-menu"
                                                            aria-labelledby="dropdownMenuButton{{ $item->id }}">
                                                            <a class="dropdown-item view-pdf-button" data-toggle="modal"
                                                                data-target="#pdfModal"
                                                                data-file="{{ asset('storage/' . $item->file_path) }}">
                                                                Lihat PDF
                                                            </a>
                                                            
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-right mt-3">
                                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </div>
                    <!-- Bagian untuk Menampilkan Checklist -->
                    <div class="card-footer">
                        <h5>Data Terpilih:</h5>
                        <ul id="selected-items-list" class="list-group">
                            <!-- Daftar data terpilih akan muncul di sini -->
                        </ul>
                    </div>
                </div>
                <!-- DataTable for User Access Menu end -->
            </div>
        </div>
    </section>
    <!-- [ Main Content ] end -->

    @include('farebox.document.' . $tablename . '.create')

    <div id="pdfModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabel">File PDF</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body" style="height: 80vh;">
                    <iframe id="pdfViewer" src="" width="100%" height="100%" frameborder="0"></iframe>
                </div>
                <div class="modal-footer">
                    {{-- Optional footer buttons can be added here --}}
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).on('click', '.view-pdf-button', function() {
            var fileUrl = $(this).data('file');
            $('#pdfViewer').attr('src', fileUrl);
        });
    </script>

    @include('farebox.document.' . $tablename . '.delete')
@endsection
