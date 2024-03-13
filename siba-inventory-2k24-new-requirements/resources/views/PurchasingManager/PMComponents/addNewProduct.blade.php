<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        @include('PurchasingManager.PMComponents.Modal-addNewProduct')
        @include('PurchasingManager.PMComponents.Modal-RequestNewProduct')
        <br><br>
        <div class="authentication-inner">

            <div class="card">
                <div class="card-header">
                    Products
                </div>
                <div class="card-body">
                    <div id="show_all_product_data"></div>
                </div>
            </div>
            <script>
                $(document).ready(function() {

                    fetchAllProductData();

                    function fetchAllProductData() {
                        $.ajax({
                            url: '{{ route('fetchAllProductData') }}',
                            method: 'get',
                            success: function(response) {
                                // console.log(response);
                                $('#show_all_product_data').html(response);
                                // //Make table a data table
                                $('#all_product_data').DataTable({

                                    // Enable horizontal scrolling
                                });
                            }


                        });
                    }
                });
            </script>
        </div>
    </div>
</div>
@include('PurchasingManager.PMComponents.Modal-EditProduct')
