@extends('layouts.default')

@section('content')
<div class="container-fluid">
	<!-- Add Project -->
	<div class="modal fade" id="addProjectSidebar">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Create Project</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<form>
                        @csrf
						<div class="form-group">
							<label class="text-black font-w500">Project Name</label>
							<input type="text" class="form-control">
						</div>
						<div class="form-group">
									<label class="text-black font-w500">Dadeline</label>
									<div class="cal-icon"><input type="date" class="form-control"><i class="far fa-calendar-alt"></i></div>
								</div>
						<div class="form-group">
							<label class="text-black font-w500">Client Name</label>
							<input type="text" class="form-control">
						</div>
						<div class="form-group">
							<button type="button" class="btn btn-primary">CREATE</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="row page-titles mx-0">
		<div class="col-sm-6 p-md-0">
			<div class="welcome-text">
				<h4>Hi, welcome back!</h4>
				<span>lightGallery</span>
			</div>
		</div>
		<div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="javascript:void(0)">Advanced</a></li>
				<li class="breadcrumb-item active"><a href="javascript:void(0)">lightGallery</a></li>
			</ol>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Light Gallery</h4>
				</div>
				<div class="card-body pb-1">
					<div id="lightgallery" class="row">
						<a href="{{ asset('images/big/img1.jpg')}}" data-exthumbimage="{{ asset('images/big/img1.jpg')}}" data-src="{{ asset('images/big/img1.jpg')}}" class="col-lg-3 col-md-6 mb-4">
							<img src="{{ asset('images/big/img1.jpg')}}" alt="" style="width:100%;"/>
						</a>
						<a href="{{ asset('images/big/img2.jpg')}}" data-exthumbimage="{{ asset('images/big/img2.jpg')}}" data-src="{{ asset('images/big/img2.jpg')}}" class="col-lg-3 col-md-6 mb-4">
							<img src="{{ asset('images/big/img2.jpg')}}" alt="" style="width:100%;" />
						</a>
						<a href="{{ asset('images/big/img3.jpg')}}" data-exthumbimage="{{ asset('images/big/img3.jpg')}}" data-src="{{ asset('images/big/img3.jpg')}}" class="col-lg-3 col-md-6 mb-4">
							<img src="{{ asset('images/big/img3.jpg')}}" alt="" style="width:100%;" />
						</a>
						<a href="{{ asset('images/big/img4.jpg')}}" data-exthumbimage="{{ asset('images/big/img4.jpg')}}" data-src="{{ asset('images/big/img4.jpg')}}" class="col-lg-3 col-md-6 mb-4">
							<img src="{{ asset('images/big/img4.jpg')}}" alt="" style="width:100%;" />
						</a>
						<a href="{{ asset('images/big/img5.jpg')}}" data-exthumbimage="{{ asset('images/big/img5.jpg')}}" data-src="{{ asset('images/big/img5.jpg')}}" class="col-lg-3 col-md-6 mb-4">
							<img src="{{ asset('images/big/img5.jpg')}}" alt="" style="width:100%;"/>
						</a>
						<a href="{{ asset('images/big/img6.jpg')}}" data-exthumbimage="{{ asset('images/big/img6.jpg')}}" data-src="{{ asset('images/big/img6.jpg')}}" class="col-lg-3 col-md-6 mb-4">
							<img src="{{ asset('images/big/img6.jpg')}}" alt="" style="width:100%;" />
						</a>
						<a href="{{ asset('images/big/img7.jpg')}}" data-exthumbimage="{{ asset('images/big/img7.jpg')}}" data-src="{{ asset('images/big/img7.jpg')}}" class="col-lg-3 col-md-6 mb-4">
							<img src="{{ asset('images/big/img7.jpg')}}" alt="" style="width:100%;" />
						</a>
						<a href="{{ asset('images/big/img8.jpg')}}" data-exthumbimage="{{ asset('images/big/img8.jpg')}}" data-src="{{ asset('images/big/img8.jpg')}}" class="col-lg-3 col-md-6 mb-4">
							<img src="{{ asset('images/big/img8.jpg')}}" alt="" style="width:100%;" />
						</a>
					</div>
				</div>
			</div>
			<!-- /# card -->
		</div>
	</div>
</div>
@endsection