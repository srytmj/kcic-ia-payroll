@extends('layout')

@section('content')
    <style>
        .dropdown-card {
            position: absolute;
            z-index: 1000;
            top: 50px;
            left: 0;
        }

        /* Style untuk loading bar */
        .loading-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .loading-text {
            color: black;
            position: absolute;
            /* Menempatkan teks di atas bar */
            font-size: 18px;
            z-index: 1;
            /* Pastikan teks muncul di atas elemen lainnya */
        }

        .loading-bar {
            width: 100px;
            height: 10px;
            background-color: #e0e0e0;
            border-radius: 5px;
            overflow: hidden;
            position: relative;
            z-index: 0;
            /* Menempatkan bar di bawah teks */
        }

        .loading-progress {
            height: 100%;
            background-color: #4680ff;
            animation: loading 3s ease-out forwards;
        }

        #dataTableContainer {
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        #dataTableContainer.show {
            visibility: visible;
            opacity: 1;
        }

        @keyframes loading {
            0% {
                width: 0;
            }

            100% {
                width: 100%;
            }
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

                            <!-- Loading Bar -->
                            <div class="loading-container" id="loadingContainer">
                                <div class="loading-text">Loading Data...</div>
                                <br>
                                <div class="loading-bar">
                                    <div class="loading-progress"></div>
                                </div>
                            </div>


                            <!-- Tabel data, initially hidden -->
                            <div class="dt-responsive table-responsive" id="dataTableContainer">
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
                                                        @php
                                                            $id = $data->$column;
                                                            $path = $data->file_path;
                                                        @endphp
                                                    @endif

                                                    {{-- Display the column data --}}
                                                    <td class="column{{ $index }}">{{ $data->$column }}</td>
                                                @endforeach
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
                                                            <a class="dropdown-item edit-button" type="button"
                                                                data-toggle="modal" data-target="#editModal"
                                                                data-table="{{ $table }}"
                                                                data-id="{{ $id }}"> Edit </a>
                                                            <a class="dropdown-item delete-button" data-toggle="modal"
                                                                data-target="#deleteModal lg" data-table="{{ $table }}"
                                                                data-id="{{ $data->id }}">Hapus</a>
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

        window.addEventListener('click', function(event) {
            const dropdownCard = document.getElementById('dropdownCard');
            if (!document.getElementById('toggleDropdown').contains(event.target) && !dropdownCard.contains(event
                    .target)) {
                dropdownCard.style.display = 'none';
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Simulate loading time (3 seconds)
            setTimeout(function() {
                // After loading completes, hide the loading bar and show the table
                document.getElementById('loadingContainer').style.display = 'none';
                document.getElementById('dataTableContainer').classList.add('show');
            }, 0); // 3 seconds loading time

            const columnCheckboxes = document.querySelectorAll('.columnCheckbox');
            const table = document.querySelector('#search-api');
            const columns = table.querySelectorAll('th');

            columnCheckboxes.forEach(function(checkbox, index) {
                const column = parseInt(checkbox.dataset.column);
                const storedVisibility = localStorage.getItem('colVisibility' + column);

                if (storedVisibility === 'false') {
                    hideColumn(column);
                    checkbox.checked = false;
                } else {
                    showColumn(column);
                }
            });

            columnCheckboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    const column = parseInt(this.dataset.column);

                    if (this.checked) {
                        showColumn(column);
                        localStorage.setItem('colVisibility' + column, true);
                    } else {
                        hideColumn(column);
                        localStorage.setItem('colVisibility' + column, false);
                    }
                });
            });

            function hideColumn(columnIndex) {
                columns[columnIndex].style.display = 'none';
                for (let i = 0; i < table.rows.length; i++) {
                    const cell = table.rows[i].cells[columnIndex];
                    if (cell) cell.style.display = 'none';
                }
            }

            function showColumn(columnIndex) {
                columns[columnIndex].style.display = '';
                for (let i = 0; i < table.rows.length; i++) {
                    const cell = table.rows[i].cells[columnIndex];
                    if (cell) cell.style.display = '';
                }
            }
        });
    </script>
    {{-- Script end --}}

    {{-- Script to handle AJAX delete and edit --}}
    <script>
        $(document).on('click', '.delete-button', function() {
            const itemId = $(this).data('id');
            const itemTable = $(this).data('table');
            $('#confirmDelete').data('id', itemId);
        });

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
