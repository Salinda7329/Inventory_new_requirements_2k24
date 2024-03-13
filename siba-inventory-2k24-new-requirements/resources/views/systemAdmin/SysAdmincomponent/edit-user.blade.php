<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="editUserDataModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <form id="UpdateUserDetailsForm" class="mb-3" method="POST" action="#">
                    @csrf

                    {{-- hidden id input field --}}
                    <input type="hidden" id="user_Id" name="user_Id_hidden">

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name1" name="name"
                            placeholder="Enter your Name" :value="old('name')" required autofocus autocomplete="name"
                            readonly disabled />
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email1" name="email"
                            placeholder="Enter your Email" :value="old('email')" autofocus required readonly
                            disabled />
                    </div>

                    <div class="mb-3">
                        <label for="epf" class="form-label">EPF No :</label>
                        <input type="text" class="form-control" id="epf1" name="epf"
                            placeholder="Enter your EPF Number" :value="old('epf')" autofocus required readonly
                            disabled />
                    </div>


                    <div class="mb-3">
                        <label for="department" class="form-label">Choose Departmnt</label>
                        <select class="form-control" id="dept_id1" name="dept_id" required>
                            <option disabled selected hidden>Select a Department</option>
                            <option value="1">Information Technology</option>
                            <option value="2">Buddhist & Pali Studies</option>
                            <option value="3">Counselling Psycology</option>
                            <option value="4">English & Modern Language</option>
                            <option value="5">Global Studies</option>
                            <option value="6">Aesthetic Department</option>
                            <option value="7">management Studies</option>
                            <option value="8">Admin Department</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Select Role</label>
                        <select class="form-control" id="role1" name="role" required>
                            <option disabled selected hidden>Select a Role</option>
                            <option value="1">User</option>
                            <option value="2">Store Manager</option>
                            <option value="3">Purchase Manager</option>
                            <option value="4">Head of Administration</option>
                            {{-- value="5" Admin --}}
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Select Status</label>
                        <select class="form-control" id="status1" name="status" required>
                            <option disabled selected hidden>Select a Status</option>
                            <option value="1">Active</option>
                            <option value="2">Deactive</option>
                            <option value="3">Delete</option>
                        </select>
                    </div>


                    <button class="btn btn-primary d-grid w-100" id="Update_user_button">Update</button>
                </form>

                <script>
                    $(document).ready(function() {
                        // Select the form using its id
                        var form = $('#userCreationForm');

                        // Attach the input event handler to the form inputs
                        form.find('input, select').on('input', function() {
                            $(this).next('.input-error').hide();
                        });
                        $('#password').on('input', function() {
                            $('#password-error').hide();
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
                        })

                        //fetch user data from database function
                        fetchAllUserData();

                        // Add a submit event listener to the form
                        form.submit(function(event) {
                            // Prevent the default form submission behavior
                            event.preventDefault();

                            // Serialize the form data into a URL-encoded string
                            var formData = new FormData(form[0]);

                            // Use jQuery Ajax to send a POST request with the form data
                            $.ajax({
                                url: '/systemAdmin/newUser',
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
                                        console.log(response);
                                        // Close the modal directly
                                        $('#newUserData').modal('hide');
                                        // Example: Display a success message or update the UI
                                        alert('User created successfully!');
                                        // reset form
                                        $('#userCreationForm')[0].reset();
                                        // You can update the UI or perform other actions here

                                        //fetch user data from database function
                                        fetchAllUserData();
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
                                        alert('Failed to create user. Please try again.');
                                        // reset form
                                        $('#userCreationForm')[0].reset();
                                    }
                                },


                            });
                        });

                        // Add an event listener to the modal close button
                        $('.btn-close').on('click', function() {
                            // Reset the form when the close button is clicked
                            $('#userCreationForm')[0].reset();
                            $('#password-error').hide();
                            $('.input-error').hide();
                        });


                        function fetchAllUserData() {
                            $.ajax({
                                url: '{{ route('fetchAllUserData') }}',
                                method: 'get',
                                success: function(response) {
                                    // console.log(response);
                                    $('#show_all_user_data').html(response);
                                    // //Make table a data table
                                    $('#all_user_data').DataTable({

                                        // Enable horizontal scrolling
                                            //order by
                                    order: [[0, 'desc']]
                                    });
                                }


                            });
                        }

                        //edit user button ( role,department,isActive)
                        $(document).on('click', '.editUserButton', function(e) {
                            e.preventDefault();
                            let user_Id = $(this).attr('id');
                            // alert(id);

                            $.ajax({
                                url: '{{ route('user.edit') }}',
                                method: 'get',
                                data: {
                                    user_Id: user_Id,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {

                                    // console.log(response.name);
                                    // Set id value to the hidden field
                                    $('#user_Id').val(response.id);
                                    $('#name1').val(response.name);
                                    $('#email1').val(response.email);
                                    $('#epf1').val(response.epf);
                                    $('#dept_id1').val(response.dept_id);
                                    $('#role1').val(response.role);
                                    $('#status1').val(response.isActive);

                                }


                            });


                        })

                        //Update form
                        $('#UpdateUserDetailsForm').submit(function(e) {
                            e.preventDefault();
                            //save form data to fd constant
                            const fd = new FormData(this);
                            //change submit button to adding
                            $('#Update_user_button').text('Updating..');

                            $.ajax({
                                url: '{{ route('user.update') }}',
                                method: 'post',
                                data: fd,
                                cache: false,
                                contentType: false,
                                processData: false,
                                dataType: 'json',
                                success: function(response) {
                                    // console.log(response);
                                    if (response.status == 200) {
                                        $('#Update_user_button').text(' Update Student');
                                        $('#UpdateUserDetailsForm')[0].reset();
                                        $('#editUserDataModal').modal('hide');

                                        fetchAllUserData();
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
