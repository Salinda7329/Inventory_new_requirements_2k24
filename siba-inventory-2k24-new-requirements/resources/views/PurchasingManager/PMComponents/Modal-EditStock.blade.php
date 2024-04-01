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
                    {{-- hidden po_id id --}}
                    <input type="hidden" id="po_id_hidden2" name="po_id_hidden">
                    {{-- hidden count --}}
                    <input type="hidden" id="count_hidden2" name="count_hidden">


                    <div class="mb-3">
                        <label class="form-label" for="po_no">PO Number</label>
                        <select class="form-select" id="po_no10" name="po_no10" aria-label="catagory">
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
                                    console.log(response.input.po_id);
                                    $('#input_id_hidden2').val(response.input.id);
                                    $('#po_no10').val(response.input.po_id);
                                    $('#item_count2').val(response.input.count);
                                    $('#count_hidden2').val(response.input.count);
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
                                url: '/pm/UpdateInputDetails',
                                method: 'post',
                                data: fd,
                                cache: false,
                                contentType: false,
                                processData: false,
                                dataType: 'json',
                                success: function(response) {
                                    $('.text-danger').text('');

                                    if (response.status == 200) {
                                        $('#UpdateInputDetailsForm')[0].reset(); // Reset the form
                                        $('#modaleditInput').modal('hide'); // Hide the modal
                                        fetchAllNewStockData(); // Fetch product data from database
                                        alert('Stock In Record updated successfully!');
                                    } else if (response.status === 422) {
                                        var errors = response.errors;

                                        for (var key in errors) {
                                            var field = $('[name="' + key + '"]');
                                            field.next('.input-error').text(errors[key][0]).show();
                                        }
                                    } else {
                                        alert('Failed to Update Stock In. Please try again.');
                                        $('#UpdateInputDetailsForm')[0].reset();
                                        fetchAllNewStockData();
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
                                            'An error occurred while processing your request. Please try again.'
                                        );
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
