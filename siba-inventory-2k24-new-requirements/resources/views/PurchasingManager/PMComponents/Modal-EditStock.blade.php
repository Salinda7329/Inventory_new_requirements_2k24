<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="modaleditInput" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Input Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <form id="UpdateInputDetailsForm" class="mb-3" method="POST" action="#">
                    @csrf
                    {{-- hidden current user id input field --}}
                    <input type="hidden" id="user_id_hidden2" name="user_id_hidden2" value="{{ Auth::user()->id }}">
                    {{-- hidden input id --}}
                    <input type="hidden" id="input_id_hidden2" name="input_id_hidden">


                    <div class="mb-3">
                        <label class="form-label" for="po_no">PO Number</label>
                        <select class="form-select" id="po_no10" name="po_no2" aria-label="catagory">
                            <option disabled selected hidden>Select a PO Number</option>
                        </select>
                        <div class="input-error text-danger" style="display: none"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="item_id">Item Name</label>
                        <select class="form-select" id="item_id2" name="item_id2" aria-label="catagory">
                            <option disabled selected hidden>Select the Item Name</option>
                        </select>
                        <div class="input-error text-danger" style="display: none"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="item-name">Item Count</label>
                        <input type="text" class="form-control" id="item_count2" name="item_count2"
                            placeholder="Enter Item Count" />
                        <div class="input-error text-danger" style="display: none"></div>
                    </div>

                    <button class="btn btn-primary d-grid w-100" id="Update_item_button">Update</button>
                </form>

                {{-- <script>
                    $(document).ready(function() {

                        //edit user button
                        $(document).on('click', '.editInputButton', function(e) {
                            e.preventDefault();
                            let input_Id = $(this).attr('id');
                            // alert(id);

                            $.ajax({
                                url: '/pm/input/edit',
                                method: 'get',
                                data: {
                                    input_Id: input_Id,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    $('#input_id_hidden2').val(response.input.id);
                                    var oldPoNo = response.old_po_no; // Access old_po_no from the response
                                    $('#po_no10').val(
                                    oldPoNo); // Set the value of po_no3 select input field
                                    $('#input_id_hidden2').val(response.input.id);
                                    $('#item_id2').val(response.input.item_id);
                                }

                            });


                        });

                        $('#modaleditInput').on('show.bs.modal', function() {
                            // Send AJAX request to fetch PO numbers
                            $.ajax({
                                url: '/fetchPoNumbers',
                                method: 'GET',
                                success: function(response) {
                                    // Update dropdown options with fetched PO numbers
                                    var poDropdown = $('#po_no10');
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
                        var form = $('#UpdateInputDetailsForm');

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
                        // Add an event listener to the modal close button
                        $('.btn-close').on('click', function() {
                            // Reset the form when the close button is clicked
                            $('#UpdateInputDetailsForm')[0].reset();
                            $('#password-error').hide();
                            $('.input-error').hide();
                        });


                        // fetch item data from database
                        fetchAllNewStockData();

                        //Update form
                        $('#UpdateInputDetailsForm').submit(function(e) {
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



                        //fetch item names
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

                        function fetchAllNewStockData() {
                            $.ajax({
                                url: '/fetchAllNewStockData',
                                method: 'get',
                                success: function(response) {
                                    // console.log(response);
                                    $('#show_all_item_data').html(response);
                                    // //Make table a data table
                                    $('#all_new_stock_data').DataTable({
                                        // Enable horizontal scrolling
                                        // "scrollX": true,
                                        order: [
                                            [0, 'desc']
                                        ]
                                    });
                                }


                            });
                        }





                        // Send AJAX request to fetch PO numbers and update
                        // Fetch all PO numbers
                        // $.ajax({
                        //     url: '/fetchPoNumbers',
                        //     method: 'GET',
                        //     success: function(response) {
                        //         var poDropdown = $('#po_no4');
                        //         poDropdown.empty(); // Clear existing options

                        //         // Add default option
                        //         poDropdown.append(
                        //             '<option disabled selected hidden>Select a Po No</option>');

                        //         // Append fetched PO numbers
                        //         $.each(response, function(index, po) {
                        //             poDropdown.append('<option value="' + po.id + '">' +
                        //                 po.po_no + " on " + po.created_at + '</option>');
                        //         });
                        //     },
                        //     error: function(xhr, status, error) {
                        //         console.error(error);
                        //     }
                        // });


                    });
                </script> --}}

                <script>
                    $(document).ready(function() {
                        // Function to fetch all new stock data
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

                        // Function to fetch PO numbers and update dropdown
                        function fetchPoNumbersAndUpdateDropdown() {
                            $.ajax({
                                url: '/fetchPoNumbers',
                                method: 'GET',
                                success: function(response) {
                                    var poDropdown = $('#po_no10');
                                    poDropdown.empty(); // Clear existing options
                                    poDropdown.append(
                                        '<option disabled selected hidden>Select a PO Number</option>');
                                    $.each(response, function(index, po) {
                                        poDropdown.append('<option value="' + po.id + '">' + po.po_no +
                                            " on " + po.created_at + '</option>');
                                    });
                                },
                                error: function(xhr, status, error) {
                                    console.error(error);
                                }
                            });
                        }

                        // Function to fetch item names and update dropdown
                        function fetchItemNamesAndUpdateDropdown() {
                            $.ajax({
                                url: '/fetchItemName',
                                method: 'GET',
                                success: function(response) {
                                    var itemDropdown = $('#item_id2');
                                    itemDropdown.empty(); // Clear existing options
                                    itemDropdown.append(
                                        '<option disabled selected hidden>Select an Item Name</option>');
                                    $.each(response, function(index, item) {
                                        itemDropdown.append('<option value="' + item.id + '">' + item
                                            .item_name + '</option>');
                                    });
                                },
                                error: function(xhr, status, error) {
                                    console.error(error);
                                }
                            });
                        }

                        // Edit Input Record button click event handler
                        $(document).on('click', '.editInputButton', function(e) {
                            e.preventDefault();
                            let input_Id = $(this).attr('id');

                            $.ajax({
                                url: '/pm/input/edit',
                                method: 'get',
                                data: {
                                    input_Id: input_Id,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    $('#input_id_hidden2').val(response.input.id);
                                    $('#po_no10').val(response
                                    .old_po_no); // Set the value of po_no10 select input field
                                    $('#input_id_hidden2').val(response.input.id);
                                    $('#item_id2').val(response.input.item_id);
                                }
                            });
                        });

                        // Modal show event handler
                        $('#modaleditInput').on('show.bs.modal', function() {
                            // Fetch PO numbers and update dropdown
                            fetchPoNumbersAndUpdateDropdown();
                            // Fetch item names and update dropdown
                            fetchItemNamesAndUpdateDropdown();
                        });

                        // Form submission event handler
                        $('#UpdateInputDetailsForm').submit(function(e) {
                            e.preventDefault();
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
                                    $('.text-danger').text('');

                                    if (response.status == 200) {
                                        alert('Item updated successfully!');
                                        $('#UpdateItemDetailsForm')[0].reset();
                                        $('#modaledititem').modal('hide');
                                        fetchAllItemData(); // Fetch product data from database
                                    } else if (response.status === 422) {
                                        var errors = response.errors;

                                        for (var key in errors) {
                                            var field = $('[name="' + key + '"]');
                                            field.next('.input-error').text(errors[key][0]).show();
                                        }
                                    } else {
                                        alert('Failed to Update item. Please try again.');
                                        $('#createItemsForm')[0].reset();
                                    }
                                },
                                error: function(xhr, status, error) {
                                    var response = xhr.responseJSON;
                                    if (response && response.errors) {
                                        var errors = response.errors;

                                        for (var key in errors) {
                                            var field = $('[name="' + key + '"]');
                                            field.next('.input-error').text(errors[key][0]).show();
                                        }
                                    } else {
                                        console.error(xhr.responseText);
                                        alert(
                                            'An error occurred while processing your request. Please try again.');
                                    }
                                }
                            });
                        });

                        // Attach input event handler to form inputs
                        var form = $('#UpdateInputDetailsForm');
                        form.find('input, select').on('input', function() {
                            $(this).next('.input-error').hide();
                        });

                        // Attach keypress event handler to form inputs
                        form.find('input').keypress(function(e) {
                            if (e.which === 13) {
                                e.preventDefault();
                                form.submit();
                            }
                        });

                        // Modal close button click event handler
                        $('.btn-close').on('click', function() {
                            $('#UpdateInputDetailsForm')[0].reset();
                            $('#password-error').hide();
                            $('.input-error').hide();
                        });

                        // Fetch item data from database
                        fetchAllNewStockData();
                    });
                </script>


            </div>
        </div>
    </div>
</div>
