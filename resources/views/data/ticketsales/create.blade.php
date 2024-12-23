<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Loader -->
<div id="loader" class="text-center" style="display: none;">
    <img src="{{ asset('assets/images/load.gif') }}" alt="loading..." width="50">
    <p>Uploading data...</p>
</div>

{{-- [ upload-collapse ] start --}}
<br>
<div class="col-sm-12">
    <div class="card">
        <div class="collapse" id="collapseUpload">
            <div class="card-body">
                <form id="uploadForm" method="POST" enctype="multipart/form-data" class="dropzone">
                    @csrf
                    <!-- Periode Input -->
                    <div class="form-group">
                        <label for="periode">Periode (Bulan-Tahun)</label>
                        <input type="month" id="periode" name="periode" class="form-control" required>
                    </div>

                    <!-- File Input -->
                    <div class="form-group">
                        <label for="csv_file">File CSV</label>
                        <input type="file" id="csv_file" name="csv_file" class="form-control" accept=".csv"
                            required>
                    </div>

                    <!-- File List -->
                    <div id="fileList" class="mt-3"></div>
                </form>

                <div class="text-center m-t-20">
                    <button type="submit" class="btn btn-primary" id="uploadBtn">Tambah Data</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ upload-collapse ] end -->

<script>
    // Set default value to the current month
    const today = new Date();
    const month = String(today.getMonth() + 1).padStart(2, '0'); // Tambahkan leading zero
    const year = today.getFullYear();
    document.getElementById('periode').value = `${year}-${month}`;

    // Handle form submission
    $('#uploadBtn').on('click', function(e) {
        e.preventDefault();

        // Tampilkan loader
        $('#loader').show();

        // Create FormData object
        var formData = new FormData($('#uploadForm')[0]);

        // Create a new XMLHttpRequest object
        var xhr = new XMLHttpRequest();

        // Configure the request
        xhr.open('POST', '{{ route('ticketsales.store') }}', true);
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));

        xhr.onload = function() {
            // Sembunyikan loader
            $('#loader').hide();

            if (xhr.status >= 200 && xhr.status < 300) {
                // Refresh or show a success message
                alert('Upload successful!');
                window.location.reload();
            } else {
                var response = JSON.parse(xhr.responseText);
                var errors = response.errors;
                var errorMsg = '';
                for (var key in errors) {
                    if (errors.hasOwnProperty(key)) {
                        errorMsg += errors[key] + '\n';
                    }
                }
                alert('Error: ' + errorMsg);
            }
        };

        xhr.onerror = function() {
            // Sembunyikan loader jika ada error
            $('#loader').hide();
            alert('An error occurred during the upload.');
        };

        // Send the FormData with the request
        xhr.send(formData);
    });
</script>
