<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" data-sidebarbg="skin5">
  <!-- Sidebar scroll-->
  <div class="scroll-sidebar">
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav">
      <ul id="sidebarnav" class="p-t-30">
        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/"
            aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a>
        </li>
        <li class="sidebar-item {{ Request::is('/alternatives*') ? 'selected' : '' }}"> <a
            class="sidebar-link waves-effect waves-dark sidebar-link {{ Request::is('/alternatives*') ? 'active' : '' }}"
            href="/alternatives" aria-expanded="false"><i class="mdi mdi-target"></i><span
              class="hide-menu">Alternatives</span></a>
        </li>
        <li class="sidebar-item {{ Request::is('/criterias*') ? 'selected' : '' }}"> <a
            class="sidebar-link waves-effect waves-dark sidebar-link {{ Request::is('/criterias*') ? 'active' : '' }}"
            href="/criterias" aria-expanded="false"><i class="mdi mdi-format-list-bulleted"></i><span
              class="hide-menu">Criterias</span></a>
        </li>
        <li class="sidebar-item {{ Request::is('/matrices*') ? 'selected' : '' }}"> <a
            class="sidebar-link waves-effect waves-dark sidebar-link {{ Request::is('/matrices*') ? 'active' : '' }}"
            href="/matrices" aria-expanded="false"><i class="mdi mdi-counter"></i><span
              class="hide-menu">Matrix</span></a>
        </li>
        <!-- <li class="sidebar-item {{ Request::is('/convertions*') ? 'selected' : '' }}"> <a
            class="sidebar-link waves-effect waves-dark sidebar-link {{ Request::is('/convertions*') ? 'active' : '' }}"
            href="/convertions" aria-expanded="false"><i class="mdi mdi-shuffle-variant"></i><span
              class="hide-menu">Convertion</span></a>
        </li> -->
      </ul>
    </nav>
    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->