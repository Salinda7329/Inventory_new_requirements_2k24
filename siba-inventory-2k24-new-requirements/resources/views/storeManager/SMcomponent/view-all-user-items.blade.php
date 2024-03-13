{{-- mekedi penn oni usersla request krpu items tk awa issue krann issue button aka abuwam ana modal ake a userge epf num aka , nama , departmnt aka ,
item code aka okkm visthara tka auto fill wela thiynn oni. --}}

<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <br><br>
        <div class="authentication-inner">

            <div class="card">
                <div class="card-header">
                    Items With Users
                </div>
                <div class="card-body">
                    <div id="show_all_requests_data"></div>
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    fetchItemsAtUsers();

                    function fetchItemsAtUsers() {
                        $.ajax({
                            url: '{{ route('fetchItemsAtUsers') }}',
                            type: 'get',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            success: function(html) {
                                // Update the show_all_requests_data div's content with the HTML table
                                $('#show_all_requests_data').html(html);

                                // Make the table a data table
                                $('#all_myItem_data').DataTable({
                                    // Enable horizontal scrolling
                                    // "scrollX": true,
                                    order: [[0, 'desc']]
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
