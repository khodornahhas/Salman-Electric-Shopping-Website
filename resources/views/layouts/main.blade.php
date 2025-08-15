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
  <div class="flex flex-wrap items-center justify-between w-full px-4 sm:px-6 lg:px-10 min-h-[70px]">

    <a href="/" class="hidden sm:block shrink-0">
      <img src="{{ asset('images/S8.PNG') }}" alt="logo" class="w-40 h-auto">
    </a>

    <a href="/" class="block sm:hidden shrink-0">
      <img src="{{ asset('images/S8.PNG') }}" alt="logo" class="w-20 h-auto">
    </a>

    <div id="collapseMenu" class="hidden lg:block">
      <ul class="flex justify-center gap-x-6">
        <li><a href="/home" class="block text-[15px] font-medium {{ request()->is('home') ? 'text-blue-700' : 'text-slate-900 hover:text-blue-700' }}">Home</a></li>
        <li><a href="/shop" class="block text-[15px] font-medium {{ request()->is('shop') || request()->is('shop/*') ? 'text-blue-700' : 'text-slate-900 hover:text-blue-700' }}">Shop</a></li>
        <li><a href="/about" class="block text-[15px] font-medium {{ request()->is('about') ? 'text-blue-700' : 'text-slate-900 hover:text-blue-700' }}">About</a></li>
        <li><a href="/contact" class="block text-[15px] font-medium {{ request()->is('contact') ? 'text-blue-700' : 'text-slate-900 hover:text-blue-700' }}">Contact</a></li>
        <li><a href="/portfolio" class="block text-[15px] font-medium {{ request()->is('portfolio') || request()->is('portfolio/*') ? 'text-blue-700' : 'text-slate-900 hover:text-blue-700' }}">Portfolio</a></li>
      </ul>
    </div>

    <div class="flex items-center gap-3 sm:gap-4 ml-auto lg:ml-0">
      <a href="{{ route('wishlist.index') }}" class="relative p-2 text-gray-700 hover:text-amber-500">
        <i class='bx bx-heart text-2xl'></i>
        <span id="heart-count" class="absolute -top-1 -right-1 bg-blue-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center"></span>
      </a>
      <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-700 hover:text-amber-500">
        <i class='bx bx-cart text-2xl'></i>
        <span id="cart-count" class="absolute -top-1 -right-1 bg-blue-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center"></span>
      </a>
      @guest
        <a href="/account" class="p-2 text-gray-700 hover:text-amber-500">
            <i class='bx bx-user text-2xl'></i>
        </a>
      @endguest
      @auth
      <div class="relative">
          <button id="userMenuButton" class="p-2 text-gray-700 hover:text-amber-500 focus:outline-none">
              <i class='bx bx-user text-2xl'></i>
          </button>

          <div id="userDropdown" 
              class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-100 rounded-lg shadow-lg z-50">
              <a href="/profile" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  <i class='bx bx-user-circle mr-2 text-lg'></i> Account
              </a>
              <a href="{{ route('orders.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  <i class='bx bx-package mr-2 text-lg'></i> Orders
              </a>
              
              {{-- Trigger for Modal --}}
              <button type="button" id="openPromoModal" 
                  class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  <i class='bx bx-purchase-tag-alt mr-2 text-lg'></i> Redeem Promo Code
              </button>

              <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" 
                          class="w-full flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                      <i class='bx bx-log-out mr-2 text-lg'></i> Logout
                  </button>
              </form>
          </div>
      </div>

    <div id="promoModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
      <div class="max-w-md w-full bg-white p-6 rounded-lg shadow-md relative">
          <button type="button" id="closePromoModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl">
              &times;
          </button>

          <h2 class="text-xl font-bold mb-4">Redeem Promo Code</h2>
            @if($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 relative rounded">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            @foreach($errors->all() as $error)
                                <p class="font-medium">{{ $error }}</p>
                            @endforeach
                        </div>
                        <button type="button" onclick="this.parentElement.parentElement.remove()" 
                            class="text-red-700 hover:text-red-900 ml-4 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            @endif
            <form method="POST" action="{{ route('user.promocodes.apply') }}">
                @csrf
                <label for="code" class="block font-medium mb-1">Promo Code</label>
                <input type="text" name="code" id="code" maxlength="8"
                    class="w-full border px-3 py-2 rounded mb-4" required>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Apply
                </button>
            </form>
        </div>
    </div>


    <script>
      const promoModal = document.getElementById('promoModal');
      const openBtn = document.getElementById('openPromoModal');
      const closeBtn = document.getElementById('closePromoModal');

      openBtn.addEventListener('click', () => {
          promoModal.classList.remove('hidden');
          document.getElementById('code').focus();
      });

      closeBtn.addEventListener('click', () => {
          promoModal.classList.add('hidden');
      });

      promoModal.addEventListener('click', (e) => {
          if (e.target === promoModal) {
              promoModal.classList.add('hidden');
          }
      });

      @if(session('message_type') === 'success')
          promoModal.classList.add('hidden');
      @elseif($errors->any())
          promoModal.classList.remove('hidden');
          document.getElementById('code').focus();
      @endif
    </script>

      @endauth


      <button id="toggleOpen" class="lg:hidden p-2">
        <svg class="w-7 h-7" fill="#000" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd"
            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
            clip-rule="evenodd"></path>
        </svg>
      </button>
    </div>
  </div>

    <div id="mobileMenu" class="fixed top-0 right-0 h-full w-64 bg-[#0c1033] shadow-lg transform translate-x-full transition-transform duration-300 z-50 flex flex-col p-6">
      <button id="toggleClose" class="self-end mb-6 p-2 text-white hover:text-red-500">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>

      <input type="text" placeholder="Search..." class="mb-6 p-3 border-0 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">

      <ul class="flex flex-col gap-4">
        <li><a href="/home" class="text-white font-medium hover:text-red-500 uppercase text-sm">Home</a></li>
        <li><a href="/shop" class="text-white font-medium hover:text-red-500 uppercase text-sm">Shop</a></li>
        <li><a href="/about" class="text-white font-medium hover:text-red-500 uppercase text-sm">About</a></li>
        <li><a href="/contact" class="text-white font-medium hover:text-red-500 uppercase text-sm">Contact</a></li>
        <li><a href="/portfolio" class="text-white font-medium hover:text-red-500 uppercase text-sm">Portfolio</a></li>
      </ul>

      <div class="mt-auto pt-6">
        <div class="flex gap-4 text-white text-xl mb-6">
          <a href="#" class="hover:text-red-500"><i class='bx bxl-facebook'></i></a>
          <a href="#" class="hover:text-red-500"><i class='bx bxl-instagram'></i></a>
          <a href="#" class="hover:text-red-500"><i class='bx bxl-twitter'></i></a>
        </div>
      </div>
    </div>

      <div id="menuOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 opacity-0 invisible transition-opacity duration-300"></div>
    </header>
  </div>

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

<footer class="px-4 bg-gray-100 text-gray-800 footer-mobile-center">
    <div class="container flex flex-col lg:flex-row justify-between py-10 mx-auto space-y-8 lg:space-y-0 max-w-screen-xl">
        <div class="footer-logo lg:w-1/3 flex justify-center lg:justify-start">
            <a href="/" class="flex items-center max-w-[280px]">
                <img 
                    src="{{ asset('images/SalmanLogo2.png') }}" 
                    alt="Salman Electric Logo" 
                    class="h-auto w-full max-h-14 object-contain"
                >
            </a>
        </div>

        <div class="lg:grid lg:grid-cols-3 text-sm gap-8 sm:gap-12 w-full lg:w-1/3">
            <div class="space-y-3 sm:space-y-4"> 
                <h3 class="text-base sm:text-lg font-bold text-gray-900 uppercase tracking-wider mb-2 sm:mb-4">Stay In Touch</h3>
                <ul class="space-y-2 sm:space-y-3 text-sm sm:text-base"> 
                    <li>
                        <a href="#" class="hover:text-blue-600 transition-colors">Contact Us</a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-blue-600 transition-colors">About Us</a>
                    </li>
                </ul>
            </div>

            <div class="space-y-3 sm:space-y-4">
                <h3 class="text-base sm:text-lg font-bold text-gray-900 uppercase tracking-wider mb-2 sm:mb-4">Company</h3>
                <ul class="space-y-2 sm:space-y-3 text-sm sm:text-base">
                    <li>
                        <a href="#" class="hover:text-blue-600 transition-colors">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-blue-600 transition-colors">Return and Exchange Policy</a>
                    </li>
                </ul>
            </div>

            <div class="space-y-3 sm:space-y-4">
                <h3 class="text-base sm:text-lg font-bold text-gray-900 uppercase tracking-wider mb-2 sm:mb-4">Reach Out</h3>
                <ul class="space-y-2 sm:space-y-3 text-sm sm:text-base">
                    <li>
                        <a href="tel:+96176765561" class="hover:text-blue-600 transition-colors">+961 76 765 561</a>
                    </li>
                    <li>
                        <a href="tel:+96181966742" class="hover:text-blue-600 transition-colors">+961 81 966 742</a>
                    </li>
                    <li>
                        <a href="mailto:walidsalman@gmail.com" class="hover:text-blue-600 transition-colors">walidsalman@gmail.com</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer-socials lg:w-1/3 flex flex-col items-center lg:items-end space-y-3 sm:space-y-4 mt-8 lg:mt-0">
            <h3 class="text-base sm:text-lg font-bold text-gray-900 uppercase tracking-wider mb-2 sm:mb-4">Our Socials</h3>

            <div class="flex space-x-4 sm:space-x-5">
                <a href="#" aria-label="Facebook" class="text-gray-600 hover:text-blue-600 transition-colors text-xl sm:text-2xl">
                    <i class='bx bxl-facebook'></i>
                </a>
                <a href="#" aria-label="Instagram" class="text-gray-600 hover:text-pink-500 transition-colors text-xl sm:text-2xl">
                    <i class='bx bxl-instagram'></i>
                </a>
                 <a href="https://maps.google.com/?q=Your+Business+Address" 
                target="_blank" 
                rel="noopener noreferrer"
                class="text-gray-600 hover:text-red-600 transition-colors text-xl sm:text-2xl">
                <i class='bx bx-map text-xl sm:text-2xl mr-2'></i></a>
            </div>
        </div>
    </div>

    <div class="py-6 text-sm sm:text-base text-center text-gray-700 border-t border-gray-300 mt-8">
        © {{ date('Y') }} Salman Electric. All rights reserved.
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
