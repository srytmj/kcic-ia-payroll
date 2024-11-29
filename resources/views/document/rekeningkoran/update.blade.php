<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

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
                <form id="editform">
                    @csrf
                    @method('PUT') <!-- Method Override for PUT -->

                    <input type="hidden" name="id" id="id"> <!-- Hidden input for ID -->
                    {{-- Periode (Bulan-Tahun) --}}
                    <div class="form-group">
                        <label for="periode">Periode (Bulan-Tahun)</label>
                        <input type="month" id="periode" name="periode" class="form-control" required>
                    </div>

                    {{-- Nama File --}}
                    <div class="form-group">
                        <label for="file_name">Nama File:</label>
                        <input type="text" class="form-control" id="file_name" name="file_name" required>
                    </div>

                    <div class="form-group">
                        <label for="nomor_rekening">Nomor Rekening :</label>
                        <select class="form-select col-sm-12" name="nomor_rekening" id="nomor_rekening">
                            <option value="" selected disabled hidden>Pilih Nomor Rekening</option>
                            <option value="111">111</option>
                            <option value="222">222</option>
                        </select>
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
                url: '/farebox/document/'+ table + '/' + id, // URL untuk fungsi show
                method: 'GET',
                success: function(data) {
                    console.log(data); // Tampilkan respons di console
                    if (data) {
                        // Populate the form fields (input)
                        $('input[name="id"]').val(data.id); // Set ID file
                        $('input[name="file_name').val(data.file_name); // Set nama file
                        $('input[name="periode').val(data.periode); // Set periode (format YYYY-MM)

                        $('select[name="nomor_rekening').val(data.nomor_rekening); // Set periode (format YYYY-MM)

                        // Update form action URL
                        $('#editform').attr('action', '/farebox/document/rekeningkoran/' + id);

                        // Show the modal
                        $('#editModal').modal('show');

                        console.log("ID: " + id);
                        console.log("Table: " + table);

                    } else {
                        alert('Data tidak ditemukan.');
                    }
                },
                error: function(xhr) {
                    console.error('Error: ', xhr); // Tampilkan error di console
                    alert('Error: ' + xhr.responseText);
                }
            });
        });

        // Handle form submission for updating data
        $('#confirmUpdateButton').click(function() {
            var form = $('#editform');
            var formData = form.serialize(); // Serialize form data

            // Send AJAX request for updating
            $.ajax({
                url: form.attr('action'), // Use the action attribute from the form
                method: 'POST',
                data: formData,
                success: function(response) {
                    // Handle success
                    $('#editModal').modal('hide');
                    location.reload(); // Reload the page to see the updated data
                },
                error: function(xhr) {
                    console.error('Error: ', xhr); // Tampilkan error di console
                    alert('Error: ' + xhr.responseText);
                }
            });
        });
    });
</script>
