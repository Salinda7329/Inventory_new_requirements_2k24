<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="modaleditpo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Purchasing Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <form id="UpdateItemDetailsForm" class="mb-3" method="POST" action="#">
                    @csrf
                    {{-- hidden current user id input field --}}
                    <input type="hidden" id="user_id_hidden2" name="user_id_hidden2" value="{{ Auth::user()->id }}">
                    {{-- hidden po id --}}
                    <input type="hidden" id="po_id_hidden" name="po_id_hidden">

                    <div id="po_image2"></div>

                    <div class="mb-3">
                        <label class="form-label" for="item-name">PO Number</label>
                        <input type="text" class="form-control" id="po_no2" name="po_no"
                            placeholder="Enter PO Number" />
                        <div class="input-error text-danger" style="display: none"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="item-name">PO Image</label>
                        <input type="file" class="form-control" id="po_image_new" name="po_image_new"
                            placeholder="Enter PO Image" />
                        <div class="input-error text-danger" style="display: none"></div>
                    </div>

                    <button class="btn btn-primary d-grid w-100" id="Update_item_button">Update</button>
                </form>

                <script>
                    $(document).ready(function() {

                        // Add an event listener to the modal close button
                        $('.btn-close').on('click', function() {
                            // Reset the form when the close button is clicked
                            $('#UpdateItemDetailsForm')[0].reset();
                            $('#password-error').hide();
                            $('.input-error').hide();
                        });

                        // fetch item data from database
                        fetchAllPoData();

                        //edit user button
                        $(document).on('click', '.editPoButton', function(e) {
                            e.preventDefault();
                            let po_Id = $(this).attr('id');
                            // alert(id);

                            $.ajax({
                                url: '/pm/po/edit',
                                method: 'get',
                                data: {
                                    po_Id: po_Id,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    // Set id value to the hidden field
                                    $('#po_id_hidden').val(response.id);
                                    $('#po_no2').val(response.po_no);
                                    // Construct the full image URL using the base URL and the image name from the response
                                    var imageUrl = 'http://127.0.0.1:8000/storage/assets/po_images/' +
                                        response.image;
                                    $('#po_image2').html(
                                        '<img src="' + imageUrl + '" width="100px" height="100px" class="img-fluid img-thumbnail">'
                                    );
                                }

                            });


                        });

                        function fetchAllPoData() {
                            $.ajax({
                                url: '/fetchAllPoData',
                                method: 'get',
                                success: function(response) {
                                    // console.log(response);
                                    $('#show_all_item_data').html(response);
                                    // //Make table a data table
                                    $('#all_po_data').DataTable({
                                        // Enable horizontal scrolling
                                        // "scrollX": true,
                                        order: [
                                            [0, 'desc']
                                        ]
                                    });
                                }


                            });
                        }

                        //Update form
                        $('#UpdateItemDetailsForm').submit(function(e) {
                            e.preventDefault();
                            //save form data to fd constant
                            const fd = new FormData(this);

                            $.ajax({
                                url: '/pm/po/update',
                                method: 'post',
                                data: fd,
                                cache: false,
                                contentType: false,
                                processData: false,
                                dataType: 'json',
                                success: function(response) {
                                    // console.log(response);
                                    if (response.status == 200) {
                                        alert('Item updated successfully!');
                                        $('#UpdateItemDetailsForm')[0].reset();
                                        $('#modaleditpo').modal('hide');
                                        // fetch product data from database
                                        fetchAllPoData();

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
