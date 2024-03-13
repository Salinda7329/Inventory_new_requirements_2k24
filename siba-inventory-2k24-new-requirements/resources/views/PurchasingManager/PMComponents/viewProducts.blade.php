{{-- meke store ake me dala thiyana row walata adala data pennann oni. thaw edit modal akata anuwa modal aka click karama auto fill wela eit krann plwn wenn hadann --}}


<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <br><br>
        <div class="authentication-inner">

            <div class="card">
                <h5 class="card-header">View products</h5>
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
                        <th>Input Date</th>
                        <th>Time</th>
                        <th>Item Code</th>
                        <th>Quentity</th>
                        <th>Brand</th>
                        <th>catagory</th>
                        <th></th>
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
                        <td>@include('PurchasingManager.PMComponents.Modal-EditProduct')
                        </td>
                        <td>@include('PurchasingManager.PMComponents.Modal-deletStore')</td>

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
