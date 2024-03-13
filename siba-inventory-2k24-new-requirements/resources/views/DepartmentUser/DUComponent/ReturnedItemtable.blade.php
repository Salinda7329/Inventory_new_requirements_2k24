<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <br><br>
        <div class="authentication-inner">

            <div class="card">
                <div class="card-header">
                    Return History
                </div>
                <div class="card-body">
                    <div id="show_my_return_data"></div>
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    // get the current user id
                    var authenticatedUserId = {{ auth()->id() }};

                    fetchMyReturnData();

                    function fetchMyReturnData() {
                        $.ajax({
                            url: '{{ route('fetchMyReturnData') }}',
                            method: 'post',
                            data: {
                                user_id: authenticatedUserId,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                $('#show_my_return_data').html(response);

                                // Initialize the DataTable plugin
                                $('#all_return_data').DataTable({
                                    order: [
                                        [0, 'desc']
                                    ] // Order by the first column in descending order
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                            }
                        });
                    }
                });
            </script>

        </div>
    </div>
</div>
