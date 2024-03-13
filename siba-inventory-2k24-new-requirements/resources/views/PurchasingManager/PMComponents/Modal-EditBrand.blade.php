<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="modaleditbrand" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Brand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <form id="UpdateBrandDetailsForm" class="mb-3" method="POST" action="#">
                    @csrf

                    {{-- hidden id input field --}}
                    <input type="hidden" id="brand_Id_hidden" name="brand_Id_hidden">

                    <div class="mb-3">
                        <label for="brand_name" class="form-label">Brand Name</label>
                        <input type="text" class="form-control" id="brand_name1" name="brand_name"
                            placeholder="Enter your Brand Name" :value="old('brand_name')" required autofocus
                            autocomplete="brand_name" />
                    </div>


                    <div class="mb-3">
                        <label for="status" class="form-label">Select Status</label>
                        <select class="form-control" id="status1" name="status1">
                            <option disabled selected hidden>Select a Status</option>
                            <option value="1">Active</option>
                            <option value="2">Deactive</option>
                            <option value="3">Delete</option>
                        </select>
                    </div>


                    <button class="btn btn-primary d-grid w-100" id="Update_brand_button">Update</button>
                </form>

                <script>
                    $(document).ready(function() {

                        // Add an event listener to the modal close button
                        $('.btn-close').on('click', function() {
                            // Reset the form when the close button is clicked
                            $('#UpdateBrandDetailsForm')[0].reset();
                            $('#password-error').hide();
                            $('.input-error').hide();
                        });

                        //edit user button
                        $(document).on('click', '.editBrandButton', function(e) {
                            e.preventDefault();
                            let brand_Id = $(this).attr('id');
                            // alert(id);

                            $.ajax({
                                url: '{{ route('brand.edit') }}',
                                method: 'get',
                                data: {
                                    brand_Id: brand_Id,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {

                                    // console.log(response.name);
                                    // Set id value to the hidden field
                                    $('#brand_Id_hidden').val(response.id);
                                    $('#brand_name1').val(response.brand_name);
                                    $('#status1').val(response.isActive);

                                }


                            });


                        })

                        function fetchAllBrandData() {
                            $.ajax({
                                url: '{{ route('fetchAllBrandData') }}',
                                method: 'get',
                                success: function(response) {
                                    // console.log(response);
                                    $('#show_all_brand_data').html(response);
                                    // //Make table a data table
                                    $('#all_brand_data').DataTable({
                                        order: [[0, 'desc']]
                                        // Enable horizontal scrolling
                                    });
                                }


                            });
                        }

                        //Update form
                        $('#UpdateBrandDetailsForm').submit(function(e) {
                            e.preventDefault();
                            //save form data to fd constant
                            const fd = new FormData(this);

                            $.ajax({
                                url: '{{ route('brand.update') }}',
                                method: 'post',
                                data: fd,
                                cache: false,
                                contentType: false,
                                processData: false,
                                dataType: 'json',
                                success: function(response) {
                                    // console.log(response);
                                    if (response.status == 200) {
                                        // $('#UpdateUserDetailsForm')[0].reset();
                                        $('#modaleditbrand').modal('hide');
                                        // fetch product data from database
                                        fetchAllBrandData();

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
