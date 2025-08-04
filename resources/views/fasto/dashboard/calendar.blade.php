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
	<div class="row">
		<div class="col-xl-3 col-xxl-4">
			<div class="card">
				<div class="card-header border-0">
					<div>
						<h4 class="font-w600 text-black fs-20 mb-1">Projects Details</h4>
						<span class="font-w500 fs-18 mb-3">September, 1st Week</span>
					</div>
				</div>
				<div class="card-body">
					<div class="mb-3 pb-3 border-bottom">
						<div class="d-flex">
							<div class="cal-ic bgl-primary text-primary rounded">
								<i class="fa fa-star" aria-hidden="true"></i>
							</div>
							<div>
								<p class="font-w600 mb-0 ms-sm-4 ms-3"><a href="{{ url('post-details')}}" class="text-black">Visual Graphic for Presentation to Client</a></p>
							</div>
						</div>
						<div class="row justify-content-between align-items-center  mt-sm-4 mt-3">
							<ul class="users col-6 d-flex justify-content-start">
								<li><img src="{{ asset('images/profile/Untitled-4.jpg')}}" alt=""></li>
								<li><img src="{{ asset('images/profile/Untitled-5.jpg')}}" alt=""></li>
								<li><img src="{{ asset('images/profile/Untitled-7.jpg')}}" alt=""></li>
							</ul>
							<div class="col-6 fs-14 text-end">
								<span>Aug 4, 2021</span>
							</div>
						</div>
					</div>
					<div class="mb-3 pb-3 border-bottom">
						<div class="d-flex">
							<div class="cal-ic bgl-warning text-warning rounded">
								<i class="fa fa-star" aria-hidden="true"></i>
							</div>
							<div>
								<p class="font-w600 mb-0 ms-sm-4 ms-3"><a href="{{ url('post-details')}}" class="text-black">Usability testing for Fasto Web App v2</a></p>
							</div>
						</div>
						<div class="row justify-content-between align-items-center mt-sm-4 mt-3">
							<ul class="users col-6 d-flex justify-content-start">
								<li><img src="{{ asset('images/profile/Untitled-4.jpg')}}" alt=""></li>
								<li><img src="{{ asset('images/profile/Untitled-5.jpg')}}" alt=""></li>
								<li><img src="{{ asset('images/profile/Untitled-7.jpg')}}" alt=""></li>
							</ul>
							<div class="col-6 fs-14 text-end">
								<span>Aug 4, 2021</span>
							</div>
						</div>
					</div>
					<div class="mb-3 pb-3 border-bottom">
						<div class="d-flex">
							<div class="cal-ic bgl-secondary text-secondary rounded">
								<i class="fa fa-star" aria-hidden="true"></i>
							</div>
							<div>
								<p class="font-w600 mb-0 ms-sm-4 ms-3"><a href="{{ url('post-details')}}" class="text-black">Create A/B testing fro Fasto Mobile App</a></p>
							</div>
						</div>
						<div class="row justify-content-between align-items-center mt-sm-4 mt-3">
							<ul class="users col-6 d-flex justify-content-start">
								<li><img src="{{ asset('images/profile/Untitled-4.jpg')}}" alt=""></li>
								<li><img src="{{ asset('images/profile/Untitled-5.jpg')}}" alt=""></li>
							</ul>
							<div class="col-6 fs-14 text-end">
								<span>Aug 4, 2021</span>
							</div>
						</div>
					</div>
					<div class="mb-3 pb-3  border-bottom">
						<div class="d-flex">
							<div class="cal-ic bgl-warning text-warning rounded">
								<i class="fa fa-star" aria-hidden="true"></i>
							</div>
							<div>
								<p class="font-w600 mb-0 ms-sm-4 ms-3"><a href="{{ url('post-details')}}" class="text-black">Rebuild Code web using Laravel</a></p>
							</div>
						</div>
						<div class="row justify-content-between align-items-center mt-sm-4 mt-3">
							<ul class="users col-6 d-flex justify-content-start">
								<li><img src="{{ asset('images/profile/Untitled-4.jpg')}}" alt=""></li>
								<li><img src="{{ asset('images/profile/Untitled-5.jpg')}}" alt=""></li>
								<li><img src="{{ asset('images/profile/Untitled-7.jpg')}}" alt=""></li>
							</ul>
							<div class="col-6 fs-14 text-end">
								<span>Aug 4, 2021</span>
							</div>
						</div>
					</div>
					<div class=" ">
						<div class="d-flex">
							<div class="cal-ic bgl-primary text-primary rounded">
								<i class="fa fa-star" aria-hidden="true"></i>
							</div>
							<div>
								<p class="font-w600 mb-0 ms-sm-4 ms-3"><a href="{{ url('post-details')}}" class="text-black">Fixing Bugs</a></p>
							</div>
						</div>
						<div class="row justify-content-between align-items-center mt-sm-4 mt-3">
							<ul class="users col-6 d-flex justify-content-start">
								<li><img src="{{ asset('images/profile/Untitled-4.jpg')}}" alt=""></li>
								<li><img src="{{ asset('images/profile/Untitled-5.jpg')}}" alt=""></li>
								<li><img src="{{ asset('images/profile/Untitled-5.jpg')}}" alt=""></li>
								<li><img src="{{ asset('images/profile/Untitled-7.jpg')}}" alt=""></li>
							</ul>
							<div class="col-6 fs-14 text-end">
								<span>Aug 4, 2021</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-9 col-xxl-8">
			<div class="card dashboard-calendar">
				<div class="card-body">
					<div id="calendar" class="app-fullcalendar dashboard-calendar"></div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection