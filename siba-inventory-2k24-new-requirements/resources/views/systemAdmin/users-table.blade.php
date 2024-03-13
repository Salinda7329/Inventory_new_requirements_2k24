<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        @include('systemAdmin.SysAdmincomponent.create-new-user')
        @include('systemAdmin.SysAdmincomponent.edit-user')
        <div class="authentication-inner">
            <div class="card">
                <div class="card-header">System Users
                </div>
                <div class="card-body">
                    <div id="show_all_user_data"></div>
                </div>

            </div>
        </div>
    </div>
</div>
