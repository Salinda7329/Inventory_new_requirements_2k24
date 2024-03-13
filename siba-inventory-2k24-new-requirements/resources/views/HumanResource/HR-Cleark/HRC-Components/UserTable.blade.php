{{-- mekedi useresla okkme methana penn vdiyata hdanna --}}


<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <br><br>
        <div class="authentication-inner">

            <div class="card">
                <div class="card-header">
                    @include('HumanResource.HR-Cleark.HRC-Components.Modal-addNewEmployee')
                </div>
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
                        <th>EPF NO</th>
                        <th>Department</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Requested By</th>
                        <th>Type</th>
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
