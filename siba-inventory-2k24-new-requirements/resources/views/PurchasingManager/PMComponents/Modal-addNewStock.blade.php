<!-- Button to trigger the modal -->
<button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalAddnewStockitem" title="Add new Stock to an Existing item.">
    Add New Stock Item
</button>

<!-- Modal -->
<div class="modal fade" id="modalAddnewStockitem" tabindex="-1" aria-labelledby="modalAddnewitem" aria-hidden="true">
    <div class="modal-dialog"> <!-- Adjust the modal size as needed -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddnewitemLabel">Add New Stock Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="createItemsForm" class="mb-3" method="POST" action="#">
                    @csrf

                    {{-- hidden field to store user_id --}}
                    <input type="text" value="{{ Auth::user()->id }}" name="user_id_hidden" id="user_id_hidden"
                        hidden>


                    <div class="mb-3">
                        <label class="form-label" for="po_no">PO Number</label>
                        <select class="form-select" id="po_no" name="po_no2" aria-label="catagory">
                            <option disabled selected hidden>Select a PO Number</option>
                        </select>
                        <div class="input-error text-danger" style="display: none"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="item_id">Item Name</label>
                        <select class="form-select" id="item_id" name="item_id2" aria-label="catagory">
                            <option disabled selected hidden>Select the Item Name</option>
                        </select>
                        <div class="input-error text-danger" style="display: none"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="item-name">Item Count</label>
                        <input type="text" class="form-control" id="item_count" name="item_count2"
                            placeholder="Enter Item Count" />
                        <div class="input-error text-danger" style="display: none"></div>
                    </div>

                    <div class="mb-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            id="btnClose">Close</button>
                        <button type="submit" id="createNewProduct" class="btn btn-primary">Add New Stock Item
                        </button>
                    </div>

                </form>

            </div>
        </div>



    </div>
</div>

<script>
    $(document).ready(function() {

        $('#modalAddnewStockitem').on('show.bs.modal', function() {
            // Send AJAX request to fetch PO numbers
            $.ajax({
                url: '/fetchPoNumbers',
                method: 'GET',
                success: function(response) {
                    // Update dropdown options with fetched PO numbers
                    var poDropdown = $('#po_no');
                    poDropdown.empty(); // Clear existing options
                    poDropdown.append(
                        '<option disabled selected hidden>Select a PO Number</option>');
                    $.each(response, function(index, po) {
                        poDropdown.append('<option value="' + po.id + '">' +
                            po.po_no + " on " + po.created_at + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
            $.ajax({
                url: '/fetchItemName',
                method: 'GET',
                success: function(response) {
                    // Update dropdown options with fetched item names
                    var itemDropdown = $('#item_id');
                    itemDropdown.empty(); // Clear existing options
                    itemDropdown.append(
                        '<option disabled selected hidden>Select an Item Name</option>');
                    $.each(response, function(index, item) {
                        itemDropdown.append('<option value="' + item.id + '">' +
                            item.item_name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

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


        // fetch all po data from database
        fetchAllNewStockData();

        // Add a submit event listener to the form
        form.submit(function(event) {
            // Prevent the default form submission behavior
            event.preventDefault();
            // Serialize the form data into a URL-encoded string
            var formData = new FormData(form[0]);

            // Use jQuery Ajax to send a POST request with the form data
            $.ajax({
                url: '/pm/addNewStockItem',
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
                        $('#modalAddnewStockitem').modal('hide');
                        // Example: Display a success message or update the UI
                        alert('Stock Input successful!');
                        // reset form
                        $('#createItemsForm')[0].reset();
                        // You can update the UI or perform other actions here

                        //fetch product data from database function
                        fetchAllNewStockData();
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

        // function fetchAllNewStockData() {
        //     $.ajax({
        //         url: '/view-low-items',
        //         method: 'get',
        //         success: function(response) {
        //             // console.log(response);
        //             $('#show_all_low_item_data').html(response);
        //             // //Make table a data table
        //             $('#all_low_item_data').DataTable({
        //                 // Enable horizontal scrolling
        //                 // "scrollX": true,
        //                 order: [
        //                     [0, 'desc']
        //                 ]
        //             });
        //         }


        //     });
        // }

        function fetchAllNewStockData() {
            $.ajax({
                url: '/fetchAllNewStockData',
                method: 'get',
                success: function(response) {
                    $('#show_all_item_data').html(response);
                    $('#all_new_stock_data').DataTable({
                        order: [
                            [0, 'desc']
                        ]
                    });
                }
            });
        }


    });
</script>
