@extends('PurchasingManager.PM-layout')

<Title>View All User Requests</Title>

@section('content')
    {{-- mekedi penn oni usersla request krpu items tk awa issue krann issue button aka abuwam ana modal ake a userge epf num aka , nama , departmnt aka ,
item code aka okkm visthara tka auto fill wela thiynn oni. --}}

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <br><br>
            <div class="authentication-inner">

                <div class="card">
                    <div class="card-header">
                        All Returns by Users
                    </div>
                    <div class="card-body">
                        <div id="show_all_requests_data"></div>
                    </div>
                </div>

                <script>
                    $(document).ready(function() {

                        // get the current user id
                        var authenticatedSMId = {{ auth()->id() }};

                        fetchAllReturnData();


                        function fetchAllReturnData() {
                            $.ajax({
                                url: '{{ route('fetchAllReturnData') }}',
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
                                    $('#all_returns_data').DataTable({
                                        // Enable horizontal scrolling
                                        // "scrollX": true,
                                        order: [
                                            [0, 'desc']
                                        ]
                                    });

                                    // Hide the Action column header and data cells
                                    $('#all_returns_data tbody td:nth-child(9), #all_returns_data thead th:nth-child(9)')
                                        .hide();
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
                        //     const requestId = parts[0]; // Get the part after the dot

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
                        //             requestId: requestId,
                        //             sm_id: authenticatedSMId,
                        //         }),
                        //         dataType: 'json',
                        //         success: function(response) {
                        //             fetchAllReturnData();
                        //         },
                        //         error: function(error) {
                        //             console.error(
                        //                 'Error performing request action:',
                        //                 error);
                        //         }
                        //     });
                        // });
                    });
                </script>

            </div>
        </div>
    </div>
@endsection
