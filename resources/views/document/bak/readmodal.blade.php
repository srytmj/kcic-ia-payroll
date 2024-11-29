<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

{{-- MODAL PDF --}}
<div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h5 class="modal-title" id="pdfModalLabel">View PDF</h5> --}}
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
            </div>
            <div class="modal-body" style="height: 85vh;">
                <iframe id="pdfViewer" src="" width="100%" height="100%" style="border: none;"></iframe>
            </div>
        </div>
    </div>
</div>
{{-- MODAL PDF END --}}

{{-- Script untuk memuat file PDF secara dinamis --}}
<script>
    // Handle the click event to set the PDF source
    $('.view-pdf-button').click(function() {
        var filePath = $(this).data('path'); // Ambil path file yang sudah disiapkan di database

        // Set the iframe source to the PDF URL
        $('#pdfViewer').attr('src', '/storage/' + filePath);
    });
</script>
{{-- Script end --}}