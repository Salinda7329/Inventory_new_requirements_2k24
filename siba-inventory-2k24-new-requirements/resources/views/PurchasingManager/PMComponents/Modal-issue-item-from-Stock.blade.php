<!-- Button to trigger the modal -->
<button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalIssueStockitem">
    Issue Item to Department
</button>

<!-- Modal -->
<div class="modal fade" id="modalIssueStockitem" tabindex="-1" aria-labelledby="modalAddnewitem" aria-hidden="true">
    <div class="modal-dialog"> <!-- Adjust the modal size as needed -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddnewitemLabel">Issue Item to Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="IssuesForm" class="mb-3" method="POST" action="#">
                    @csrf

                    {{-- hidden field to store user_id --}}
                    <input type="text" value="{{ Auth::user()->id }}" name="user_id_hidden" id="user_id_hidden"
                        hidden>


                    <div class="mb-3">
                        <label class="form-label" for="po_no">Item</label>
                        <select class="form-select" id="item_id" name="item_id" aria-label="catagory">
                            <option disabled selected hidden>Select Item Name</option>
                        </select>
                        <div class="input-error text-danger" style="display: none"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="item-name">Quantity</label>
                        <input type="text" class="form-control" id="item_count" name="count"
                            placeholder="Enter Item Count" />
                        <div class="input-error text-danger" style="display: none"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="po_no">To Department</label>
                        <select class="form-select" id="issued_to" name="issued_to" aria-label="catagory">
                            <option disabled selected hidden>Select Department</option>
                        </select>
                        <div class="input-error text-danger" style="display: none"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="item-name">Issue Remark</label>
                        <input type="text" class="form-control" id="remark" name="issue_remark"
                            placeholder="Enter Issue Remark" />
                        <div class="input-error text-danger" style="display: none"></div>
                    </div>


                    <div class="mb-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            id="btnClose">Close</button>
                        <button type="submit" id="createNewProduct" class="btn btn-primary">Issue Item
                        </button>
                    </div>

                </form>

            </div>
        </div>

        <script>
            $(document).ready(function() {


                // // Select the form using its id
                var form = $('#IssuesForm');

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


                // fetch all po data from database
                // fetchAllNewStockData();

                // Add a submit event listener to the form
                form.submit(function(event) {
                    // Prevent the default form submission behavior
                    event.preventDefault();
                    // Serialize the form data into a URL-encoded string
                    var formData = new FormData(form[0]);

                    // Use jQuery Ajax to send a POST request with the form data
                    $.ajax({
                        url: '/pm/issueItemtoDept',
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
                                $('#modalIssueStockitem').modal('hide');
                                // Example: Display a success message or update the UI
                                alert('Item issued successfully!');
                                // reset form
                                $('#IssuesForm')[0].reset();
                                // You can update the UI or perform other actions here

                                //fetch product data from database function
                                // fetchAllNewStockData();
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
                                alert('Failed to issue Item. Please try again.');
                                // reset form
                                $('#IssuesForm')[0].reset();
                            }
                        },


                    });
                });

                // Add an event listener to the modal close button
                $('#btnClose, .btn-close').on('click', function() {
                    // Reset the form when the close button is clicked
                    $('#IssuesForm')[0].reset();
                    $('.input-error').hide();
                });

                // function fetchAllNewStockData() {
                //     $.ajax({
                //         url: '/fetchAllNewStockData',
                //         method: 'get',
                //         success: function(response) {
                //             // console.log(response);
                //             $('#show_all_item_data').html(response);
                //             // //Make table a data table
                //             $('#all_new_stock_data').DataTable({
                //                 // Enable horizontal scrolling
                //                 // "scrollX": true,
                //                 order: [
                //                     [0, 'desc']
                //                 ]
                //             });
                //         }


                //     });
                // }

                // fetch items data
                $.ajax({
                    url: '/fetchItemName',
                    method: 'get',
                    success: function(items) {
                        updateItemDropdown(items);
                    }
                });

                // Function to update the items dropdown
                function updateItemDropdown(items) {
                    var itemDropdown = $('#item_id');
                    itemDropdown.empty(); // Clear existing options

                    // Add default option
                    itemDropdown.append('<option disabled selected hidden>Select an Item</option>');

                    // Populate the dropdown with items
                    $.each(items, function(index,
                        item) { // Change 'items' variable to 'item' in the function parameters
                        itemDropdown.append('<option value="' + item.id + '">' + item.item_name +
                            '</option>'); // Change 'items' variable to 'item'
                    });
                }


                // fetch departments
                $.ajax({
                    url: '/fetchDepartmentData',
                    method: 'get',
                    success: function(categories) {
                        updateDepartmentsDropdown(categories);
                    }
                });

                // Function to update the departments dropdown
                function updateDepartmentsDropdown(departments) {
                    var departmentDropdown = $('#issued_to');
                    departmentDropdown.empty(); // Clear existing options

                    // Add default option
                    departmentDropdown.append('<option disabled selected hidden>Select a Department</option>');

                    // Populate the dropdown with departments
                    $.each(departments, function(index, department) {
                        departmentDropdown.append('<option value="' + department.id + '">' + department
                            .dept_name + '</option>');
                    });
                }


            });
        </script>


    </div>
</div>
