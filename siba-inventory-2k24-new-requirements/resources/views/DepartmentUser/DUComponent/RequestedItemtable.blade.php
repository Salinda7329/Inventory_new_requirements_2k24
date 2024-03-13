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
                    Request History
                </div>
                <div class="card-body">
                    <div id="show_my_request_data"></div>
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    // get the current user id
                    var authenticatedUserId = {{ auth()->id() }};

                        fetchMyRequestData();


                    function fetchMyRequestData() {

                        $.ajax({
                            url: '{{ route('fetchMyRequestData') }}',
                            method: 'post',
                            data: {
                                user_id: authenticatedUserId, // Include the user ID in the data
                                _token: '{{ csrf_token() }}' // Include the CSRF token
                            },
                            success: function(response) {
                                // console.log(response);
                                $('#show_my_request_data').html(response);
                                // //Make table a data table
                                $('#all_request_data').DataTable({
                                    // Enable horizontal scrolling
                                    // "scrollX": true,
                                    order: [[0, 'desc']]
                                });

                            }
                        });
                    }

                });
            </script>

        </div>
    </div>
