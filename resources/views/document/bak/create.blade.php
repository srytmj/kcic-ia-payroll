<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- [ upload-collapse ] start -->
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

                    <!-- File Upload Area -->
                    <div class="form-group">
                        <label for="files">Upload Files</label>
                        <div id="dropzone" class="dropzone border border-dashed text-center p-5"
                            style="border-radius: 10px;">
                            <p>Drag and drop files here, or click to select files</p>
                            <input type="file" id="fileInput" name="files[]" multiple hidden accept=".pdf">
                        </div>
                    </div>

                    <!-- File List -->
                    <div id="fileList" class="mt-3"></div>

                </form>

                <div class="text-center m-t-20">
                    <button type="button" class="btn btn-primary" id="uploadBtn">Upload Now</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ upload-collapse ] end -->

<script>
    // Run your script logic and refresh the page once done
    async function runScriptAndRefresh() {
        await runAsyncTask(); // Wait for the async task to complete

        // After all tasks are completed, refresh the page
        window.location.reload(); // This will reload the page
    }

    // Get the current date
    const now = new Date();

    // Format the date to match the input type="month" (YYYY-MM)
    const year = now.getFullYear();
    const month = (now.getMonth() + 1).toString().padStart(2, '0'); // Pad month to 2 digits

    // Set the value of the input to the current month
    document.getElementById('periode').value = `${year}-${month}`;


    // Handle drag and drop or click for file input
    const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('fileInput');
    const fileList = document.getElementById('fileList');
    let files = [];

    // Open file input when dropzone is clicked
    dropzone.addEventListener('click', () => {
        fileInput.click();
    });

    // Handle file selection
    fileInput.addEventListener('change', (event) => {
        handleFiles(event.target.files);
    });

    // Handle files dropped into dropzone
    dropzone.addEventListener('dragover', (event) => {
        event.preventDefault();
        dropzone.classList.add('border-primary');
    });

    dropzone.addEventListener('dragleave', () => {
        dropzone.classList.remove('border-primary');
    });

    dropzone.addEventListener('drop', (event) => {
        event.preventDefault();
        dropzone.classList.remove('border-primary');
        handleFiles(event.dataTransfer.files);
    });

    // Handle file listing
    function handleFiles(selectedFiles) {
        files = [...files, ...selectedFiles]; // Merge existing files with new ones
        displayFileList();
    }

    function displayFileList() {
        fileList.innerHTML = '';
        files.forEach((file, index) => {
            const fileItem = document.createElement('div');
            fileItem.classList.add('file-item', 'border', 'p-2', 'my-2', 'd-flex', 'justify-content-between',
                'align-items-center');
            fileItem.innerHTML = `
            <span>${file.name}</span>
            <button type="button" class="btn btn-danger btn-sm" onclick="removeFile(${index})">Remove</button>
        `;
            fileList.appendChild(fileItem);
        });
    }

    function removeFile(index) {
        files.splice(index, 1);
        displayFileList();
    }

    // Handle form submission
    $('#uploadBtn').on('click', function(e) {
        e.preventDefault();

        // Prepare FormData
        var formData = new FormData();
        var periode = $('#periode').val();
        var files = $('#fileInput')[0].files;

        // Append periode and files to formData
        formData.append('periode', periode);
        for (var i = 0; i < files.length; i++) {
            formData.append('files[]', files[i]);
        }

        // Send Ajax request
        $.ajax({
            url: '{{ route('bak.store') }}', // Adjust URL to your route
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // alert(response.message); // Display success message
                runScriptAndRefresh();
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                var errorMsg = '';
                for (var key in errors) {
                    if (errors.hasOwnProperty(key)) {
                        errorMsg += errors[key] + '\n';
                    }
                }
                runScriptAndRefresh();
                // alert('Error: ' + errorMsg); // Display error message
            }
        });
    });
</script>
