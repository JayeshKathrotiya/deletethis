<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>OKTAT - The Admission App</title>
	
	<!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets') }}/img/favicon.png">
	
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/bootstrap.min.css">
	
	<!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/font-awesome.min.css">
	
	<!-- Feathericon CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/feathericon.min.css">
	
	<link rel="stylesheet" href="{{ asset('assets') }}/plugins/morris/morris.css">
	
	<!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/style.css">

    	<!-- Datatables CSS -->
	<link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables/datatables.min.css">

	<!-- Jquery Confirm Box CSS -->
		<link rel="stylesheet" href="{{ asset('assets') }}/library/jquery-confirm/jquery-confirm.min.css">
	<!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('assets') }}/select2/dist/css/select2.min.css">

	  <!-- daterangepicker CSS-->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/library/bootstrap-4-master/build/css/tempusdominus-bootstrap-4.min.css" />

   <!-- Lightbox galary CSS -->
    <link rel="stylesheet" href="{{asset('edifygo_assets')}}/css/lightgallery.min.css">


    <!-- CKEditor -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/library/ckeditor/skins/moono-lisa/editor.css?t=H5SE">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/library/ckeditor/plugins/scayt/skins/moono-lisa/scayt.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/library/ckeditor/plugins/scayt/dialogs/dialog.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/library/ckeditor/plugins/tableselection/styles/tableselection.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/library/ckeditor/plugins/wsc/skins/moono-lisa/wsc.css">

  
	<!--[if lt IE 9]>
		<script src="{{ asset('assets') }}/js/html5shiv.min.js"></script>
		<script src="{{ asset('assets') }}/js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<!-- main loader -->
   <div class="loading">
        <div class="load-circle">
        </div>
    </div>
  	<!-- uploading loader -->
 	<!--<div class="dataloading hidden" id="dataloading">
      <div class="dataload-circle"></div>
  	</div> -->
		<!-- Main Wrapper -->
    <div class="main-wrapper">	
        <div class="header">		
			<!-- Logo -->
            <div class="header-left">
                <a href="/dashboard" class="logo">
					<img src="{{ asset('assets') }}/img/white-logo.png" alt="Logo">
				</a>
				<a href="/dashboard" class="logo logo-small">
					<img src="{{ asset('assets') }}/img/white-favicon.png" alt="Logo" width="30" height="30">
				</a>
            </div>
			<!-- /Logo -->
			
			<a href="javascript:void(0);" id="toggle_btn">
				<i class="fe fe-text-align-left"></i>
			</a>
			
			<!-- Mobile Menu Toggle -->
			<a class="mobile_btn" id="mobile_btn">
				<i class="fa fa-bars"></i>
			</a>
			<!-- /Mobile Menu Toggle -->
			
			<!-- Header Right Menu -->
			<ul class="nav user-menu">
				
				<!-- User Menu -->
				<li class="nav-item dropdown has-arrow">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
						<span class="user-img"></span>
					</a>
					<div class="dropdown-menu">
						<div class="user-header">
							<div class="user-text">
								<h6>{{ session('admin_login_session') }}</h6>
								<p class="text-muted mb-0">Administrator</p>
							</div>
						</div>
						<a class="dropdown-item" href="/logout">Logout</a>
					</div>
				</li>
				<!-- /User Menu -->
				
			</ul>
			<!-- /Header Right Menu -->
			
        </div>
		<!-- /Header -->
		
		<!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
				<div id="sidebar-menu" class="sidebar-menu">
					<ul><!-- 
						<li class="menu-title"> 
							<span>Main</span>
						</li> -->
						<li class="{{ Request::is('dashboard') ? 'active' : '' }}"> 
							<a href="/dashboard"><i class="fe fe-home"></i> <span>Dashboard</span></a>
						</li>
						<li class="submenu">
							<a href="#"><i class="fa fa-bars"></i> <span> Course</span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a class="{{ Request::is('maincourse') ? 'active' : '' }}" href="/maincourse">Main Course</a></li>
								<li><a class="{{ Request::is('subcourse') ? 'active' : '' }}" href="/subcourse">Sub Course</a></li>
								<li><a class="{{ Request::is('childcourse') ? 'active' : '' }}" href="/childcourse">Child Course</a></li>
							</ul>
						</li>
						<li class="submenu">
							<a href="#"><i class="fa fa-location-arrow"></i> <span> Locations</span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a class="{{ Request::is('country') ? 'active' : '' }}" href="/country">Country</a></li>
								<li><a class="{{ Request::is('state') ? 'active' : '' }}" href="/state">State</a></li>
								<li><a class="{{ Request::is('city') ? 'active' : '' }}" href="/city">City</a></li>
								<li><a class="{{ Request::is('area') ? 'active' : '' }}" href="/area">Area</a></li>
							</ul>
						</li>
						<!-- <li> 
							<a href="/fee"><i class="fa fa-inr"></i> <span>Fee Structure</span></a>
						</li> -->
						<li class="submenu">
							<a href="#"><i class="fa fa-inr"></i> <span>Fees</span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a class="{{ Request::is('fee') ? 'active' : '' }}" href="/fee">Fee Structure</a></li>
								<li><a class="{{ Request::is('admission') ? 'active' : '' }}" href="/admission">Admission Amount</a></li>
							</ul>
						</li>

						<li class="{{ Request::is('coupon') ? 'active' : '' }}"> 
							<a href="/coupon"><i class="fa fa-microchip"></i> <span>Coupon</span></a>
						</li>
						<li class="submenu">
							<a href="#"><i class="fa fa-sliders"></i> <span> Sliders</span> <span class="menu-arrow"></span></a>
							<ul style="display: none; ">
								<li><a class="{{ Request::is('exclusive_slider') ? 'active' : '' }}" href="/exclusive_slider">Exclusive Slider</a></li>
								<li><a class="{{ Request::is('feature_slider') ? 'active' : '' }}" href="/feature_slider">Feature Slider</a></li>
								<li><a class="{{ Request::is('promoter_slider') ? 'active' : '' }}" href="/promoter_slider">Promoter Slider</a></li>
								<li><a class="{{ Request::is('newly_slider') ? 'active' : '' }}" href="/newly_slider">Newly Arrived Slider</a></li>
								<li><a class="{{ Request::is('sponsored_slider') ? 'active' : '' }}" href="/sponsored_slider">Sponsored Slider</a></li>
								<li><a class="{{ Request::is('category_slider') ? 'active' : '' }}" href="/category_slider">Category Slider</a></li>
								<li><a class="{{ Request::is('promocode') ? 'active' : '' }}" href="/promocode">Promocode</a></li>
							</ul>
						</li>

						<li class="{{ Request::is('admin/add') ? 'active' : '' }}"> 
							<a href="/admin/add"><i class="fa fa-podcast"></i> <span>Slider Advertise</span></a>
						</li>
						<li class="{{ Request::is('classes') ? 'active' : '' }}">
							<a href="/classes"><i class="fa fa-expand"></i> <span>Classes</span></a>
						</li>

						<li class="{{ (Request::is('courselist') || Request::is('filter_courselist')) ? 'active' : '' }}"> 
							<a href="/courselist"><i class="fa fa-exchange"></i> <span>Course</span></a>
						</li>

						<li class="{{ (Request::is('enrollcourse') || Request::is('filter_enroll')) ? 'active' : '' }}"> 
							<a href="/enrollcourse"><i class="fa fa-etsy"></i> <span>Enroll Course</span></a>
						</li>

						<li class="{{ Request::is('studentlist') ? 'active' : '' }}"> 
							<a href="/studentlist"><i class="fa fa-user-circle-o"></i> <span>Students</span></a>
						</li>

						<li class="{{ Request::is('reviews') ? 'active' : '' }}"> 
							<a href="/reviews"><i class="fa fa-star"></i> <span>Review</span></a>
						</li>

						<li class="{{ Request::is('testimonials') ? 'active' : '' }}"> 
							<a href="/testimonials"><i class="fa fa-ellipsis-h"></i> <span>Testimonial</span></a>
						</li>

						<li class="{{ Request::is('bl') ? 'active' : '' }}"> 
							<a href="/bl"><i class="fa fa-ellipsis-h"></i> <span>Blogs</span></a>
						</li>

						<li class="{{ Request::is('contactus') ? 'active' : '' }}"> 
							<a href="/contactus"><i class="fa fa-compress"></i> <span>Contact Us</span></a>
						</li>

						<li class="submenu">
							<a href="#"><i class="fa fa-cog"></i> <span> General Settings</span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a class="{{ Request::is('setting') ? 'active' : '' }}" href="/setting">Values</a></li>
								<li><a class="{{ Request::is('know-us') ? 'active' : '' }}" href="know-us">How Know Us</a></li>
							</ul>
						</li>

					</ul>
				</div>
            </div>
        </div>
		<!-- /Sidebar -->
		
	<!-- jQuery -->
    <script src="{{ asset('assets') }}/js/jquery-3.2.1.min.js"></script>
	
	<!-- Bootstrap Core JS -->
    <script src="{{ asset('assets') }}/js/popper.min.js"></script>
    <script src="{{ asset('assets') }}/js/bootstrap.min.js"></script>

    <!-- For date picker -->
    <script src="{{ asset('assets') }}/js/moment.min.js"></script>

    <!-- daterangepicker JS-->
  	<script type="text/javascript" src="{{ asset('assets') }}/library/bootstrap-4-master/build/js/tempusdominus-bootstrap-4.min.js"></script>


    <!-- Jquery validation -->
    <script src="{{ asset('assets') }}/library/jquery-validate/dist/jquery.validate.js"></script>
    <script src="{{ asset('assets') }}/library/jquery-validate/dist/additional-methods.min.js"></script>
    <script src="{{ asset('assets') }}/library/jquery-validate/dist/additional-methods.js"></script>

    <!-- Datatables JS -->
	<script src="{{ asset('assets') }}/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="{{ asset('assets') }}/plugins/datatables/datatables.min.js"></script>
	
	<!-- Slimscroll JS -->
    <script src="{{ asset('assets') }}/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	
	<script src="{{ asset('assets') }}/plugins/raphael/raphael.min.js"></script> 
	
	<!-- Custom JS -->
	<script  src="{{ asset('assets') }}/js/script.js"></script>
	<script  src="{{ asset('assets') }}/js/custom.js"></script>

	<!-- Select2 -->
    <script src="{{ asset('assets') }}/select2/dist/js/select2.full.min.js"></script>

	<!-- Jquery Confirm Box JS -->
		<script src="{{ asset('assets') }}/library/jquery-confirm/jquery-confirm.min.js"></script>

	<!-- Lightbox galary JS -->
    <script src="{{asset('edifygo_assets')}}/js/picturefill.min.js"></script>
    <script src="{{asset('edifygo_assets')}}/js/lightgallery.min.js"></script>
    <script src="{{asset('edifygo_assets')}}/js/lg-video.min.js"></script>
    <script src="{{asset('edifygo_assets')}}/js/jquery.mousewheel.min.js"></script>


    <!-- CKEditor -->
  <script src="{{ asset('assets') }}/library/ckeditor/ckeditor.js"></script>
  <script type="text/javascript" src="{{ asset('assets') }}/library/ckeditor/config.js"></script>
  <script type="text/javascript" src="{{ asset('assets') }}/library/ckeditor/lang/en.js?t=H5SE"></script>
  <script type="text/javascript" src="{{ asset('assets') }}/library/ckeditor/styles.js?t=H5SE"></script>
  
	<script type="text/javascript">

	    $(document).ready( function () {
	    	$('#group-video').lightGallery();
	      //Initialize Select2 Elements
	      $('.select2').select2()

	      $('.sorting-data').DataTable({
	        "columnDefs":[{
	          "targets":'no-sort',
	          "orderable":false,
	        }]
	      });

	      /*$('#tbl_pattr').dataTable({
	        "aLengthMenu": [[5], [5]],
	        "iDisplayLength": 5,
	        "columnDefs":[{
	          "targets":'no-sort',
	          "orderable":false,
	        }]
	      });

	      $('.invoice').dataTable({
	        dom: 't',
	        ordering: false,
	        paging: false,

	        keys: true, //enable KeyTable extension
	      });*/

	    });
	  </script>
	  		<div class="page-wrapper">
				@yield('content')

				<div class="col-md-12">
					<div class="error-msg-box">
					  @if(session('success-msg'))
					    <div class="alert alert-success close-alert" role="alert">
					          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					          {{ session('success-msg') }}
					    </div>
					  @endif

					  @if(session('error-msg'))
					  <div class="alert alert-danger close-alert" role="alert">
					        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					          {{ session('error-msg') }}
					    </div>
					  @endif
					</div>
				</div>
			</div>		
        </div>
    </body>
</html>