@extends('PurchasingManager.PM-layout')

@section('content')
    {{-- mekedi penn oni usersla request krpu items tk awa issue krann issue button aka abuwam ana modal ake a userge epf num aka , nama , departmnt aka ,
item code aka okkm visthara tka auto fill wela thiynn oni. --}}

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <br><br>
            <div class="authentication-inner">

                <div class="card">
                    <div class="card-header">
                        Rejected Returns History
                    </div>
                    <div class="card-body">
                        <div id="show_rejected_returns_data"></div>
                    </div>
                </div>

                <script>
                    $(document).ready(function() {

                        // get the current user id
                        var authenticatedSMId = {{ auth()->id() }};

                        fetchAllRejectReturnsHistoryPM();


                        function fetchAllRejectReturnsHistoryPM() {
                            $.ajax({
                                url: '{{ route('fetchAllRejectReturnsHistoryPM') }}',
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
                                    $('#show_rejected_returns_data').html(html);

                                    // Make the table a data table
                                    $('#show_rejected_returns').DataTable({
                                        // Enable horizontal scrolling
                                        "scrollX": true,
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
                                                    clickedButton.removeClass(
                                                        'btn-outline-danger').addClass(
                                                        'btn-outline-secondary');
                                                } else {
                                                    clickedButton.removeClass(
                                                        'btn-outline-secondary').addClass(
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

                    });
                </script>

            </div>
        </div>
    </div>
@endsection
