@extends('layouts.main')

@section('content')
<div class="py-16  min-h-screen flex items-center justify-center">
    <div class="w-full max-w-6xl bg-white rounded-lg p-6 flex flex-col md:flex-row gap-24">
        <div class="w-full md:w-1/2">
            <h2 class="text-2xl font-semibold mb-6">Log In to your Account</h2>

            <div class="flex gap-4 mb-4">
                <button class="border p-2 rounded"><i class="bx bxl-google"></i></button>
                <button class="border p-2 rounded"><i class="bx bxl-facebook"></i></button>
            </div>

            <p class="text-sm mb-4">- or login using your email address.</p>
            @if (session('status'))
    <div class="mb-4 text-sm text-green-600">
        {{ session('status') }}
    </div>
@endif

@if ($errors->any())
    <div class="mb-4">
        <ul class="list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                <input type="email" name="email" placeholder="user@mail.com*" required class="w-full px-4 py-2 border rounded" />
                <input type="password" name="password" placeholder="********" required class="w-full px-4 py-2 border rounded" />

                <div class="flex items-center justify-between">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="remember" />
                        <span class="text-sm">Remember me</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">Forget Password?</a>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded font-semibold transition">LOGIN</button>
            </form>
        </div>

        <div class="hidden md:flex items-center justify-center w-px bg-gray-300"></div>

        <div class="w-full md:w-1/2">
            <h2 class="text-2xl font-semibold mb-6">Create a New Account</h2>
            <div class="flex gap-4 mb-4">
                <button class="border p-2 rounded"><i class="bx bxl-google"></i></button>
                <button class="border p-2 rounded"><i class="bx bxl-facebook"></i></button>
            </div>

            <p class="text-sm mb-4">- or login using your email address.</p>
            @if ($errors->any())
                <div class="mb-4">
                    <ul class="list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf
                <input type="text" name="name" placeholder="Username*" required class="w-full px-4 py-2 border rounded" />
                <input type="text" name="first_name" placeholder="First Name*" class="w-full px-4 py-2 border rounded" />
                <input type="text" name="last_name" placeholder="Last Name*" class="w-full px-4 py-2 border rounded" />
                <input type="email" name="email" placeholder="user@mail.com*" required class="w-full px-4 py-2 border rounded" />
                <select name="location" class="w-full px-4 py-2 border rounded">
                    <option value="Beirut">Beirut</option>
                    <option value="Tripoli">Tripoli</option>
                    <option value="Sidon">Sidon</option>
                </select>
                <input type="text" name="address" placeholder="Enter Your Address*" class="w-full px-4 py-2 border rounded" />
                <input type="text" name="phone" placeholder="Enter phone number*" class="w-full px-4 py-2 border rounded" />
                <input type="password" name="password" placeholder="********" required class="w-full px-4 py-2 border rounded" />
                <input type="password" name="password_confirmation" placeholder="********" required class="w-full px-4 py-2 border rounded" />

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded font-semibold transition">Sign Up</button>
            </form>
        </div>
    </div>
</div>
@endsection
