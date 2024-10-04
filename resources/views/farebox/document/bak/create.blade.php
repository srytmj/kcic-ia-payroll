<!-- Modal HTML -->
<div class="modal fade" id="createmodal" tabindex="-1" aria-labelledby="createmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createmodalLabel">Upload Files</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for uploading files -->
                <form id="uploadForm" enctype="multipart/form-data">
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="uploadBtn">Upload</button>
            </div>
        </div>
    </div>
</div>

<!-- Button to trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createmodal">
    Upload Files
</button> --}}

<script>
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

    // Handle form submission and upload
    document.getElementById('uploadBtn').addEventListener('click', async () => {
        const formData = new FormData();
        formData.append('periode', document.getElementById('periode').value);
        files.forEach(file => formData.append('files[]', file));

        try {
            const response = await fetch('/farebox/document/bak', { // URL route yang benar
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            });

            if (response.ok) {
                alert('Files uploaded successfully!');
                // Optionally, close the modal or reset the form
                files = [];
                fileList.innerHTML = '';
                document.getElementById('uploadForm').reset();
                $('#uploadModal').modal('hide');
            } else {
                alert('Error uploading files!');
            }
        } catch (error) {
            alert('An error occurred while uploading the files!');
            console.error(error);
        }
    });
</script>
