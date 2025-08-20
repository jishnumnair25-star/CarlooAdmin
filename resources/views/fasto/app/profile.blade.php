@extends('layouts.default')

@section('content')
<div class="container-fluid">
	<!-- Add Project -->
	
	<div class="row page-titles mx-0">
		<div class="col-sm-6 p-md-0">
			<div class="welcome-text">
				<h4>Hi,</h4>
				<p class="mb-0">Update Your Profile</p>
			</div>
		</div>
		<!-- <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="javascript:void(0)">App</a></li>
				<li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
			</ol>
		</div> -->
	</div>
	<!-- row -->
	<!-- <div class="row">
		<div class="col-lg-12">
			<div class="profile card card-body px-3 pt-3 pb-0">
				<div class="profile-head">
					<div class="photo-content">
						<div class="cover-photo rounded"></div>
					</div> -->

<style>
   

    .card {
      background-color: #fff;
      border-radius: 12px;
      padding: 30px;
      width: 400px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .avatar {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      background-color: #3b82f6;
      color: white;
      font-size: 28px;
      font-weight: bold;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0 auto;
    }

    .card h2 {
      text-align: center;
      margin: 15px 0 5px;
      color: #333;
    }

    .card p.username {
      text-align: center;
      color: green;
      font-size: 14px;
      margin-bottom: 25px;
    }

    .form-group {
      margin-bottom: 18px;
    }

    .form-group label {
      display: block;
      margin-bottom: 6px;
      font-size: 14px;
      color: #555;
    }

    .form-group input {
      width: 100%;
      padding: 10px 12px;
      font-size: 14px;
      border: 1px solid #ccc;
      border-radius: 6px;
      box-sizing: border-box;
    }

    .form-group input:focus {
      border-color: #3b82f6;
      outline: none;
    }

    .submit-btn {
      width: 100%;
      padding: 12px;
      background-color: #1d4ed8;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 15px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .submit-btn:hover {
      background-color: #153aa8;
    }
  </style>
<center>
    <div class="card">
        <div class="avatar">
            {{ strtoupper(substr($user['first_name'] ?? 'U', 0, 1)) }}{{ strtoupper(substr($user['last_name'] ?? 'N', 0, 1)) }}
        </div>
        <h2>{{ $user['first_name'] ?? '' }} {{ $user['last_name'] ?? '' }}</h2>
		

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" value="{{ old('first_name', $user['first_name'] ?? '') }}">
            </div>

            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" value="{{ old('last_name', $user['last_name'] ?? '') }}">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" value="{{ old('email', $user['email'] ?? '') }}">
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="tel" name="phone_number" value="{{ old('phone_number', $user['phone_number'] ?? '') }}">
            </div>

            <button type="submit" class="submit-btn">Save Changes</button>
        </form>
    </div>
</center>




					<!-- <div class="profile-info">
						<div class="profile-photo">
							<img src="{{ asset('images/profile/profile.png')}}" class="img-fluid rounded-circle" alt="">
						</div>
						<div class="profile-details">
							<div class="profile-name px-3 pt-2">
								<h4 class="text-primary mb-0">Mitchell C. Shay</h4>
								<p>UX / UI Designer</p>
							</div>
							<div class="profile-email px-2 pt-2">
								<h4 class="text-muted mb-0">info@example.com</h4>
								<p>Email</p>
							</div>
							<div class="dropdown ms-auto">
								<a href="javascript:void(0);" class="btn btn-primary light sharp" data-bs-toggle="dropdown" aria-expanded="true"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></a>
								<ul class="dropdown-menu dropdown-menu-end">
									<li class="dropdown-item"><i class="fa fa-user-circle text-primary me-2"></i> View profile</li>
									<li class="dropdown-item"><i class="fa fa-users text-primary me-2"></i> Add to btn-close friends</li>
									<li class="dropdown-item"><i class="fa fa-plus text-primary me-2"></i> Add to group</li>
									<li class="dropdown-item"><i class="fa fa-ban text-primary me-2"></i> Block</li>
								</ul>
							</div>
						</div>
					</div> -->
				</div>
			</div>
		</div>
	</div>
	<!-- <div class="row">
		<div class="col-xl-4">
			<div class="row">
				<div class="col-xl-12">
					<div class="card">
						<div class="card-body">
							<div class="profile-statistics"> -->
								<!-- <div class="text-center">
									<div class="row">
										<div class="col">
											<h3 class="m-b-0">150</h3><span>Follower</span>
										</div>
										<div class="col">
											<h3 class="m-b-0">140</h3><span>Place Stay</span>
										</div>
										<div class="col">
											<h3 class="m-b-0">45</h3><span>Reviews</span>
										</div>
									</div>
									<div class="mt-4">
										<a href="javascript:void(0);" class="btn btn-primary mb-1 me-1">Follow</a> 
										<a href="javascript:void(0);" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#sendMessageModal">Send Message</a>
									</div>
								</div> -->
								<!-- Modal -->
								<!-- <div class="modal fade" id="sendMessageModal">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title">Send Message</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
											</div>
											<div class="modal-body">
												<form class="comment-form">
													@csrf
													<div class="row"> 
														<div class="col-lg-6">
															<div class="mb-3">
																<label class="text-black font-w600 form-label">Name <span class="required">*</span></label>
																<input type="text" class="form-control" value="Author" name="Author" placeholder="Author">
															</div>
														</div>
														<div class="col-lg-6">
															<div class="mb-3">
																<label class="text-black font-w600 form-label">Email <span class="required">*</span></label>
																<input type="text" class="form-control" value="Email" placeholder="Email" name="Email">
															</div>
														</div>
														<div class="col-lg-12">
															<div class="mb-3">
																<label class="text-black font-w600 form-label">Comment</label>
																<textarea rows="8" class="form-control" name="comment" placeholder="Comment"></textarea>
															</div>
														</div>
														<div class="col-lg-12">
															<div class="mb-3 mb-0">
																<input type="submit" value="Post Comment" class="submit btn btn-primary" name="submit">
															</div>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div> -->
							</div>
						</div>
					</div>
				</div>
				<!-- <div class="col-xl-12">
					<div class="card">
						<div class="card-body">
							<div class="profile-blog">
								<h5 class="text-primary d-inline">Today Highlights</h5>
								<img src="{{ asset('images/profile/1.jpg')}}" alt="" class="img-fluid mt-4 mb-4 w-100">
								<h4><a href="{{ url('post-details')}}" class="text-black">Darwin Creative Agency Theme</a></h4>
								<p class="mb-0">A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
							</div>
						</div>
					</div>
				</div> -->
				<!-- <div class="col-xl-12">
					<div class="card">
						<div class="card-body">
							<div class="profile-interest">
								<h5 class="text-primary d-inline">Interest</h5>
								<div class="row mt-4 sp4" id="lightgallery">
									<a href="{{ asset('images/profile/2.jpg')}}" data-exthumbimage="{{ asset('images/profile/2.jpg')}}" data-src="{{ asset('images/profile/2.jpg')}}" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
										<img src="{{ asset('images/profile/2.jpg')}}" alt="" class="img-fluid">
									</a>
									<a href="{{ asset('images/profile/3.jpg')}}" data-exthumbimage="{{ asset('images/profile/3.jpg')}}" data-src="{{ asset('images/profile/3.jpg')}}" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
										<img src="{{ asset('images/profile/3.jpg')}}" alt="" class="img-fluid">
									</a>
									<a href="{{ asset('images/profile/4.jpg')}}" data-exthumbimage="{{ asset('images/profile/4.jpg')}}" data-src="{{ asset('images/profile/4.jpg')}}" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
										<img src="{{ asset('images/profile/4.jpg')}}" alt="" class="img-fluid">
									</a>
									<a href="{{ asset('images/profile/3.jpg')}}" data-exthumbimage="{{ asset('images/profile/3.jpg')}}" data-src="{{ asset('images/profile/3.jpg')}}" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
										<img src="{{ asset('images/profile/3.jpg')}}" alt="" class="img-fluid">
									</a>
									<a href="{{ asset('images/profile/4.jpg')}}" data-exthumbimage="{{ asset('images/profile/4.jpg')}}" data-src="{{ asset('images/profile/4.jpg')}}" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
										<img src="{{ asset('images/profile/4.jpg')}}" alt="" class="img-fluid">
									</a>
									<a href="{{ asset('images/profile/2.jpg')}}" data-exthumbimage="{{ asset('images/profile/2.jpg')}}" data-src="{{ asset('images/profile/2.jpg')}}" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
										<img src="{{ asset('images/profile/2.jpg')}}" alt="" class="img-fluid">
									</a>
								</div>
							</div>
						</div>
					</div>
				</div> -->
				<!-- <div class="col-xl-12">
					<div class="card">
						<div class="card-body">
							<div class="profile-news">
								<h5 class="text-primary d-inline">Our Latest News</h5>
								<div class="media pt-3 pb-3">
									<img src="{{ asset('images/profile/5.jpg')}}" alt="image" class="me-3 rounded" width="75">
									<div class="media-body">
										<h5 class="m-b-5"><a href="{{ url('post-details')}}" class="text-black">Collection of textile samples</a></h5>
										<p class="mb-0">I shared this on my fb wall a few months back, and I thought.</p>
									</div>
								</div>
								<div class="media pt-3 pb-3">
									<img src="{{ asset('images/profile/6.jpg')}}" alt="image" class="me-3 rounded" width="75">
									<div class="media-body">
										<h5 class="m-b-5"><a href="{{ url('post-details')}}" class="text-black">Collection of textile samples</a></h5>
										<p class="mb-0">I shared this on my fb wall a few months back, and I thought.</p>
									</div>
								</div>
								<div class="media pt-3 pb-3">
									<img src="{{ asset('images/profile/7.jpg')}}" alt="image" class="me-3 rounded" width="75">
									<div class="media-body">
										<h5 class="m-b-5"><a href="{{ url('post-details')}}" class="text-black">Collection of textile samples</a></h5>
										<p class="mb-0">I shared this on my fb wall a few months back, and I thought.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div> -->
			</div>
		</div>


		
		<!-- <div class="col-xl-8">
			<div class="card">
				<div class="card-body">
					<div class="profile-tab">
						<div class="custom-tab-1">
							<ul class="nav nav-tabs">
								<li class="nav-item"><a href="#my-posts" data-bs-toggle="tab" class="nav-link active show">Posts</a>
								</li>
								<li class="nav-item"><a href="#about-me" data-bs-toggle="tab" class="nav-link">About Me</a>
								</li>
								<li class="nav-item"><a href="#profile-settings" data-bs-toggle="tab" class="nav-link">Setting</a>
								</li>
							</ul> -->
							
						<!-- Modal -->
						<!-- <div class="modal fade" id="replyModal">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Post Reply</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
									</div>
									<div class="modal-body">
										<form>
                        @csrf
											<textarea class="form-control" rows="4">Message</textarea>
										</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">btn-close</button>
										<button type="button" class="btn btn-primary">Reply</button>
									</div>
								</div>
							</div>
						</div> -->
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
@endsection