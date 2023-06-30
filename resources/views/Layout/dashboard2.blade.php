
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Food Portal</title>
    <!-- Favicon icon -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('assets/images/favicon.png')}}">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{ url('assets/plugins/owl.carousel/dist/css/owl.carousel.min.css')}}">
    <link href="{{ url('assets/plugins/fullcalendar/css/fullcalendar.min.css')}}" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="{{ url('assets/plugins/chartist/css/chartist.min.css')}}">
    <link href="{{ url('new-style/css/style.css')}}" rel="stylesheet">
    <link href="{{ url('css/myCustom.css') }}" rel="stylesheet">
    <!--popper js-->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>

    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>

    <!-- Datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css"/>

    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- date range picker js-->

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>


    <!-- data tables js-->

    <script type="text/javascript" src=" https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src=" https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src=" https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src=" https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>

</head>
<body>
<!--*******************
    Preloader start
********************-->
<div id="preloader">
    <div class="loader"></div>
</div>
<!--*******************
    Preloader end
********************-->


<!--**********************************
    Main wrapper start
***********************************-->
<div id="main-wrapper">

    <!--**********************************
        Nav header start
    ***********************************-->
    <div class="nav-header">
        <div class="brand-logo">
            <a href="index.html">
                <b class="logo-abbr">DS</b>
                <span class="brand-title"><b>DS FOOD PORTAL</b></span>
            </a>
        </div>
        <div class="nav-control">
            <div class="hamburger">
                <span class="toggle-icon"><i class="icon-menu"></i></span>
            </div>
        </div>
    </div>
    <!--**********************************
        Nav header end
    ***********************************-->

    <!--**********************************
        Header start
    ***********************************-->
<!---->
    <!--**********************************
        Header end ti-comment-alt
    ***********************************-->

    <!--**********************************
        Sidebar start
    ***********************************-->
    <div class="nk-sidebar">
        <div class="nk-nav-scroll">
            <ul class="metismenu" id="menu">
                @if (Auth::user()->is_admin == 1)
                <li class="nav-label">ADMIN</li>
                <li>
                    <a class="has-arrow" href="{{ route('admin.home') }}" aria-expanded="false">
                        <i class="bx bxs-dashboard"></i><span class="nav-text">Dashboard</span>
                    </a>

                </li>
                @else
                <li class="nav-label">PANEL</li>
                <li><a class="has-arrow" href="{{ route('userhome') }}" aria-expanded="false"><i class="icon-layers"></i><span class="nav-text">DashBoard</span></a>

                </li>
                @endif
                @if (Auth::user()->is_admin == 1)
                <li class="nav-label">MENU</li>
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="bx bx-dish"></i><span class="nav-text">Menu</span></a>
                    <ul aria-expanded="false">
                        <li><a data-toggle="modal" data-target="#event-modal">Add Item</a></li>
                        <li><a href="{{ route('showMenuItems') }}">Edit Item</a></li>
                    </ul>
                </li>
                @endif
                <li class="nav-label">ORDERS</li>
                <li><a href="{{ route('order.index') }}" aria-expanded="false"><i class="icon-diamond"></i><span class="nav-text">Order Now</span></a></li>
                <li class="nav-label">REPORTS</li>
                <li><a href="forms.html" aria-expanded="false"><i class="icon-settings"></i><span class="nav-text">Forms</span></a></li>
                <li class="nav-label">USER INFO</li>

                @if (Auth::user()->is_admin == 1)
                <li><a href="{{ route('admin-actions.index') }}" aria-expanded="false"><i class="icon-briefcase"></i><span class="nav-text">User Profiles</span></a></li>
                @else
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link"
                       href="{{ route('admin-actions.show', Auth::user()->id) }}" aria-expanded="false">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <span class="hide-menu"> My Profile</span>
                    </a>
                </li>
                @endif
                <li class="nav-label">LOG OUT</li>
                <li><a href="{{ route('logout') }}" aria-expanded="false" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon-logout"></i><span class="nav-text">Log Out</span></a></li>

                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                      class="d-none">
                    @csrf

                </form>


            </ul>
        </div>
        <!-- Modal for adding a new item -->

        <div class="modal fade none-border" id="createModal" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Fill the form!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <!-- Start Create form  -->
                        <form class="form-horizontal form-material" method="POST" action="{{ route('createMenuItem') }}">
                            @csrf

                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Item Name</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" class="form-control p-0 border-0" name="name" >
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Item Price</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" class="form-control p-0 border-0" name="price">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="col-sm-12">
                                    <button class="btn btn-success" >Create</button>
                                </div>
                            </div>
                        </form>
                        <!-- End Create form  -->

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>

        <!-- End of New food item Modal -->
    </div>

    <div class="modal fade none-border" id="event-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong>Add New Menu Item</strong></h4>
                </div>
                <div class="modal-body">
                    <!-- Start Create form  -->
                    <form class="form-horizontal form-material" method="POST" action="{{ route('createMenuItem') }}">
                        @csrf

                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Item Name</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="text" class="form-control p-0 border-0" name="name" >
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Item Price</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="text" class="form-control p-0 border-0" name="price">
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <div class="col-sm-12">
                                <button class="btn btn-success" >Create</button>
                            </div>
                        </div>
                    </form>
                    <!-- End Create form  -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal Add Category -->
    <div class="modal fade none-border" id="add-category">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong>Add a category</strong></h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label">Category Name</label>
                                <input class="form-control form-white" placeholder="Enter name"
                                       type="text" name="category-name">
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">Choose Category Color</label>
                                <select class="form-control form-white"
                                        data-placeholder="Choose a color..." name="category-color">
                                    <option value="success">Success</option>
                                    <option value="danger">Danger</option>
                                    <option value="info">Info</option>
                                    <option value="pink">Pink</option>
                                    <option value="primary">Primary</option>
                                    <option value="warning">Warning</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect"
                            data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light save-category"
                            data-dismiss="modal">Save</button>
                </div>
            </div>
        </div>
    </div>

    </div>
    <!--**********************************
        Sidebar end
    ***********************************-->

    <!--**********************************
        Content body start
    ***********************************-->

    <div class="content-body">
        <section>
            <div class="header">
                <div class="header-content clearfix">

                    <div class="header-right">

                        <ul class="clearfix">
                            <li class="icons d-none d-md-flex">
                                <a href="javascript:void(0)" class="window_fullscreen-x">
                                    <i class="icon-frame"></i>
                                </a>
                            </li>
                            <li class="icons">
                                <a href="javascript:void(0)" class="">
                                    <i class="icon-envelope"></i>
                                    <span class="badge badge-danger">3</span>
                                </a>
                                <div class="drop-down animated flipInX">
                                    <div class="dropdown-content-body">
                                        <ul>
                                            <li class="notification-unread">
                                                <a href="javascript:void()">
                                                    <img class="float-left mr-3 avatar-img" src="../../assets/images/avatar/1.jpg" alt="avatar">
                                                    <div class="notification-content">
                                                        <div class="notification-text">Hey, What's up! You have a good news !!!</div>
                                                        <div class="notification-timestamp">08 Hours ago</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="notification-unread">
                                                <a href="javascript:void()">
                                                    <img class="float-left mr-3 avatar-img" src="../../assets/images/avatar/2.jpg" alt="avatar">
                                                    <div class="notification-content">
                                                        <div class="notification-timestamp">08 Hours ago</div>
                                                        <div class="notification-text">Can you do me a favour?</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void()">
                                                    <img class="float-left mr-3 avatar-img" src="../../assets/images/avatar/3.jpg" alt="avatar">
                                                    <div class="notification-content">
                                                        <div class="notification-text">Hey!</div>
                                                        <div class="notification-timestamp">08 Hours ago</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void()">
                                                    <img class="float-left mr-3 avatar-img" src="../../assets/images/avatar/4.jpg" alt="avatar">
                                                    <div class="notification-content">
                                                        <div class="notification-text">And what do you do?</div>
                                                        <div class="notification-timestamp">08 Hours ago</div>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                        <a class="d-flex justify-content-center bg-primary px-4 text-white" href="email-inbox.html">
                                            <span>See all messagese </span>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="icons">
                                <a href="javascript:void(0)" class="">
                                    <i class="icon-bell"></i>
                                    <span class="badge badge-primary">3</span>
                                </a>
                                <div class="drop-down animated flipInX dropdown-notfication">
                                    <div class="dropdown-content-body">
                                        <ul>
                                            <li>
                                                <a href="javascript:void()">
                                                    <span class="mr-3 avatar-icon bg-success-lighten-2"><i class="icon-calender"></i></span>
                                                    <div class="notification-content">
                                                        <h5 class="notification-heading">Event Started</h5>
                                                        <span class="notification-text">One hour ago</span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void()">
                                                    <span class="mr-3 avatar-icon bg-danger-lighten-2"><i class="icon-calender"></i></span>
                                                    <div class="notification-content">
                                                        <h5 class="notification-heading">Event Started</h5>
                                                        <span class="notification-text">One hour ago</span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void()">
                                                    <span class="mr-3 avatar-icon bg-success-lighten-2"><i class="icon-calender"></i></span>
                                                    <div class="notification-content">
                                                        <h5 class="notification-heading">Event Started</h5>
                                                        <span class="notification-text">One hour ago</span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void()">
                                                    <span class="mr-3 avatar-icon bg-danger-lighten-2"><i class="icon-calender"></i></span>
                                                    <div class="notification-content">
                                                        <h5 class="notification-heading">Event Started</h5>
                                                        <span class="notification-text">One hour ago</span>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                        <a class="d-flex justify-content-between bg-primary px-4 text-white" href="javascript:void()">
                                            <span>All Notifications</span>
                                            <span><i class="icon-settings"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="icons">
                                <div class="user-img c-pointer-x">
                                    <span class="activity active"></span>
                                    <img src="../../assets/images/user/1.png" height="40" width="40" alt="avatar">
                                </div>
                                <div class="drop-down dropdown-profile animated flipInX">
                                    <div class="dropdown-content-body">
                                        <ul>
                                            <li><a href="javascript:void()"><i class="icon-user"></i> <span>My Profile</span></a>
                                            </li>
                                            <li><a href="javascript:void()"><i class="icon-calender"></i> <span>My Calender</span></a>
                                            </li>
                                            <li><a href="javascript:void()"><i class="icon-envelope-open"></i> <span>My Inbox</span> <div class="badge gradient-3 badge-pill badge-primary">3</div></a>
                                            </li>
                                            <li><a href="javascript:void()"><i class="icon-paper-plane"></i> <span>My Tasks</span><div class="badge badge-pill bg-dark">3</div></a>
                                            </li>
                                            <li><a href="javascript:void()"><i class="icon-check"></i> <span>Online</span></a>
                                            </li>
                                            <li><a href="javascript:void()"><i class="icon-lock"></i> <span>Lock Screen</span></a>
                                            </li>
                                            <li><a href="javascript:void()"><i class="icon-key"></i> <span>Logout</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>


                </div>
            </div>
            @yield('content')
        </section>
    </div>

    <div class="footer">
        <div class="copyright">
            <footer class="footer text-center"> <?php echo date('Y'); ?> © Digital Solutions
            </footer>
        </div>
    </div>
</div>
<!--**********************************
    Scripts
***********************************-->
<script src="{{ url('assets/plugins/common/common.min.js')}}"></script>
<script src="{{ url('new-style/js/custom.min.js')}}"></script>
<script src="{{ url('new-style/js/settings.js')}}"></script>
<script src="{{ url('new-style/js/quixnav.js')}}"></script>
<script src="{{ url('new-style/js/styleSwitcher.js')}}"></script>

<!-- Datamap -->
<script src="{{ url('assets/plugins/d3v3/index.js')}}"></script>
<script src="{{ url('assets/plugins/topojson/topojson.min.js')}}"></script>
<!--    <script src="{{ url('assets/plugins/datamaps/datamaps.world.min.js')}}"></script>-->
<!-- Calender -->
<script src="{{ url('assets/plugins/jqueryui/js/jquery-ui.min.js')}}"></script>
<script src="{{ url('assets/plugins/moment/moment.min.js')}}"></script>
<script src="{{ url('assets/plugins/fullcalendar/js/fullcalendar.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{ url('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- MorrisJS -->
<script src="{{ url('assets/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{ url('assets/plugins/morris/morris.min.js')}}"></script>
<!-- Owl carousel -->
<script src="{{ url('assets/plugins/owl.carousel/dist/js/owl.carousel.min.js')}}"></script>
<!-- Chartist -->
<script src="{{ url('assets/plugins/chartist/js/chartist.min.js')}}"></script>
<script src="{{ url('assets/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js')}}"></script>


<!-- Init files -->
<script src="{{ url('new-style/js/plugins-init/fullcalendar-init.js')}}"></script>
<script src="{{ url('new-style/js/dashboard/dashboard-1.js')}}"></script>
<script src="{{ url('new-style/js/charts.js')}}"></script>

</body>

</html>
