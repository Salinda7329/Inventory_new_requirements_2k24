{{-- methanadi store ake me deela thiyana tka view karann all items penn vdiyata catagory arawa mewa nathuw --}}


<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <br><br>
        <div class="authentication-inner">

            <div class="card">
                <div class="card-header">
                    <H3>Request an Item</H3>
                </div>
                <div class="card-body">
                    <div id="show_all_item_data"></div>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    fetchAllItemDataUser();
                    function fetchAllItemDataUser() {
                    $.ajax({
                        url: '{{ route('fetchAllItemDataUser') }}',
                        method: 'get',
                        success: function(response) {
                            // console.log(response);
                            $('#show_all_item_data').html(response);
                            // //Make table a data table
                            $('#all_item_data').DataTable({
                                // Enable horizontal scrolling
                            });
                        }


                    });
                }
                })
            </script>
        </div>
        @include('DepartmentUser.DUComponent.Modal-RequestItems')
    </div>
</div>
