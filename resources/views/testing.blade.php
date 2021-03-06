@extends('admin.layout')

@section('content')

<div class="page-wrapper">			
    <div class="content container-fluid">
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<!-- <h3 class="page-title">Welcome Admin!</h3> -->
					<ul class="breadcrumb">
						<li class="breadcrumb-item">Dashboard</li>
						<li class="breadcrumb-item active">Country</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->

		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Basic Inputs<button type="button" class="btn btn-secondary pull-right">Secondary</button></h4>
					</div>
					<div class="card-body">
						<form action="#">
							<div class="form-group row">
								<label class="col-form-label col-md-2">Text Input</label>
								<div class="col-md-10">
									<input type="text" class="form-control">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-md-2">Password</label>
								<div class="col-md-10">
									<input type="password" class="form-control">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-md-2">Disabled Input</label>
								<div class="col-md-10">
									<input type="text" class="form-control" disabled="disabled">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-md-2">Readonly Input</label>
								<div class="col-md-10">
									<input type="text" class="form-control" value="readonly" readonly="readonly">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-md-2">Placeholder</label>
								<div class="col-md-10">
									<input type="text" class="form-control" placeholder="Placeholder">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-md-2">File Input</label>
								<div class="col-md-10">
									<input class="form-control" type="file">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-md-2">Default Select</label>
								<div class="col-md-10">
									<select class="form-control">
										<option>-- Select --</option>
										<option>Option 1</option>
										<option>Option 2</option>
										<option>Option 3</option>
										<option>Option 4</option>
										<option>Option 5</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-md-2">Radio</label>
								<div class="col-md-10">
									<div class="radio">
										<label>
											<input type="radio" name="radio"> Option 1
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="radio"> Option 2
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="radio"> Option 3
										</label>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-md-2">Checkbox</label>
								<div class="col-md-10">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="checkbox"> Option 1
										</label>
									</div>
									<div class="checkbox">
										<label>
											<input type="checkbox" name="checkbox"> Option 2
										</label>
									</div>
									<div class="checkbox">
										<label>
											<input type="checkbox" name="checkbox"> Option 3
										</label>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-md-2">Textarea</label>
								<div class="col-md-10">
									<textarea rows="5" cols="5" class="form-control" placeholder="Enter text here"></textarea>
								</div>
							</div>
							<div class="form-group mb-0 row">
								<label class="col-form-label col-md-2">Input Addons</label>
								<div class="col-md-10">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">$</span>
										</div>
										<input class="form-control" type="text">
										<div class="input-group-append">
											<button class="btn btn-primary" type="button">Button</button>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="card-footer">
						<button type="button" class="btn btn-primary">Primary</button>
					</div>
				</div>
			</div>
		</div>
	</div>			
</div>

@endsection