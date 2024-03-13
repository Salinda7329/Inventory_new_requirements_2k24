<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        @include('PurchasingManager.PMComponents.Modal-addNewItem')
        <br><br>
        <div class="authentication-inner">

            <div class="card">
                <div class="card-header">
                    Items
                </div>
                <div class="card-body">
                    <div id="show_all_item_data"></div>
                </div>
            </div>

        </div>
    </div>
</div>
@include('PurchasingManager.PMComponents.Modal-EditItem')
