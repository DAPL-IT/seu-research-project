<!DOCTYPE html>
<html lang="en">

<head>
    @include('backend.includes.head')
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    @include('backend.includes.sidebar')
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        @include('backend.includes.navbar')
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <!-- Panel Title -->
          @include('backend.includes.panel_title')
          <!-- Panel Title -->

          <div class="row mb-3">
            @yield('main')
          </div>
          <!--Row-->

        </div>
        <!---Container Fluid-->
      </div>

      <!-- Footer -->
      @include('backend.includes.footer')
      <!-- Footer -->

    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  @include('backend.includes.scripts')
</body>

</html>
