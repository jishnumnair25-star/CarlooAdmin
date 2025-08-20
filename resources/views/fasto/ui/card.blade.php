@php
$token = session('access_token');
@endphp
<script>
const SUBSCRIPTION_API_TOKEN = @json($token);
</script>
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
		<!-- <div class="col-xl-6">
			<div class="card">
				<div class="card-header border-0 pb-0">
					<h5 class="card-title">Card title</h5>
				</div>
				<div class="card-body">
					<p class="card-text">He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff <br> sections. The bedding was hardly able to cover it and seemed ready to
						slide off any moment.
					</p>
				</div>
				<div class="card-footer border-0 pt-0">
					<p class="card-text d-inline">Card footer</p>
					<a href="javascript:void(0);" class="card-link float-end">Card link</a>
				</div>
			</div>
		</div> -->
		<!-- <div class="col-xl-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Card title</h5>
				</div>
				<div class="card-body">
					<p class="card-text">This is a wider card with supporting text and below as a natural lead-in to the additional content. This content is a little <br> bit longer. Some quick example text to build the bulk</p>
				</div>
				<div class="card-footer d-sm-flex justify-content-between align-items-center">
					<div class="card-footer-link mb-4 mb-sm-0">
						<p class="card-text text-dark d-inline">Last updated 3 mins ago</p>
					</div>

					<a href="javascript:void(0);" class="btn btn-primary">Go somewhere</a>
				</div>
			</div>
		</div> -->
		<!-- <div class="col-xl-6">
			<div class="card text-center">
				<div class="card-header">
					<h5 class="card-title">Card Title</h5>
				</div>
				<div class="card-body">

					<p class="card-text">This is a wider card with supporting text and below as a natural lead-in to the additional content. This content</p>
					<a href="javascript:void(0);" class="btn btn-primary">Go somewhere</a>
				</div>
				<div class="card-footer">
					<p class="card-text text-dark">Last updateed 3 min ago</p>
				</div>
			</div>
		</div> -->
<style>
.pricing-card {
  background: white;
  border-radius: 12px;
  padding: 25px 30px;
  /* width: 250px; */
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
  text-align: left;
  border: 1px solid #e5e7eb;
}

.plan-title {
  font-size: 18px;
  font-weight: bold;
  color: #5f4b8b;
  margin-bottom: 10px;
}

.price {
  font-size: 24px;
  font-weight: bold;
  color: #0a2540;
  margin-bottom: 20px;
}

.price span {
  font-size: 16px;
  font-weight: normal;
  color: #4b5563;
}

.subscribe-btn {
  width: 100%;
  padding: 10px;
  border: 1px solid #0a2540;
  background: transparent;
  border-radius: 6px;
  color: #0a2540;
  font-weight: bold;
  cursor: pointer;
  margin-bottom: 20px;
  transition: background 0.2s ease;
}

.subscribe-btn:hover {
  background: #0a2540;
  color: #ffffff;
}

.features {
  list-style: none;
  padding: 0;
  margin: 0;
}

.features li {
  margin-bottom: 10px;
  padding-left: 24px;
  position: relative;
  color: #0a2540;
  font-size: 14px;
}

.features li::before {
  content: '✔';
  position: absolute;
  left: 0;
  color: #0a2540;
}</style>



@section('content')
<div class="container my-5">
  <div class="row justify-content-center">
	
<div class="row page-titles mx-0">
		<div class="col-sm-6 p-md-0">
			<div class="welcome-text">

				<h4>Algorethics Subscription</h4>
				<span>				
Choose the plan that best fits your needs.</span>
			</div>
		</div>
		<div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
			<ol class="breadcrumb">
				<!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Subscription</a></li> -->
				<li class="breadcrumb-item active"><a href="javascript:void(0)">Subscription</a></li>
			</ol>
		</div>
	</div>
    @foreach ($plans as $plan)
      <div class="col-xl-4 col-lg-4 col-md-6 mb-4">
        <div class="card text-center p-3 shadow-sm">
          <div class="pricing-card">
            <h3 class="plan-title text-capitalize">{{ $plan['tier'] }}</h3>
            <p class="price">${{ $plan['price'] }} <span>/mo</span></p>
			@php
    // Example mapping of tier to Stripe Checkout URL (ideally fetched from API in real app)
    $stripeUrls = [
        'seed' => 'https://checkout.stripe.com/c/pay/cs_test_seed',
        'growth' => 'https://checkout.stripe.com/c/pay/cs_test_growth',
        'pro' => 'https://checkout.stripe.com/c/pay/cs_test_pro',
        'global' => 'https://checkout.stripe.com/c/pay/cs_test_global',
        'infinite' => 'https://checkout.stripe.com/c/pay/cs_test_a1XluCWE9me98SHZQoG2oKlMp60H3BVCZEivPHruA1ZAwxSuCPgBSFWFAl',
    ];
    $tier = strtolower($plan['tier']);
@endphp

<button type="button" class="btn btn-primary subscribe-btn" data-tier="{{ $tier }}">Subscribe</button>
<script>
document.addEventListener('DOMContentLoaded', function() {
	document.querySelectorAll('.subscribe-btn').forEach(function(btn) {
		btn.addEventListener('click', function(e) {
			e.preventDefault();
			const tier = btn.getAttribute('data-tier');
			btn.disabled = true;
			btn.textContent = 'Redirecting...';
							fetch('https://carlo.algorethics.ai/api/subscription/checkout', {
								method: 'POST',
								headers: {
									'Content-Type': 'application/json',
									...(SUBSCRIPTION_API_TOKEN ? { 'Authorization': 'Bearer ' + SUBSCRIPTION_API_TOKEN } : {})
								},
								body: JSON.stringify({
									pricing_tier: tier,
									billing_cycle: 'monthly',
									success_url: window.location.origin + '/subscription/success',
									cancel_url: window.location.origin + '/subscription/cancel',
									discount_code: 'WELCOME10'
								})
							})
							.then(res => res.json())
							.then(data => {
								console.log('Subscription API response:', data);
								if (data.success && data.data && data.data.checkout_url) {
									window.location.href = data.data.checkout_url;
								} else {
									alert('Failed to get checkout URL.');
									btn.disabled = false;
									btn.textContent = 'Subscribe';
								}
							})
							.catch((err) => {
								console.error('Subscription API error:', err);
								alert('Error connecting to subscription service.');
								btn.disabled = false;
								btn.textContent = 'Subscribe';
							});
		});
	});
});
</script>
            <!-- <button class="btn btn-primary">Subscribe</button> -->
            <ul class="features list-unstyled mt-3">
              <li>{{ $plan['projects_supported'] }} projects</li>
              @foreach ($plan['features'] as $feature)
                <li>{{ $feature }}</li>
              @endforeach
              @if (!empty($plan['regions_supported']))
                <li>Regions: {{ ucfirst($plan['regions_supported']) }}</li>
              @endif
              <li>Support: {{ str_replace('_', ' ', $plan['dedicated_support']) }}</li>
            </ul>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>



    <!-- Card 2 -->
    <!-- <div class="col-xl-4 col-lg-4 col-md-6 mb-4">
      <div class="card text-center p-3">
        <div class="pricing-card">
          <h3 class="plan-title">Growth</h3>
          <p class="price">$299<span>/mo</span></p>
          <button class="subscribe-btn">Subscribe</button>
          <ul class="features">
            <li>5 projects</li>
            <li>Priority Email Support</li>
            <li>Multi-region Support</li>
            <li>Compliance Dashboard</li>
			<li>Audit Logs</li>
          </ul>
        </div>
      </div>
    </div> -->

    <!-- Card 3 -->
    <!-- <div class="col-xl-4 col-lg-4 col-md-6 mb-4">
      <div class="card text-center p-3">
        <div class="pricing-card">
          <h3 class="plan-title">Enterprise</h3>
          <p class="price">$499 <span>/mo</span></p>
          <button class="subscribe-btn">Subscribe</button>
          <ul class="features">
            <li>Unlimited projects</li>
            <li>Priority Support</li>
            <li>Full Compliance</li>
            <li>Custom Integrations</li>
          </ul>
        </div>
      </div>
    </div> -->


	<!-- <div class="col-xl-4 col-lg-4 col-md-6 mb-4">
      <div class="card text-center p-3">
        <div class="pricing-card">
          <h3 class="plan-title">Grow</h3>
          <p class="price">$199 <span>/mo</span></p>
          <button class="subscribe-btn">Subscribe</button>
          <ul class="features">
            <li>10 projects</li>
            <li>Email Support</li>
            <li>Advanced GDPR</li>
            <li>Advanced CCPA</li>
          </ul>
        </div>
      </div>
    </div> -->
	<!-- <div class="col-xl-4 col-lg-4 col-md-6 mb-4">
      <div class="card text-center p-3">
        <div class="pricing-card">
          <h3 class="plan-title">Grow</h3>
          <p class="price">$199 <span>/mo</span></p>
          <button class="subscribe-btn">Subscribe</button>
          <ul class="features">
            <li>10 projects</li>
            <li>Email Support</li>
            <li>Advanced GDPR</li>
            <li>Advanced CCPA</li>
          </ul>
        </div>
      </div>
    </div>
	<div class="col-xl-4 col-lg-4 col-md-6 mb-4">
      <div class="card text-center p-3">
        <div class="pricing-card">
          <h3 class="plan-title">Grow</h3>
          <p class="price">$199 <span>/mo</span></p>
          <button class="subscribe-btn">Subscribe</button>
          <ul class="features">
            <li>10 projects</li>
            <li>Email Support</li>
            <li>Advanced GDPR</li>
            <li>Advanced CCPA</li>
          </ul>
        </div>
      </div>
    </div> -->

  </div>
</div>







				<!-- <div class="card-header">
					<h5 class="card-title">Special title treatment</h5>
				</div>
				<div class="card-body custom-tab-1">
					<ul class="nav nav-tabs card-body-tabs mb-3">
						<li class="nav-item"><a class="nav-link active" href="javascript:void(0);">Active</a>
						</li>
						<li class="nav-item"><a class="nav-link" href="javascript:void(0);">Link</a>
						</li>
						<li class="nav-item"><a class="nav-link disabled" href="javascript:void(0);">Disabled</a>
						</li>
					</ul>

					<p class="card-text">With supporting text below as a natural lead-in to additional content.</p><a href="javascript:void(0);" class="btn btn-primary btn-card">Go somewhere</a>
				</div> -->
			</div>
		</div>



<!-- 

		<div class="col-xl-6">
			<div class="card text-white bg-primary">
				<div class="card-header">
					<h5 class="card-title text-white">Primary card title</h5>
				</div>
				<div class="card-body mb-0">
					<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p><a href="javascript:void(0);" class="btn bg-white text-primary btn-card">Go
						somewhere</a>
				</div>
				<div class="card-footer bg-transparent border-0 text-white">Last updateed 3 min ago
				</div>
			</div>
		</div>
		<div class="col-xl-6">
			<div class="card text-white bg-secondary">
				<div class="card-header">
					<h5 class="card-title text-white">Secondary card title</h5>
				</div>
				<div class="card-body mb-0">
					<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p><a href="javascript:void(0);" class="btn bg-white text-secondary btn-card">Go
						somewhere</a>
				</div>
				<div class="card-footer bg-transparent border-0 text-white">Last updateed 3 min ago
				</div>
			</div>
		</div>
		<div class="col-xl-6">
			<div class="card text-white bg-success">
				<div class="card-header">
					<h5 class="card-title text-white">Success card title</h5>
				</div>
				<div class="card-body mb-0">
					<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p><a href="javascript:void(0);" class="btn bg-white text-success light btn-card">Go
						somewhere</a>
				</div>
				<div class="card-footer bg-transparent border-0 text-white">Last updateed 3 min ago
				</div>
			</div>
		</div>
		<div class="col-xl-6">
			<div class="card text-white bg-danger">
				<div class="card-header">
					<h5 class="card-title text-white">Danger card title</h5>
				</div>
				<div class="card-body mb-0">
					<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p><a href="javascript:void(0);" class=" btn bg-white text-danger btn-card">Go
						somewhere</a>
				</div>
				<div class="card-footer bg-transparent border-0 text-white">Last updateed 3 min ago
				</div>
			</div>
		</div>
		<div class="col-xl-6">
			<div class="card text-white bg-warning">
				<div class="card-header">
					<h5 class="card-title text-white">Warning card title</h5>
				</div>
				<div class="card-body mb-0">
					<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p><a href="javascript:void(0);" class="btn bg-white text-warning btn-card">Go
						somewhere</a>
				</div>
				<div class="card-footer bg-transparent border-0 text-white">Last updateed 3 min ago
				</div>
			</div>
		</div>
		<div class="col-xl-6">
			<div class="card text-white bg-info">
				<div class="card-header">
					<h5 class="card-title text-white">Info card title</h5>
				</div>
				<div class="card-body mb-0">
					<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p><a href="javascript:void(0);" class="btn bg-white text-info btn-card">Go
						somewhere</a>
				</div>
				<div class="card-footer bg-transparent border-0 text-white">
					Last updateed 3 min ago
				</div>
			</div>
		</div>
		<div class="col-xl-6">
			<div class="card bg-light">
				<div class="card-header">
					<h5 class="card-title">Light card title</h5>
				</div>
				<div class="card-body mb-0">
					<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p><a href="javascript:void(0);" class="btn btn-dark btn-card">Go
						somewhere</a>
				</div>
				<div class="card-footer bg-transparent border-0">Last updateed 3 min ago
				</div>
			</div>
		</div>
		<div class="col-xl-6">
			<div class="card text-white bg-dark">
				<div class="card-header">
					<h5 class="card-title text-white">Dark card title</h5>
				</div>
				<div class="card-body mb-0">
					<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
					<a href="javascript:void(0);" class="btn btn-light btn-card text-dark">Go
						somewhere</a>
				</div>
				<div class="card-footer bg-transparent border-0 text-white">Last updateed 3 min ago
				</div>
			</div>
		</div>
		<div class="col-xl-6">
			<div class="card">
				<img class="card-img-top img-fluid" src="{{ asset('images/card/1.png')}}" alt="Card image cap">
				<div class="card-header">
					<h5 class="card-title">Card title</h5>
				</div>
				<div class="card-body">
					<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
					<p class="card-text text-dark">Last updated 3 mins ago</p>
				</div>
			</div>
		</div>
		<div class="col-xl-6">
			<div class="card">
				<img class="card-img-top img-fluid" src="{{ asset('images/card/2.png')}}" alt="Card image cap">
				<div class="card-header">
					<h5 class="card-title">Card title</h5>
				</div>
				<div class="card-body">
					<p class="card-text">He lay on his armour-like back, and if he lifted his head a little
					</p>
				</div>
				<div class="card-footer">
					<p class="card-text d-inline">Card footer</p>
					<a href="javascript:void(0);" class="card-link float-end">Card link</a>
				</div>
			</div>
		</div>
		<div class="col-xl-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Card title</h5>
				</div>
				<div class="card-body">
					<p class="card-text">This is a wider card with supporting text and below as a natural lead-in to the additional content. This content is a little</p>
				</div>
				<img class="card-img-bottom img-fluid" src="{{ asset('images/card/3.png')}}" alt="Card image cap">
				<div class="card-footer">
					<p class="card-text d-inline">Card footer</p>
					<a href="javascript:void(0);" class="card-link float-end">Card link</a>
				</div>
			</div>
		</div> -->
	</div>
</div>
@endsection