<ul class="navbar-nav sidebar sidebar-light accordion d-flex pb-3" id="accordionSidebar">
    <a class="sidebar-brand d-flex justify-content-start" href="">
      {{-- <div class="sidebar-brand-icon">
        <img src="img/logo/logo2.png">
      </div> --}}
      <div class="sidebar-brand-text mx-3">{{ucwords(Auth::user()->role)}}</div>
    </a>

    <li class="nav-item">
        <a class="nav-link" href="">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Operations
    </div>

   @if (Auth::user()->role == 'admin')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMods" aria-expanded="false" aria-controls="collapseMods">
            <i class="fas fa-user-cog"></i>
        <span>Moderators</span>
        </a>
        <div id="collapseMods" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar" style="">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="">View All</a>
            <a class="collapse-item" href="">Add New</a>
        </div>
        </div>
    </li>
   @endif

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRentAds" aria-expanded="false" aria-controls="collapseRentAds">
            <i class="fas fa-ad"></i>
          <span>Rent Ads</span>
        </a>
        <div id="collapseRentAds" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar" style="">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="">Approved</a>
            <a class="collapse-item" href="">Pendings</a>
            <a class="collapse-item" href="">Rejected</a>
          </div>
        </div>
    </li>

    <div class="version mt-auto">Version: 1.23</div>
</ul>
