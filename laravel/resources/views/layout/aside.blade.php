 <div class="h-100" data-simplebar>

     <!--- Sidemenu -->
     <div id="sidebar-menu">

         <div class="logo-box">
             <a class='logo logo-light' href='index.html'>
                 <span class="logo-sm">
                     <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
                 </span>
                 <span class="logo-lg">
                     <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="24">
                 </span>
             </a>
             <a class='logo logo-dark' href='index.html'>
                 <span class="logo-sm">
                     <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
                 </span>
                 <span class="logo-lg">
                     <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="24">
                 </span>
             </a>
         </div>

         <ul id="side-menu">

             <li class="menu-title">Menu</li>

             <li>
                 <a class='tp-link' href="/admin">
                     <i data-feather="home"></i>
                     <span> Tổng quan </span>
                 </a>
             </li>

             <li class="menu-title">Pages</li>

             {{-- <li>
                 <a href="#sidebarAuth" data-bs-toggle="collapse">
                     <i data-feather="users"></i>
                     <span> Authentication </span>
                     <span class="menu-arrow"></span>
                 </a>
                 <div class="collapse" id="sidebarAuth">
                     <ul class="nav-second-level">
                         <li>
                             <a class='tp-link' href='auth-login.html'>Log In</a>
                         </li>
                     </ul>
                 </div>
             </li> --}}

             <li>
                 <a class='tp-link' href='/admin/catalogues'>
                     <i data-feather="grid"></i>
                     <span> Quản lý danh mục </span>
                 </a>
             </li>
             <li>
                 <a class='tp-link' href='/admin/posts'>
                     <i data-feather="file-text"></i>
                     <span> Quản lý bài viết </span>
                 </a>
             </li>


         </ul>

     </div>
     <!-- End Sidebar -->

     <div class="clearfix"></div>

 </div>
