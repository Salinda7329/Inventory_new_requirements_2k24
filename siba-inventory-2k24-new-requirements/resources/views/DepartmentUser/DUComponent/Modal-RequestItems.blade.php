{{-- mekedi palaweni input field ake a select karapu item aka (store table ake) name aka watenn oni item code aka etapasse edit karann bari wen vdiyata
auto watenn dann --}}


{{-- <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalrequestitem">
    Request
</button> --}}

<!-- Modal -->
<div class="modal fade" id="modalrequestitem" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalrequest">Request an Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <form id="RequestItemForm" class="mb-3" method="POST" action="#">
                    @csrf


                    <div class="mb-3">
                        <label for="product_name" class="form-label">Product Name</label>
                        <input class="form-control" type="text" id="product_name" name="" placeholder=""
                            readonly />
                    </div>
                    <div class="mb-3">
                        <label for="itemid" class="form-label">Item ID</label>
                        <input class="form-control" type="text" id="item_id" name="item_user" placeholder=""
                            readonly />
                    </div>
                    <div class="mb-3">
                        <label for="itemname" class="form-label">Item Name</label>
                        <input class="form-control" type="text" id="item_name" name="item_name" placeholder=""
                            readonly />
                    </div>
                    <div class="mb-3">
                        <label for="quentity" class="form-label">Quantity</label>
                        <input type="text" id="quantity_user" name="quantity_user" class="form-control"
                            placeholder="" />
                        <div class="input-error text-danger" style="display: none"></div>
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Comment</label>
                        <textarea class="form-control" id="user_remark" name="user_remark" rows="3"></textarea>
                        <div class="input-error text-danger" style="display: none"></div>
                    </div>

                    <input type="hidden" id="request_by" name="request_by" value="{{ Auth::user()->id }}">
                    {{-- // request_item --}}
                    <input type="hidden" id="type" name="type" value="1">
                    {{-- // user_request --}}
                    <input type="hidden" id="status" name="status" value="0">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" type="button" class="btn btn-primary">request</button>
            </div>
            </form>
            <script>
                $(document).ready(function() {

                    // // Select the form using its id
                    var form = $('#RequestItemForm');

                    // Attach the input event handler to the form inputs
                    form.find('input, select, textarea').on('input', function() {
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

                    // Add an event listener to the modal close button
                    $('.btn-close').on('click', function() {
                        // Reset the form when the close button is clicked
                        $('#RequestItemForm')[0].reset();
                        $('.input-error').hide();
                    });

                    //request  item button
                    $(document).on('click', '.requestItemButton', function(e) {
                        e.preventDefault();
                        let item_Id = $(this).attr('id');
                        let request_by = $('#request_by').val();


                        $.ajax({
                            url: '/checkExistingRequest',
                            method: 'post',
                            data: {
                                request_by: request_by,
                                item_user: item_Id,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.status === 200) {
                                    $.ajax({
                                        url: '{{ route('item.edit') }}',
                                        method: 'get',
                                        data: {
                                            item_Id: item_Id,
                                            _token: '{{ csrf_token() }}'
                                        },
                                        success: function(response) {

                                            $('#modalrequestitem').modal('show');

                                            // console.log(response);
                                            // Set id value to the hidden field
                                            $('#item_id').val(response.id);
                                            $('#item_name').val(response.item_name);
                                            // Fetch product name using product_id
                                            fetchProductName(response.product_id);
                                        }

                                    });

                                }else if(response.status === 300){
                                    alert("You have already requested this item!");
                                }
                            }

                        });

                    })


                    // Function to fetch product name using product_id
                    function fetchProductName(productId) {
                        $.ajax({
                            url: '{{ route('fetchProductDetails') }}',
                            method: 'get',
                            data: {
                                productId: productId,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                $('#product_name').val(response.product_name);
                            }
                        });
                    }

                    // Add a submit event listener to the form
                    form.submit(function(event) {
                        // Prevent the default form submission behavior
                        event.preventDefault();
                        // Serialize the form data into a URL-encoded string
                        var formData = new FormData(form[0]);

                        // Use jQuery Ajax to send a POST request with the form data
                        $.ajax({
                            url: '/user/newRequest',
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function(response) {
                                // Clear existing error messages
                                $('.text-danger').text('');

                                // Check if the response status is 200
                                if (response.status === 200) {
                                    // Handle the successful response
                                    // Close the modal directly
                                    $('#modalrequestitem').modal('hide');
                                    // Example: Display a success message or update the UI
                                    alert('Request created successfully!');
                                    // reset form
                                    $('#RequestItemForm')[0].reset();
                                    // You can update the UI or perform other actions here

                                    //fetch product data from database function
                                    fetchAllItemDataUser();
                                } else if (response.status === 422) {
                                    // Handle validation errors
                                    var errors = response.errors;

                                    for (var key in errors) {
                                        // Find the form field
                                        var field = $('[name="' + key + '"]');
                                        // Display the error message
                                        field.next('.input-error').text(errors[key][0]).show();
                                    }

                                    $('#password-error').text(errors[key][0]).show();

                                } else {
                                    // Handle other status codes if needed
                                    // For example, display an error message
                                    alert('Failed to create request. Please try again.');
                                    // reset form
                                    $('#RequestItemForm')[0].reset();
                                }
                            },


                        });
                    });

                });
            </script>
        </div>
    </div>
</div>
