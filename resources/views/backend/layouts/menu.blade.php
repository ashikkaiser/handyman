  <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

      <div class="app-brand demo">
          <a href="/" class="app-brand-link">
              <div class="">
                  <img src="{{ site()->logo }}" alt="TRADE EXPERT" height="45px" width="100%">

              </div>
          </a>

          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
              <i class="bx menu-toggle-icon d-none d-xl-block fs-4 align-middle"></i>
              <i class="bx bx-x d-block d-xl-none bx-sm align-middle"></i>
          </a>
      </div>

      <div class="menu-divider mt-0"></div>

      <div class="menu-inner-shadow"></div>

      <ul class="menu-inner py-1">
          <!-- Dashboards -->

          <li class="menu-item">
              <a href="{{ route('admin.dashboard') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-home-circle"></i>
                  <div data-i18n="Dashboards">Dashboards</div>
              </a>
          </li>
          <!-- Apps & Pages -->
          <li class="menu-header small text-uppercase"><span class="menu-header-text">
                  Category Management
              </span>
          </li>
          <li class="menu-item {{ request()->is('leaderboard/*') ? 'open' : '' }}">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-user-check"></i>
                  <div data-i18n="Categories">Categories</div>
              </a>
              <ul class="menu-sub">

                  <li class="menu-item {{ request()->is('leaderboard/1') ? 'active' : '' }}">
                      <a href="{{ route('admin.category.index') }}" class="menu-link">
                          <div data-i18n="Category">Categories </div>
                      </a>
                  </li>
                  <li class="menu-item {{ request()->is('leaderboard/1') ? 'active' : '' }}">
                      <a href="{{ route('admin.subcategory.index') }}" class="menu-link">
                          <div data-i18n="Sub Categories">Sub Categories </div>
                      </a>
                  </li>
              </ul>
          </li>





          <li class="menu-header small text-uppercase"><span class="menu-header-text">
                  Company & Users
              </span>
          </li>
          <li class="menu-item">
              <a href="{{ route('admin.users.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-home-circle"></i>
                  <div data-i18n="Pakcages">Users</div>
              </a>
          </li>
          <li class="menu-item">
              <a href="{{ route('admin.company.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-home-circle"></i>
                  <div data-i18n="Pakcages">Company</div>
              </a>
          </li>
          <li class="menu-header small text-uppercase"><span class="menu-header-text">
                  Jobs & Reviews
              </span>
          </li>
          <li class="menu-item">
              <a href="{{ route('admin.jobs.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-home-circle"></i>
                  <div data-i18n="Pakcages">Jobs</div>
              </a>
          </li>
          <li class="menu-item">
              <a href="{{ route('admin.reviews.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-home-circle"></i>
                  <div data-i18n="Pakcages">Reviews</div>
              </a>
          </li>

          <li class="menu-header small text-uppercase"><span class="menu-header-text">
                  Blog & Pages
              </span>
          </li>
          <li class="menu-item">
              <a href="{{ route('admin.testimonial.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-home-circle"></i>
                  <div data-i18n="Pakcages">Testimonials</div>
              </a>
          </li>
          {{-- <li class="menu-item">
              <a href="{{ route('admin.blogs.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-home-circle"></i>
                  <div data-i18n="Pakcages">Blog</div>
              </a>
          </li> --}}
          <li class="menu-item">
              <a href="{{ route('admin.pages.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-home-circle"></i>
                  <div data-i18n="Pakcages">Pages</div>
              </a>
          </li>
          <li class="menu-header small text-uppercase"><span class="menu-header-text">
                  Site & Packages
              </span>
          </li>
          <li class="menu-item">
              <a href="{{ route('admin.package.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-home-circle"></i>
                  <div data-i18n="Pakcages">Package</div>
              </a>
          </li>
          <li class="menu-item">
              <a href="{{ route('admin.settings.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-home-circle"></i>
                  <div data-i18n="Pakcages">Site Settings</div>
              </a>
          </li>
          <li class="menu-header small text-uppercase"><span class="menu-header-text">
                  Accounts
              </span>
          </li>

          <li class="menu-item">
              <a href="{{ route('admin.transactions.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-home-circle"></i>
                  <div data-i18n="Pakcages">Transaction</div>
              </a>
          </li>
          <li class="menu-item">

              <a class="menu-link" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                  <i class="menu-icon tf-icons bx bx-exit"></i> {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>



          </li>
      </ul>
  </aside>
