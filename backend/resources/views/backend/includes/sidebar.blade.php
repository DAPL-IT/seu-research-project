<ul class="navbar-nav sidebar sidebar-light accordion d-flex pb-3" id="accordionSidebar">
    <a class="sidebar-brand d-flex justify-content-start" href="@if(Auth::user()->isAdmin()) {{route('admin.dashboard')}} @else {{route('moderator.dashboard')}} @endif">
      {{-- <div class="sidebar-brand-icon">
        <img src="img/logo/logo2.png">
      </div> --}}
      <div class="sidebar-brand-text mx-3">{{ucwords(Auth::user()->role)}}</div>
    </a>

    <li class="nav-item">
        <a class="nav-link" href="@if(Auth::user()->isAdmin()) {{route('admin.dashboard')}} @else {{route('moderator.dashboard')}} @endif">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Operations
    </div>

   @if (Auth::user()->isAdmin())
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMods" aria-expanded="false" aria-controls="collapseMods">
            <i class="fas fa-user-cog"></i>
        <span>Moderators</span>
        </a>
        <div id="collapseMods" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar" >
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('admin.manage.moderators.all')}}">View All</a>
            <a class="collapse-item" href="{{route('admin.manage.moderators.add')}}">Add New</a>
        </div>
        </div>
    </li>

   @endif

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdPosters" aria-expanded="false" aria-controls="collapseAdPosters">
            <i class="fas fa-user-friends"></i>
        <span>Users</span>
        </a>
        <div id="collapseAdPosters" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar" >
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('users.show', ['role'=>Auth::user()->role])}}">View All</a>
            <a class="collapse-item" href="{{route('users.locked', ['role'=>Auth::user()->role])}}">Locked Users</a>
        </div>
        </div>
    </li>

    @if(Auth::user()->isAdmin())
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDistricts" aria-expanded="false" aria-controls="collapseDistricts">
            <i class="fas fa-map"></i>
          <span>Districts</span>
        </a>
        <div id="collapseDistricts" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar" >
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('admin.manage.districts.all')}}">Manage</a>
          </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseArea" aria-expanded="false" aria-controls="collapseArea">
            <i class="fas fa-map-marker-alt"></i>
          <span>Areas</span>
        </a>
        <div id="collapseArea" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar" >
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('admin.manage.areas.all')}}">Manage</a>
          </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRentTypes" aria-expanded="false" aria-controls="collapseRentTypes">
            <i class="fas fa-list"></i>
          <span>Rent Types</span>
        </a>
        <div id="collapseRentTypes" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar" >
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('admin.manage.rent_types.all')}}">Manage</a>
          </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOperations" aria-expanded="false" aria-controls="collapseOperations">
            <i class="fas fa-tools"></i>
          <span>Operations</span>
        </a>
        <div id="collapseOperations" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar" >
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('admin.manage.rent.classifications.all')}}">Rent Range Labels</a>
          </div>
        </div>
    </li>
    @endif

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRentAds" aria-expanded="false" aria-controls="collapseRentAds">
            <i class="fas fa-ad"></i>
          <span>Rent Ads</span>
        </a>
        <div id="collapseRentAds" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar" >
          <div class="bg-white py-2 collapse-inner rounded">
            @if(Auth::user()->isAdmin())
            <a class="collapse-item" href="{{ route('admin.manage.rent_ads.all', ['status'=>'approved']) }}">Approved</a>
            <a class="collapse-item" href="{{ route('admin.manage.rent_ads.all', ['status'=>'pending']) }}">Pendings</a>
            <a class="collapse-item" href="{{ route('admin.manage.rent_ads.all', ['status'=>'rejected']) }}">Rejected</a>
            @else
            <a class="collapse-item" href="{{ route('moderator.manage.rent_ads.all', ['status'=>'approved']) }}">Approved</a>
            <a class="collapse-item" href="{{ route('moderator.manage.rent_ads.all', ['status'=>'pending']) }}">Pendings</a>
            <a class="collapse-item" href="{{ route('moderator.manage.rent_ads.all', ['status'=>'rejected']) }}">Rejected</a>
            @endif
          </div>
        </div>
    </li>

    <div class="version mt-auto">Version: 1.23</div>
</ul>
