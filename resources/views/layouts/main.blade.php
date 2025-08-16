<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="icon" type="image/png" href="{{ asset('images/salman.png') }}?v={{ time() }}">
  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @yield('head') 
</head>
<style>
  body {
    font-family: 'Urbanist', sans-serif !important;
    padding-top: 40px;  
    margin: 0;          
    padding-left: 0;
    padding-right: 0;
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

  @media (max-width: 767px) {
    body {
      padding-top: 60px; 
    }
    
    .logo-container {
      display: flex;
      justify-content: center;
      width: 100%;
      position: absolute;
      left: 0;
    }
    
    header .mx-auto {
      position: relative;
    }
    
    #mobileSearchToggle {
      position: relative;
      z-index: 10;
    }
    
    .flex.items-center.justify-between.md\:h-20 {
      height: 60px; 
    }
  }

  @media (max-width: 767px) {
    #mobileMenu {
      position: fixed;
      top: 0;
      right: -280px;
      width: 280px;
      height: 100vh;
      background-color: #0c1033;
      color: white;
      padding: 2rem 1.5rem;
      z-index: 60;
      transition: transform 0.3s ease;
      display: flex;
      flex-direction: column;
      overflow-y: auto;
    }

    #mobileMenu.open {
      transform: translateX(-280px);
    }

    #mobileMenu .close-btn {
      position: absolute;
      top: 1.2rem;
      right: 1.2rem;
      font-size: 2rem;
      cursor: pointer;
      color: white;
    }

    #menuOverlay {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0,0,0,0.5);
      z-index: 55;
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
    }

    #menuOverlay.active {
      opacity: 1;
      visibility: visible;
    }

    #mobileMenu .search-input {
      width: 100%;
      padding: 0.7rem 1rem;
      border-radius: 999px;
      border: none;
      background: white;
      color: #333;
      font-size: 0.9rem;
      margin-bottom: 1.5rem;
    }

    #mobileMenu nav a {
      color: white;
      font-weight: bold;
      text-transform: uppercase;
      margin: 0.6rem 0;
      display: block;
      font-size: 0.9rem;
    }

    #mobileMenu nav a:hover { 
      color: #c72c2c; 
    }

    #mobileMenu .social-icons {
      display: flex;
      gap: 1rem;
      font-size: 1.4rem;
      margin-top: auto;
    }
  }

  @media (max-width: 1023px) {
    .footer-mobile-center {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
    }
    
    .footer-mobile-center > div {
      width: 100%;
      max-width: 280px;
      margin-bottom: 2rem;
    }
    
    .footer-mobile-center .footer-logo {
      margin-bottom: 1.5rem;
    }
    
    .footer-mobile-center .footer-socials {
      margin-top: 1rem;
    }
    
    @media (min-width: 768px) {
      .footer-mobile-center .footer-nav-sections {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 2.5rem;
      }
      
      .footer-mobile-center .footer-nav-sections > div {
        width: 100%;
        max-width: 220px;
      }
    }
  }

  /* New mobile-specific styles */
  @media (max-width: 767px) {
    /* Hide desktop search on mobile */
    .desktop-search {
      display: none;
    }

    /* Adjust header layout for mobile */
    header .flex.items-center.justify-between {
      padding-left: 0.5rem;
      padding-right: 0.5rem;
    }

    /* Center logo on mobile */
    .logo-container {
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
    }

    /* Adjust icon sizes for mobile */
    .mobile-icons .bx {
      font-size: 1.5rem;
    }

    /* Make cart/wishlist icons closer together */
    .mobile-icons > a {
      padding: 0.5rem;
    }

    /* Mobile menu search input */
    #mobileMenu input[type="text"] {
      width: 100%;
      padding: 0.75rem 1rem;
      border-radius: 999px;
      margin-bottom: 1.5rem;
      border: none;
      background: rgba(255,255,255,0.9);
    }
  }

  /* Tablet styles */
  @media (min-width: 768px) and (max-width: 1023px) {
    /* Adjust header padding */
    header .flex.items-center.justify-between {
      padding-left: 1rem;
      padding-right: 1rem;
    }

    /* Make search bar slightly smaller */
    .desktop-search {
      max-width: 300px;
    }
  }
</style>
<body>
<div class="sticky-header hidden md:block">
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
          <a href="#" class="text-gray-600 hover:text-pink-500 transition-colors"><i class='bx bxl-instagram'></i></a>
        </div>
      </div>
    </div>
  </div>
</div>

  <header class="sticky top-0 z-50 bg-white shadow-md tracking-wide font-[Urbanist]">
    <div class="flex items-center justify-between w-full px-4 sm:px-5 lg:px-6 min-h-[70px]">
      <div class="flex items-center gap-3 lg:gap-8 xl:gap-10">

        <a href="/" class="shrink-0">
          <img src="{{ asset('images/S8.PNG') }}" alt="logo" class="hidden sm:block w-36 lg:w-40 h-auto lg:ml-[20px] xl:ml-[130px]">
          <img src="{{ asset('images/S8.PNG') }}" alt="logo" class="block sm:hidden w-20 h-auto">
        </a>

        <div id="collapseMenu" class="hidden lg:block">
          <ul class="flex gap-x-3 lg:gap-x-4 xl:gap-x-6">
            <li><a href="/home" class="block text-[14px] lg:text-[15px] font-medium {{ request()->is('home') ? 'text-blue-700' : 'text-slate-900 hover:text-blue-700' }}">Home</a></li>
            <li><a href="/shop" class="block text-[14px] lg:text-[15px] font-medium {{ request()->is('shop') || request()->is('shop/*') ? 'text-blue-700' : 'text-slate-900 hover:text-blue-700' }}">Shop</a></li>
            <li><a href="/about" class="block text-[14px] lg:text-[15px] font-medium {{ request()->is('about') ? 'text-blue-700' : 'text-slate-900 hover:text-blue-700' }}">About</a></li>
            <li><a href="/contact" class="block text-[14px] lg:text-[15px] font-medium {{ request()->is('contact') ? 'text-blue-700' : 'text-slate-900 hover:text-blue-700' }}">Contact</a></li>
            <li><a href="/portfolio" class="block text-[14px] lg:text-[15px] font-medium {{ request()->is('portfolio') || request()->is('portfolio/*') ? 'text-blue-700' : 'text-slate-900 hover:text-blue-700' }}">Portfolio</a></li>
          </ul>
        </div>
      </div>

      <div class="flex items-center gap-1 sm:gap-2 lg:gap-3 xl:gap-4">

        <div class="desktop-search relative hidden sm:flex items-center w-[160px] md:w-[180px] lg:w-[220px] xl:w-[280px] 2xl:w-[320px] mx-auto rounded-full bg-white shadow-sm border border-gray-200 focus-within:border-amber-400 focus-within:ring-1 focus-within:ring-amber-400 transition-all duration-200">
          <input 
            type="text" 
            name="q" 
            placeholder="Search..." 
            class="w-full py-[6px] lg:py-2 pl-3 lg:pl-4 xl:pl-5 pr-8 lg:pr-10 text-gray-700 rounded-full focus:outline-none bg-transparent text-xs lg:text-sm xl:text-base"
            autocomplete="off"
          >
          <button 
            type="submit" 
            class="absolute right-0 px-2 lg:px-3 xl:px-4 text-gray-400 hover:text-amber-500 transition-colors duration-200"
          >
            <i class='bx bx-search text-base lg:text-lg xl:text-xl'></i>
          </button>
        </div>
        
        <div class="mobile-icons flex items-center gap-1 sm:gap-2 lg:gap-3 xl:gap-4">
          <a href="{{ route('wishlist.index') }}" class="relative p-1 sm:p-1.5 lg:p-2 text-gray-700 hover:text-amber-500">
            <i class='bx bx-heart text-lg sm:text-xl lg:text-2xl'></i>
            <span id="heart-count" class="absolute -top-1 -right-1 bg-blue-600 text-white text-[10px] xs:text-xs rounded-full h-4 w-4 xs:h-5 xs:w-5 flex items-center justify-center"></span>
          </a>

          <a href="{{ route('cart.index') }}" class="relative p-1 sm:p-1.5 lg:p-2 text-gray-700 hover:text-amber-500">
            <i class='bx bx-cart text-lg sm:text-xl lg:text-2xl'></i>
            <span id="cart-count" class="absolute -top-1 -right-1 bg-blue-600 text-white text-[10px] xs:text-xs rounded-full h-4 w-4 xs:h-5 xs:w-5 flex items-center justify-center"></span>
          </a>

          @guest
            <a href="/account" class="p-1 sm:p-1.5 lg:p-2 text-gray-700 hover:text-amber-500">
              <i class='bx bx-user text-lg sm:text-xl lg:text-2xl'></i>
            </a>
          @endguest

          @auth
          <div class="relative" x-data="{ open: false }">
            <button 
              @click="open = !open" 
              class="p-1 sm:p-1.5 lg:p-2 text-gray-700 hover:text-amber-500 focus:outline-none"
            >
              <i class='bx bx-user text-lg sm:text-xl lg:text-2xl'></i>
            </button>

            <div 
              x-show="open" 
              @click.away="open = false"
              x-transition
              class="absolute right-0 mt-2 w-52 bg-white border border-gray-100 rounded-lg shadow-lg z-50"
            >
              <a href="{{ url('/profile') }}" 
                class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-gray-100">
                <i class='bx bx-user-circle text-lg'></i> Account
              </a>

              <a href="{{ url('/profile/orders') }}" 
                class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-gray-100">
                <i class='bx bx-package text-lg'></i> Orders
              </a>

              <a href="{{ url('/redeem') }}" 
                class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-gray-100">
                <i class='bx bx-gift text-lg'></i> Redeem Code
              </a>

              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                  class="w-full text-left flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-gray-100">
                  <i class='bx bx-log-out text-lg'></i> Logout
                </button>
              </form>
            </div>
          </div>
          @endauth


          <button id="toggleOpen" class="lg:hidden p-1 sm:p-1.5">
            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="#000" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
            </svg>
          </button>
        </div>
      </div>
    </div>

    <div id="mobileMenu" class="fixed top-0 right-0 h-full w-64 bg-[#0c1033] shadow-lg transform translate-x-full transition-transform duration-300 z-50 flex flex-col p-6">
    </div>

    <div id="menuOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 opacity-0 invisible transition-opacity duration-300"></div>
  </header>

    <main>
        @if(session('message_type') === 'success')
            <div id="flashMessage" class="fixed top-4 right-4 max-w-md w-full z-50 transition-all duration-300 transform">
                <div class="bg-white rounded-lg shadow-lg border border-green-200 overflow-hidden">
                    <div class="flex items-start justify-between p-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-lg font-medium text-gray-900">Success!</h3>
                                <div class="mt-1 text-sm text-gray-600">
                                    {{ session('message') }}
                                </div>
                                <div class="mt-2">
                                    <a href="{{ route('shop') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500 underline">
                                        Go to Shop →
                                    </a>
                                </div>
                            </div>
                        </div>
                        <button type="button" onclick="closeFlashMessage()" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    <div class="bg-green-500 h-1 w-full" id="progressBar"></div>
                </div>
            </div>

            <script>
                let timeLeft = 100;
                const progressBar = document.getElementById('progressBar');
                const interval = setInterval(() => {
                    timeLeft -= 1;
                    progressBar.style.width = timeLeft + '%';
                    if(timeLeft <= 0) {
                        clearInterval(interval);
                        closeFlashMessage();
                    }
                }, 50);

                function closeFlashMessage() {
                    const flashMessage = document.getElementById('flashMessage');
                    flashMessage.classList.add('opacity-0', 'translate-y-2');
                    setTimeout(() => flashMessage.remove(), 300);
                }

                document.getElementById('flashMessage').querySelector('button').addEventListener('click', closeFlashMessage);
            </script>
        @endif
      @yield('content')
    </main>
  <div class="fixed bottom-6 right-6 z-50">
    <a href="https://wa.me/yourphonenumber" target="_blank">
        <img src="{{ asset('images/whatsapp.png') }}" alt="WhatsApp" class="w-10 h-10">
    </a>
</div>
</body>

<footer class="bg-white text-gray-800">
  <div class="container mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-5 gap-8 max-w-screen-xl text-center md:text-left">

    <!-- Logo + Extra Info -->
    <div class="flex flex-col items-center md:items-start">
      <a href="/" class="flex items-center mb-4">
        <img src="{{ asset('images/SalmanLogo2.png') }}" alt="Salman Electric Logo" class="h-12 object-contain">
      </a>
      <p class="text-sm text-gray-600">Your Trusted Solar & Electric Solutions</p>
    </div>
    
         <!-- Keep in Touch -->
<div class="flex flex-col items-center md:items-start md:ml-[25px]">
      <h3 class="font-bold text-lg uppercase mb-4 text-gray-900">Keep In Touch</h3>
      <ul class="space-y-2 text-sm">
        <li><a href="#" class="hover:text-blue-600 transition-colors">About Us</a></li>
        <li><a href="#" class="hover:text-blue-600 transition-colors">Contact Us</a></li>
      </ul>
    </div>




    <div class="flex flex-col items-center md:items-start">
      <h3 class="font-bold text-lg uppercase mb-4 text-gray-900">Useful Links</h3>
      <ul class="space-y-2 text-sm">
        <li><a href="#" class="hover:text-blue-600 transition-colors">Privacy Policy</a></li>
        <li><a href="#" class="hover:text-blue-600 transition-colors">Return & Exchange Policy</a></li>
      </ul>
    </div>
    
    <div class="flex flex-col items-center md:items-start">
      <h3 class="font-bold text-lg uppercase mb-4 text-gray-900">Contact Us</h3>
      <ul class="space-y-2 text-sm">
        <li><a href="tel:+96176765561" class="hover:text-blue-600 transition-colors">+961 76 765 561</a></li>
        <li><a href="tel:+96181966742" class="hover:text-blue-600 transition-colors">+961 81 966 742</a></li>
        <li><a href="mailto:walidsalman@gmail.com" class="hover:text-blue-600 transition-colors">walidsalman@gmail.com</a></li>
      </ul>
    </div>

    <div class="flex flex-col items-center md:items-start">
      <h3 class="font-bold text-lg uppercase mb-4 text-gray-900">Follow Us</h3>
      <div class="flex space-x-4">
        <a href="https://facebook.com" target="_blank" aria-label="Facebook" class="text-gray-600 hover:text-blue-600 text-xl transition">
          <i class='bx bxl-facebook'></i>
        </a>
        <a href="https://instagram.com" target="_blank" aria-label="Instagram" class="text-gray-600 hover:text-pink-500 text-xl transition">
          <i class='bx bxl-instagram'></i>
        </a>
        <a href="https://maps.google.com/?q=Your+Business+Address" target="_blank" aria-label="Google Maps" class="text-gray-600 hover:text-red-600 text-xl transition">
          <i class='bx bx-map'></i>
        </a>
      </div>
    </div>
  </div>

  <div class="border-t border-gray-300 py-6 text-center text-sm text-gray-600 relative">
    <p>© {{ date('Y') }} Salman Electric. All rights reserved.</p>
    <a href="#" class="absolute right-1/2 top-[-20px] transform translate-x-1/2 bg-gray-200 p-2 rounded hover:bg-gray-300 transition">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
      </svg>
    </a>
  </div>
</footer>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/wishlist.js') }}"></script>

<script>

  document.addEventListener('DOMContentLoaded', function () {
      const toggleOpen = document.getElementById('toggleOpen');
      const toggleClose = document.getElementById('toggleClose');
      const mobileMenu = document.getElementById('mobileMenu');
      const menuOverlay = document.getElementById('menuOverlay');

      if (toggleOpen) {
          toggleOpen.addEventListener('click', function () {
              mobileMenu.classList.add('open');
              menuOverlay.classList.add('active');
              document.body.style.overflow = 'hidden'; 
          });
      }

    
      if (toggleClose) {
          toggleClose.addEventListener('click', function () {
              mobileMenu.classList.remove('open');
              menuOverlay.classList.remove('active');
              document.body.style.overflow = ''; 
          });
      }

      if (menuOverlay) {
          menuOverlay.addEventListener('click', function() {
              mobileMenu.classList.remove('open');
              menuOverlay.classList.remove('active');
              document.body.style.overflow = ''; 
          });
      }

    updateCartCount();
    updateWishlistCount();

    document.querySelectorAll('.add-to-wishlist').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const productId = this.getAttribute('data-product-id');
            const heartIcon = this.querySelector('i');

            fetch(`/wishlist`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ product_id: productId })
            })
            .then(res => res.json())
            .then(data => {
                updateWishlistCount();

                if (data.inWishlist) {
                    heartIcon.classList.remove('bx-heart', 'text-gray-400');
                    heartIcon.classList.add('bxs-heart', 'text-red-500');
                } else {
                    heartIcon.classList.remove('bxs-heart', 'text-red-500');
                    heartIcon.classList.add('bx-heart', 'text-gray-400');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });

    const mobileSearchToggle = document.getElementById('mobileSearchToggle');
    if (mobileSearchToggle) {
        mobileSearchToggle.addEventListener('click', function() {
            const searchBar = document.getElementById('mobileSearchBar');
            searchBar.classList.toggle('hidden');
        });
    }

    function updateCartCount() {
        fetch('/cart/count')
            .then(res => res.json())
            .then(data => {
                document.getElementById('cart-count').innerText = data.count;
                const mobileCart = document.getElementById('cart-count-mobile');
                if (mobileCart) mobileCart.innerText = data.count;
            });
    }

    function updateWishlistCount() {
        fetch('/wishlist/count')
            .then(res => res.json())
            .then(data => {
                document.getElementById('heart-count').innerText = data.count;
                const mobileHeart = document.getElementById('heart-count-mobile');
                if (mobileHeart) mobileHeart.innerText = data.count;
            });
    }
  });

  document.addEventListener("DOMContentLoaded", function () {
      const userMenuButton = document.getElementById("userMenuButton");
      const userDropdown = document.getElementById("userDropdown");

      if (userMenuButton) {
          userMenuButton.addEventListener("click", function (e) {
              e.stopPropagation();
              userDropdown.classList.toggle("hidden");
          });

          document.addEventListener("click", function () {
              if (!userDropdown.classList.contains("hidden")) {
                  userDropdown.classList.add("hidden");
              }
          });
      }
  });
</script>
</html>
