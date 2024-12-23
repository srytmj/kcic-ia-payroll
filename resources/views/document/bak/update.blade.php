<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="editform" action="{{ route('bak.update', ['id' => 'id']) }}">
                    @csrf
                    @method('PUT')

                    {{-- <p>{{ $id }}</p> --}}
                    <input type="hidden" name="id" id="id"> <!-- Hidden input for ID -->
                    <div class="form-group">
                        <label for="periode">Periode (Bulan-Tahun)</label>
                        <input type="month" id="periode" name="periode" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="file_name">Nama File:</label>
                        <input type="text" class="form-control" id="file_name" name="file_name" required>
                    </div>

                    <div class="form-group">
                        <label for="status">Status:</label><br>
                        <label><input type="radio" name="status" value="pending" id="status_pending"> Pending</label>
                        <label><input type="radio" name="status" value="listed" id="status_listed"> Listed</label>
                    </div>

                    <div class="form-group">
                        <label for="nama_pihak_kedua">Nama Pihak Kedua:</label>
                        <input type="text" class="form-control" id="nama_pihak_kedua" name="nama_pihak_kedua"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="no_dokumen">No Dokumen:</label>
                        <input type="text" class="form-control" id="no_dokumen" name="no_dokumen">
                    </div>

                    <div class="form-group">
                        <label for="total_nominal">Total Nominal:</label>
                        <input type="number" class="form-control" id="total_nominal" name="total_nominal">
                    </div>

                    <div class="form-group">
                        <label for="tanggal_dokumen">Tanggal Dokumen:</label>
                        <input type="date" class="form-control" id="tanggal_dokumen" name="tanggal_dokumen">
                    </div>

                    <div class="form-group">
                        <label for="bukti_transfer">Bukti Transfer:</label><br>
                        <label><input type="radio" name="bukti_transfer" value="0" id="bukti_transfer_0"> Tidak
                            Ada</label>
                        <label><input type="radio" name="bukti_transfer" value="1" id="bukti_transfer_1">
                            Ada</label>
                    </div>

                    <div class="form-group">
                        <label for="manifest">Manifest:</label><br>
                        <label><input type="radio" name="manifest" value="0" id="manifest_0"> Tidak Ada</label>
                        <label><input type="radio" name="manifest" value="1" id="manifest_1"> Ada</label>
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan:</label>
                        <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="confirmUpdateButton">Update Data</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Handle edit button click
        $('.edit-button').click(function() {
            var id = $(this).data('id');
            var table = $(this).data('table');

            // Fetch current data and populate the form
            $.ajax({
                url: '/document/' + table + '/' + id, // URL untuk fungsi show
                method: 'GET',
                success: function(data) {
                    if (data) {
                        // Populate form fields
                        $('input[name="id"]').val(data.id); // Set ID file
                        $('input[name="file_name"]').val(data.file_name); // Set nama file
                        $('input[name="periode"]').val(data.periode); // Set periode
                        $('input[name="nama_pihak_kedua"]').val(data
                            .nama_pihak_kedua); // Set nama pihak kedua
                        $('input[name="no_dokumen"]').val(data
                            .no_dokumen); // Set no dokumen
                        $('input[name="total_nominal"]').val(data
                            .total_nominal); // Set total nominal
                        $('input[name="tanggal_dokumen"]').val(data
                            .tanggal_dokumen); // Set tanggal dokumen
                        $('textarea[name="keterangan"]').val(data
                            .keterangan); // Set keterangan

                        // Set status radio button
                        $('input[name="status"][value="' + data.status + '"]').prop(
                            'checked', true);

                        // Set bukti_transfer radio button
                        $('input[name="bukti_transfer"][value="' + data.bukti_transfer +
                            '"]').prop('checked', true);

                        // Set manifest radio button
                        $('input[name="manifest"][value="' + data.manifest + '"]').prop(
                            'checked', true);

                        // Show the modal
                        $('#editModal').modal('show');
                    } else {
                        alert('Data tidak ditemukan.');
                    }
                },
                error: function(xhr) {
                    console.error('Error: ', xhr);
                    alert('Error: ' + xhr.responseText);
                }
            });
        });

        // Handle form submission for updating data
        $('#confirmUpdateButton').click(function() {
            var id = $('#id').val(); // Ambil nilai ID dari input hidden

            var form = $('#editform');
            var formData = form.serialize(); // Serialize form data

            // Send AJAX request for updating
            $.ajax({
                url: '/document/bak/' + id, // Pasang id dengan benar di URL
                method: 'PUT', // Jangan pake GET buat update, pake PUT
                data: formData, // Kirim form data untuk update
                success: function(response) {
                    // Reload page atau update tampilan setelah sukses
                    $('#editModal').modal('hide');
                    location.reload(); // Reload halaman setelah update berhasil
                },
                error: function(xhr) {
                    console.error('Error: ', xhr);
                    alert('Error: ' + xhr.responseText);
                }
            });
        });

    });
</script>
w
