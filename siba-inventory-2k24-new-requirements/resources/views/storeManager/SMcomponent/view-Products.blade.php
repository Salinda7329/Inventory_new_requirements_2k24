<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        {{-- @include('PurchasingManager.PMComponents.Modal-addNewProduct') --}}
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

        </div>
    </div>
</div>
@include('PurchasingManager.PMComponents.Modal-EditProduct')
