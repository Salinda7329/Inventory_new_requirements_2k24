<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        @include('PurchasingManager.PMComponents.Modal-addNewCategory')
        <br><br>
        <div class="authentication-inner">

            <div class="card">
                <div class="card-header">
                    Categories
                </div>
                <div class="card-body">
                    <div id="show_all_category_data"></div>
                </div>
            </div>

        </div>
    </div>
</div>
@include('PurchasingManager.PMComponents.Modal-EditCategory')
