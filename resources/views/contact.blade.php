@extends('layouts.main')
@section('head')
    <title>Salman Electric - Contact</title>
    <link rel="icon" type="image/png" href="{{ asset('images/salmanlogo.png') }}?v={{ time() }}">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
@endsection
@section('content')

<div class="bg-blue-600 text-white font-bold py-4 px-4 md:px-16 text-left mt-[30px]">
    <div class="max-w-7xl mx-auto">
        <a href="{{ url('/home') }}" class="hover:underline opacity-70 transition-opacity duration-300">Home</a>
        <span class="opacity-50 mx-2"> &gt; </span>
        <span class="opacity-90">Contact Us</span>
    </div>
</div>


<div class="bg-white py-12 px-4 sm:px-6 lg:py-16 lg:px-8 max-w-7xl mx-auto">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl lg:text-6xl">
            Get in Touch
        </h1>
        <p class="mt-5 max-w-xl mx-auto text-xl text-gray-500">
            We'd love to hear from you! Reach out for inquiries, support, or feedback.
        </p>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
        <div class="lg:w-1/2 w-full space-y-6 bg-white p-6 md:p-8 rounded-2xl shadow-sm">
            <div class="flex items-start gap-4">
                <svg class="w-6 h-6 text-blue-500 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                </svg>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Our Location</h3>
                    <p class="text-gray-600">Chiayah, Old Saida Road, Near Speed Gas Station</p>
                    <p class="text-gray-600">Beirut, Lebanon</p>
                </div>
            </div>

            <div class="flex items-start gap-4">
                <svg class="w-6 h-6 text-blue-500 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 
                          0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 
                          1.293c-.282.376-.769.542-1.21.38a12.035 12.035 
                          0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 
                          3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 
                          2.25 0 002.25 4.5v2.25z" />
                </svg>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Call Us</h3>
                    <p><a href="tel:+96176765561" class="text-gray-600 hover:text-blue-600">+961 76 765 561</a></p>
                    <p><a href="tel:+96181966742" class="text-gray-600 hover:text-blue-600">+961 03 813 154</a></p>
                </div>
            </div>

            <div class="flex items-start gap-4">
                <svg class="w-6 h-6 text-blue-500 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M21.75 6.75v10.5a2.25 2.25 
                          0 01-2.25 2.25h-15a2.25 2.25 
                          0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 
                          0 0019.5 4.5h-15a2.25 2.25 
                          0 00-2.25 2.25m19.5 0v.243a2.25 2.25 
                          0 01-1.07 1.916l-7.5 4.615a2.25 2.25 
                          0 01-2.36 0L3.32 8.91a2.25 2.25 
                          0 01-1.07-1.916V6.75" />
                </svg>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Email Us</h3>
                    <p><a href="mailto:sales@yourdomain.com" class="text-gray-600 hover:text-blue-600">sales@yourdomain.com</a></p>
                </div>
            </div>

            <div class="flex items-start gap-4 pt-2">
                <svg class="w-6 h-6 text-blue-500 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M12 6v6h4.5m4.5 
                          0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Opening Hours</h3>
                    <p class="text-gray-600 font-bold">Monday – Saturday: 7:00 AM – 6:00 PM</p>
                    <p class="text-gray-600 font-bold">Sunday: Closed</p>
                </div>
            </div>

            <div class="pt-6">
                <a href="https://maps.app.goo.gl/MJcWKaUrpZzXK2BY8" target="_blank" rel="noopener noreferrer" class="block relative w-full overflow-hidden rounded-lg" style="padding-bottom: 56.25%;">
                    <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3313.0767365694!2d35.5180989!3d33.8619132!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151f170059153593%3A0x8e38ddb835744431!2sSalman%20Electric!5e0!3m2!1sen!2slb!4v1754469349998!5m2!1sen!2slb"
                    class="absolute top-0 left-0 w-full h-full border-0 pointer-events-none"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </a>
            </div>
        </div>

        <div class="lg:w-1/2 w-full bg-white p-6 md:p-8 rounded-2xl shadow-sm">
            <h2 class="text-2xl text-gray-900 mb-6">Send Us a Message</h2>
            <form action="{{ route('contact.send') }}" method="POST" class="space-y-5">
                @csrf
                <input type="text" name="name" required placeholder="Your Name *" class="w-full border border-gray-300 rounded-full px-6 py-3 focus:ring-2 focus:ring-blue-400 hover:border-blue-300">
                <input type="email" name="email" required placeholder="Your Email *" class="w-full border border-gray-300 rounded-full px-6 py-3 focus:ring-2 focus:ring-blue-400 hover:border-blue-300">
                <input type="tel" name="phone" placeholder="Phone Number" pattern="[0-9]{8,15}" class="w-full border border-gray-300 rounded-full px-6 py-3 focus:ring-2 focus:ring-blue-400 hover:border-blue-300">
                <textarea name="message" rows="5" required placeholder="Your Message *" class="w-full border border-gray-300 rounded-2xl px-6 py-3 focus:ring-2 focus:ring-blue-400 hover:border-blue-300"></textarea>
                <button type="submit" class="w-full sm:w-auto py-3 px-6 rounded-full text-white bg-blue-500 hover:bg-blue-600 font-semibold focus:ring-2 focus:ring-blue-400">
                    Send Message
                </button>
            </form>
        </div>
    </div>

    <div class="mt-16 text-center">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Follow Us</h3>
        <div class="flex justify-center space-x-6">
            <a href="#" class="text-gray-500 hover:text-blue-600" aria-label="Facebook">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M22 12a10 10 0 10-11.5 9.95v-7.04H8v-2.91h2.5V9.41c0-2.48 1.48-3.85 3.76-3.85 1.09 0 2.23.2 2.23.2v2.45h-1.26c-1.24 0-1.63.77-1.63 1.56v1.87H17l-.4 2.91h-2.1v7.04A10 10 0 0022 12z"/>
                </svg>
            </a>

            <a href="#" class="text-gray-500 hover:text-blue-400" aria-label="Twitter">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8 19c7.5 0 11.6-6.2 11.6-11.6v-.5A8.2 8.2 0 0022 4.6a8.1 8.1 0 01-2.3.6 4.1 4.1 0 001.8-2.2 8.2 8.2 0 01-2.6 1 4.1 4.1 0 00-7 3.8A11.6 11.6 0 013 4.1a4.1 4.1 0 001.3 5.5 4.1 4.1 0 01-1.8-.5v.1a4.1 4.1 0 003.3 4 4.1 4.1 0 01-1.8.1 4.1 4.1 0 003.8 2.8 8.3 8.3 0 01-6.1 1.7A11.7 11.7 0 008 19"/>
                </svg>
            </a>

            <a href="#" class="text-gray-500 hover:text-pink-600" aria-label="Instagram">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M7 2C4.8 2 3 3.8 3 6v12c0 2.2 1.8 4 4 4h10c2.2 0 4-1.8 4-4V6c0-2.2-1.8-4-4-4H7zm10 2c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H7c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2h10zm-5 3a5 5 0 100 10 5 5 0 000-10zm0 2a3 3 0 110 6 3 3 0 010-6zm4.5-.5a1 1 0 100 2 1 1 0 000-2z"/>
                </svg>
            </a>
        </div>
    </div>
</div>
@endsection
