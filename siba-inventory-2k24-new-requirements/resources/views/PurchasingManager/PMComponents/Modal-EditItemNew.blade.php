<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="modaledititem" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Item New</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <form id="UpdateItemDetailsForm" class="mb-3" method="POST" action="#">
                    @csrf

                    {{-- hidden id input field --}}
                    <input type="hidden" id="item_Id_hidden2" name="item_Id_hidden">

                    {{-- hidden current user id input field --}}
                    <input type="hidden" id="user_id_hidden2" name="user_id_hidden2" value="{{ Auth::user()->id }}">

                     {{-- hidden input filed to store old item_ref --}}
                     <input type="hidden" name="old_item_ref" id="old_item_ref">

                    <div class="mb-3">
                        <label class="form-label" for="brand_name">Category</label>
                        <select class="form-select" id="category_id2" name="category_id" aria-label="brand_name">
                            <option disabled selected hidden>Select an option</option>
                            <option value="1">Electronic</option>
                            <option value="2">Stationary</option>
                            <option value="3">Cleaning</option>
                        </select>
                        <div class="input-error text-danger" style="display: none"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="item-name">Reference ID</label>
                        <input type="text" class="form-control" id="item_ref2" name="item_ref"
                            placeholder="Enter Item Reference ex:st/41" />
                        <div class="input-error text-danger" style="display: none"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="catagory">Item Name</label>
                        <input type="text" class="form-control" id="item_name2" name="item_name"
                            placeholder="Enter Item Name" />
                        <div class="input-error text-danger" style="display: none"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="item-name">Item Price</label>
                        <input type="text" class="form-control" id="item_price2" name="item_price"
                            placeholder="Enter Item Price" />
                        <div class="input-error text-danger" style="display: none"></div>
                    </div>


                    <div class="mb-3">
                        <label class="form-label" for="lower_limit">Lower Limit</label>
                        <input type="text" class="form-control" id="lower_limit2" name="lower_limit"
                            placeholder="Enter Lower Limit" />
                        <div class="input-error text-danger" style="display: none"></div>
                    </div>

                    @if (Auth::user()->role == 3)
                        <div class="mb-3">
                            <label for="status" class="form-label">Select Status</label>
                            <select class="form-control" id="status2" name="isActive">
                                <option disabled selected hidden>Select a Status</option>
                                <option value="1">Active</option>
                                <option value="2">Deactive</option>
                            </select>
                        </div>
                    @else
                        <div class="mb-3" style="display:none">
                            <label for="status" class="form-label">Select Status</label>
                            <select class="form-control" id="status2" name="isActive">
                                <option disabled selected hidden>Select a Status</option>
                                <option value="1">Active</option>
                                <option value="2">Deactive</option>
                            </select>
                        </div>
                    @endif

                    <button class="btn btn-primary d-grid w-100" id="Update_item_button">Update</button>
                </form>

                <script>
                    $(document).ready(function() {

                        // // Select the form using its id
                        var form = $('#UpdateItemDetailsForm');

                        // Add an event listener to the modal close button
                        $('.btn-close').on('click', function() {
                            // Reset the form when the close button is clicked
                            $('#UpdateItemDetailsForm')[0].reset();
                            $('#password-error').hide();
                            $('.input-error').hide();
                        });

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

                        //edit user button
                        $(document).on('click', '.editItemButton', function(e) {
                            e.preventDefault();
                            let item_Id = $(this).attr('id');
                            // alert(id);

                            $.ajax({
                                url: '{{ route('item.editnew') }}',
                                method: 'get',
                                data: {
                                    item_Id: item_Id,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {

                                    console.log(response.po_no);
                                    // Set id value to the hidden field
                                    $('#item_Id_hidden2').val(response.id);
                                    $('#old_item_ref').val(response.item_ref);
                                    $('#item_ref2').val(response.item_ref);
                                    $('#item_name2').val(response.item_name);
                                    $('#category_id2').val(response.category_id);
                                    $('#item_price2').val(response.item_price);
                                    $('#lower_limit2').val(response.lower_limit);
                                    $('#status2').val(response.isActive);

                                }


                            });


                        })

                        function fetchAllItemData() {
                            $.ajax({
                                url: '/pm/home/fetchAllItemDataNew',
                                method: 'get',
                                success: function(response) {
                                    // console.log(response);
                                    $('#show_all_item_data').html(response);
                                    // //Make table a data table
                                    $('#all_item_data').DataTable({
                                        // Enable horizontal scrolling
                                        // "scrollX": true,
                                        order: [
                                            [0, 'desc']
                                        ],
                                        // pageLength: 25,
                                    });
                                }


                            });
                        }

                        //Update form
                        $('#UpdateItemDetailsForm').submit(function(e) {
                            e.preventDefault();
                            // Save form data to fd constant
                            const fd = new FormData(this);

                            $.ajax({
                                url: '/pm/Item/updateNew',
                                method: 'post',
                                data: fd,
                                cache: false,
                                contentType: false,
                                processData: false,
                                dataType: 'json',
                                success: function(response) {
                                    // Clear existing error messages
                                    $('.text-danger').text('');

                                    if (response.status == 200) {
                                        alert('Item updated successfully!');
                                        $('#UpdateItemDetailsForm')[0].reset();
                                        $('#modaledititem').modal('hide');
                                        // Fetch product data from database
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
                                    } else {
                                        // Handle other status codes if needed
                                        // For example, display an error message
                                        alert('Failed to Update item. Please try again.');
                                        // reset form
                                        $('#createItemsForm')[0].reset();
                                    }
                                },
                                error: function(xhr, status, error) {
                                    // Handle validation errors
                                    var response = xhr.responseJSON;
                                    if (response && response.errors) {
                                        var errors = response.errors;

                                        for (var key in errors) {
                                            // Find the form field
                                            var field = $('[name="' + key + '"]');
                                            // Display the error message
                                            field.next('.input-error').text(errors[key][0]).show();
                                        }
                                    } else {
                                        // Handle other errors if needed
                                        console.error(xhr.responseText);
                                        alert(
                                            'An error occurred while processing your request. Please try again.'
                                        );
                                    }
                                }
                            });
                        });



                        // fetch categories
                        $.ajax({
                            url: '/categories/fetch',
                            method: 'get',
                            success: function(categories) {
                                updateCategoryDropdown(categories);
                            }
                        });

                        // Function to update the brand dropdown
                        function updateCategoryDropdown(categories) {
                            var categoryDropdown = $('#category_id2');
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
    </div>
</div>
