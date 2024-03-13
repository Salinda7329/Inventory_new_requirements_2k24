<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="modaleditproduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <form id="UpdateProductDetailsForm" class="mb-3" method="POST" action="#">
                    @csrf

                    {{-- hidden id input field --}}
                    <input type="hidden" id="product_Id_hidden" name="product_Id_hidden">

                    <div class="mb-3">
                        <label for="product_name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="product_name1" name="product_name"
                            placeholder="Enter your Product Name" :value="old('product_name')" required autofocus
                            autocomplete="product_name" />
                        <div class="input-error text-danger" style="display: none"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="category_id">Catagory</label>
                        <select class="form-select" id="category_id2" name="category_id" aria-label="category_id">
                            <option disabled selected hidden>Select an option</option>
                            {{-- <option value="1">Electronic</option>
                            <option value="2">Stationary</option>
                            <option value="3">Cleaning</option> --}}
                        </select>
                        <div class="input-error text-danger" style="display: none"></div>
                    </div>
                    {{-- <div class="mb-3">
                        <label class="form-label" for="category_id">Catagory</label>
                        <input type="text" name="category_id" id="category_id2">
                    </div> --}}

                    <div class="mb-3">
                        <label for="product_name" class="form-label">Product Lower Limit</label>
                        <input type="text" class="form-control" id="lower_limit1" name="lower_limit"
                            placeholder="Enter your Product Limit" :value="old('lower_limit')" required autofocus
                            autocomplete="lower_limit" />
                        <div class="input-error text-danger" style="display: none"></div>
                    </div>




                    <div class="mb-3">
                        <label for="status" class="form-label">Select Status</label>
                        <select class="form-control" id="status1" name="isActive">
                            <option disabled selected hidden>Select a Status</option>
                            <option value="1">Active</option>
                            <option value="2">Deactive</option>
                            <option value="3">Delete</option>
                        </select>
                    </div>


                    <button class="btn btn-primary d-grid w-100" id="Update_product_button">Update</button>
                </form>

                <script>
                    $(document).ready(function() {

                         // Attach the input event handler to the form inputs
                         $('#UpdateProductDetailsForm').find('input, select').on('input', function() {
                    $(this).next('.input-error').hide();
                });

                        // Add an event listener to the modal close button
                        $('.btn-close').on('click', function() {
                            // Reset the form when the close button is clicked
                            $('#UpdateProductDetailsForm')[0].reset();
                            $('#password-error').hide();
                            $('.input-error').hide();
                        });

                        //fetch All product Data
                        fetchAllProductData();

                        //edit user button
                        $(document).on('click', '.editProductButton', function(e) {
                            e.preventDefault();
                            let product_Id = $(this).attr('id');

                            $.ajax({
                                url: '{{ route('product.edit') }}',
                                method: 'get',
                                data: {
                                    product_Id: product_Id,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {

                                    // Populate the category dropdown with category names
                                    $.ajax({
                                        url: '{{ route('categories.fetch') }}',
                                        method: 'get',
                                        success: function(categories) {
                                            updateCategoryDropdown(categories, response
                                                .category_id);
                                            // Open the modal after updating the dropdown
                                            $('#modaleditproduct').modal('show');
                                        }
                                    });

                                    // Set id value to the hidden field
                                    $('#product_Id_hidden').val(response.id);
                                    $('#product_name1').val(response.product_name);
                                    $('#lower_limit1').val(response.lower_limit);
                                    $('#status1').val(response.isActive);
                                }
                            });
                        });

                        function fetchAllProductData() {
                            $.ajax({
                                url: '{{ route('fetchAllProductData') }}',
                                method: 'get',
                                success: function(response) {
                                    $('#show_all_product_data').html(response);
                                    // //Make table a data table
                                    $('#all_product_data').DataTable({

                                        // Enable horizontal scrolling
                                    });
                                }
                            });
                        }

                        //Update form
                        $('#UpdateProductDetailsForm').submit(function(e) {
                            e.preventDefault();
                            //save form data to fd constant
                            const fd = new FormData(this);

                            $.ajax({
                                url: '{{ route('product.update') }}',
                                method: 'post',
                                data: fd,
                                cache: false,
                                contentType: false,
                                processData: false,
                                dataType: 'json',
                                success: function(response) {
                                    if (response.status == 200) {
                                        alert('Product updated successfully!');
                                        $('#UpdateProductDetailsForm')[0].reset();
                                        $('#modaleditproduct').modal('hide');

                                        // fetch product data from the database
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
                                    }
                                }
                            });
                        });

                        // Function to update the category dropdown
                        function updateCategoryDropdown(categories, selectedCategoryId) {
                            var categoryDropdown = $('#category_id2');
                            categoryDropdown.empty(); // Clear existing options

                            // Add default option
                            categoryDropdown.append('<option disabled selected hidden>Select a Category</option>');

                            // Populate the dropdown with category names
                            categories.forEach(function(category) {
                                var option = $('<option></option>')
                                    .attr('value', category.id)
                                    .text(category.category_name);

                                // Set 'selected' attribute for the existing category
                                if (category.id == selectedCategoryId) {
                                    option.attr('selected', true);
                                }

                                categoryDropdown.append(option);
                            });
                        }


                    });
                </script>

            </div>
        </div>
    </div>
</div>
