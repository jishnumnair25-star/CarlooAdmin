


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carlo PEaas Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
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
            max-width: 400px;
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
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(5deg);
            }
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
        
        .input-field::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }
        
        .btn-login {
            background: linear-gradient(45deg, #9d00ff, #ff00ff);
            color: white;
            border-radius: 50px;
            padding: 15px 0;
            transition: all 0.3s ease;
            border: none;
            font-weight: 600;
            letter-spacing: 1px;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(157, 0, 255, 0.4);
        }
        
        .social-icon {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .social-icon:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .title {
            background: linear-gradient(90deg, #9d00ff, #00ffcc);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            display: inline-block;
        }
        
        .checkbox-container {
            display: flex;
            align-items: center;
        }
        
        .checkbox-container input[type="checkbox"] {
            appearance: none;
            -webkit-appearance: none;
            width: 18px;
            height: 18px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 4px;
            outline: none;
            cursor: pointer;
            position: relative;
            margin-right: 8px;
        }
        
        .checkbox-container input[type="checkbox"]:checked {
            background: linear-gradient(45deg, #9d00ff, #ff00ff);
            border-color: transparent;
        }
        
        .checkbox-container input[type="checkbox"]:checked::after {
            content: "✓";
            position: absolute;
            color: white;
            font-size: 12px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>
<body>
    <!-- Background spheres -->
    <div class="sphere sphere-1"></div>
    <div class="sphere sphere-2"></div>
    <div class="sphere sphere-3"></div>
    
    <!-- Main login card -->
    <div class="glass-card">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold title mb-2">Welcome Back</h1>
            <p class="text-white opacity-80">Sign in to your account</p>
        </div>
         {{-- Session error --}}
    @if (session('error'))
        <div class="alert alert-danger" style="color: red;" >
            {{ session('error') }}
        </div>
    @endif

    {{-- Validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger" style="color: red;">
            {{ $errors->first() }}
        </div>
    @endif
         <form class="space-y-6" method="POST" action="{{ route('login.post') }}">
        @csrf
       
            <div class="space-y-4">
                <div>
                    <div class="flex items-center mb-1">
                        <i class="fas fa-envelope text-white mr-2 opacity-80"></i>
                        <label for="Username" class="text-white text-sm opacity-80">Username</label>
                    </div>
                    <input type="text" id="email" name="username" class="input-field" placeholder="Username" value="{{ old('username') }}">
                </div>
                
                <div>
                    <div class="flex items-center mb-1">
                        <i class="fas fa-lock text-white mr-2 opacity-80"></i>
                        <label for="password" class="text-white text-sm opacity-80">Password</label>
                    </div>
                    <input type="password" name="password" id="password" class="input-field" placeholder="Enter your password">
                </div>
            </div>
            
            <div class="flex items-center justify-between">
                <!-- <div class="checkbox-container">
                    <input type="checkbox" id="remember">
                    <label for="remember" class="text-white text-sm opacity-80 cursor-pointer">Remember me</label>
                </div>
                <a href="#" class="text-white text-sm opacity-80 hover:opacity-100 hover:text-cyan-300 transition">Forgot password?</a>
            </div> -->
            
            <button type="submit" class="w-full btn-login font-medium">LOGIN</button>
        </form>
        
        <!-- <div class="text-center mt-8">
            <p class="text-white text-sm opacity-80 mb-4">Or login with</p>
            <div class="flex justify-center space-x-4">
                <a href="#" class="social-icon">
                    <i class="fab fa-facebook-f text-white"></i>
                </a>
                <a href="#" class="social-icon">
                    <i class="fab fa-google text-white"></i>
                </a>
                <a href="#" class="social-icon">
                    <i class="fab fa-twitter text-white"></i>
                </a>
            </div>
        </div> -->
        
        <!-- <div class="text-center mt-8">
            <p class="text-white text-sm opacity-80">Don't have an account? <a href="#" class="font-medium hover:opacity-100 text-cyan-300 transition">Sign up</a></p>
        </div> -->
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.input-field');
            
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.querySelector('i').style.transform = 'scale(1.2)';
                    this.parentElement.querySelector('i').style.opacity = '1';
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.querySelector('i').style.transform = 'scale(1)';
                    this.parentElement.querySelector('i').style.opacity = '0.8';
                });
            });
            
            // Add subtle floating animation to the login card
            const card = document.querySelector('.glass-card');
            let floatValue = 0;
            let floatDirection = 1;
            
            function floatCard() {
                floatValue += 0.02 * floatDirection;
                
                if (floatValue > 3) floatDirection = -1;
                if (floatValue < -3) floatDirection = 1;
                
                card.style.transform = `translateY(${floatValue}px)`;
                requestAnimationFrame(floatCard);
            }
            
            floatCard();
            
            // Add sphere interaction
            const spheres = document.querySelectorAll('.sphere');
            
            spheres.forEach(sphere => {
                sphere.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.1)';
                    this.style.opacity = '1';
                });
                
                sphere.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                    this.style.opacity = '0.8';
                });
            });
        });
    </script>
</body>
</html>