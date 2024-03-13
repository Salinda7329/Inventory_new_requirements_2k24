<!-- Button to trigger the modal -->
<button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalAddnewproduct">
    Add New Product
</button>

<!-- Modal -->
<div class="modal fade" id="modalAddnewproduct" tabindex="-1" aria-labelledby="modalAddnewproduct" aria-hidden="true">
    <div class="modal-dialog"> <!-- Adjust the modal size as needed -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddnewproductLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="createProductsForm" class="mb-3" method="POST" action="#">
                    @csrf

                    {{-- hiidden field to store user_id --}}
                    <input type="text" value="{{ Auth::user()->id }}" name="user_id_hidden" id="user_id_hidden"
                        hidden>
                    <!-- Dropdown menu on the left side -->
                    <div class="mb-3">
                        <label class="form-label" for="catagory">Catagory</label>
                        <select class="form-select" id="category_id1" name="category_id" aria-label="catagory">
                            <option disabled selected hidden>Select an option</option>
                            <option value="1">Electronic</option>
                            <option value="2">Stationary</option>
                            <option value="3">Cleaning</option>
                        </select>
                        <div class="input-error text-danger" style="display: none"></div>
                    </div>


                    <div class="mb-3">
                        <label class="form-label" for="catagory">Product Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name"
                            placeholder="Enter Product Name" />
                        <div class="input-error text-danger" style="display: none"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="limit">Lower Limit</label>
                        <input type="text" class="form-control" id="lower_limit" name="lower_limit"
                            placeholder="Enter Product Lower Limit" />
                        <div class="input-error text-danger" style="display: none"></div>
                    </div>

                    <div class="mb-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            id="btnClose">Close</button>
                        <button type="submit" id="createNewProduct" class="btn btn-primary">Add New Product
                        </button>
                    </div>

                </form>

            </div>
        </div>

        <script>
            $(document).ready(function() {

                // // Select the form using its id
                var form = $('#createProductsForm');

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
                        url: '/pm/newProduct',
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
                                $('#modalAddnewproduct').modal('hide');
                                // Example: Display a success message or update the UI
                                alert('Product created successfully!');
                                // reset form
                                $('#createProductsForm')[0].reset();
                                // You can update the UI or perform other actions here

                                //fetch product data from database function
                                fetchAllProductData();
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
                                alert('Failed to create product. Please try again.');
                                // reset form
                                $('#createProductsForm')[0].reset();
                            }
                        },


                    });
                });

                // Add an event listener to the modal close button
                $('#btnClose, .btn-close').on('click', function() {
                    // Reset the form when the close button is clicked
                    $('#createProductsForm')[0].reset();
                    $('.input-error').hide();
                });

                function fetchAllProductData() {
                    $.ajax({
                        url: '{{ route('fetchAllProductData') }}',
                        method: 'get',
                        success: function(response) {
                            // console.log(response);
                            $('#show_all_product_data').html(response);
                            // //Make table a data table
                            $('#all_product_data').DataTable({

                                // Enable horizontal scrolling
                            });
                        }


                    });
                }

                // fetch categories
                $.ajax({
                    url: '{{ route('categories.fetch') }}',
                    method: 'get',
                    success: function(categories) {
                        updateCategoryDropdown(categories);
                    }
                });

                // Function to update the category dropdown
                function updateCategoryDropdown(categories) {
                    var categoryDropdown = $('#category_id1');
                    categoryDropdown.empty(); // Clear existing options

                    // Add default option
                    categoryDropdown.append('<option disabled selected hidden>Select a Category</option>');

                    // Populate the dropdown with categories
                    $.each(categories, function(index, category) {
                        categoryDropdown.append('<option value="' + category.id + '">' + category
                            .category_name + '</option>');
                    });
                }

            });
        </script>


    </div>
</div>
