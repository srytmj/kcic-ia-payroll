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
                                <button class="btn btn-primary" data-toggle="modal" data-target="#createModal">Tambah
                                    Data</button>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Delete
                                    Selected</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="dt-responsive table-responsive">
                                <table id="userAccessMenuTable" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th style="width: 2%"><input type="checkbox" id="select-all"></th>
                                            <th style="width: 3%;">Id</th>
                                            <th style="width: 5%;">Periode</th>
                                            <th style="width: 70%;">BAK</th>
                                            <th style="width: 15%;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $item)
                                            <tr class="datarow" data-id="{{ $item->id }}">
                                                <td><input type="checkbox" class="select-item"
                                                        data-id="{{ $item->id }}"></td>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->periode }}</td>
                                                <td>{{ $item->file_name }}</td>
                                                <td>
                                                    <!-- View PDF Button -->
                                                    <button type="button" class="btn btn-info view-pdf-button"
                                                        data-toggle="modal" data-target="#pdfModal"
                                                        data-file="{{ asset('storage/' . $item->file_path) }}">
                                                        Lihat PDF
                                                    </button>

                                                    <!-- Edit Button -->
                                                    <button type="button" class="btn btn-warning edit-button"
                                                        data-toggle="modal" data-target="#editModal"
                                                        data-table="{{ $tablename }}" data-id="{{ $item->id }}">
                                                        Edit
                                                    </button>
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

    <script>
        $(document).ready(function() {
            var selectedIds = [];

            // Function to update the list of selected items below the table
            function updateSelectedList() {
                var itemListHtml = '';
                if (selectedIds.length > 0) {
                    selectedIds.forEach(function(id) {
                        var rowText = $('tr[data-id="' + id + '"]').find('td').eq(2).text();
                        itemListHtml += '<li class="list-group-item">' + rowText + '</li>';
                    });
                } else {
                    itemListHtml = '<li class="list-group-item">Tidak ada data yang dipilih</li>';
                }
                $('#selected-items-list').html(itemListHtml);
            }

            // Handle select all checkbox
            $('#select-all').on('click', function() {
                var isChecked = $(this).is(':checked');
                $('.select-item').prop('checked', isChecked);

                $('.select-item').each(function() {
                    var id = $(this).data('id');
                    if (isChecked && !selectedIds.includes(id)) {
                        selectedIds.push(id);
                    } else if (!isChecked) {
                        selectedIds = selectedIds.filter(function(item) {
                            return item !== id;
                        });
                    }
                });
                updateSelectedList(); // Update the selected list below the table
            });

            // Handle individual checkbox click
            $(document).on('click', '.select-item', function() {
                var id = $(this).data('id');
                if ($(this).is(':checked')) {
                    if (!selectedIds.includes(id)) {
                        selectedIds.push(id);
                    }
                } else {
                    selectedIds = selectedIds.filter(function(item) {
                        return item !== id;
                    });
                }
                updateSelectedList(); // Update the selected list below the table
            });

            // Handle pagination event (if using a pagination plugin, handle its event here)
            $('#userAccessMenuTable').on('draw.dt', function() {
                maintainCheckedState();
                updateSelectedList(); // Maintain the selected list when pagination changes
            });

            // Show delete modal and populate data
            $('.btn-danger').on('click', function() {
                if (selectedIds.length > 0) {
                    $('#selected-count').text(selectedIds.length);
                    var itemListHtml = '';
                    selectedIds.forEach(function(id) {
                        var rowText = $('tr[data-id="' + id + '"]').find('td').eq(2).text();
                        itemListHtml += '<li>' + rowText + '</li>';
                    });
                    $('#deleteModal').modal('show');
                }
            });

            // Confirm delete action
            $('#confirm-delete').on('click', function() {
                $.ajax({
                    url: '{{ route('delete.selected') }}', // Ganti route sesuai kebutuhan
                    method: 'DELETE',
                    data: {
                        ids: selectedIds,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            selectedIds.forEach(function(id) {
                                $('tr[data-id="' + id + '"]').remove();
                            });
                            selectedIds = [];
                            updateSelectedList(); // Clear the selected list after deletion
                            $('#deleteModal').modal('hide');
                        }
                    }
                });
            });

            // Function to maintain checked state across pagination
            function maintainCheckedState() {
                $('.select-item').each(function() {
                    var id = $(this).data('id');
                    if (selectedIds.includes(id)) {
                        $(this).prop('checked', true);
                    } else {
                        $(this).prop('checked', false);
                    }
                });
            }
        });
    </script>

    @include('farebox.document.' . $tablename . '.delete')
@endsection
