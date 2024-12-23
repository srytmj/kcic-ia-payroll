<!-- Modal Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus item ini?
                <!-- Hidden fields to store table and id -->
                <input type="hidden" id="delete-ids">
                <input type="hidden" id="delete-table">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Hapus</button>
                <!-- Corrected button ID -->
            </div>
        </div>
    </div>
</div>

<script>
    // Handle the delete confirmation
    $('.delete-button').click(function() {
        var table = $(this).data('table');
        var id = $(this).data('id');

        // Set data in the delete confirmation modal
        $('#delete-ids').val(id);
        $('#delete-table').val(table);
        $('#deleteModal').modal('show');
    });

    $('#confirmDelete').click(function() { // Corrected button ID
        var id = $('#delete-ids').val();
        var table = $('#delete-table').val();

        // Send AJAX request
        $.ajax({
            url: '/data/' + table + '/' + id, // Ensure this matches the correct route in web.php
            method: 'POST', // Use POST to send the request
            data: {
                _method: 'DELETE', // Use _method to indicate it's a DELETE request
                _token: '{{ csrf_token() }}' // CSRF token for security
            },
            success: function(response) {
                $('#deleteModal').modal('hide');
                location.reload(); // Reload the page on success
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseText);
            }
        });
    });
</script>
