@extends('edifygoclass.layout')
@section('contents')

<section class="breadcrumb-banner overlay" style="background-image: url('{{asset('edifygo_assets')}}/image/breadcrumb-banner.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="breadcrumb-title">Blog Details</h2>
            </div>
        </div>
    </div>
</section>

<section class="blogview">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<h3>{{$blog->question ? $blog->question : ""}}</h3>
				<ul class="authdate">
					<li><i class="fa fa-user" aria-hidden="true"></i> {{$blog->title ? $blog->title : ""}}</li>
					<li><i class="fa fa-calendar" aria-hidden="true"></i>{{$blog->date ? date('d M Y',strtotime($blog->date)) : ""}}</li>
				</ul>

				<img src="{{asset('blogs/'.$blog->image.'')}}">
				<p><?php echo $blog->description; ?></p>
			</div>
		</div>
	</div>
</section>

@endsection