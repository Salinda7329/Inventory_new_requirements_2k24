<!-- Your existing modal -->
<div class="modal fade" id="actionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalActionTitle">Process Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="processRequestForm" class="mb-3" method="POST" action="#">
                    @csrf

                    {{-- hiidden field to store request id --}}
                    <input type="text" name="request_id_hidden" id="request_id_hidden" hidden>
                    {{-- hiidden field to store request type --}}
                    <input type="text" name="request_type_hidden" id="request_type_hidden" hidden>
                    {{-- hiidden field to store user_id --}}
                    <input type="text" value="{{ Auth::user()->id }}" name="store_manager"
                        id="store_manager_id_hidden" hidden>

                    <div class="container-xxl">
                        <!-- ... (your existing form content) ... -->
                        <div class="mb-3">
                            <label for="type1" class="form-label">User Request Type</label>
                            <input type="text" class="form-control type1" id="type1" name="type" readonly
                                disabled>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="mb-3">
                                    <label for="type1" class="form-label">Requested Item ID</label>
                                    <input type="text" class="form-control" id="item_user1" name="item_user1"
                                        readonly disabled>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label for="type1" class="form-label">Requested Quantity</label>
                                    <input type="text" class="form-control" id="quantity_user1" name="quantity_user"
                                        readonly disabled>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="type1" class="form-label">Request Remark</label>
                            <input type="text" class="form-control" id="user_remark1" name="user_remark" readonly
                                disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="status1">Action</label>
                            <select class="form-select" id="status1" name="request_status" aria-label="catagory">
                                <option disabled selected hidden>Select an option</option>
                                <option value="2">Approve</option>
                                <option value="3">Reject</option>
                            </select>
                            <div class="input-error text-danger" style="display: none"></div>
                        </div>
                        <div class="row">
                            <!-- Left side -->
                            <div class="col-md-7">
                                <!-- ... (your existing form content) ... -->
                                <!-- Your first input field -->
                                <div class="mb-3">
                                    <label for="item_id1" class="form-label">Enter Item ID</label>
                                    <input type="text" class="form-control" id="item_id1" name="item_id"
                                        placeholder="Item ID..">
                                </div>
                            </div>

                            <!-- Right side -->
                            <div class="col-md-5">
                                <!-- ... (your existing form content) ... -->
                                <!-- Your third input field -->
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="text" class="form-control" id="quantity1" name="quantity"
                                        placeholder="">
                                </div>

                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="comments" class="form-label">Remark</label>
                            <textarea class="form-control" id="sm_remark1" name="sm_remark" rows="3" placeholder="Add your comments here..."></textarea>
                        </div>
                        <div class="mb-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                id="btnClose">Close</button>
                            <button type="submit" id="createNewProduct" class="btn btn-primary">Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <script>
                $(document).ready(function() {

                    // get the current user id
                    var authenticatedSMId = {{ auth()->id() }};

                    //edit user button ( role,department,isActive)
                    $(document).on('click', '.actionRequestButton', function(e) {
                        e.preventDefault();
                        let request_id = $(this).attr('id');
                        // alert(request_id);

                        $.ajax({
                            url: '{{ route('dataForProcessModal') }}',
                            method: 'get',
                            data: {
                                request_id: request_id,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {

                                console.log(response.type);
                                // Set id value to the hidden field
                                if (response.type == 1) {
                                    $('#type1').val("Requesting");
                                    // Set color to red when type is 1
                                    $('#type1').css('color', 'red');
                                } else {
                                    $('#type1').val("Returning");
                                    // Set color to green when type is not 1
                                    $('#type1').css('color', 'green');
                                }
                                $('#modalActionTitle').text("Process Request - ID " + response.id);
                                $('#item_user1').val(response.item_user);
                                $('#quantity_user1').val(response.quantity_user);
                                $('#user_remark1').val(response.user_remark);
                                $('#request_id_hidden').val(response.id);
                                $('#request_type_hidden').val(response.type);


                            }


                        });

                    })

                    // // Select the form using its id
                    var form = $('#processRequestForm');

                    // Attach the input event handler to the form inputs
                    form.find('input, select').on('input', function() {
                        $(this).next('.input-error').hide();
                    });
                    // Attach the keypress event handler to the form inputs
                    form.find('input').keypress(function(e) {
                        // If the pressed key is Enter (key code 13)
                        if (e.which === 13) {
                            // Prevent the default form submission behavior
                            e.preventDefault();

                            // Trigger the form submission
                            form.submit();
                        }
                    });



                    // Add a submit event listener to the form
                    form.submit(function(event) {
                        // Prevent the default form submission behavior
                        event.preventDefault();
                        // Serialize the form data into a URL-encoded string
                        var formData = new FormData(form[0]);

                        // Use jQuery Ajax to send a POST request with the form data
                        $.ajax({
                            url: '/storeManager/processRequest',
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function(response) {
                                // Clear existing error messages
                                // $('.text-danger').text('');


                                // // Check if the response status is 200
                                if (response.status === 200) {
                                    // Close the modal directly
                                    $('#actionModal').modal('hide');
                                    //     // Handle the successful response
                                    //     // reset form
                                    $('#processRequestForm')[0].reset();
                                    //     // Example: Display a success message or update the UI
                                    alert('Request processed successfully!');

                                    //fetch  fetchAllRequestData(); function
                                    fetchAllProcessingRequestData();
                                }
                            },


                        });
                    });

                    // Add an event listener to the modal close button
                    $('#btnClose, .btn-close').on('click', function() {
                        // Reset the form when the close button is clicked
                        $('#processRequestForm')[0].reset();
                        $('.input-error').hide();
                    });



                    function fetchAllProcessingRequestData() {
                        $.ajax({
                            url: '{{ route('fetchAllProcessingRequestData') }}',
                            type: 'post',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            data: JSON.stringify({
                                sm_id: authenticatedSMId,
                            }),
                            success: function(html) {
                                // Update the show_all_requests_data div's content with the HTML table
                                $('#show_all_requests_data').html(html);

                                // Make the table a data table
                                $('#all_request_data').DataTable({
                                    // Enable horizontal scrolling
                                    // "scrollX": true,
                                });

                                // Add event listeners for process buttons
                                $(document).on("click", ".processRequestButton", function(e) {
                                    e.preventDefault();

                                    const id = this.id;
                                    const parts = id.split('.');
                                    const itemUser = parts[1]; // Get the part after the dot

                                    // Store a reference to the button
                                    var clickedButton = $(this);

                                    // Send AJAX request to the backend using jQuery
                                    $.ajax({
                                        url: '/storeManager/RequestAction',
                                        type: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        },
                                        data: JSON.stringify({
                                            itemUser: itemUser,
                                            sm_id: authenticatedSMId,
                                        }),
                                        dataType: 'json',
                                        success: function(data) {
                                            // fetchAllRequestData();
                                            // Use the stored reference to update the clicked button's class
                                            if (data.message === 0) {
                                                clickedButton.removeClass('btn-outline-danger').addClass(
                                                    'btn-outline-secondary');
                                            } else {
                                                clickedButton.removeClass('btn-outline-secondary').addClass(
                                                    'btn-outline-danger');
                                            }
                                        },
                                        error: function(error) {
                                            console.error(
                                                'Error performing request action:',
                                                error);
                                        }
                                    });
                                });
                            },
                            error: function(error) {
                                console.error('Error fetching request data:', error);
                            }
                        });
                    }

                });
            </script>
        </div>
    </div>
</div>
