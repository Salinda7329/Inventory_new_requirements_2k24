{{-- methana departmnt user dapu request tka timestamp akath akk penn piliwelata view wenn hdann. thaw usert oninm edit krann cancel krann plwn wenn hadann
     --}}
{{--
     thaw request aka store manager accept kralanm status aka update krann hadnn athkot edit , cancel buttons penn hdnn epa athkot view status
     kiyala button akk thiyanw aka obapuwam modl akk anw ake storemanager dala thiyana comment akai accept karpu date aki time akai penn hdnn --}}

<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <br><br>
        <div class="authentication-inner">

            <div class="card">
                <div class="card-header">
                    My Items
                </div>
                <div class="card-body">
                    <div id="show_my_items_data"></div>
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    // get the current user id
                    var authenticatedUserId = {{ auth()->id() }};

                    fetchMyRequestData();

                    // fetchMyRequestData();

                    function fetchMyRequestData() {

                        $.ajax({
                            url: '{{ route('fetchMyItems') }}',
                            method: 'post',
                            data: {
                                user_id: authenticatedUserId, // Include the user ID in the data
                                _token: '{{ csrf_token() }}' // Include the CSRF token
                            },
                            success: function(response) {
                                // console.log(response);
                                $('#show_my_items_data').html(response);
                                // //Make table a data table
                                $('#all_myItem_data').DataTable({
                                    // Enable horizontal scrolling
                                    // "scrollX": true,
                                });

                            }
                        });
                    }

                    // Add event listeners for process buttons
                    $(document).on("click", ".processRequestButton", function(e) {
                        e.preventDefault();

                        const id = this.id;
                        const parts = id.split('.');
                        const itemUser = parts[1]; // Get the part after the dot

                        // Store a reference to the button
                        var clickedButton = $(this);

                        // Send AJAX request to the backend using jQuery
                        $.ajax({
                            url: '/storeManager/RequestAction',
                            type: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            data: JSON.stringify({
                                itemUser: itemUser
                            }),
                            dataType: 'json',
                            success: function(data) {
                                fetchAllRequestData();
                                // Use the stored reference to update the clicked button's class
                                // if (data.message === 0) {
                                //     clickedButton.removeClass('btn-outline-danger').addClass(
                                //         'btn-outline-secondary');
                                // } else {
                                //     clickedButton.removeClass('btn-outline-secondary').addClass(
                                //         'btn-outline-danger');
                                // }
                            },
                            error: function(error) {
                                console.error('Error performing request action:', error);
                            }
                        });
                    });
                });
            </script>

        </div>
    </div>
