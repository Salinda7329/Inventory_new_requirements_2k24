<!-- Button to trigger the modal -->
<button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalAddnewitem">
    Add New Item
</button>

<!-- Modal -->
<div class="modal fade" id="modalAddnewitem" tabindex="-1" aria-labelledby="modalAddnewitem" aria-hidden="true">
    <div class="modal-dialog"> <!-- Adjust the modal size as needed -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddnewitemLabel">Add New Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="createItemsForm" class="mb-3" method="POST" action="#">
                    @csrf

                    {{-- hidden field to store user_id --}}
                    <input type="text" value="{{ Auth::user()->id }}" name="user_id_hidden" id="user_id_hidden"
                        hidden>

                    {{-- hidden field to store owner --}}
                    <input type="text" value="{{ Auth::user()->id }}" name="owner_hidden" id="owner_hidden"
                        hidden>

                    <div class="mb-3">
                        <label class="form-label" for="catagory">PO Number</label>
                        <input type="text" class="form-control" id="po_no" name="po_no"
                            placeholder="Enter PO Number" />
                        <div class="input-error text-danger" style="display: none"></div>
                    </div>

                    <!-- Dropdown menu on the left side -->
                    <div class="mb-3">
                        <label class="form-label" for="product_name">Product Name</label>
                        <select class="form-select" id="product_id1" name="product_id" aria-label="product_name">
                            <option disabled selected hidden>Select an option</option>
                            <option value="1">Electronic</option>
                            <option value="2">Stationary</option>
                            <option value="3">Cleaning</option>
                        </select>
                        <div class="input-error text-danger" style="display: none"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="brand_name">Brand Name</label>
                        <select class="form-select" id="brand_id1" name="brand_id" aria-label="brand_name">
                            <option disabled selected hidden>Select an option</option>
                            <option value="1">Electronic</option>
                            <option value="2">Stationary</option>
                            <option value="3">Cleaning</option>
                        </select>
                        <div class="input-error text-danger" style="display: none"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="catagory">Item Name</label>
                        <input type="text" class="form-control" id="item_name" name="item_name"
                            placeholder="Enter Item Name" />
                        <div class="input-error text-danger" style="display: none"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="condition">Condition</label>
                        <select class="form-select" id="condition" name="condition" aria-label="condition">
                            <option disabled selected hidden>Select an option</option>
                            <option value="1">Working</option>
                            <option value="2">Damaged</option>
                        </select>
                        <div class="input-error text-danger" style="display: none"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="items_remaining">Item Count</label>
                        <input type="text" class="form-control" id="items_remaining" name="items_remaining"
                            placeholder="Enter Item Count" />
                        <div class="input-error text-danger" style="display: none"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="lower_limit">Lower Limit</label>
                        <input type="text" class="form-control" id="lower_limit" name="lower_limit"
                            placeholder="Enter Lower Limit" />
                        <div class="input-error text-danger" style="display: none"></div>
                    </div>


                    <div class="mb-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            id="btnClose">Close</button>
                        <button type="submit" id="createNewProduct" class="btn btn-primary">Add New Item
                        </button>
                    </div>

                </form>

            </div>
        </div>

        <script>
            $(document).ready(function() {

                // // Select the form using its id
                var form = $('#createItemsForm');

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


                // fetch item data from database
                fetchAllItemData();

                // Add a submit event listener to the form
                form.submit(function(event) {
                    // Prevent the default form submission behavior
                    event.preventDefault();
                    // Serialize the form data into a URL-encoded string
                    var formData = new FormData(form[0]);

                    // Use jQuery Ajax to send a POST request with the form data
                    $.ajax({
                        url: '/pm/newItem',
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
                                $('#modalAddnewitem').modal('hide');
                                // Example: Display a success message or update the UI
                                alert('Item created successfully!');
                                // reset form
                                $('#createItemsForm')[0].reset();
                                // You can update the UI or perform other actions here

                                //fetch product data from database function
                                fetchAllItemData();
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
                                alert('Failed to create item. Please try again.');
                                // reset form
                                $('#createItemsForm')[0].reset();
                            }
                        },


                    });
                });

                // Add an event listener to the modal close button
                $('#btnClose, .btn-close').on('click', function() {
                    // Reset the form when the close button is clicked
                    $('#createItemsForm')[0].reset();
                    $('.input-error').hide();
                });

                function fetchAllItemData() {
                    $.ajax({
                        url: '{{ route('fetchAllItemData') }}',
                        method: 'get',
                        success: function(response) {
                            // console.log(response);
                            $('#show_all_item_data').html(response);
                            // //Make table a data table
                            $('#all_item_data').DataTable({
                                // Enable horizontal scrolling
                                "scrollX": true,
                                order: [[0, 'desc']]
                            });
                        }


                    });
                }

                // fetch products
                $.ajax({
                    url: '{{ route('products.fetch') }}',
                    method: 'get',
                    success: function(products) {
                        updateProductDropdown(products);
                    }
                });

                // Function to update the product dropdown
                function updateProductDropdown(products) {
                    var productDropdown = $('#product_id1');
                    productDropdown.empty(); // Clear existing options

                    // Add default option
                    productDropdown.append('<option disabled selected hidden>Select a Product</option>');

                    // Populate the dropdown with products
                    $.each(products, function(index, product) {
                        productDropdown.append('<option value="' + product.id + '">' + product
                            .product_name + '</option>');
                    });
                }

                // fetch brands
                $.ajax({
                    url: '{{ route('brands.fetch') }}',
                    method: 'get',
                    success: function(brands) {
                        updateBrandDropdown(brands);
                    }
                });

                // Function to update the brand dropdown
                function updateBrandDropdown(brands) {
                    var brandDropdown = $('#brand_id1');
                    brandDropdown.empty(); // Clear existing options

                    // Add default option
                    brandDropdown.append('<option disabled selected hidden>Select a Brand</option>');

                    // Populate the dropdown with products
                    $.each(brands, function(index, brand) {
                        brandDropdown.append('<option value="' + brand.id + '">' + brand
                            .brand_name + '</option>');
                    });
                }

            });
        </script>


    </div>
</div>
