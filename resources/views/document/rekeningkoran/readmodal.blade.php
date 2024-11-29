<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>


{{-- MODAL PDF --}}
<div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content"> <!-- Set modal height to 80% of viewport height -->
            <div class="modal-header">
                {{-- <h5 class="modal-title" id="pdfModalLabel">View PDF</h5> --}}
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
            </div>
            <div class="modal-body" style="height: 85vh;"> <!-- Adjust body height accordingly -->
                <iframe id="pdfViewer" src="" width="100%" height="100%" style="border: none;"></iframe>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div> --}}
        </div>
    </div>
</div>
{{-- MODAL PDF END --}}

{{-- Script untuk memuat file PDF secara dinamis --}}
<script>
    // Handle the click event to set the PDF source
    $('.view-pdf-button').click(function() {
        var id = $(this).data('id');
        var pdfUrl = '/farebox/document/rekeningkoran/pdf/' + id; // URL to fetch the PDF

        // Set the iframe source to the PDF URL
        $('#pdfViewer').attr('src', pdfUrl);
    });
</script>
{{-- Script end --}}
