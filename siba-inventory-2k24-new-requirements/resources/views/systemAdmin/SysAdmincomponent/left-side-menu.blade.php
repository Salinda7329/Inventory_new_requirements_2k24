<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="/home" class="app-brand-link">
        <span class="app-brand-logo demo">

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
      <li class="menu-item active">
        <a href="/home" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">Dashboard</div>
        </a>
      </li>

      <!-- Layouts -->

      {{-- <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Store</span>
      </li>
      <li class="menu-item">
        <a href="/visit-store" class="menu-link">
          <i class="menu-icon tf-icons bx bx-dock-top"></i>
          <div data-i18n="Account Settings">Visit Store </div>
        </a>
      </li>

      <!-- Components -->
      <li class="menu-header small text-uppercase"><span class="menu-header-text">Return</span></li>
      <!-- Cards -->
      <!-- User interface -->
      <li class="menu-item">
        <a href="javascript:void(0)" class="menu-link">
          <i class="menu-icon tf-icons bx bx-box"></i>
          <div data-i18n="User interface">View Returned Item</div>
        </a>
      </li>




      <!-- Extended components -->


      <!-- Forms & Tables -->
      <li class="menu-header small text-uppercase"><span class="menu-header-text">Store Quentity</span></li>
      <!-- Forms -->
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link">
          <i class="menu-icon tf-icons bx bx-detail"></i>
          <div data-i18n="Form Elements">Low Quentity</div>
        </a>


      <!-- Forms -->

      <li class="menu-header small text-uppercase"><span class="menu-header-text">Requested Item</span></li>
      <!-- Forms -->
      <li class="menu-item">
        <a href="/view-requested-items" class="menu-link">
          <i class="menu-icon tf-icons bx bx-detail"></i>
          <div data-i18n="Form Elements">View Request</div>
        </a>
      </li>

      <!-- Misc -->

      </li> --}}
    </ul>
</aside>
