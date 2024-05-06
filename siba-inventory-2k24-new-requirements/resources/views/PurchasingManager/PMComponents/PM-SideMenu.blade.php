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
        <li class="menu-item">
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

        <li class="menu-item">
            <a href="/pm/addNewItemNew" class="menu-link">
                <div data-i18n="Without menu">Manage Items</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="/pm/addNewCategory" class="menu-link">
                <div data-i18n="Without menu">Manage Categories</div>
            </a>
        </li>

        @if (Auth::user()->role == 3)
            <li class="menu-item">
                <a href="/pm/addNewPONew" class="menu-link ">
                    <div data-i18n="Without menu">Manage Purchasing Orders</div>
                </a>
            </li>
        @endif

        @if (Auth::user()->role == 2)
            <li class="menu-item">
                <a href="/pm/viewNewPO" class="menu-link">
                    <div data-i18n="Without menu">Manage Purchasing Orders</div>
                </a>
            </li>
        @endif

        <li class="menu-item">
            <a href="/pm/viewNewGrn" class="menu-link">
                <div data-i18n="Without menu">Import GRN's</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Reports</span></li>
        <!-- Forms -->
        <li class="menu-item">
            <a href="/pm/view-low-items" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">Low Limit Items</div>
            </a>
            <a href="/pm/view-issued-items-details-report" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">Issued Items Details</div>
            </a>
            <a href="/pm/view-stock-input-history-report" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">Stock Input History</div>
            </a>
        </li>

    </ul>
</aside>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var currentPageUrl = window.location.pathname;
        var menuItems = document.querySelectorAll('.menu-item');

        menuItems.forEach(function(item) {
            var link = item.querySelector('a');
            var href = link.getAttribute('href');
            if (currentPageUrl === href) {
                item.classList.add('active-link');
            }
        });
    });
</script>

<style>
    .active-link {
        background-color: red;
        /* Change this to the desired text color */
    }
</style>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        var currentPageUrl = window.location.pathname;
        var menuItems = document.querySelectorAll('.menu-item');

        menuItems.forEach(function(item) {
            var link = item.querySelector('a');
            var href = link.getAttribute('href');
            if (currentPageUrl === href) {
                item.classList.add('active-link');
            }
        });
    });
</script>

{{-- <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <span class="app-brand-logo demo">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Welcome !</span>
            <a href="" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
        </span>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item" id="home">
            <a href="/home" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Layouts -->

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Inventory</span>
        </li>

        <li class="menu-item" id="issueItems">
            <a href="/pm/issueItems" class="menu-link">
                <div data-i18n="Without menu">Issue Items</div>
            </a>
        </li>

        <li class="menu-item" id="addNewStock">
            <a href="/pm/addNewStock" class="menu-link">
                <div data-i18n="Without menu">Input Stock</div>
            </a>
        </li>

        <li class="menu-item" id="addNewItemNew">
            <a href="/pm/addNewItemNew" class="menu-link">
                <div data-i18n="Without menu">Manage Items</div>
            </a>
        </li>

        <li class="menu-item" id="addNewCategory">
            <a href="/pm/addNewCategory" class="menu-link">
                <div data-i18n="Without menu">Manage Categories</div>
            </a>
        </li>

        @if (Auth::user()->role == 3)
            <li class="menu-item" id="addNewPONew">
                <a href="/pm/addNewPONew" class="menu-link ">
                    <div data-i18n="Without menu">Manage Purchasing Orders</div>
                </a>
            </li>
        @endif

        @if (Auth::user()->role == 2)
            <li class="menu-item" id="viewNewPO">
                <a href="/pm/viewNewPO" class="menu-link">
                    <div data-i18n="Without menu">Manage Purchasing Orders</div>
                </a>
            </li>
        @endif

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Reports</span></li>
        <!-- Forms -->
        <li class="menu-item" id="view-low-items">
            <a href="/pm/view-low-items" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">Low Limit Items</div>
            </a>
        </li>
        <li class="menu-item" id="view-issued-items-details-report">
            <a href="/pm/view-issued-items-details-report" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">Issued Items Details</div>
            </a>
        </li>
        <li class="menu-item" id="view-stock-input-history-report">
            <a href="/pm/view-stock-input-history-report" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">Stock Input History</div>
            </a>
        </li>
    </ul>
</aside>

<style>
    .active-link {
        color: red; /* Change this to the desired text color */
    }
</style> --}}
