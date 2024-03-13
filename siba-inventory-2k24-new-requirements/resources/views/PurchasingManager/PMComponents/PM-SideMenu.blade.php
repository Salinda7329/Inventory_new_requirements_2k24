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


        <li class="menu-item">

            <a href="/pm/product-limits" class="menu-link">
                <div data-i18n="Without menu">Check Product Limits</div>
            </a>
            {{-- <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Store</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item" id="3">
                    <a href="/pm/viewProducts" class="menu-link">
                        <div data-i18n="Without menu">View Store</div>
                    </a>
                </li>
            </ul>
            <ul class="menu-sub">
                <li class="menu-item" id="4">
                    <a href="/pm/product-limits" class="menu-link">
                        <div data-i18n="Without menu">Check Product Limits</div>
                    </a>
                </li>
            </ul> --}}
        </li>


        <li class="menu-item">
            <a href="/pm/items-with-users" class="menu-link">
                <div data-i18n="Without menu">Items With Users</div>
            </a>
        </li>

        {{-- <li class="menu-item" id="5">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-layout"></i>
          <div data-i18n="Layouts">Manage Requests</div>
        </a>

        <ul class="menu-sub">
          <li class="menu-item" id="6">
            <a href="/pm/ViewRequestedItems" class="menu-link">
              <div data-i18n="Without menu">View Inventory Request</div>
            </a>
          </li>
          <li class="menu-item" id="7">
            <a href="layouts-without-navbar.html" class="menu-link">
              <div data-i18n="Without navbar">View My Request</div>
            </a>
          </li>
          <li class="menu-item" id="8">
            <a href="layouts-container.html" class="menu-link">
              <div data-i18n="Container">View Request History</div>
            </a>
          </li>
        </ul>
      </li> --}}


        <li class="menu-item">
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
        </li>

        <li class="menu-item">
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

        </li>

        <li class="menu-item">
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
        </li>

        <li class="menu-item">
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
        </li>


        <li class="menu-header small text-uppercase">
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
            <!-- Components -->
        </li>


        <li class="menu-header small text-uppercase"><span class="menu-header-text">Processing</span></li>
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
            <!-- Components -->
        </li>




        <li class="menu-header small text-uppercase"><span class="menu-header-text">History</span></li>
        <!-- Forms -->
        <li class="menu-item">
            <a href="/pm/view-issued-items-history" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">Issued Items History</div>
            </a>
            <a href="/pm/view-accepted-items-history" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">Accepted Items History</div>
            </a>
            <a href="/pm/view-rejected-history" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">Rejected Requests History</div>
            </a>
            <a href="/pm/view-rejected-return-history" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">Rejected Returns History</div>
            </a>
        </li>

        <!-- Extended components -->


        {{-- <!-- Forms & Tables -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Human Resource</span></li>
        <!-- Forms -->
        <li class="menu-item" id="18">
            <a href="/store/low-quentity" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">Low Quentity</div>
            </a>


            <!-- Forms -->

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Finance</span></li>
        <!-- Forms -->
        <li class="menu-item" id="19">
            <a href="/view-requested-items" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">View Request</div>
            </a>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Examination</span></li>
        <!-- Forms -->
        <li class="menu-item" id="20">
            <a href="/store/History" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">Check History</div>
            </a>
        </li>

        <!-- Misc -->

        </li> --}}
    </ul>
</aside>
