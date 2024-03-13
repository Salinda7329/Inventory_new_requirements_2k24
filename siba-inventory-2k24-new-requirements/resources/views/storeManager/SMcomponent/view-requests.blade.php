{{-- mekedi penn oni usersla request krpu items tk awa issue krann issue button aka abuwam ana modal ake a userge epf num aka , nama , departmnt aka ,
item code aka okkm visthara tka auto fill wela thiynn oni. --}}

<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <br><br>
        <div class="authentication-inner">

            <div class="card">
                <div class="card-header">
                    Processing Requests
                </div>
                <div class="card-body">
                    <div id="show_all_requests_data"></div>
                </div>
            </div>

            <script>
                $(document).ready(function() {

                    // get the current user id
                    var authenticatedSMId = {{ auth()->id() }};

                    fetchAllRequestData();

                    // function fetchAllRequestData() {

                    //     $.ajax({
                    //         url: '{{ route('fetchAllRequestData') }}',
                    //         type: 'get',
                    //         headers: {
                    //             'Content-Type': 'application/json',
                    //             'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    //         },
                    //         data: JSON.stringify({
                    //             sm_id: authenticatedSMId,
                    //         }),
                    //         dataType: 'json',
                    //         success: function(response) {
                    //             $('#show_all_requests_data').html(response);
                    //             $('#show_all_requests_data').innerText(response);
                    //             //Make table a data table
                    //             $('#all_request_data').DataTable({
                    //                 // Enable horizontal scrolling
                    //                 // "scrollX": true,
                    //             });

                    //             // $('.processRequestButton').each(function() {
                    //             //     var status = $(this).attr('data-status');
                    //             //     if (status == "1") {
                    //             //         $(this).removeClass('btn btn-primary').addClass(
                    //             //             'btn btn-danger');
                    //             //         $(this).closest('#requestButtonContainer').find(
                    //             //             '.requestActionButton').show();
                    //             //     } else if (status == "0") {
                    //             //         $(this).removeClass('btn btn-danger').addClass(
                    //             //             'btn btn-primary');
                    //             //         $(this).closest('#requestButtonContainer').find(
                    //             //             '.requestActionButton').hide();
                    //             //     } else {
                    //             //         $(this).removeClass('btn btn-danger').addClass(
                    //             //             'btn btn-success');
                    //             //         $(this).addAttribute('disabled');
                    //             //         $(this).closest('#requestButtonContainer').find(
                    //             //             '.requestActionButton').hide();
                    //             //     }
                    //             // });


                    //         }
                    //     });
                    // }

                    // function fetchAllRequestData() {
                    //     $.ajax({
                    //         url: '{{ route('fetchAllRequestData') }}',
                    //         type: 'get',
                    //         headers: {
                    //             'Content-Type': 'application/json',
                    //             'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    //         },
                    //         data: JSON.stringify({
                    //             sm_id: authenticatedSMId,
                    //         }),
                    //         dataType: 'json',
                    //         success: function(response) {
                    //             // Parse the JSON response and extract the HTML table
                    //             const tableHtml = $('<div>').append(response.html).find('#all_request_data')
                    //                 .html();

                    //             // Update the show_all_requests_data div's content with the extracted HTML table
                    //             $('#show_all_requests_data').html(tableHtml);

                    //             // Make the table a data table
                    //             $('#all_request_data').DataTable({
                    //                 // Enable horizontal scrolling
                    //                 // "scrollX": true,
                    //             });

                    //             // Add event listeners for process buttons
                    //             $(document).on("click", ".processRequestButton", function(e) {
                    //                 // ...
                    //             });
                    //         },
                    //         error: function(error) {
                    //             console.error('Error fetching request data:', error);
                    //         }
                    //     });
                    // }

                    function fetchAllRequestData() {
                        $.ajax({
                            url: '{{ route('fetchAllProcessingRequestsData') }}',
                            type: 'post',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            data: JSON.stringify({
                                sm_id: authenticatedSMId,
                            }),
                            success: function(html) {
                                // Update the show_all_requests_data div's content with the HTML table
                                $('#show_all_requests_data').html(html);

                                // Make the table a data table
                                $('#all_request_data').DataTable({
                                    // Enable horizontal scrolling
                                    // "scrollX": true,
                                });

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
                                            itemUser: itemUser,
                                            sm_id: authenticatedSMId,
                                        }),
                                        dataType: 'json',
                                        success: function(data) {
                                            // fetchAllRequestData();
                                            // Use the stored reference to update the clicked button's class
                                            if (data.message === 0) {
                                                clickedButton.removeClass('btn-outline-danger').addClass(
                                                    'btn-outline-secondary');
                                            } else {
                                                clickedButton.removeClass('btn-outline-secondary').addClass(
                                                    'btn-outline-danger');
                                            }
                                        },
                                        error: function(error) {
                                            console.error(
                                                'Error performing request action:',
                                                error);
                                        }
                                    });
                                });
                            },
                            error: function(error) {
                                console.error('Error fetching request data:', error);
                            }
                        });
                    }

                    // Add event listeners for process buttons
                    // $(document).on("click", ".processRequestButton", function(e) {

                    //     e.preventDefault();

                    //     const id = this.id;
                    //     const parts = id.split('.');
                    //     const itemUser = parts[1]; // Get the part after the dot

                    //     // Store a reference to the button
                    //     var clickedButton = $(this);

                    //     // Send AJAX request to the backend using jQuery
                    //     $.ajax({
                    //         url: '/storeManager/RequestAction',
                    //         type: 'POST',
                    //         headers: {
                    //             'Content-Type': 'application/json',
                    //             'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    //         },
                    //         data: JSON.stringify({
                    //             itemUser: itemUser,
                    //             sm_id: authenticatedSMId,
                    //         }),
                    //         dataType: 'json',
                    //         success: function(data) {
                    //             fetchAllRequestData();
                    //             // Use the stored reference to update the clicked button's class
                    //             // if (data.message === 0) {
                    //             //     clickedButton.removeClass('btn-outline-danger').addClass(
                    //             //         'btn-outline-secondary');
                    //             // } else {
                    //             //     clickedButton.removeClass('btn-outline-secondary').addClass(
                    //             //         'btn-outline-danger');
                    //             // }
                    //         },
                    //         error: function(error) {
                    //             console.error('Error performing request action:', error);
                    //         }
                    //     });
                    // });
                });
            </script>

        </div>
    </div>
</div>
@include('storeManager.SMcomponent.action-item-buttonModal-requestedtable')
