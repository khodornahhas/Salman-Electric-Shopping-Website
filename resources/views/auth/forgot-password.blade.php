@extends('layouts.main')
@section('content')
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

<div class="bg-blue-600 text-white font-bold py-4 pl-32 text-left mb-6" style="margin-top: 40px;margin-bottom:40px; font-size: 20px; font-family: 'Open Sans', sans-serif;">
    <div class="flex items-center space-x-4">
        <a href="{{ url('/home') }}" class="hover:underline opacity-40">Home</a>
        <span class="opacity-40">&gt;</span>
        <span class="opacity-100">Account</span>
    </div>
</div>

<div class="flex justify-center bg-white py-8 "style="margin-bottom:40px">
    <div class="w-full max-w-md p-4 bg-white rounded shadow">
        @if (session('status'))
            <div class="text-green-600 text-sm mb-2">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="text-red-600 text-sm mb-2">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <p class="text-center text-gray-600 mb-4">
            Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.
        </p>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-3">
                <input id="email" name="email" type="email" required autofocus placeholder="Username or email *"
                    class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div>
                <button type="submit" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 py-2 rounded transition">
                    Reset password
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
