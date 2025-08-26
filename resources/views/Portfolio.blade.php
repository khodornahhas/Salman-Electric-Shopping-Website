@extends('layouts.main')
@section('head')
    <title>Salman Electric - Portfolio</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
@endsection
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salman Electric - Our Portfolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8ed 100%);
        }
        .project-card:hover .project-image {
            transform: scale(1.05);
        }
        .floating {
            animation: floating 6s ease-in-out infinite;
        }
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body>
    
    <div class="bg-blue-600 text-white font-bold py-4 px-4 md:px-16 text-left mt-[30px]">
        <div class="max-w-7xl mx-auto">
            <a href="{{ url('/home') }}" class="hover:underline opacity-70 transition-opacity duration-300">Home</a>
            <span class="opacity-50 mx-2"> &gt; </span>
            <span class="opacity-90">Portfolio</span>
        </div>
    </div>

    <header class="relative overflow-hidden py-20 bg-white text-gray-900">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-20 w-64 h-64 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-70"></div>
            <div class="absolute bottom-0 right-20 w-64 h-64 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl opacity-70"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10" data-aos="fade-up">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                Our Portfolio</span>
            </h1>
            <p class="text-xl md:text-2xl max-w-2xl mb-8 text-gray-700">
                Showcasing our electrical excellence and innovative solutions that power businesses and homes
            </p>
            <div class="flex space-x-4">
                <a href="#projects" class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-full transition-all duration-300 transform hover:scale-105 shadow-lg">
                    View Projects
                </a>
                <a href="/about" class="px-8 py-3 border-2 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white font-bold rounded-full transition-all duration-300 transform hover:scale-105">
                    About Us
                </a>
            </div>
        </div>
    </header>


    <section class="py-0 bg-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="p-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-4xl md:text-5xl font-bold text-blue-700 mb-2">10+</div>
                    <div class="text-gray-600">Projects Completed</div>
                </div>
                <div class="p-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-4xl md:text-5xl font-bold text-blue-700 mb-2">97%</div>
                    <div class="text-gray-600">Client Satisfaction</div>
                </div>
                <div class="p-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-4xl md:text-5xl font-bold text-blue-700 mb-2">10+</div>
                    <div class="text-gray-600">Years Experience</div>
                </div>
                <div class="p-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="text-4xl md:text-5xl font-bold text-blue-700 mb-2">5+</div>
                    <div class="text-gray-600">Cities Served</div>
                </div>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 md:px-16 py-16 space-y-24">
        <div class="text-center py-0">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Featured Projects
            </h2>
            <p class="text-gray-500 max-w-2xl mx-auto text-lg">
                Showcase of our projects including installations that power businesses and homes.
            </p>
        </div>

    <div class="flex flex-col md:flex-row items-center gap-8 md:gap-16" data-aos="fade-up">
        <div class="w-full md:w-1/2">
            <img src="images/project.png" alt="Commercial Lighting Project"
                 class="rounded-xl shadow-2xl w-full h-auto object-cover transition-all duration-500 hover:shadow-lg">
        </div>
        <div class="w-full md:w-1/2 text-center md:text-left">
            <h3 class="font-bold mb-4 text-blue-600 text-2xl">Fully Powered Watering System</h3>
            <p class="text-gray-600 mb-4 text-lg leading-relaxed">
                Automated energy-powered watering setup solution powered by solar energy.
            </p>
            <span class="text-sm font-medium text-gray-500">Completed: 2025</span>
        </div>
    </div>

    <div class="flex flex-col-reverse md:flex-row items-center gap-8 md:gap-16" data-aos="fade-up" data-aos-delay="200">
        <div class="w-full md:w-1/2 text-center md:text-left">
            <h3 class="font-bold mb-4 text-blue-600 text-2xl">Household Solar System Baalbek</h3>
            <p class="text-gray-600 mb-4 text-lg leading-relaxed">
                Complete residential solar panel installation providing 24/7 energy in Baalbek.
            </p>
            <span class="text-sm font-medium text-gray-500">Completed: 2024</span>
        </div>
        <div class="w-full md:w-1/2">
            <img src="images/project2.png" alt="Smart Home Installation"
                 class="rounded-xl shadow-2xl w-full h-auto object-cover transition-all duration-500 hover:shadow-lg">
        </div>
    </div>

    <div class="flex flex-col md:flex-row items-center gap-8 md:gap-16" data-aos="fade-up" data-aos-delay="300">
        <div class="w-full md:w-1/2">
            <img src="images/project4.jpg" alt="Industrial Electrical Work"
                 class="rounded-xl shadow-2xl w-full h-auto object-cover transition-all duration-500 hover:shadow-lg">
        </div>
        <div class="w-full md:w-1/2 text-center md:text-left">
            <h3 class="font-bold mb-4 text-blue-600 text-2xl">Household Solar System Beirut</h3>
            <p class="text-gray-600 mb-4 text-lg leading-relaxed">
                Complete home solar setup ensuring 24/7 electricity in Beirut.
            </p>
            <span class="text-sm font-medium text-gray-500">Completed: 2024</span>
        </div>
    </div>

    <div class="flex flex-col-reverse md:flex-row items-center gap-8 md:gap-16" data-aos="fade-up" data-aos-delay="400">
        <div class="w-full md:w-1/2 text-center md:text-left">
            <h3 class="font-bold mb-4 text-blue-600 text-2xl">Industrial Solar Systems</h3>
            <p class="text-gray-600 mb-4 text-lg leading-relaxed">
                Large scale solar panels installation.
            </p>
            <span class="text-sm font-medium text-gray-500">Completed: 2023</span>
        </div>
        <div class="w-full md:w-1/2">
            <img src="images/project3.png" alt="Commercial Solar Installation"class="rounded-xl shadow-2xl w-full h-auto object-cover transition-all duration-500 hover:shadow-lg">
        </div>
    </div>
</section>


    <section class="py-20 bg-gradient-to-r from-blue-800 to-blue-600 text-white">
        <div class="container mx-auto px-6 text-center">
            <div class="max-w-3xl mx-auto" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to Power Your Next Project?</h2>
                <p class="text-xl mb-8 text-blue-100">Contact Us below to bring electrical solutions to your home or business</p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="/contact" class="px-8 py-4 border-2 border-white hover:bg-white hover:text-blue-900 font-bold rounded-full transition-all duration-300 transform hover:scale-105">
                        Call Us Now
                    </a>
                </div>
            </div>
        </div>
    </section>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
    </script>
</body>
</html>
@endsection