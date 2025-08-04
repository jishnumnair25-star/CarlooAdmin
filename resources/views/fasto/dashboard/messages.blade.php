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
		<div class="col-xl-5">
			<div class="row">
				<div class="col-xl-12">
					<div class="card">
						<div class="card-body d-flex align-items-center">
							<div class="d-flex me-auto mb-sm-0 mb-2 align-items-center">
								<img src="{{ asset('images/profile/Untitled-1.jpg')}}" alt="" width="55" class="rounded-circle me-2">
								<div>
									<h5 class="fs-18 text-black font-w600">Peter Parkur</h5>
									<div class="dropdown">
										<a href="javascript:void(0);" class="text-primary" data-bs-toggle="dropdown" aria-expanded="false">
											<svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
												<circle cx="4" cy="4" r="4" fill="#43DC80"/>
											</svg>
											Available
											<i class="las la-angle-down text-dark ms-2"></i>
										</a>
										<div class="dropdown-menu dropdown-menu-end">
											<a class="dropdown-item" href="javascript:void(0);">Available</a>
											<a class="dropdown-item" href="javascript:void(0);">Unavailable</a>
										</div>
									</div>
								</div>
							</div>
							<a href="{{ url('contacts')}}" class="btn btn-primary btn-rounded text-white shadow-primary"><i class="las la-comment-dots me-2 scale5"></i>+ New</a>
						</div>
					</div>
				</div>
				<div class="col-xl-12">
					<div class="card">
						<div class="card-header align-items-center">
							<div class="card-action card-tabs">
								<ul class="nav nav-tabs style-1" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" data-bs-toggle="tab" href="#AllMessage" role="tab" aria-selected="false">
											All Message
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-bs-toggle="tab" href="#Unread" role="tab" aria-selected="false">
											Unread
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link " data-bs-toggle="tab" href="#Archived" role="tab" aria-selected="true">
											Archived
										</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="card-body message-bx px-0 pt-3" >
							<div class="input-group message-search-area">
								<input type="text" class="form-control" placeholder="Search from people and grup">
								<div class="input-group-append">
									<button class="input-group-text"><i class="flaticon-381-search-2"></i></button>
								</div>
							</div>
							<div class="tab-content dz-scroll height520" id="message-bx">
								<div class="tab-pane fade show active" id="AllMessage" role="tabpanel">
									<div class="media chat-list-area active">
										<div class="image-bx">
											<img src="{{ asset('images/profile/Untitled-2.jpg')}}" alt="" class="rounded-circle me-sm-4 me-2 img-1">
										</div>
										<div class="media-body">
											<div class="d-flex mb-sm-2 mb-0">
												<h6 class="text-black mb-0 font-w600 fs-16">Olivia Rellaq</h6>
												<span class="ms-auto fs-14">25m ago</span>
											</div>
											<p class="text-black">Nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
										</div>
									</div>
									<div class="media chat-list-area">
										<div class="image-bx me-sm-4 me-2">
											<img src="{{ asset('images/profile/Untitled-3.jpg')}}" alt="" class="rounded-circle img-1">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<div class="d-flex mb-sm-2 mb-0">
												<h6 class="text-black font-w600 fs-16 mb-0">Roberto Charloz</h6>
												<span class="ms-auto fs-14">2m ago</span>
											</div>
											<p class="text-black">Hey, check my design update last night. Tell me what you think and if that is OK. I hear client said they want to change the layout concept</p>
										</div>
									</div>
									<div class="media chat-list-area">
										<div class="image-bx me-sm-4 me-2">
											<img src="{{ asset('images/profile/Untitled-1.jpg')}}" alt="" class="rounded-circle img-1">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<div class="d-flex mb-sm-2 mb-0">
												<h6 class="text-black font-w600 fs-16 mb-0">Laura Chyan</h6>
												<span class="ms-auto fs-14">5m ago</span>
											</div>
											<p class="text-black">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut</p>
										</div>
									</div>
									<div class="media chat-list-area">
										<div class="image-bx me-sm-4 me-2">
											<img src="{{ asset('images/profile/Untitled-2.jpg')}}" alt="" class="rounded-circle img-1">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<div class="d-flex mb-sm-2 mb-0">
												<h6 class="text-black font-w600 fs-16 mb-0">Keanu Tipes</h6>
												<span class="ms-auto fs-14">41m ago</span>
											</div>
											<p class="text-black">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut</p>
										</div>
									</div>
									<div class="media chat-list-area">
										<div class="image-bx">
											<img src="{{ asset('images/profile/Untitled-3.jpg')}}" alt="" class="rounded-circle img-1 me-sm-4 me-2">
										</div>
										<div class="media-body">
											<div class="d-flex mb-sm-2 mb-0">
												<h6 class="text-black font-w600 fs-16 mb-0">Olivia Rellaq</h6>
												<span class="ms-auto fs-14">25m ago</span>
											</div>
											<p class="text-black">Nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
										</div>
									</div>
									<div class="media chat-list-area">
										<div class="image-bx">
											<img src="{{ asset('images/profile/Untitled-2.jpg')}}" alt="" class="rounded-circle img-1 me-sm-4 me-2">
										</div>
										<div class="media-body">
											<div class="d-flex mb-sm-2 mb-0">
												<h6 class="text-black font-w600 fs-16 mb-0">Olivia Rellaq</h6>
												<span class="ms-auto fs-14">25m ago</span>
											</div>
											<p class="text-black">Nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="Unread" role="tabpanel">
									<div class="media chat-list-area">
										<div class="image-bx me-sm-4 me-2">
											<img src="{{ asset('images/profile/Untitled-1.jpg')}}" alt="" class="rounded-circle img-1">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<div class="d-flex mb-sm-2 mb-0">
												<h6 class="text-black font-w600 fs-16 mb-0">Roberto Charloz</h6>
												<span class="ms-auto fs-14">2m ago</span>
											</div>
											<p class="text-black">Hey, check my design update last night. Tell me what you think and if that is OK. I hear client said they want to change the layout concept</p>
										</div>
									</div>
									<div class="media chat-list-area">
										<div class="image-bx me-sm-4 me-2">
											<img src="{{ asset('images/profile/Untitled-2.jpg')}}" alt="" class="rounded-circle img-1">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<div class="d-flex mb-sm-2 mb-0">
												<h6 class="text-black font-w600 fs-16 mb-0">Keanu Tipes</h6>
												<span class="ms-auto fs-14">41m ago</span>
											</div>
											<p class="text-black">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut</p>
										</div>
									</div>
									<div class="media chat-list-area">
										<div class="image-bx me-sm-4 me-2">
											<img src="{{ asset('images/profile/Untitled-2.jpg')}}" alt="" class="rounded-circle img-1">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<div class="d-flex mb-sm-2 mb-0">
												<h6 class="text-black font-w600 fs-16 mb-0">Olivia Rellaq</h6>
												<span class="ms-auto fs-14">25m ago</span>
											</div>
											<p class="text-black">Nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
										</div>
									</div>
									<div class="media chat-list-area">
										<div class="image-bx me-sm-4 me-2">
											<img src="{{ asset('images/profile/Untitled-3.jpg')}}" alt="" class="rounded-circle img-1">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<div class="d-flex mb-sm-2 mb-0">
												<h6 class="text-black font-w600 fs-16 mb-0">Olivia Rellaq</h6>
												<span class="ms-auto fs-14">25m ago</span>
											</div>
											<p class="text-black">Nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="Archived" role="tabpanel">
									<div class="media chat-list-area">
										<div class="image-bx me-sm-4 me-2">
											<img src="{{ asset('images/profile/Untitled-1.jpg')}}" alt="" class="rounded-circle img-1">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<div class="d-flex mb-sm-2 mb-0">
												<h6 class="text-black font-w600 fs-16 mb-0">Laura Chyan</h6>
												<span class="ms-auto fs-14">5m ago</span>
											</div>
											<p class="text-black">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut</p>
										</div>
									</div>
									<div class="media chat-list-area">
										<div class="image-bx me-sm-4 me-2">
											<img src="{{ asset('images/profile/Untitled-2.jpg')}}" alt="" class="rounded-circle img-1">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<div class="d-flex mb-sm-2 mb-0">
												<h6 class="text-black font-w600 fs-16 mb-0">Keanu Tipes</h6>
												<span class="ms-auto fs-14">41m ago</span>
											</div>
											<p class="text-black">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut</p>
										</div>
									</div>
									<div class="media chat-list-area">
										<div class="image-bx me-sm-4 me-2">
											<img src="{{ asset('images/profile/Untitled-3.jpg')}}" alt="" class="rounded-circle img-1">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<div class="d-flex mb-2">
												<h6 class="text-black font-w600 fs-16 mb-0">Olivia Rellaq</h6>
												<span class="ms-auto fs-14">25m ago</span>
											</div>
											<p class="text-black">Nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
										</div>
									</div>
									<div class="media chat-list-area">
										<div class="image-bx me-sm-4 me-2">
											<img src="{{ asset('images/profile/Untitled-1.jpg')}}" alt="" class="rounded-circle img-1">
											<span class="active"></span>
										</div>
										<div class="media-body">
											<div class="d-flex mb-sm-2 mb-0">
												<h6 class="text-black font-w600 fs-16 mb-0">Olivia Rellaq</h6>
												<span class="ms-auto fs-14">25m ago</span>
											</div>
											<p class="text-black">Nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-7">
			<div class="row">
				<div class="col-xl-12">
					<div class="card  message-bx chat-box">
						<div class="card-header">
							<div><h5 class="text-black font-w500 mb-sm-1 mb-0 title-nm">Roberto Charloz</h5></div>
							<div class="d-flex align-items-center">	
								<span>Last seen 4:23 AM</span>
								<div class="dropdown ms-2">
									<a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											<path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											<path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
										</svg>
									</a>
									<div class="dropdown-menu dropdown-menu-end">
										<a class="dropdown-item" href="javascript:void(0);">Edit</a>
										<a class="dropdown-item" href="javascript:void(0);">Delete</a>
									</div>
								</div>
							</div>	
						</div>
						<div class="card-body chat-box-area dz-scroll" id="chartBox">
							<div class="media mb-4  justify-content-start align-items-start">
								<div class="image-bx me-sm-4 me-2">
									<img src="{{ asset('images/profile/Untitled-3.jpg')}}" alt="" class="rounded-circle img-1">
									<span class="active"></span>
								</div>
								<div class="message-received">
									<p class="mb-1">
										Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptat
									</p>
									<span class="fs-12">4.30 AM</span>
								</div>
							</div>
							<div class="media mb-4 justify-content-end align-items-end">
								<div class="message-sent">
									<p class="mb-1">
										sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet
									</p>
									<span class="fs-12">9.30 AM</span>
								</div>
								<div class="image-bx ms-sm-4 ms-2 mb-4">
									<img src="{{ asset('images/profile/Untitled-2.jpg')}}" alt="" class="rounded-circle img-1">
									<span class="active"></span>
								</div>
							</div>
							<div class="media mb-4  justify-content-end align-items-end">
								<div class="message-sent">
									<p class="mb-1">
										nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea
									</p>
									<span class="fs-12">9.30 AM</span>
								</div>
								<div class="image-bx ms-sm-4 ms-2 mb-4">
									<img src="{{ asset('images/profile/Untitled-2.jpg')}}" alt="" class="rounded-circle img-1">
									<span class="active"></span>
								</div>
							</div>
							<div class="media justify-content-start align-items-start">
								<div class="image-bx me-sm-4 me-2">
									<img src="{{ asset('images/profile/Untitled-1.jpg')}}" alt="" class="rounded-circle img-1">
									<span class="active"></span>
								</div>
								<div class="message-received">
									<p class="mb-1">
										Hey, check my design update last night. Tell me what you think and if that is OK. I hear client said they want to change the layout concept
									</p>
									<span class="fs-12">4.30 AM</span>
								</div>
							</div>
						</div>
						<div class="card-footer border-0 type-massage">
							<div class="input-group">
								<textarea class="form-control" placeholder="Type message..."></textarea>
								<div class="input-group-append">
									<button type="button" class="btn pe-0"><i class="las la-paperclip scale5 text-secondary"></i></button>
									<button type="button" class="btn"><i class="las la-image scale5 text-secondary"></i></button>
									<button type="button" class="btn btn-primary rounded text-white">SEND</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection