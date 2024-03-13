<!-- Button to trigger the modal -->
<button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalAddnewcategory">
    Add New Category
</button>

<!-- Modal -->
<div class="modal fade" id="modalAddnewcategory" tabindex="-1" aria-labelledby="modalAddnewcategory" aria-hidden="true">
    <div class="modal-dialog"> <!-- Adjust the modal size as needed -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddnewcategoryLabel">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="createCategoryForm" class="mb-3" method="POST" action="#">
                    @csrf

                    {{-- hidden field to store user_id --}}
                    <input type="text" value="{{ Auth::user()->id }}" name="user_id_hidden" id="user_id_hidden"
                        hidden>


                    <div class="mb-3">
                        <label class="form-label" for="category">Category Name</label>
                        <input type="text" class="form-control" id="category_name" name="category_name"
                            placeholder="Enter Category Name" />
                        <div class="input-error text-danger" style="display: none"></div>
                    </div>

                    <div class="mb-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnClose">Close</button>
                        <button type="submit" id="createNewCategory" class="btn btn-primary">Add New Category
                        </button>
                    </div>

                </form>

            </div>
        </div>

        <script>
            $(document).ready(function() {

                // // Select the form using its id
                var form = $('#createCategoryForm');

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


                // fetch category data from database
                fetchAllCategoryData();

                // Add a submit event listener to the form
                form.submit(function(event) {
                    // Prevent the default form submission behavior
                    event.preventDefault();
                    // Serialize the form data into a URL-encoded string
                    var formData = new FormData(form[0]);

                    // Use jQuery Ajax to send a POST request with the form data
                    $.ajax({
                        url: '/pm/newCategory',
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
                                $('#modalAddnewcategory').modal('hide');
                                // Example: Display a success message or update the UI
                                alert('Category created successfully!');
                                // reset form
                                $('#createCategoryForm')[0].reset();
                                // You can update the UI or perform other actions here

                                //fetch brand data from database function
                                fetchAllCategoryData();
                            } else if (response.status === 422) {
                                // Handle validation errors
                                var errors = response.errors;

                                for (var key in errors) {
                                    // Find the form field
                                    var field = $('[name="' + key + '"]');
                                    // Display the error message
                                    field.next('.input-error').text(errors[key][0]).show();
                                }

                                // $('#password-error').text(errors[key][0]).show();

                            } else {
                                // Handle other status codes if needed
                                // For example, display an error message
                                alert('Failed to create category. Please try again.');
                                // reset form
                                $('#createCategoryForm')[0].reset();
                            }
                        },


                    });
                });

                // Add an event listener to the modal close button
                $('#btnClose, .btn-close').on('click', function() {
                    // Reset the form when the close button is clicked
                    $('#createCategoryForm')[0].reset();
                    $('.input-error').hide();
                });

                function fetchAllCategoryData() {
                    $.ajax({
                        url: '/categories/fetchAllCategoryData',
                        method: 'get',
                        success: function(response) {
                            // console.log(response);
                            $('#show_all_category_data').html(response);
                            // //Make table a data table
                            $('#all_category_data').DataTable({

                                // Enable horizontal scrolling
                            });
                        }


                    });
                }

            });
        </script>


    </div>
</div>
