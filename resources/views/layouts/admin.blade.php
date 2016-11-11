<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Quản trị</title>

    <!-- Bootstrap core CSS -->

    <link href="{!! url('public/admin') !!}/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{url('')}}/public/admin/css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="{{url('')}}/public/admin/css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    <script src="{{url('')}}/public/admin/js/jquery.min.js"></script>

    <link href="{!! url('public/admin') !!}/dist/css/select2.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="{!! url('public/admin') !!}/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{!! url('public/admin') !!}/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    {{-- embed Ckeditor And Ckfinder --}}
    <script src="{!! url('public/admin') !!}/js/ckeditor/ckeditor.js"></script>
    <script src="{!! url('public/admin') !!}/js/ckfinder/ckfinder.js"></script>
    <script src="{!! url('public/admin') !!}/js/func_ckfinder.js"></script>
    <script type="text/javascript">
        var baseURL = "{!! url('/') !!}";
    </script>
    

</head>


<body class="nav-md">

    <div class="container body">


        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0; background: #000088">
                        <a href="index.html" class="site_title"><i class="fa fa-gears"></i> <span>SOAPP Web</span></a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
                            <img src="{{url('')}}/public/admin/images/img.jpg" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2>Quản trị web</h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <h3>Admin 1</h3>
                            <ul class="nav side-menu">
                                <li>
                            <a href="#"><i class="fa fa-dashboard"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-calendar-check-o"></i> Danh Mục Sản Phẩm<span class="fa arrow"></span></a>
                            <ul class="nav child_menu">
                                <li>
                                    <a href="{!! URL::route('admin.cate.list') !!}">Danh sách category</a>
                                </li>
                                <li>
                                    <a href="{!! URL::route('admin.cate.getAdd') !!}">Thêm Category</a>
                                </li>
                            </ul>
                            <!-- /.child_menu -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-edit"></i>Bài Viết<span class="fa arrow"></span></a>
                            <ul class="nav child_menu">
                                <li>
                                    <a href="{!! URL::route('admin.post.list') !!}">Danh Sách</a>
                                </li>
                                <li>
                                    <a href="{!! URL::route('admin.post.getAdd') !!}">Thêm Mới</a>
                                </li>
                                <li>
                                    <a href="{!! URL::route('admin.catepost.list') !!}">Danh Mục</a>
                                </li>
                                <li>
                                    <a href="{!! URL::route('admin.catepost.getAdd') !!}">Thêm Danh Mục</a>
                                </li>
                            </ul>
                            <!-- /.child_menu -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-cart-plus"></i>Sản Phẩm<span class="fa arrow"></span></a>
                            <ul class="nav child_menu">
                                <li>
                                    <a href="{!! URL::route('admin.product.list') !!}">Danh Sách</a>
                                </li>
                                <li>
                                    <a href="{!! URL::route('admin.product.getAdd') !!}">Thêm Mới</a>
                                </li>
                                <li>
                                    <a href="{!! URL::route('admin.tags.list') !!}">Thẻ</a>
                                </li>
                                <li>
                                    <a href="{!! URL::route('admin.manufacturer.list') !!}">Nhà Sản Xuất</a>
                                </li>
                            </ul>
                            <!-- /.child_menu -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-drivers-license"></i>Thông tin<span class="fa arrow"></span></a>
                            <ul class="nav child_menu">
                                <li>
                                    <a href="{!! URL::route('admin.about.getList') !!}">SEO</a>
                                </li>
                                <li>
                                    <a href="{!! URL::route('admin.about.getListShop') !!}">Shop Location</a>
                                </li>
                            </ul>
                            <!-- /.child_menu -->
                        </li>
                            </ul>
                        </div>
                        

                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a href="login.html" data-toggle="tooltip" data-placement="top" title="Logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="{{url('')}}/public/admin/images/img.jpg" alt="">Admin 1
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="{{url('')}}/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
                            </li>

                            <li role="presentation" class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="badge bg-green">0</span>
                                </a>
                                <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="{{url('')}}/public/admin/images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="{{url('')}}/public/admin/images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="{{url('')}}/public/admin/images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="{{url('')}}/public/admin/images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="text-center">
                                            <a>
                                                <strong><a href="inbox.html">See All Alerts</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </nav>
                </div>

            </div>
            <!-- /top navigation -->


            <!-- page content -->
            <div class="right_col" role="main" style="padding: 85px 20px; min-height: 1800px;">
                @yield('body_right')
            </div>
            <!-- /page content -->
        </div>


    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

        
     <script src="{{url('')}}/public/admin/js/custom.js"></script>
     <!-- jQuery -->

    <!-- Bootstrap Core JavaScript -->
    <script src="{!! url('public/admin') !!}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    {{-- My script --}}
    <script src="{!! url('public/admin') !!}/js/myscript.js"></script>

    <!-- DataTables JavaScript -->
    <script src="{!! url('public/admin') !!}/bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>
    <script src="{!! url('public/admin') !!}/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="{!! url('public/admin') !!}/js/select2.min.js"></script>
<script type="text/javascript">
    $("#product_select").select2({
        tags:true
    });
    $("#manufacturer_select").select2({
        tags:true
    });

</script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
(function($) {
  $(document).ready(function() {
  $("#start").datepicker({'dateFormat': 'dd/mm/yy'});
  $("#end").datepicker({'dateFormat': 'dd/mm/yy'});
  });
})(jQuery);
</script>
    @yield('import_js')
</body>

</html>