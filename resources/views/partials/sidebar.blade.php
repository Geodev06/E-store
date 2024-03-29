<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 bg-slate-900 fixed-start " id="sidenav-main">
  <div class="sidenav-header">

    @php
    $site_name = DB::table('system_settings')->where('setting_name', 'SYSTEM_NAME')->first();
    @endphp
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand d-flex align-items-center m-0" href="#" target="_blank">
      <span class="font-weight-bold text-lg">{{ $site_name->value ?? '' }}</span>
    </a>
  </div>
  <div class="collapse navbar-collapse px-4  w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link   {{ request()->is('admin-dashboard') ? 'active' : '' }} " href="{{ route('admin.dashboard') }}">
          <div class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
            <span class="mdi mdi-view-dashboard text-white"></span>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ request()->is('admin-settings') ? 'active' : '' }} " href="{{ route('admin.settings')}}">
          <div class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
            <span class="mdi mdi-cog-box text-white"></span>

          </div>
          <span class="nav-link-text ms-1">System Settings</span>
        </a>
      </li>

      <!-- Product -->
      <li class="nav-item mt-2">
        <div class="d-flex align-items-center nav-link">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="ms-2" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" />
          </svg>
          <span class="font-weight-normal text-md ms-2">Products</span>
        </div>
      </li>
      <li class="nav-item border-start my-0 pt-2">
        <a class="nav-link position-relative ms-0 ps-2 py-2 {{ request()->is('product-item') ? 'active' : '' }} " href="{{ route('product') }}">
          <span class="nav-link-text ms-1">Items</span>
        </a>
      </li>
      <li class="nav-item border-start my-0 pt-2">
        <a class="nav-link position-relative ms-0 ps-2 py-2 {{ request()->is('product-category') ? 'active' : '' }} " href="{{ route('category') }}">
          <span class="nav-link-text ms-1">Category</span>
        </a>
      </li>
      <!-- End product -->
      <li class="nav-item mt-2">
        <div class="d-flex align-items-center nav-link">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="ms-2" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" />
          </svg>
          <span class="font-weight-normal text-md ms-2">Account Settings</span>
        </div>
      </li>
      <li class="nav-item border-start my-0 pt-2">
        <a class="nav-link position-relative ms-0 ps-2 py-2 " href="#">
          <span class="nav-link-text ms-1">Account Information</span>
        </a>
      </li>
      <li class="nav-item border-start my-0 pt-2">
        <a class="nav-link position-relative ms-0 ps-2 py-2 " href="#sign-out" id="btn-sign-out">
          <span class="nav-link-text ms-1">Sign Out</span>
        </a>
      </li>
    </ul>
  </div>

</aside>