<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carlo PEaas Signup</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo.jpg')}}">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
      min-height: 100vh;
      overflow: auto;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .glass-card {
      background: rgba(15, 12, 41, 0.5);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border-radius: 20px;
      border: 1px solid rgba(255, 255, 255, 0.1);
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.2);
      width: 90%;
      max-width: 500px;
      padding: 2.5rem;
      margin: 2rem;
      position: relative;
      z-index: 10;
    }
    .sphere {
      position: absolute;
      border-radius: 50%;
      filter: blur(0px);
      animation: float 15s infinite ease-in-out;
      opacity: 0.8;
    }
    .sphere-1 {
      width: 250px;
      height: 250px;
      top: 10%;
      left: 25%;
      background: radial-gradient(circle at 30% 30%, #ff00ff 0%, #9d00ff 100%);
      animation-delay: 0s;
    }
    .sphere-2 {
      width: 180px;
      height: 180px;
      bottom: 15%;
      right: 15%;
      background: radial-gradient(circle at 30% 30%, #00ffcc 0%, #0099ff 100%);
      animation-delay: 3s;
    }
    .sphere-3 {
      width: 120px;
      height: 120px;
      top: 90%;
      left: 20%;
      background: radial-gradient(circle at 30% 30%, #ffcc00 0%, #ff6600 100%);
      animation-delay: 6s;
    }
    @keyframes float {
      0%, 100% { transform: translateY(0) rotate(0deg); }
      50% { transform: translateY(-20px) rotate(5deg); }
    }
    .input-field {
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 50px;
      padding: 15px 20px;
      color: white;
      transition: all 0.3s ease;
      width: 100%;
    }
    .input-field:focus {
      background: rgba(255, 255, 255, 0.15);
      outline: none;
      border-color: rgba(255, 255, 255, 0.4);
      box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
    }
    .input-field::placeholder { color: rgba(255, 255, 255, 0.5); }
    .btn-login, .btn-primary, .btn-success {
      background: linear-gradient(45deg, #9d00ff, #ff00ff);
      color: white;
      border-radius: 50px;
      padding: 15px 0;
      transition: all 0.3s ease;
      border: none;
      font-weight: 600;
      letter-spacing: 1px;
    }
    .btn-login:hover, .btn-primary:hover, .btn-success:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(157, 0, 255, 0.4);
    }
    .animated-title {
      background: linear-gradient(90deg, #9d00ff, #00ffcc);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
      display: inline-block;
      letter-spacing: 1px;
      font-weight: 700;
      animation: fadeInDown 1s;
    }
    .error { color: #ffbaba; font-size: 0.95em; min-height: 18px; }
    .step { display: none; opacity: 0; transform: translateY(30px) scale(0.98); transition: all 0.5s cubic-bezier(.4,2,.6,1); }
    .step.active { display: block; opacity: 1; transform: translateY(0) scale(1); animation: fadeInUp 0.7s; }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInDown { from { opacity: 0; transform: translateY(-40px); } to { opacity: 1; transform: translateY(0); } }
  </style>
</head>
<body>
  <!-- Background spheres -->
  <div class="sphere sphere-1"></div>
  <div class="sphere sphere-2"></div>
  <div class="sphere sphere-3"></div>
  <!-- Main signup card -->
  <div class="glass-card">
    <div class="text-center mb-3">
     <center> <img src="{{ asset('images/logo.jpg')}}" alt="Logo" style="max-width:100px; max-height:80px; margin-bottom:10px; animation: fadeInDown 1s;"></center>
    </div>
   <center> <h3 class="mb-4 text-center animated-title">Create Your Account</h3></center>
  <form id="multiStepForm" class="space-y-6">
      
      <!-- Step 1: User Info -->
      <div class="step active" id="step1">
        <h5 class="text-white text-lg font-semibold mb-4">User Info</h5>
        <div class="mb-3">
          <label class="text-white mb-1">First Name</label>
          <input type="text" class="input-field" id="first_name" required placeholder="First Name">
          <div class="error" id="first_name_error"></div>
        </div>
        <div class="mb-3">
          <label class="text-white mb-1">Last Name</label>
          <input type="text" class="input-field" id="last_name" required placeholder="Last Name">
          <div class="error" id="last_name_error"></div>
        </div>
        <div class="mb-3">
          <label class="text-white mb-1">Email</label>
          <input type="email" class="input-field" id="email" required placeholder="Email">
          <div class="error" id="email_error"></div>
        </div>
        <div class="mb-3">
          <label class="text-white mb-1">Phone Number</label>
          <input type="text" class="input-field" id="phone_number" required placeholder="Phone Number">
          <div class="error" id="phone_number_error"></div>
        </div>
        <button type="button" class="w-full btn-login nextBtn font-medium">Next</button>
      </div>

      <!-- Step 2: Account Setup -->
      <div class="step" id="step2">
        <h5 class="text-white text-lg font-semibold mb-4">Account Setup</h5>
        <div class="mb-3">
          <label class="text-white mb-1">Username</label>
          <input type="text" class="input-field" id="username" required placeholder="Username">
          <div class="error" id="username_error"></div>
        </div>
        <div class="mb-3">
          <label class="text-white mb-1">Password</label>
          <input type="password" class="input-field" id="password" required placeholder="Password">
          <div class="error" id="password_error"></div>
        </div>
        <div class="mb-3">
          <label class="text-white mb-1">Preferred Communication Channel</label>
          <select id="preferred_communication_channel" class="input-field" required>
            <option value="">Select</option>
            <option value="email">Email</option>
            <option value="phone">Phone</option>
          </select>
          <div class="error" id="preferred_communication_channel_error"></div>
        </div>
        <div class="flex gap-2">
          <button type="button" class="w-1/2 btn-login prevBtn font-medium">Previous</button>
          <button type="button" class="w-1/2 btn-login nextBtn font-medium">Next</button>
        </div>
      </div>

      <!-- Step 3: Company Info -->
      <div class="step" id="step3">
        <h5 class="text-white text-lg font-semibold mb-4">Company Info</h5>
        <div class="mb-3">
          <label class="text-white mb-1">Company Name</label>
          <input type="text" class="input-field" id="company_name" required placeholder="Company Name">
          <div class="error" id="company_name_error"></div>
        </div>
        <div class="mb-3">
          <label class="text-white mb-1">Industry</label>
          <input type="text" class="input-field" id="industry" required placeholder="Industry">
          <div class="error" id="industry_error"></div>
        </div>
        <div class="mb-3">
          <label class="text-white mb-1">Website</label>
          <input type="url" class="input-field" id="website" placeholder="Website">
        </div>
        <div class="mb-3">
          <label class="text-white mb-1">Company Size</label>
          <input type="text" class="input-field" id="company_size" placeholder="Company Size">
        </div>
        <div class="mb-3">
          <label class="text-white mb-1">Country</label>
          <input type="text" class="input-field" id="country" placeholder="Country">
        </div>
        <div class="flex gap-2">
          <button type="button" class="w-1/2 btn-login prevBtn font-medium">Previous</button>
          <button type="button" class="w-1/2 btn-login nextBtn font-medium">Next</button>
        </div>
      </div>

      <!-- Step 4: Project Details -->
      <div class="step" id="step4">
        <h5 class="text-white text-lg font-semibold mb-4">Project Details</h5>
        <div class="mb-3">
          <label class="text-white mb-1">Primary Use Case</label>
          <input type="text" class="input-field" id="primary_use_case" required placeholder="Primary Use Case">
          <div class="error" id="primary_use_case_error"></div>
        </div>
        <div class="mb-3">
          <label class="text-white mb-1">Number of Projects</label>
          <input type="number" class="input-field" id="number_of_projects" required placeholder="Number of Projects">
          <div class="error" id="number_of_projects_error"></div>
        </div>
        <div class="flex gap-2">
          <button type="button" class="w-1/2 btn-login prevBtn font-medium">Previous</button>
          <button type="button" class="w-1/2 btn-login nextBtn font-medium">Next</button>
        </div>
      </div>

      <!-- Step 5: Subscription -->
      <div class="step" id="step5">
        <h5 class="text-white text-lg font-semibold mb-4">Subscription Details</h5>
        <div class="mb-3">
          <label class="text-white mb-1">Subscription Plan</label>
          <input type="text" class="input-field" id="subscription_plan" required placeholder="Subscription Plan">
          <div class="error" id="subscription_plan_error"></div>
        </div>
        <div class="mb-3">
          <label class="text-white mb-1">Billing Frequency</label>
          <input type="text" class="input-field" id="billing_frequency" placeholder="Billing Frequency">
        </div>
        <div class="mb-3">
          <label class="text-white mb-1">Promo Code</label>
          <input type="text" class="input-field" id="promo_code" placeholder="Promo Code">
        </div>
        <div class="flex gap-2">
          <button type="button" class="w-1/2 btn-login prevBtn font-medium">Previous</button>
          <button type="button" class="w-1/2 btn-login nextBtn font-medium">Next</button>
        </div>
      </div>

      <!-- Step 6: Developer Preferences -->
      <div class="step" id="step6">
        <h5 class="text-white text-lg font-semibold mb-4">Developer Preferences</h5>
        <div class="mb-3">
          <label class="text-white mb-1">Preferred Language</label>
          <input type="text" class="input-field" id="preferred_language" required placeholder="Preferred Language">
          <div class="error" id="preferred_language_error"></div>
        </div>
        <div class="mb-3">
          <label class="text-white mb-1">Tools Integrations (comma separated)</label>
          <input type="text" class="input-field" id="tools_integrations" placeholder="Tools Integrations">
        </div>
        <div class="flex gap-2">
          <button type="button" class="w-1/2 btn-login prevBtn font-medium">Previous</button>
          <button type="submit" class="w-1/2 btn-login font-medium">Submit</button>
        </div>
      </div>
    </form>
  <div id="formMessage" class="mt-3 text-center"></div>
  <div class="text-center mt-8">
    <p class="text-white text-sm opacity-80">Already have an account? <a href="/login" class="font-medium hover:opacity-100 text-cyan-300 transition">Login</a></p>
  </div>
  </div>
</div>

<script>
let currentStep = 0;
const steps = document.querySelectorAll(".step");

function showStep(index) {
  steps.forEach((s, i) => s.classList.toggle("active", i === index));
  currentStep = index;
}

function validateStep(stepIndex) {
  let valid = true;
  const step = steps[stepIndex];
  const inputs = step.querySelectorAll("input, select");
  inputs.forEach(input => {
    const errorDiv = document.getElementById(input.id + "_error");
    if (errorDiv) errorDiv.textContent = "";
    if (input.hasAttribute("required") && !input.value.trim()) {
      if (errorDiv) errorDiv.textContent = "This field is required.";
      valid = false;
    }
   
    if (input.id === "password" && input.value.trim()) {
      const pw = input.value;
      const pwError = [];
      if (!/[A-Z]/.test(pw)) pwError.push("At least one uppercase letter (A-Z)");
      if (!/[0-9]/.test(pw)) pwError.push("At least one number (0-9)");
      if (!/[!@#$%^&*(),.?\":{}|<>]/.test(pw)) pwError.push("At least one special character (e.g., !@#$%^&*)");
      if (pwError.length > 0) {
        if (errorDiv) errorDiv.innerHTML = pwError.map(e => `<div>${e}</div>`).join("");
        valid = false;
      }
    }
  });
  return valid;
}

document.querySelectorAll(".nextBtn").forEach(btn => {
  btn.addEventListener("click", () => {
    if (validateStep(currentStep)) showStep(currentStep + 1);
  });
});
document.querySelectorAll(".prevBtn").forEach(btn => {
  btn.addEventListener("click", () => showStep(currentStep - 1));
});

document.getElementById("multiStepForm").addEventListener("submit", async (e) => {
  e.preventDefault();
  if (!validateStep(currentStep)) return;

  const payload = {
    user_info: {
      first_name: document.getElementById("first_name").value,
      last_name: document.getElementById("last_name").value,
      email: document.getElementById("email").value,
      phone_number: document.getElementById("phone_number").value
    },
    account_setup: {
      username: document.getElementById("username").value,
      password: document.getElementById("password").value,
      preferred_communication_channel: document.getElementById("preferred_communication_channel").value
    }
  };


  console.log("📤 Sending register request:", JSON.stringify(payload, null, 2));

  try {
    const registerRes = await fetch("https://carlo.algorethics.ai/api/auth/register", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(payload)
    });
    let registerData;
    try {
      registerData = await registerRes.json();
    } catch (jsonErr) {
      registerData = { message: 'Invalid JSON response', raw: await registerRes.text() };
    }
   
    console.log("📥 Register response:", registerData);

    if (!registerRes.ok) {
     
      let errorMsg = registerData.message || 'Validation error';
      if (registerData.errors) {
        errorMsg += '<ul>' + Object.entries(registerData.errors).map(([k,v]) => `<li><b>${k}</b>: ${v}</li>`).join('') + '</ul>';
      }
      document.getElementById("formMessage").innerHTML = `<div class=\"text-danger\">${errorMsg}</div>`;
      return;
    }

    
    document.getElementById("formMessage").innerHTML = `<div class=\"text-success\">✅ Account created successfully! Redirecting...</div>`;
    setTimeout(() => window.location.href = "/login", 2000);
    // If you want to keep the complete-profile step, you can add it here only if token is valid
    // const token = registerData.token;
    // if (token) { ...complete-profile logic... }
  } catch (err) {
    console.error("❌ Error:", err);
    document.getElementById("formMessage").innerHTML = `<div class="text-danger">Something went wrong. Check console.</div>`;
  }
});

</script>
</body>
</html>
