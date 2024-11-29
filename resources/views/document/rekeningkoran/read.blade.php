@extends('layout')

@section('content')
    <style>
        .dropdown-card {
            position: absolute;
            /* or fixed, depending on your layout */
            z-index: 1000;
            /* ensure it appears above other elements */
            top: 50px;
            /* adjust this value as necessary */
            left: 0;
            /* adjust this value as necessary */
        }
    </style>

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

                <!-- Search API (Regular Expressions) table start -->
                <div class="col-sm-12">
                    <div class="card">

                        {{-- card header --}}
                        <div class="card-header">
                            <h5>Data {{ $table }}</h5>
                            <div class="card-header-right d-flex justify-content-between">
                                <div class="d-flex justify-content-between align-items-center">
                                    <button class="btn btn-primary mr-2" id="toggleDropdown">Show/Hide Column</button>

                                    <!-- Dropdown Card -->
                                    <div class="dropdown-card" id="dropdownCard" style="display: none;">
                                        <div class="card">
                                            <div class="card-body">
                                                <form id="columnToggleForm">
                                                    @foreach ($columns as $index => $column)
                                                        <div
                                                            class="form-group d-flex justify-content-between align-items-center mb-3">
                                                            <label class="form-check-label"
                                                                for="colCheckbox{{ $index }}">{{ ucfirst($column) }}</label>
                                                            <div class="form-check form-switch">
                                                                <input class="columnCheckbox form-check-input"
                                                                    type="checkbox" role="switch"
                                                                    id="colCheckbox{{ $index }}"
                                                                    data-column="{{ $index }}" checked>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Dropdown Card End -->

                                    <button class="btn btn-primary" data-toggle="collapse" data-target="#collapseUpload"
                                        aria-expanded="false" aria-controls="collapseUpload">Upload Files</button>
                                </div>
                            </div>
                        </div>
                        {{-- card header end --}}

                        @include($type . '.' . $table . '.create')

                        {{-- card body --}}
                        <div class="card-body">
                            {{-- Search API --}}
                            {{-- <div class="dt-responsive table-responsive">
                                <table class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>Target</th>
                                            <th>Search text</th>
                                        </tr>
                                    </thead>
                                    <tbody class="search-api">
                                        <tr id="filter_global">
                                            <td>Global search</td>
                                            <td>
                                                <input type="text" class="global_filter form-control" id="global_filter">
                                            </td>
                                        </tr>
                                        <tr id="filter_col1" data-column="0">
                                            <td>Column - Name</td>
                                            <td>
                                                <input type="text" class="column_filter form-control" id="col0_filter">
                                            </td>
                                        </tr>
                                        <tr id="filter_col2" data-column="1">
                                            <td>Column - Position</td>
                                            <td>
                                                <input type="text" class="column_filter form-control" id="col1_filter">
                                            </td>
                                        </tr>
                                        @foreach (array_keys($datas[0]->getAttributes()) as $index => $column)
                                            @if ($index !== 0 && $index < count($datas[0]->getAttributes()) - 2)
                                                <tr id="filter_col{{ $index }}" data-column="{{ $index }}">
                                                    <td>Column - {{ ucfirst($column) }}</td>
                                                    <td>
                                                        <input type="text" class="column_filter form-control"
                                                            id="col{{ $index }}_filter">
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> --}}
                            {{-- Search API end --}}

                            <!-- Tabel data -->
                            <div class="dt-responsive table-responsive">
                                <table id="search-api" class="table table-striped table-bordered nowrap">

                                    {{-- head column --}}
                                    <thead>
                                        <tr>
                                            @foreach ($columns as $index => $column)
                                                <th class="column{{ $index }}">{{ ucfirst($column) }}</th>
                                            @endforeach
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    {{-- head column end --}}

                                    {{-- data --}}
                                    <tbody>
                                        @foreach ($datas as $data)
                                            <tr>

                                                {{-- Loop through the columns --}}
                                                @foreach ($columns as $index => $column)
                                                    {{-- If it's the first column, treat it as the "id" --}}
                                                    @if ($index == 0)
                                                        {{-- Store the id --}}
                                                        @php $id = $data->$column; $path = $data->file_path; @endphp
                                                    @endif

                                                    {{-- Display the column data --}}
                                                    <td class="column{{ $index }}">{{ $data->$column }}</td>
                                                @endforeach
                                                {{-- Columns end --}}

                                                {{-- aksi --}}
                                                <td>
                                                    <div class="btn-group mb-2 mr-2">
                                                        <!-- Tombol untuk membuka modal -->


                                                        {{-- Tombol untuk membuka modal PDF --}}
                                                        <a class="btn btn-primary view-pdf-button" data-toggle="modal"
                                                            data-target="#pdfModal" data-path="{{ $path }}"
                                                            style="margin-left: 5px; color:white;">
                                                            Lihat PDF
                                                        </a>


                                                        <!-- Dropdown untuk Edit dan Hapus -->
                                                        <button type="button"
                                                            class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            {{-- <span class="sr-only">Toggle Dropdown</span> --}}
                                                        </button>
                                                        <div class="dropdown-menu">

                                                            <a class="dropdown-item edit-button" type="button"
                                                                data-toggle="modal" data-target="#editModal"
                                                                data-table="{{ $table }}"
                                                                data-id="{{ $id }}"> {{-- Use the stored id --}}
                                                                Edit
                                                            </a>

                                                            <a class="dropdown-item delete-button" data-toggle="modal"
                                                                data-target="#deleteModal" data-table="{{ $table }}"
                                                                data-id="{{ $data->id }}">Hapus</a>
                                                            <div class="dropdown-divider"></div>
                                                            {{-- <a class="dropdown-item" href="#!">Separated link</a> --}}
                                                            <a href="{{ route('rekeningkoran.download', $data->id) }}" class="dropdown-item">Download PDF</a>

                                                        </div>
                                                    </div>
                                                </td>
                                                {{-- aksi end --}}

                                            </tr>
                                        @endforeach
                                    </tbody>
                                    {{-- data end --}}

                                    {{-- foot column --}}
                                    <tfoot>
                                        <tr>
                                            @foreach ($columns as $index => $column)
                                                <th class="column{{ $index }}">{{ ucfirst($column) }}</th>
                                            @endforeach
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    {{-- foot column end --}}

                                </table>

                            </div>
                            {{-- table end --}}

                        </div>
                    </div>
                </div>
                <!-- Search API (Regular Expressions) table end -->

            </div>
            <!-- [ Main Content ] end -->

        </div>
    </section>
    <!-- [ Main Content ] end -->

    {{-- Script to toggle column visibility --}}
    <script>
        document.getElementById('toggleDropdown').addEventListener('click', function() {
            const dropdownCard = document.getElementById('dropdownCard');
            dropdownCard.style.display = dropdownCard.style.display === 'none' ? 'block' : 'none';
        });

        // Optional: Close dropdown when clicking outside
        window.addEventListener('click', function(event) {
            const dropdownCard = document.getElementById('dropdownCard');
            if (!document.getElementById('toggleDropdown').contains(event.target) && !dropdownCard.contains(event
                    .target)) {
                dropdownCard.style.display = 'none';
            }
        });


        document.addEventListener('DOMContentLoaded', function() {
            const columnCheckboxes = document.querySelectorAll('.columnCheckbox');
            const table = document.querySelector('#search-api');
            const columns = table.querySelectorAll('th');

            // Initialize column visibility from localStorage
            columnCheckboxes.forEach(function(checkbox, index) {
                const column = parseInt(checkbox.dataset.column); // Get the column index from checkbox
                const storedVisibility = localStorage.getItem('colVisibility' +
                    column); // Retrieve visibility status from localStorage

                // Apply visibility based on stored state
                if (storedVisibility === 'false') {
                    hideColumn(column);
                    checkbox.checked = false;
                } else {
                    showColumn(column);
                }
            });

            // Event listener for checkbox changes
            columnCheckboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    const column = parseInt(this.dataset.column);

                    if (this.checked) {
                        showColumn(column); // Show column when checked
                        localStorage.setItem('colVisibility' + column,
                            true); // Save to localStorage
                    } else {
                        hideColumn(column); // Hide column when unchecked
                        localStorage.setItem('colVisibility' + column,
                            false); // Save to localStorage
                    }
                });
            });

            // Function to hide a column
            function hideColumn(columnIndex) {
                columns[columnIndex].style.display = 'none'; // Hide the header
                for (let i = 0; i < table.rows.length; i++) {
                    const cell = table.rows[i].cells[columnIndex];
                    if (cell) cell.style.display = 'none'; // Hide each cell in the column
                }
            }

            // Function to show a column
            function showColumn(columnIndex) {
                columns[columnIndex].style.display = ''; // Show the header
                for (let i = 0; i < table.rows.length; i++) {
                    const cell = table.rows[i].cells[columnIndex];
                    if (cell) cell.style.display = ''; // Show each cell in the column
                }
            }
        });
    </script>
    {{-- Script end --}}

    {{-- Script to handle AJAX delete and edit --}}
    <script>
        // Mengonfirmasi Hapus
        $(document).on('click', '.delete-button', function() {
            const itemId = $(this).data('id');
            const itemTable = $(this).data('table');
            // Simpan itemId untuk dihapus nanti
            $('#confirmDelete').data('id', itemId);
        });

        // Tangani konfirmasi hapus
        $('#confirmDelete').on('click', function() {
            const itemId = $(this).data('id');
            // Lakukan AJAX untuk menghapus item berdasarkan itemId
        });
    </script>
    {{-- Script end --}}

    @include($type . '.' . $table . '.update')
    @include($type . '.' . $table . '.delete')
    @include($type . '.' . $table . '.readmodal')
@endsection
