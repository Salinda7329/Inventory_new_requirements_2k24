<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/home" class="app-brand-link">

            <span class="app-brand-text demo menu-text fw-bolder ms-2">Welcome !</span>
            <br>
            {{-- <span class="app-brand-text demo menu-text fw-bolder ms-2">{{ Auth::user()->getRoleNameAttribute()}}</span> --}}
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item">
            <a href="/home/department-users" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Layouts -->


        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Store</span>
        </li>
        <li class="menu-item">
            {{-- <a href="" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-dock-top"></i>
          <div data-i18n="Account Settings">View store</div>
        </a> --}}
            <ul>
                <li class="menu-item">
                    <a href="/user/view-store" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-dock-top"></i>
                        <div data-i18n="visitstore">Visit Store</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/user/user-myItems" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-dock-top"></i>
                        <div data-i18n="requestitem">My Items</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/user/RequestItemTableView" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-dock-top"></i>
                        <div data-i18n="requestitem">Request History</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/user/ReturnedItemTableView" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-dock-top"></i>
                        <div data-i18n="requestitem">Return history</div>
                    </a>
                </li>
            </ul>
        </li>
        {{-- <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-cube-alt"></i>
          <div data-i18n="return">Return</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="pages-misc-error.html" class="menu-link">
              <div data-i18n="Error">Return an item</div>
            </a>
          </li>
        </ul>
        <ul class="menu-sub">
            <li class="menu-item">
              <a href="pages-misc-error.html" class="menu-link">
                <div data-i18n="history">History</div>
              </a>
            </li>
          </ul>
      </li>

      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-detail"></i>
          <div data-i18n="purchasing">Purchasing</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="pages-misc-error.html" class="menu-link">
              <div data-i18n="Request">Request</div>
            </a>
          </li>
        </ul>
        <ul class="menu-sub">
            <li class="menu-item">
              <a href="pages-misc-error.html" class="menu-link">
                <div data-i18n="history">History</div>
              </a>
            </li>
          </ul>
      </li>
      <!-- Components -->
      <li class="menu-header small text-uppercase"><span class="menu-header-text">Human resource</span></li>
      <!-- Cards -->
      <li class="menu-item">
        <a href="cards-basic.html" class="menu-link">
          <i class="menu-icon tf-icons bx bx-collection"></i>
          <div data-i18n="Basic">**********</div>
        </a>
      </li>
      <!-- User interface -->


      <!-- Forms & Tables -->
      <li class="menu-header small text-uppercase"><span class="menu-header-text">Finance</span></li>
      <!-- Forms -->
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-detail"></i>
          <div data-i18n="Form Elements">********</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="forms-basic-inputs.html" class="menu-link">
              <div data-i18n="Basic Inputs">*********</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="forms-input-groups.html" class="menu-link">
              <div data-i18n="Input groups">***********</div>
            </a>
          </li>
        </ul>
      </li>
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-detail"></i>
          <div data-i18n="Form Layouts">**********</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="form-layouts-vertical.html" class="menu-link">
              <div data-i18n="Vertical Form">************</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="form-layouts-horizontal.html" class="menu-link">
              <div data-i18n="Horizontal Form">*************</div>
            </a>
          </li>
        </ul>
      </li>
      <!-- Tables -->
      <li class="menu-item">
        <a href="tables-basic.html" class="menu-link">
          <i class="menu-icon tf-icons bx bx-table"></i>
          <div data-i18n="Tables">*************</div>
        </a>
      </li> --}}

    </ul>
</aside>
