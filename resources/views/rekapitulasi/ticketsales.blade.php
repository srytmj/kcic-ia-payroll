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
                                    <h5 class="m-b-10">Rekapitulasi</h5>
                                </div>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="#!">Rekapitulasi</a></li>
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
                            <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                                <h5>Klasifikasi</h5>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#exportModal">Export Data</button>
                            </div>
                            

                            <!-- Modal -->
                            <div class="modal fade" id="exportModal" tabindex="-1" role="dialog"
                                aria-labelledby="exportModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exportModalLabel">Export Data</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="GET" action="{{ route('export.csv.ticketsales') }}">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="start">Start From</label>
                                                    <select name="start" id="start" class="form-control">
                                                        @foreach ($periodeList as $periode)
                                                            <option value="{{ $periode }}">{{ $periode }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="to">To</label>
                                                    <select name="to" id="to" class="form-control">
                                                        @foreach ($periodeList as $periode)
                                                            <option value="{{ $periode }}">{{ $periode }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Export</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="dt-responsive table-responsive">
                                    <table id="search-api" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Periode</th>
                                                <th>ROmbongan</th>
                                                <th>Nama</th>
                                                <th>NIK</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($datas as $data)
                                                <tr>
                                                    {{-- Columns start --}}
                                                    <td class="id">{{ $data->id }}</td>
                                                    <td class="periode">{{ $data->periode }}</td>
                                                    <td class="status">{{ $data->nama_pihak_kedua }}</td>
                                                    <td class="file_name">{{ $data->passenger_name }}</td>
                                                    <td class="status">{{ $data->nik_passport_no }}</td>
                                                    {{-- Columns end --}}
                                                </tr>
                                            @endforeach
                                        </tbody>
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
