{{-- meka autofill wen vdiyat hadann request aka anuwa --}}


<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <br><br>
        <div class="authentication-inner">

            <div class="card">
                <h5 class="card-header">View Requested items</h5>
                <br><br>
                <div class="card-body">

                    <div class="row">
                        <!-- Left side -->
                        <div class="col-md-6">

                        </div>
                        <!-- Right side -->
                        <div class="col-md-6">
            </div>

            <table id="example" class="hover" style="width:100%">
                <thead>
                    <tr>
                        <th>requested Date</th>
                        <th>Time</th>
                        <th>Item Nane</th>
                        <th>Item Code</th>
                        <th>Requested By</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>************</td>
                        <td>************</td>
                        <td>************</td>
                        <td>************</td>
                        <td>************</td>
                        <td>************</td>
                        <td>@include('PurchasingManager.PMComponents.Modat-CancelRequest')
                            @include('PurchasingManager.PMComponents.Modal-Accept&RequestProduct')
                        </td>

                    </tr>


            </table>
                <script>
                    $(document).ready( function () {
                        $('#example').DataTable();
                    });
                </script>
        </div>
    </div>
</div>
