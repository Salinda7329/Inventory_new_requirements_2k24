
{{-- meka store managerge store view aka. mekedi store manager mkk hri raw akk uda click krama aka issue item modal aka open wenn hadann oni  --}}


<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <div class="card">
                <h5 class="card-header">Store</h5>
                <br><br>
                <div class="card-body">
                    <div class="row">
                        <!-- Left side -->
                        <div class="col-md-6"></div>
                        <!-- Right side -->
                        <div class="col-md-6">
                        </div>
                    </div>

                    <table id="example" class="hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>Category ID</th>
                                <th>Category Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-href="your-link-for-row-1.html">
                                <td>S/EL</td>
                                <td>Electric    </td>
                            </tr>
                            <tr data-href="your-link-for-row-2.html">
                                <td>S/ST</td>
                                <td>Stationary</td>
                            </tr>
                        </tbody>
                    </table>

                    <script>
                        $(document).ready(function () {
                            // Initialize DataTable
                            var table = $('#example').DataTable();

                            // Make rows clickable
                            $('#example tbody').on('click', 'tr', function () {
                                var url = $(this).data('href');
                                if (url) {
                                    window.location.href = url;
                                }
                            });
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>
</div>

