$(document).ready(function() {
    setTimeout(function() {
        // [ Checkbox Selection ]
        var table = $('#checkbox-select').DataTable({
            columnDefs: [{
                orderable: false,
                className: 'select-checkbox',
                targets: 0
            }],
            select: {
                style: 'os',
                selector: 'td:first-child'
            },
            order: [
                [1, 'asc']
            ]
        });

        $('<button class="btn btn-primary m-b-20">Update Selected Data</button>')
    .prependTo('.dt-plugin-buttons')
    .on('click', function() {
        // Ambil ID dari baris yang terpilih
        var selectedData = table.rows({ selected: true }).data();
        var selectedIds = [];

        selectedData.each(function(value) {
            selectedIds.push(value[1]); // Ambil ID dari kolom kedua (ID yang dibutuhkan)
        });

        // Ambil ID BAK dari hidden input
        var idBak = $('input[name="id"]').val();

        if (selectedIds.length === 0) {
            alert('No data selected!');
            return;
        }

        // Kirim data ke server melalui AJAX
        $.ajax({
            url: '/update-ticket-sales', // Endpoint ke controller
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'), // CSRF Token jika menggunakan Laravel
                selected_ids: selectedIds,
                bak_id: idBak
            },
            success: function(response) {
                alert('Data successfully updated!');
                table.ajax.reload(); // Reload data di tabel jika diperlukan
            },
            error: function(xhr) {
                // alert('Failed to update data. Please try again.');
                // console.error(xhr.responseText);
                location.reload();
            }
        });
    });


    }, 350);
});
