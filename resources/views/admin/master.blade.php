<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Khóa Học Lập Trình Laravel Framework 5.x Tại Khoa Phạm">
    <meta name="author" content="Vu Quoc Tuan">
    <title>public/admin - Khoa Phạm</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <!-- Bootstrap Core CSS -->
    <link href="{!! url('public/admin') !!}/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{!! url('public/admin') !!}/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <link href="{!! url('public/admin') !!}/dist/css/select2.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{!! url('public/admin') !!}/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{!! url('public/admin') !!}/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Admin Area - Lê Thái Laravel</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Danh Mục Sản Phẩm<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! URL::route('admin.cate.list') !!}">List Category</a>
                                </li>
                                <li>
                                    <a href="{!! URL::route('admin.cate.getAdd') !!}">Add Category</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Bài Viết<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! URL::route('admin.post.list') !!}">Danh Sách</a>
                                </li>
                                <li>
                                    <a href="{!! URL::route('admin.post.getAdd') !!}">Thêm Mới</a>
                                </li>
                                <li>
                                    <a href="{!! URL::route('admin.catepost.list') !!}">Danh Mục</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-cube fa-fw"></i>Sản Phẩm<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
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
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-cube fa-fw"></i>About<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! URL::route('admin.about.getList') !!}">SEO</a>
                                </li>
                                <li>
                                    <a href="{!! URL::route('admin.about.getListShop') !!}">Shop Location</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">@section('name') @show
                            <small>@section('action') @show</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
@if(Session::has('flash_message'))
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="alert alert-{!! Session::get('level') !!}">
        {!! Session::get('flash_message') !!}
    </div>
</div>
@endif
                    <!-- Start Content -->
                    @yield('content')
                    <!-- End Content -->

                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="{!! url('public/admin') !!}/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{!! url('public/admin') !!}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{!! url('public/admin') !!}/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{!! url('public/admin') !!}/dist/js/sb-admin-2.js"></script>
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


</body>

</html>
