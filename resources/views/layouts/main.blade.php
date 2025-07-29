<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salman Electric</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<style>
        body {
             font-family: "Roboto Flex", sans-serif;
             padding-top: 108px; 
        }
     .sticky-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 50;
            transition: all 0.3s ease;
            width: 100%;
        }
        
        .scrolled-header {
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            backdrop-filter: blur(5px);
            background-color: rgba(255,255,255,0.95);
        }
</style>
<body>
    <div class="sticky-header">
    <div class="bg-gray-100 py-2 text-sm">
        <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div class="text-gray-700">
                    <div class="bg-blue-50 px-3 py-1 rounded-full text-sm font-medium flex items-center gap-1">
                        <i class='bx bx-package text-blue-500'></i>
                        <span class="text-blue-600">Free Delivery</span> on Orders Over <span class="text-blue-800">$30</span>
                    </div>
                </div>
        <div class="flex items-center space-x-4">
            <a href="#" class="text-gray-600 hover:text-blue-500 transition-colors"><i class='bx bxl-facebook'></i></a>
            <a href="#" class="text-gray-600 hover:text-blue-400 transition-colors"><i class='bx bxl-twitter'></i></a>
            <a href="#" class="text-gray-600 hover:text-pink-500 transition-colors"><i class='bx bxl-instagram'></i></a>
            <a href="#" class="text-gray-600 hover:text-red-500 transition-colors"><i class='bx bxl-youtube'></i></a>
        </div>
    </div>
</div>
</div>

    <header class="bg-white shadow-sm">
        <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-20 items-center justify-between">
                <div class="flex items-center gap-8">
                    <a href="/" aria-label="Home" class="flex items-center"><img src="{{ asset('images/salmanLogo2.png') }}" alt="Salman Electric Logo" class="h-10 w-auto"  ></a>
                        <nav aria-label="Global" class="hidden md:block">
                            <ul class="flex items-center gap-6 text-sm font-bold ">
                                <li>
                                    <a class="text-gray-900 hover:text-blue-600 transition-colors" href="/home">HOME</a>
                                </li>
                                <li>
                                    <a class="text-gray-900 hover:text-blue-600 transition-colors" href="/shop">SHOP</a>
                                </li>
                                <li>
                                    <a class="text-gray-900 hover:text-blue-600 transition-colors" href="#">ABOUT</a>
                                </li>
                                <li>
                                    <a class="text-gray-900 hover:text-blue-600 transition-colors" href="#">CONTACT</a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                    <div class="flex items-center gap-6">
                        <div class="relative hidden md:block">
                            <input 
                                type="text" 
                                placeholder="Search products..." 
                                class="w-64 px-4 py-2 border border-gray-300 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            >
                            <button class="absolute right-3 top-2 text-gray-500 hover:text-blue-600">
                                <i class='bx bx-search text-xl'></i>
                            </button>
                        </div>

                       <div class="flex items-center gap-4">
                            <a href="#" class="p-2 text-gray-700 hover:text-amber-500 transition-colors relative" aria-label="Wishlist">
                                <i class='bx bx-heart text-2xl'></i>
                                <span class="absolute -top-1 -right-1 bg-blue-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">0</span>
                            </a>

                            <a href="{{ route('cart.index') }}" class="p-2 text-gray-700 hover:text-amber-500 transition-colors relative" aria-label="Cart">
                                <i class='bx bx-cart text-2xl'></i>
                                <span id="cart-count" class="absolute -top-1 -right-1 bg-blue-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">0</span>
                            </a>


                            @auth
                            <a href="{{ route('profile.edit') }}">
                                <div class="flex flex-col items-center text-sm text-center">
                                    <div class="flex items-center gap-2">
                                        <i class='bx bx-user text-2xl text-gray-700'></i> {{-- Icon color reset to default gray --}}
                                        <span class="font-semibold text-black">{{ Auth::user()->name }}</span>
                                    </div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="text-red-500 hover:underline text-sm">Log out</button>
                                    </form>
                                </div>
                            </a>
                            @else
                                <a href="{{ route('account') }}" class="flex items-center space-x-1 text-gray-700 hover:text-blue-600 transition-colors">
                                    <i class='bx bx-user text-2xl'></i>
                                </a>
                            @endauth
                        </div>

                        <div class="block md:hidden">
                            <button class="rounded-sm bg-gray-100 p-2 text-gray-700 transition hover:text-blue-600" aria-label="Menu">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>

    <main>
        @yield('content')
    </main>
  <div class="fixed bottom-6 right-6 z-50">
    <a href="https://wa.me/yourphonenumber" target="_blank">
        <img src="{{ asset('images/whatsapp.png') }}" alt="WhatsApp" class="w-10 h-10">
    </a>
</div>
</body>
    <footer class="px-4 bg-gray-100 text-gray-800">
    <div class="container flex flex-col justify-between py-10 mx-auto space-y-8 lg:flex-row lg:space-y-0">
        <div class="lg:w-1/3 flex justify-center lg:justify-start mb-16"style="margin-bottom:90px;">
            <a href="/" class="flex items-center">
                <img 
                    src="{{ asset('images/SalmanLogo2.png') }}" 
                    alt="Salman Electric Logo" 
                    class="h-14 w-auto"  
                >
            </a>
        </div>

        <div class="grid grid-cols-2 text-sm sm:grid-cols-3 mx-auto gap-12"> 
            <div class="space-y-4"> 
                <h3 class="text-lg font-bold text-gray-900 uppercase tracking-wider mb-4">Stay In Touch</h3>
                <ul class="space-y-3 text-base"> 
                    <li>
                        <a href="#" class="hover:text-blue-600 transition-colors">Contact Us</a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-blue-600 transition-colors">About Us</a>
                    </li>
                </ul>
            </div>
            
            <div class="space-y-4">
                <h3 class="text-lg font-bold text-gray-900 uppercase tracking-wider mb-4">Company</h3>
                <ul class="space-y-3 text-base">
                    <li>
                        <a href="#" class="hover:text-blue-600 transition-colors">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-blue-600 transition-colors">Return and Exchange Policy</a>
                    </li>
                </ul>
            </div>
            
            <div class="space-y-4">
                <h3 class="text-lg font-bold text-gray-900 uppercase tracking-wider mb-4">Reach Out</h3>
                <ul class="space-y-3 text-base">
                    <li>
                        <a href="#" class="hover:text-blue-600 transition-colors">+961 76 765 561</a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-blue-600 transition-colors">+961 81 966 742</a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-blue-600 transition-colors">walidsalman@gmail.com</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="lg:w-1/3 flex flex-col items-center lg:items-end space-y-4 mt-4">
    <h3 class="text-lg font-bold text-gray-900 uppercase tracking-wider mb-4">Our Socials</h3>
    
    <div class="flex space-x-5">
        <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors text-2xl">
            <i class='bx bxl-facebook'></i>
        </a>
        <a href="#" class="text-gray-600 hover:text-blue-400 transition-colors text-2xl">
            <i class='bx bxl-twitter'></i>
        </a>
        <a href="#" class="text-gray-600 hover:text-pink-500 transition-colors text-2xl">
            <i class='bx bxl-instagram'></i>
        </a>
        <a href="#" class="text-gray-600 hover:text-red-600 transition-colors text-2xl">
            <i class='bx bxl-youtube'></i>
        </a>
    </div>
    
    <a href="https://maps.google.com/?q=Your+Business+Address" 
       target="_blank" 
       class="flex items-center text-gray-600 hover:text-blue-600 transition-colors mt-4">
        <i class='bx bx-map text-2xl mr-2'></i>
        <span class="text-sm">Our Location</span>
    </a>
</div>
    </div>
    
  <div class="py-6 text-base text-center text-gray-600 border-t border-gray-200 mt-8">
    © {{ date('Y') }} Salman Electric. All rights reserved.
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        updateCartCount();

        document.querySelectorAll('.cart-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const button = form.querySelector('.add-to-cart');
                const productId = button.getAttribute('data-product-id');
                const quantity = button.getAttribute('data-quantity');

                fetch(`/cart/add/${productId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ quantity: quantity })
                })
                .then(res => res.json())
                .then(data => {
                    updateCartCount();
                })
                .catch(error => console.error('Error:', error));
            });
        });
    });

    function updateCartCount() {
        fetch('/cart/count')
            .then(res => res.json())
            .then(data => {
                document.getElementById('cart-count').innerText = data.count;
            });
    }
</script>
</footer>
</html>
