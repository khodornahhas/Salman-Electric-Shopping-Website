@extends('layouts.main')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Salman Electric</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="font-['Urbanist'] bg-white">

<!-- Animated Breadcrumbs -->
<div class="hero-gradient text-white font-bold py-4 px-4 md:px-16 text-left" style="margin-top: 30px;">
    <div class="max-w-7xl mx-auto">
        <a href="{{ url('/home') }}" class="hover:underline opacity-70 transition-opacity duration-300">Home</a>
        <span class="opacity-50 mx-2"> &gt; </span>
        <span class="opacity-90">About Us</span>
    </div>
</div>

<!-- Who We Are Section -->
<div class="max-w-7xl mx-auto px-4 md:px-16 py-16 flex flex-col md:flex-row items-center gap-8 md:gap-16">
    <div class="w-full md:w-1/2" data-aos="fade-right">
        <img src="{{ asset('images/sm.png') }}" alt="Salman Electric Storefront" 
             class="rounded-xl shadow-2xl w-full h-auto object-cover transition-all duration-500 hover:shadow-lg">
    </div>
    <div class="w-full md:w-1/2 text-center md:text-left" data-aos="fade-left" data-aos-delay="200">
        <h2 class="font-bold mb-4 text-gray-700 text-xl sm:text-2xl">Who we are</h2>
        <p class="text-gray-400 leading-relaxed text-sm sm:text-base md:text-lg">
            Salman Electric is a trusted provider of high-quality electrical solutions, committed to serving customers and clients. We specialize in solar energy systems, advanced lighting technologies, and EV chargers. Be sure to check our portfolio to see the projects we do and the impact we've made.
        </p>
    </div>
</div>

<!-- Rebranding Section -->
<div class="py-16">
    <div class="max-w-7xl mx-auto px-4 md:px-16 flex flex-col-reverse md:flex-row items-center gap-8 md:gap-16">
        <div class="w-full md:w-1/2 text-center md:text-left" data-aos="fade-right" data-aos-delay="200">
            <h2 class="font-bold mb-4 text-gray-700 text-xl sm:text-2xl">Rebranding</h2>
            <p class="text-gray-400 leading-relaxed text-sm sm:text-base md:text-lg">
                Salman Electric recently went through a full rebranding and store renovation. Our new look shows our move toward a more modern and professional style, while still keeping the values our customers trust.
            </p>
        </div>
        <div class="w-full md:w-1/2" data-aos="fade-left">
            <img src="{{ asset('images/sm2.png') }}" alt="Salman Electric Store Renovation" 
                 class="rounded-xl shadow-2xl w-full h-auto object-cover transition-all duration-500 hover:shadow-lg">
        </div>
    </div>
</div>

<!-- Values Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 md:px-16">
        <h2 class="text-3xl font-bold text-center mb-16 text-gray-800" data-aos="fade-up">Our Values</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
            <div class="feature-card bg-white p-6 rounded-xl shadow-md border border-gray-100 transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                    <img src="{{ asset('images/service.png') }}" alt="Friendly Service" class="w-8 h-8">
                </div>
                <h3 class="text-lg font-semibold text-gray-800 text-center mb-2">Friendly Service</h3>
                <p class="text-sm sm:text-base text-gray-500 text-center">Our team is always ready to help.</p>
            </div>
            
            <div class="feature-card bg-white p-6 rounded-xl shadow-md border border-gray-100 transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                    <img src="{{ asset('images/quality.png') }}" alt="High Quality" class="w-8 h-8">
                </div>
                <h3 class="text-lg font-semibold text-gray-800 text-center mb-2">Top Quality</h3>
                <p class="text-sm sm:text-base text-gray-500 text-center">We only sell trusted products.</p>
            </div>
            
            <div class="feature-card bg-white p-6 rounded-xl shadow-md border border-gray-100 transition-all duration-300" data-aos="fade-up" data-aos-delay="300">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                    <img src="{{ asset('images/affordable.png') }}" alt="Affordable Prices" class="w-8 h-8">
                </div>
                <h3 class="text-lg font-semibold text-gray-800 text-center mb-2">Affordable Prices</h3>
                <p class="text-sm sm:text-base text-gray-500 text-center">Great value without compromise.</p>
            </div>
            
            <div class="feature-card bg-white p-6 rounded-xl shadow-md border border-gray-100 transition-all duration-300" data-aos="fade-up" data-aos-delay="400">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                    <img src="{{ asset('images/experience.png') }}" alt="Years of Experience" class="w-8 h-8">
                </div>
                <h3 class="text-lg font-semibold text-gray-800 text-center mb-2">Experienced Team</h3>
                <p class="text-sm sm:text-base text-gray-500 text-center">Professional knowledge in electrical systems.</p>
            </div>
        </div>
    </div>
</section>


<script>
    // Initialize animations
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true,
        offset: 100
    });
</script>
</body>
</html>
@endsection
