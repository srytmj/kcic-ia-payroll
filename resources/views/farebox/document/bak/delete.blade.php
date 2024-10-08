<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this item?</p>
                <input type="text" id="delete-ids" name="ids">
                <input type="text" id="delete-table" name="table">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Yes, Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Handle the delete confirmation
        $('.delete-button').on('click', function() {
            var table = $(this).data('table');
            var id = $(this).data('id');

            // Set data in the delete confirmation modal
            $('#delete-ids').val(id);
            $('#delete-table').val(table);
            $('#deleteModal').modal('show');
        });

        $('#confirmDeleteButton').on('click', function() {
            var id = $('#delete-ids').val();
            var table = $('#delete-table').val();

            $.ajax({
                url: table + '/' + id, // Ensure the URL matches the route definition
                method: 'POST', // Use POST method
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: 'DELETE' // Spoof DELETE method
                },
                success: function(response) {
                    $('#deleteModal').modal('hide');
                    location.reload();
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseText);
                }
            });

        });
    });
</script>
