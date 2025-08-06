@extends('layouts.main')
@section('content')

<style>
    * {
        font-family: 'Urbanist', sans-serif !important;
    }
</style>
<div class="bg-blue-600 text-white font-bold py-4 px-4 md:px-16 text-left mb-6 text-base md:text-lg" style="margin-top: 30px; font-family: 'Open Sans', sans-serif;">
    <a href="{{ url('/home') }}" class="hover:underline opacity-40">Home</a>
    <span style="opacity: 0.4;"> &gt; </span>
    <span style="opacity: 0.8;">About Us</span>
</div>

<div class="max-w-7xl mx-auto px-4 md:px-16 py-10 flex flex-col md:flex-row items-center gap-10 mt-20">
    <div class="w-full md:w-1/2">
        <img src="{{ asset('images/sm.png') }}" alt="Salman Electric Storefront" class="rounded-lg shadow-lg w-full">
    </div>
    <div class="w-full md:w-1/2">
        <h2 class=" font-bold mb-4 text-gray-700"style="font-size:20px;">Who we are</h2>
        <p class="text-gray-400 leading-relaxed text-base md:text-lg">
            Salman Electric is a trusted provider of high-quality electrical solutions, committed to serving customers and clients. We are specialized in solar energy systems, advanced lighting technologies, and EV chargers. Be sure to check our portfolio to see the projects we do and the impact we’ve made.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 md:px-16 py-10 flex flex-col md:flex-row items-center gap-10 mt-20 mb-10">
    <div class="w-full md:w-1/2">
        <h2 class="font-bold mb-4 text-gray-700" style="font-size:20px;">Rebranding</h2>
        <p class="text-gray-400 leading-relaxed text-base md:text-lg">
        Salman Electric recently went through a full rebranding and store renovation. Our new look shows our move toward a more modern and professional style, while still keeping the values our customers trust.</p>
    </div>    

    <div class="w-full md:w-1/2">
        <img src="{{ asset('images/sm2.png') }}" alt="Salman Electric Storefront" class="rounded-lg shadow-lg w-full">
    </div>
</div>

<div class=" py-16 mt-5 mb-5">
    <div class="max-w-7xl mx-auto px-4 md:px-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-10 text-center">
            <div>
                <img src="{{ asset('images/service.png') }}" alt="Friendly Service" class="mx-auto w-10 h-10 mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Friendly Service</h3>
                <p class="text-l text-gray-500">Our team is always ready to help.</p>
            </div>
            <div>
                <img src="{{ asset('images/quality.png') }}" alt="High Quality" class="mx-auto w-10 h-10 mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Top Quality</h3>
                <p class="text-l text-gray-500">We only sell trusted products.</p>
            </div>
            <div>
                <img src="{{ asset('images/affordable.png') }}" alt="Affordable Prices" class="mx-auto w-10 h-10 mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Affordable Prices</h3>
                <p class="text-l text-gray-500">Great value with no compromise on performance.</p>
            </div>
            <div>
                <img src="{{ asset('images/experience.png') }}" alt="Years of Experience" class="mx-auto w-10 h-10 mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Experienced Team</h3>
                <p class="text-l text-gray-500">Professional knowledge in electrical systems.</p>
            </div>
        </div>
    </div>
</div>


@endsection
