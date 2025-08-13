@extends('layouts.main')
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
<body class="gradient-bg font-sans">
    <header class="relative overflow-hidden py-20 bg-gradient-to-r from-blue-900 to-blue-700 text-white">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-0 left-20 w-64 h-64 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-70"></div>
            <div class="absolute bottom-0 right-20 w-64 h-64 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-70"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10" data-aos="fade-up">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">Our <span class="text-yellow-300">Portfolio</span></h1>
            <p class="text-xl md:text-2xl max-w-2xl mb-8">Showcasing our electrical excellence and innovative solutions that power businesses and homes</p>
            <div class="flex space-x-4">
                <a href="#projects" class="px-8 py-3 bg-yellow-400 hover:bg-yellow-300 text-blue-900 font-bold rounded-full transition-all duration-300 transform hover:scale-105">
                    View Projects
                </a>
                <a href="/about" class="px-8 py-3 border-2 border-white hover:bg-white hover:text-blue-900 font-bold rounded-full transition-all duration-300 transform hover:scale-105">
                    About Us
                </a>
            </div>
        </div>
    </header>

    <section class="py-16 bg-white">
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

    <section id="projects" class="py-20">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Featured <span class="text-blue-600">Projects</span></h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Explore our vast majority of projects we've done over the years.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="project-card bg-white rounded-xl shadow-xl overflow-hidden transition-all duration-500 hover:shadow-2xl" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative overflow-hidden h-64">
                        <img src="images/project.png" 
                            alt="Commercial Lighting Project" 
                            class="project-image w-full h-full object-cover transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6">
                            <h3 class="text-white text-xl font-bold">Fully Powered Watering System</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Automated energy-powered watering setup solution powered by solar energy.</p>
                        <div class="text-center">
                            <span class="text-sm font-medium text-blue-600">Completed: 2025</span>
                        </div>
                    </div>
                </div>

                <div class="project-card bg-white rounded-xl shadow-xl overflow-hidden transition-all duration-500 hover:shadow-2xl" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative overflow-hidden h-64">
                        <img src="images/project2.jpg" 
                            alt="Smart Home Installation" 
                            class="project-image w-full h-full object-cover transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6">
                            <h3 class="text-white text-xl font-bold">Household Solar System Baalbek</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Complete residential solar panel installation providing 24/7 energy in Baalbek.</p>
                        <div class="text-center">
                            <span class="text-sm font-medium text-blue-600">Completed: 2024</span>
                        </div>
                    </div>
                </div>

                <div class="project-card bg-white rounded-xl shadow-xl overflow-hidden transition-all duration-500 hover:shadow-2xl" data-aos="fade-up" data-aos-delay="300">
                    <div class="relative overflow-hidden h-64">
                        <img src="images/project4.jpg" 
                            alt="Industrial Electrical Work" 
                            class="project-image w-full h-full object-cover transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6">
                            <h3 class="text-white text-xl font-bold">Household Solar System Beirut</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Complete home solar setup ensuring 24/7 electricity in Beirut.</p>
                        <div class="text-center">
                            <span class="text-sm font-medium text-blue-600">Completed: 2024</span>
                        </div>
                    </div>
                </div>

                <div class="project-card bg-white rounded-xl shadow-xl overflow-hidden transition-all duration-500 hover:shadow-2xl md:col-span-2 lg:col-span-3 mx-auto" data-aos="fade-up" data-aos-delay="400">
                    <div class="relative overflow-hidden h-80">
                        <img src="images/project3.png" 
                            alt="Commercial Solar Installation" 
                            class="project-image w-full h-full object-cover transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6">
                            <h3 class="text-white text-xl font-bold">Industrial Solar Systems</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Large scale solar panels installation.</p>
                        <div class="text-center">
                            <span class="text-sm font-medium text-blue-600">Completed: 2023</span>
                        </div>
                    </div>
                </div>
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