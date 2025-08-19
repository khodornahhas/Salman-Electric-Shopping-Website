@extends('layouts.main')
@section('content')
    @if ($errors->any())
        <div 
            x-data="{ show: true }" 
            x-show="show" 
            x-transition 
            class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-[#95250F] text-white px-6 py-3 rounded-lg shadow-lg flex items-center gap-4 z-50"
        >
            <span>
                @if ($errors->first())
                    {{ $errors->first() }}
                @endif
            </span>
            <button @click="show = false" class="text-white hover:text-gray-200">
                <i class="bx bx-x text-2xl"></i>
            </button>
        </div>
    @endif


    @if (session('status'))
        <div 
            x-data="{ show: true }" 
            x-show="show" 
            x-transition 
            class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg flex items-center gap-4 z-50"
        >
            <span>{{ session('status') }}</span>
            <button @click="show = false" class="text-white hover:text-gray-200">
                <i class="bx bx-x text-2xl"></i>
            </button>
        </div>
    @endif

    <div class="py-16 min-h-screen flex items-center justify-center">
        <div class="w-full max-w-6xl bg-white rounded-lg p-6 flex flex-col md:flex-row gap-24">
            
            <div class="w-full md:w-1/2">
                <h2 class="text-2xl font-semibold mb-6">Log In to your Account</h2>

                <div class="flex gap-4 mb-4">
                    <a href="{{ route('auth.google') }}" class="border p-2 rounded inline-flex items-center space-x-2">
                        <i class="bx bxl-google"></i>
                        <span>Login with Google</span>
                    </a>
                </div>
                <p class="text-sm mb-4">- or login using your email address.</p>
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf
                    <input type="email" name="email" placeholder="user@mail.com*" required 
                        class="w-full px-4 py-2 border rounded" />

                    <div class="relative">
                        <input type="password" name="password" placeholder="Password" required 
                            class="w-full px-4 py-2 border rounded pr-10" id="login-password" />
                        <i class="bx bx-show absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer text-gray-500" 
                        id="toggle-login-password"></i>
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="remember" />
                            <span class="text-sm">Remember me</span>
                        </label>
                        <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">Forget Password?</a>
                    </div>

                    <button type="submit" 
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded font-semibold transition">
                        LOGIN
                    </button>
                </form>
            </div>

            <div class="hidden md:flex items-center justify-center w-px bg-gray-300"></div>

            <div class="w-full md:w-1/2">
                <h2 class="text-2xl font-semibold mb-6">Create a New Account</h2>

                <div class="flex gap-4 mb-4">
                    <a href="{{ route('auth.google') }}" class="border p-2 rounded inline-flex items-center space-x-2">
                        <i class="bx bxl-google"></i>
                        <span>Register with Google</span>
                    </a>
                </div>

                <p class="text-sm mb-4">- or register using your email address.</p>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf
                    <input type="text" name="name" placeholder="Username*" required 
                        class="w-full px-4 py-2 border rounded" />
                    <input type="text" name="first_name" placeholder="First Name*" 
                        class="w-full px-4 py-2 border rounded" />
                    <input type="text" name="last_name" placeholder="Last Name*" 
                        class="w-full px-4 py-2 border rounded" />
                    <input type="email" name="email" placeholder="user@mail.com*" required 
                        class="w-full px-4 py-2 border rounded" />
                    <input type="text" name="phone" placeholder="Enter phone number*" 
                        class="w-full px-4 py-2 border rounded" />

                    <div class="relative">
                        <input type="password" name="password" placeholder="Password" required 
                            class="w-full px-4 py-2 border rounded pr-10" id="register-password" />
                        <i class="bx bx-show absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer text-gray-500" 
                        id="toggle-register-password"></i>
                    </div>

                    <button type="submit" 
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded font-semibold transition">
                        Sign Up
                    </button>
                </form>
            </div>
        </div>
    </div>

<script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);

        icon.addEventListener('click', () => {
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove('bx-show');
                icon.classList.add('bx-hide');
            } else {
                input.type = "password";
                icon.classList.remove('bx-hide');
                icon.classList.add('bx-show');
            }
        });
    }

    togglePassword("login-password", "toggle-login-password");
    togglePassword("register-password", "toggle-register-password");
</script>

@endsection
