@extends('PurchasingManager.PM-layout')

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            {{-- @include('PurchasingManager.PMComponents.Modal-addNewStock') --}}
            <br><br>
            <div class="authentication-inner">
                <div class="card">
                    <div class="card-header">
                        Low Level Item Details
                        <!-- Button to trigger the Excel export -->
                        <button type="button" class="btn btn-success float-end" id="exportExcel">Export to Excel</button>
                    </div>
                    <div class="card-body">
                        <div id="show_all_low_item_data"></div>
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
                                alert('Item created successfully!');
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

                function fetchAllNewStockData() {
                    $.ajax({
                        url: '/view-low-items',
                        method: 'get',
                        success: function(response) {
                            // console.log(response);
                            $('#show_all_low_item_data').html(response);
                            // //Make table a data table
                            $('#all_low_item_data').DataTable({
                                // Enable horizontal scrolling
                                // "scrollX": true,
                                order: [
                                    [0, 'desc']
                                ]
                            });
                        }


                    });
                }


            });
        </script>
    </div>

    <!-- Include the necessary dependencies for exporting Excel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

    <script>
        $(document).ready(function() {
            // Add click event listener to the export button
            $('#exportExcel').click(function() {
                // Disable DataTables pagination temporarily
                var dataTable = $('#all_low_item_data').DataTable();
                dataTable.page.len(-1).draw();

                // Get the HTML content of the table inside show_all_low_item_data div
                var htmlTable = document.getElementById('show_all_low_item_data').outerHTML;

                // Convert the HTML table to a workbook
                var workbook = XLSX.utils.table_to_book(document.getElementById('all_low_item_data'));

                // Generate a binary string from the workbook
                var binaryString = XLSX.write(workbook, {
                    bookType: 'xlsx',
                    type: 'binary'
                });

                // Convert the binary string to a Blob
                var blob = new Blob([s2ab(binaryString)], {
                    type: 'application/octet-stream'
                });

                // Save the Blob as an Excel file
                saveAs(blob, 'stock_input.xlsx');

                // Re-enable DataTables pagination after export
                dataTable.page.len(10).draw(); // Change 10 to your desired page length
            });
        });

        // Utility function to convert a string to an ArrayBuffer
        function s2ab(s) {
            var buf = new ArrayBuffer(s.length);
            var view = new Uint8Array(buf);
            for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
            return buf;
        }
    </script>
@endsection
