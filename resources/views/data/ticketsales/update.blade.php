<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Ticket Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editform" action="{{ route('ticketsales.update', ['ticketsale' => 'id']) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Hidden Input for ID -->
                    <input type="hidden" name="id" id="id">

                    <!-- Ticket Info Grid -->
                    <div class="row">
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="periode">Periode (Bulan-Tahun)</label>
                                <input type="month" id="periode" name="periode" class="form-control" required>
                            </div>
                        </div> --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="bak">BAK</label>
                                <input type="number" id="bak" name="bak" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="passenger_name">Passenger Name</label>
                                <input type="text" id="passenger_name" name="passenger_name" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nationality">Nationality</label>
                                <select id="nationality" name="nationality" class="form-control" required>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="USA">USA</option>
                                    <option value="India">India</option>
                                    <option value="Germany">Germany</option>
                                    <option value="Japan">Japan</option>
                                    <!-- Add more countries here as needed -->
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="order_no">Order No</label>
                                <input type="text" id="order_no" name="order_no" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ticket_no">Ticket No</label>
                                <input type="text" id="ticket_no" name="ticket_no" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="operator_name">Operator Name</label>
                                <input type="text" id="operator_name" name="operator_name" class="form-control"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="origin">Origin</label>
                                <select id="origin" name="origin" class="form-control" required>
                                    <option value="Halim">Halim</option>
                                    <option value="Padalarang">Padalarang</option>
                                    <option value="Tegalluar">Tegalluar</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="destination">Destination</label>
                                <select id="destination" name="destination" class="form-control" required>
                                    <option value="Halim">Halim</option>
                                    <option value="Padalarang">Padalarang</option>
                                    <option value="Tegalluar">Tegalluar</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="departure_date">Departure Date</label>
                                <input type="date" id="departure_date" name="departure_date" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="arrival_date">Arrival Date</label>
                                <input type="date" id="arrival_date" name="arrival_date" class="form-control"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="departure_time">Departure Time</label>
                                <input type="time" id="departure_time" name="departure_time" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="arrival_time">Arrival Time</label>
                                <input type="time" id="arrival_time" name="arrival_time" class="form-control"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="seat_class">Seat Class</label>
                                <select id="seat_class" name="seat_class" class="form-control" required>
                                    <option value="Premium Economy Class">Premium Economy Class</option>
                                    <option value="Business Class">Business Class</option>
                                    <option value="First Class">First Class</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="after_tax_price">After Tax Price</label>
                                <input type="number" id="after_tax_price" name="after_tax_price"
                                    class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="payment_method">Payment Method</label>
                                <input type="text" id="payment_method" name="payment_method" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="plat_trade_no">Plat Trade No</label>
                                <input type="text" id="plat_trade_no" name="plat_trade_no" class="form-control"
                                    required>
                            </div>
                        </div>
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
        // For fetching the data when editing
        $('.edit-button').click(function() {
            var id = $(this).data('id'); // Get the ticket ID from the button
            $.ajax({
                url: 'ticketsales/' + id + '/edit', // Get the ticket data
                method: 'GET',
                success: function(data) {
                    if (data) {
                        // Populate the form with the fetched data
                        $('#id').val(data.id);
                        // $('#periode').val(data.periode);
                        $('#passenger_name').val(data.passenger_name);
                        $('#bak').val(data.bak); // Make sure bak is populated
                        $('#nationality').val(data.nationality);
                        $('#order_no').val(data.order_no);
                        $('#ticket_no').val(data.ticket_no);
                        $('#operator_name').val(data.operator_name);
                        $('#departure_date').val(data.departure_date);
                        $('#origin').val(data.origin);
                        $('#departure_time').val(data.departure_time);
                        $('#destination').val(data.destination);
                        $('#arrival_date').val(data.arrival_date);
                        $('#arrival_time').val(data.arrival_time);
                        $('#seat_class').val(data.seat_class);
                        $('#after_tax_price').val(data.after_tax_price);
                        $('#payment_method').val(data.payment_method);
                        $('#plat_trade_no').val(data.plat_trade_no);
                        $('#editModal').modal('show'); // Show the modal
                    } else {
                        alert('Ticket not found.');
                    }
                },
                error: function(xhr) {
                    console.error('Error: ', xhr);
                    alert('Error: ' + xhr.responseText);
                }
            });
        });

        // For updating the data
        $('#confirmUpdateButton').click(function() {
            var id = $('#id').val(); // Get the ID
            $.ajax({
                url: 'ticketsales/' + id, // Route for update
                method: 'PUT',
                data: $('#editform').serialize(), // Send form data
                success: function(response) {
                    alert('Ticket updated successfully!');
                    $('#editModal').modal('hide'); // Close the modal
                    location.reload(); // Reload page to see the changes
                },
                error: function(xhr) {
                    console.error('Error: ', xhr);
                    alert('Error: ' + xhr.responseText);
                }
            });
        });

    });
</script>
