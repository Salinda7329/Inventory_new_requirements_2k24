<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
            <span class="app-brand-logo demo">

                <span class="app-brand-text demo menu-text fw-bolder ms-2">Welcome !</span>

        <a href="" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item" id="1">
            <a href="/home" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Layouts -->

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Inventory</span>
        </li>

        <li class="menu-item" id="6">
            <a href="/pm/issueItems" class="menu-link">
                <div data-i18n="Without menu">Issue Items</div>
            </a>
        </li>

        <li class="menu-item" id="5">
            <a href="/pm/addNewStock" class="menu-link">
                <div data-i18n="Without menu">Input Stock</div>
            </a>
        </li>

        <li class="menu-item" id="4">
            <a href="/pm/addNewItemNew" class="menu-link">
                <div data-i18n="Without menu">Manage Items</div>
            </a>
        </li>

        <li class="menu-item" id="3">
            <a href="/pm/addNewCategory" class="menu-link" >
                <div data-i18n="Without menu">Manage Categories</div>
            </a>
        </li>

        {{-- <li class="menu-item" id="2">
            <a href="/pm/addNewPONew" class="menu-link" >
                <div data-i18n="Without menu">Manage Purchasing Orders</div>
            </a>
        </li> --}}
        <li class="menu-item" id="2">
            <a href="/pm/viewNewPO" class="menu-link" >
                <div data-i18n="Without menu">Manage Purchasing Orders</div>
            </a>
        </li>




        <li class="menu-header small text-uppercase"><span class="menu-header-text">Reports</span></li>
        <!-- Forms -->
        <li class="menu-item">
            <a href="/pm/view-low-items" class="menu-link" id="7">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">Low Limit Items</div>
            </a>
            <a href="/pm/view-issued-items-details-report" class="menu-link" id="8">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">Issued Items Details</div>
            </a>
            <a href="/pm/view-stock-input-history-report" class="menu-link" id="9">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">Stock Input History</div>
            </a>
        </li>

    </ul>
</aside>
