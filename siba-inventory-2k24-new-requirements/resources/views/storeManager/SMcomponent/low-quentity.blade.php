<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <div class="card">
                <h5 class="card-header">Low Quentity Items</h5>
                <div class="card-body">
                    <div class="row">
                        <!-- Left side -->
                        <div class="col-md-10">
                            <!-- Your first input field -->
                        </div>
                        <!-- Right side -->
                        <div class="col-md-2">
                            <!-- Your third input field -->
                            <div class="mb-3">
                                @include('storeManager.SMcomponent.set-lover-limit-modal')
                            </div>
                        </div>
                    </div>
<br><br><br>

                    <table id="example" class="hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>Category ID</th>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Quentity</th>
                                <th>Request</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-href="your-link-for-row-1.html">
                                <td>S/EL</td>
                                <td>S/EL/Dell</td>
                                <td>Dell Inspiron i5000</td>
                                <td>2</td>
                                <td>@include('storeManager.SMcomponent.request-low-level-item-modal')</td>
                            </tr>
                            <tr data-href="your-link-for-row-2.html">
                                <td>S/ST</td>
                                <td>S/ST/A4</td>
                                <td>Atlas A4</td>
                                <td>100</td>
                                <td>@include('storeManager.SMcomponent.request-low-level-item-modal')</td>
                            </tr>
                        </tbody>
                    </table>

                    <script>
                        $(document).ready(function () {
                            // Initialize DataTable
                            var table = $('#example').DataTable();
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>
</div>
