    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newUserData" id="createNewUser">
        Create New User
    </button>

    <!-- Modal -->
    <div class="modal fade" id="newUserData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Enter New User Details</h5>
                    <button type="button" id="modal-close" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <form id="userCreationForm" class="mb-3" method="POST" action="#">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter your Name" :value="old('name')" required autofocus
                                autocomplete="name" />
                            <div class="input-error text-danger" style="display: none"></div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter your Email" :value="old('email')" autofocus required />
                            <div class="input-error text-danger" style="display: none"></div>
                        </div>

                        <div class="mb-3">
                            <label for="epf" class="form-label">EPF No :</label>
                            <input type="text" class="form-control" id="epf" name="epf"
                                placeholder="Enter your EPF Number" :value="old('epf')" autofocus required />
                            <div class="input-error text-danger" style="display: none"></div>
                        </div>


                        <div class="mb-3">
                            <label for="department" class="form-label">Choose Departmnt</label>
                            <select class="form-control" id="dept_id" name="dept_id" required>
                                <option disabled selected hidden>Select a Department</option>
                                <option value="1">Information Technology</option>
                                <option value="2">Buddhist & Pali Studies</option>
                                <option value="3">Counselling Psycology</option>
                                <option value="4">English & Modern Language</option>
                                <option value="5">Global Studies</option>
                                <option value="6">Aesthetic Department</option>
                                <option value="7">Management Studies</option>
                                <option value="8">Kandyan Dancing</option>
                                <option value="9">Admin Department</option>
                            </select>
                            <div class="input-error text-danger" style="display: none"></div>
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Select Role</label>
                            <select class="form-control" id="role" name="role" required>
                                <option disabled selected hidden>Select a Role</option>
                                <option value="1">User</option>
                                <option value="2">Store Manager</option>
                                <option value="3">Purchase Manager</option>
                                <option value="4">Head of Administration</option>
                                {{-- value="5" Admin --}}
                            </select>
                            <div class="input-error text-danger" style="display: none"></div>
                        </div>

                        <div class="mb-3 form-password-toggle">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group input-group-merge" id="password">
                                <input type="password" class="form-control" name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" required autocomplete="new-password" />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                            <div class="input-error text-danger" id="password-error" style="display: none"></div>
                        </div>

                        <div class="mb-3 form-password-toggle">
                            <label class="form-label" for="password_confirmation">Confirm
                                Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password_confirmation" class="form-control"
                                    name="password_confirmation"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" required autocomplete="new-password" />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>

                        </div>

                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100">Create New User</button>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-danger d-grid w-100" id="clear-btn">Clear</button>
                        </div>





                </div>
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
                            //change submit button to adding
                            $('#createNewUser').text('Creating..');

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
                                        $('#createNewUser').text('Create New User');
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
                        $('#modal-close').on('click', function() {
                            // Reset the form when the close button is clicked
                            // $('#userCreationForm')[0].reset();
                            $('#password-error').hide();
                            $('.input-error').hide();
                            //change submit button to adding
                            $('#createNewUser').text('Create New User');
                        });

                        $('#clear-btn').on('click', function() {
                            $('#userCreationForm')[0].reset();
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

                    });
                </script>

            </div>
        </div>
    </div>
    </div>
