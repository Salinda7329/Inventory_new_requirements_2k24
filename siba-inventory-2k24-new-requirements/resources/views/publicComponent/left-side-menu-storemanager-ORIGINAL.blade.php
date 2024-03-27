<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/home" class="app-brand-link">
            <span class="app-brand-logo demo">

                <span class="app-brand-text demo menu-text fw-bolder ms-2">Welcome !</span>
                <br>
                {{-- <span class="app-brand-text demo menu-text fw-bolder ms-2"></span> --}}
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item active">
            <a href="/home" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Layouts -->

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Store</span>
        </li>
        <li class="menu-item">
            <a href="/storeManager/store" class="menu-link">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Visit Store </div>
            </a>
            <a href="/storeManager/view-user-items" class="menu-link">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="User interface">Items with Users</div>
            </a>
            <a href="/storeManager/product-limits" class="menu-link">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="Form Elements">Low Quantity</div>
            </a>
        </li>

        <!-- Forms -->

        <li class="menu-header small text-uppercase"><span class="menu-header-text">User Requests</span></li>
        <!-- Forms -->
        <li class="menu-item">
            <a href="/storeManager/view-requested-items" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">View All Requests</div>
            </a>
            <a href="/storeManager/view-return-items" class="menu-link">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="User interface">View All Returns</div>
            </a>
            <!-- Components -->
        </li>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Processing</span></li>
        <!-- Forms -->
        <li class="menu-item">
            <a href="/storeManager/view-processing-requests" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">View Processing Requests</div>
            </a>
            <a href="/storeManager/view-processing-returns" class="menu-link">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="User interface">View Processing Returns</div>
            </a>
            <!-- Components -->
        </li>


        <li class="menu-header small text-uppercase"><span class="menu-header-text">History</span></li>
        <!-- Forms -->
        <li class="menu-item">
            <a href="/storeManager/view-issued-items-history" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">Issued Items History</div>
            </a>
            <a href="/storeManager/view-accepted-items-history" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">Accepted Items History</div>
            </a>
            <a href="/storeManager/view-rejected-history" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">Rejected Requests History</div>
            </a>
            <a href="/storeManager/view-rejected-returns-history" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">Rejected Returns History</div>
            </a>
        </li>


    </ul>
</aside>
