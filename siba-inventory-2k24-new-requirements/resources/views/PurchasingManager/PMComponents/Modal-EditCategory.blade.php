<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="modaleditcategory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <form id="UpdateCategoryDetailsForm" class="mb-3" method="POST" action="#">
                    @csrf

                    {{-- hidden id input field --}}
                    <input type="hidden" id="category_Id_hidden2" name="category_Id_hidden2">

                    <div class="mb-3">
                        <label for="category_name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="category_name1" name="category_name"
                            placeholder="Enter your Category Name" :value="old('category_name')" required autofocus
                            autocomplete="category_name" />
                    </div>


                    <div class="mb-3">
                        <label for="status" class="form-label">Select Status</label>
                        <select class="form-control" id="status2" name="status2">
                            <option disabled selected hidden>Select a Status</option>
                            <option value="1">Active</option>
                            <option value="2">Deactive</option>
                            <option value="3">Delete</option>
                        </select>
                    </div>


                    <button class="btn btn-primary d-grid w-100" id="Update_category_button">Update</button>
                </form>

                <script>
                    $(document).ready(function() {

                        // Add an event listener to the modal close button
                        $('.btn-close').on('click', function() {
                            // Reset the form when the close button is clicked
                            $('#UpdateCategoryDetailsForm')[0].reset();
                            $('#password-error').hide();
                            $('.input-error').hide();
                        });

                        //edit user button
                        $(document).on('click', '.editCategoryButton', function(e) {
                            e.preventDefault();
                            let category_Id = $(this).attr('id');
                            // alert(category_Id);

                            $.ajax({
                                url: '/pm/Category/edit',
                                method: 'get',
                                data: {
                                    category_Id: category_Id,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {

                                    // console.log(response.name);
                                    // Set id value to the hidden field
                                    $('#category_Id_hidden2').val(response.id);
                                    $('#category_name1').val(response.category_name);
                                    $('#status2').val(response.isActive);

                                }


                            });


                        })


                        function fetchAllCategoryData() {
                            $.ajax({
                                url: '{{ route('fetchAllCategoryData') }}',
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

                        //Update form
                        $('#UpdateCategoryDetailsForm').submit(function(e) {
                            e.preventDefault();
                            //save form data to fd constant
                            const fd = new FormData(this);

                            $.ajax({
                                url: '/pm/Category/update',
                                method: 'post',
                                data: fd,
                                cache: false,
                                contentType: false,
                                processData: false,
                                dataType: 'json',
                                success: function(response) {
                                    // console.log(response);
                                    if (response.status == 200) {
                                        $('#UpdateCategoryDetailsForm')[0].reset();
                                        $('#modaleditcategory').modal('hide');
                                        // fetch product data from database
                                        fetchAllCategoryData();

                                    }
                                }
                            });


                        });


                    });
                </script>

            </div>
        </div>
    </div>
</div>
