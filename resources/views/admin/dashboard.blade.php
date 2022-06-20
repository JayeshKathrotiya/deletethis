@extends('admin.layout')

@section('content')
		
    <div class="content container-fluid">
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<h3 class="page-title">Welcome Admin!</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item active">Dashboard</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->

		<div class="row">
			<div class="col-xl-3 col-sm-6 col-12" onclick="window.location.href='/studentlist'">
				<div class="card">
					<div class="card-body">
						<div class="dash-widget-header">
							<span class="dash-widget-icon bg-primary">
								<i class="fe fe-users"></i>
							</span>
						</div>
						<div class="dash-widget-info">
							<h3>{{$students ? $students : "0"}}</h3>
							<h6 class="text-muted">Students</h6>
							<div class="progress progress-sm">
								<div class="progress-bar bg-primary w-100"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-sm-6 col-12" onclick="window.location.href='/classes'">
				<div class="card">
					<div class="card-body">
						<div class="dash-widget-header">
							<span class="dash-widget-icon bg-success">
								<i class="fe fe-money"></i>
							</span>
						</div>
						<div class="dash-widget-info">
							<h3>{{$classes ? $classes : "0"}}</h3>
							<h6 class="text-muted">Classes</h6>
							<div class="progress progress-sm">
								<div class="progress-bar bg-success w-100"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-sm-6 col-12" onclick="window.location.href='/courselist'">
				<div class="card">
					<div class="card-body">
						<div class="dash-widget-header">
							<span class="dash-widget-icon bg-danger">
								<i class="fe fe-credit-card"></i>
							</span>
						</div>
						<div class="dash-widget-info">
							<h3>{{$courses ? $courses : "0"}}</h3>
							<h6 class="text-muted">Courses</h6>
							<div class="progress progress-sm">
								<div class="progress-bar bg-danger w-100"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-sm-6 col-12" onclick="window.location.href='/admin/add'">
				<div class="card">
					<div class="card-body">
						<div class="dash-widget-header">
							<span class="dash-widget-icon bg-warning">
								<i class="fe fe-folder"></i>
							</span>
						</div>
						<div class="dash-widget-info">
							<h3>{{$slider ? $slider : "0"}}</h3>
							<h6 class="text-muted">Slider Request</h6>
							<div class="progress progress-sm">
								<div class="progress-bar bg-warning w-100"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	

@endsection