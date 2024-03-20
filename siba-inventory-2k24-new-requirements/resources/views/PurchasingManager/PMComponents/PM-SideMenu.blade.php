<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">

                <span class="app-brand-text demo menu-text fw-bolder ms-2">Welcome !</span>
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
            <span class="menu-header-text">Inventory</span>
        </li>


        {{-- <li class="menu-item">

            <a href="/pm/product-limits" class="menu-link">
                <div data-i18n="Without menu">Check Product Limits</div>
            </a>
        </li> --}}


        {{-- <li class="menu-item">
            <a href="/pm/items-with-users" class="menu-link">
                <div data-i18n="Without menu">Items With Users</div>
            </a>
        </li> --}}
        <li class="menu-item" >
            <a href="/pm/addNewPONew" class="menu-link" >
                <div data-i18n="Without menu">Manage Purchasing Orders</div>
            </a>
        </li>

        <li class="menu-item" >
            <a href="/pm/addNewCategory" class="menu-link" >
                <div data-i18n="Without menu">Manage Categories</div>
            </a>
        </li>

        <li class="menu-item" >
            <a href="/pm/addNewItemNew" class="menu-link">
                <div data-i18n="Without menu">Manage Items</div>
            </a>
        </li>


        <li class="menu-item" >
            <a href="/pm/addNewStock" class="menu-link">
                <div data-i18n="Without menu">Input Stock</div>
            </a>
        </li>

        <li class="menu-item" >
            <a href="/pm/issueItems" class="menu-link">
                <div data-i18n="Without menu">Issue Items</div>
            </a>
        </li>



        {{-- <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Items</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/pm/addNewItem" class="menu-link">
                        <div data-i18n="Without menu">Manage Items</div>
                    </a>
                </li>
            </ul>
        </li> --}}

        {{-- <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Products</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/pm/addNewProduct" class="menu-link">
                        <div data-i18n="Without menu">Manage Products</div>
                    </a>
                </li>
            </ul>

        </li> --}}

        {{-- <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Brands</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/pm/addNewBrand" class="menu-link">
                        <div data-i18n="Without menu">Manage Brands</div>
                    </a>
                </li>
            </ul>
        </li> --}}

        {{-- <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Categories</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/pm/addNewCategory" class="menu-link">
                        <div data-i18n="Without menu">Manage Categories</div>
                    </a>
                </li>
            </ul>
        </li> --}}


        {{-- <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Requests</span>
        </li>
        <!-- Forms -->
        <li class="menu-item">
            <a href="/pm/view-all-requests" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">View All Requests</div>
            </a>
            <a href="/pm/view-all-returns" class="menu-link">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="User interface">View All Returns</div>
            </a>
        </li> --}}


        {{-- <li class="menu-header small text-uppercase"><span class="menu-header-text">Processing</span></li>
        <!-- Forms -->
        <li class="menu-item">
            <a href="/pm/view-processing-requests" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">View Processing Requests</div>
            </a>
            <a href="/pm/view-processing-returns" class="menu-link">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="User interface">View Processing Returns</div>
            </a>
        </li> --}}




        <li class="menu-header small text-uppercase"><span class="menu-header-text">Reports</span></li>
        <!-- Forms -->
        <li class="menu-item">
            <a href="/pm/view-rejected-history" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">Item Balances</div>
            </a>
            <a href="/pm/view-rejected-history" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">Low Limit Items</div>
            </a>
            <a href="/pm/view-issued-items-history" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">Issued Items History</div>
            </a>
            <a href="/pm/view-rejected-return-history" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">Stock Input History</div>
            </a>
        </li>

    </ul>
</aside>
