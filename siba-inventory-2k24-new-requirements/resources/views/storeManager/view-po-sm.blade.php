@extends('PurchasingManager.PM-layout')

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            @include('PurchasingManager.PMComponents.Modal-addNewPo')
            <br><br>
            <div class="authentication-inner">

                <div class="card">
                    <div class="card-header">
                        Purchasing Orders Data Table <i class='bx bxs-info-square'
                            title="This table shows the records of Purchasing Orders."></i>
                    </div>
                    <div class="card-body">
                        <div id="show_all_item_data"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- @include('PurchasingManager.PMComponents.Modal-EditPo') --}}
    <script>
        $(document).ready(function() {

            fetchAllPoData();

            function fetchAllPoData() {
                $.ajax({
                    url: '/fetchAllPoData/sm',
                    method: 'get',
                    success: function(response) {
                        // console.log(response);
                        $('#show_all_item_data').html(response);
                        // //Make table a data table
                        $('#all_po_data').DataTable({
                            // Enable horizontal scrolling
                            // "scrollX": true,
                            order: [
                                [5, 'desc']
                            ]
                        });
                    }


                });
            }
        });
    </script>
@endsection
