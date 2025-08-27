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
    <script defer src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="{{ asset('js/wishlist.js') }}"></script>

    @yield('head') 
</head>

<style>
  body {
    font-family: 'Urbanist', sans-serif !important;
    padding-top: 0px;  
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

  @media (max-width: 1023px) {
    #toggleOpen {
      display: block !important;
    }
    
    #collapseMenu {
      display: none;
    }
  }

  @media (max-width: 767px) {
    body {
      padding-top: 0px; 
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

  #mobileMenu {
    position: fixed;
    top: 0;
    right: -280px;
    width: 280px;
    height: 100vh;
    background-color: #0E2795;
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
      background: none;
      border: none;
      width: 30px;
      height: 30px;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 70;
  }

  #mobileMenu .close-btn:hover {
      color: #023d03ff;
  }

  .mobile-menu-header {
      position: relative;
      margin-bottom: 1.5rem;
      padding-right: 40px; 
  }

  .mobile-menu-close-container {
      position: absolute;
      top: 0;
      right: 0;
      z-index: 70;
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

  #mobileMenu nav {
      display: flex;
      flex-direction: column;
      gap: 1rem;
  }

  #mobileMenu nav a {
      color: white;
      font-weight: bold;
      text-transform: uppercase;
      display: block;
      font-size: 0.9rem;
      padding: 0.5rem 0;
      border-bottom: 1px solid rgba(255,255,255,0.1);
  }

  #mobileMenu nav a:hover { 
      color: #abababff; 
  }

  #mobileMenu .social-icons {
      display: flex;
      gap: 1rem;
      font-size: 1.4rem;
      margin-top: auto;
      padding-top: 2rem;
      justify-content: center;
  }

  #mobile-search-results {
      max-height: 80vh;
      overflow-y: auto;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      border-radius: 8px;
      border: 1px solid #e5e7eb;
  }

  #mobile-search-results a {
      transition: background-color 0.2s ease;
  }

  #mobile-search-results .bg-gray-100 {
      background-color: #f3f4f6;
  }

  #mobile-search-results .border-b {
      border-bottom: 1px solid #e5e7eb;
  }

  #mobile-search-results::-webkit-scrollbar {
      display: none;
  }

  #mobile-search-results {
      -ms-overflow-style: none;
      scrollbar-width: none;
  }

  @media (max-width: 767px) {
    .shrink-0 img {
      width: 150px !important; 
      margin: 0 auto;
    }
  }

  @media (min-width: 768px) and (max-width: 1023px) {
    .shrink-0 img {
      width: 180px !important;
    }
  }

  @media (min-width: 1024px) and (max-width: 1148px) {
    .shrink-0 img {
      width: 180px !important; 
    }
  }

  @media (min-width: 1149px) and (max-width: 1279px) {
    .shrink-0 img {
      width: 200px !important;
    }
  }

  @media (min-width: 1280px) {
    .shrink-0 img {
      width: 220px !important;
    }
  }

  @media (min-width: 1536px) {
    .shrink-0 img {
      width: 250px !important;
    }
  }
  @media (max-width: 767px) {
    .desktop-search {
      display: none;
    }

    header .flex.items-center.justify-between {
      padding-left: 0.5rem;
      padding-right: 0.5rem;
    }

    .logo-container {
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
    }

    .mobile-icons .bx {
      font-size: 1.5rem;
    }

    .mobile-icons > a {
      padding: 0.5rem;
    }
  }

  @media (min-width: 768px) and (max-width: 1023px) {
    header .flex.items-center.justify-between {
      padding-left: 1rem;
      padding-right: 1rem;
    }

    .desktop-search {
      max-width: 300px;
    }
  }
  
  #heart-count, #cart-count {
    opacity: 1 !important;
    transition: none !important;
  }
  
  .counter-loading {
    visibility: hidden;
  }

  #search-results {
      width: 450px;
      max-height: none !important;
      overflow-y: visible !important;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
      border-radius: 12px;
      border: 1px solid #e5e7eb;
  }

  #search-results a {
      transition: background-color 0.2s ease;
  }

  #search-results .bg-gray-100 {
      background-color: #f3f4f6;
  }

  #search-results .border-b {
      border-bottom: 1px solid #e5e7eb;
  }

  #search-results::-webkit-scrollbar {
      display: none;
  }

  #search-results {
      -ms-overflow-style: none;
      scrollbar-width: none;
  }

  @media (min-width: 1024px) and (max-width: 1410px) {
    .flex.items-center.justify-between.w-full.px-4 {
      flex-wrap: nowrap;
      padding-left: 1rem;
      padding-right: 1rem;
    }
    
    .desktop-search {
      width: 280px !important;
      min-width: 280px;
      margin: 0 0.5rem;
    }
    
    .shrink-0 {
      margin-right: 0.5rem;
    }
    
    #collapseMenu ul {
      gap: 0.75rem;
    }
    
    #collapseMenu ul li a {
      font-size: 16px;
    }
    
    .mobile-icons {
      gap: 0.5rem;
    }
  }

  @media (min-width: 1024px) and (max-width: 1280px) {
    .desktop-search {
      width: 240px !important;
      min-width: 240px;
    }
    
    #collapseMenu ul {
      gap: 0.5rem;
    }
    
    #collapseMenu ul li a {
      font-size: 15px;
    }
  }

  @media (min-width: 1024px) and (max-width: 1149px) {
    .flex.items-center.justify-between.w-full.px-4 {
      flex-wrap: nowrap;
      padding-left: 0.5rem;
      padding-right: 0.5rem;
    }
    
    .desktop-search {
      width: 200px !important;
      min-width: 200px;
      margin: 0 0.25rem;
    }
    
   .shrink-0 img {
      height: auto;
      max-width: 100%;
      transition: all 0.3s ease;
    }
    
    #collapseMenu ul {
      gap: 0.4rem;
    }
    
    #collapseMenu ul li a {
      font-size: 14px;
      font-weight: 600;
    }
    
    .mobile-icons {
      gap: 0.4rem;
    }
    
    #collapseMenu ul li {
      white-space: nowrap;
    }
  }

  @media (min-width: 1024px) and (max-width: 1070px) {
    #collapseMenu ul li a {
      font-size: 13px;
    }
    
    .mobile-icons .bx {
      font-size: 1.1rem;
    }
    
    #heart-count, #cart-count {
      height: 14px;
      width: 14px;
      font-size: 9px;
    }
  }
</style>

<body>
  <header class="sticky top-0 z-50 bg-white  tracking-wide font-[Urbanist]">

     <div class="hidden md:block py-2 text-sm ">
        <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8">
          <div class="flex items-center justify-between">
            <div class="text-gray-700 font-medium">
                <h1 class="font-bold">The dollar exchange rate is set daily based on market value</h1>              
            </div>
            <div class="flex items-center space-x-6">
              <a href="#" title="Facebook" class="text-gray-600 hover:text-blue-500 transition-colors text-lg"><i class='bx bxl-facebook'></i></a>
              <a href="#" title="Instagram" class="text-gray-600 hover:text-pink-500 transition-colors text-lg"><i class='bx bxl-instagram'></i></a>
            </div>
          </div>
        </div>
      </div>


    <div class="flex items-center justify-between w-full px-4 sm:px-5 lg:px-6 min-h-[70px]">
      <div class="flex items-center gap-3 lg:gap-8 xl:gap-10">

        <a href="/home" class="shrink-0">
          <img src="{{ asset('images/Salmantest.PNG') }}" 
              alt="logo" 
              class="hidden sm:block">

          <img src="{{ asset('images/Salmantest.PNG') }}" 
              alt="logo" 
              class="block sm:hidden">
        </a>
  
        <div id="collapseMenu" class="hidden lg:block">
          <ul class="flex gap-x-4 lg:gap-x-6 xl:gap-x-8">
            <li>
              <a href="{{ route('home') }}" 
                class="block text-[16px] lg:text-[18px] font-bold {{ request()->routeIs('home') ? 'text-blue-700' : 'text-black hover:text-blue-700' }}">
                Home
              </a>
            </li>
            <li>
              <a href="{{ route('shop') }}" 
                class="block text-[16px] lg:text-[18px] font-bold {{ request()->routeIs('shop') || request()->routeIs('shop.*') ? 'text-blue-700' : 'text-black hover:text-blue-700' }}">
                Shop
              </a>
            </li>
            <li>
              <a href="{{ route('about') }}" 
                class="block text-[16px] lg:text-[18px] font-bold {{ request()->routeIs('about') ? 'text-blue-700' : 'text-black hover:text-blue-700' }}">
                About
              </a>
            </li>
            <li>
              <a href="{{ route('contact') }}" 
                class="block text-[16px] lg:text-[18px] font-bold {{ request()->routeIs('contact') ? 'text-blue-700' : 'text-black hover:text-blue-700' }}">
                Contact
              </a>
            </li>
            <li>
              <a href="{{ route('portfolio') }}" 
                class="block text-[16px] lg:text-[18px] font-bold {{ request()->routeIs('portfolio') || request()->routeIs('portfolio.*') ? 'text-blue-700' : 'text-black hover:text-blue-700' }}">
                Portfolio
              </a>
            </li>
          </ul>
        </div>
      </div>

      <div class="flex items-center gap-1 sm:gap-2 lg:gap-3 xl:gap-4">

       <div class="desktop-search relative hidden sm:flex items-center w-[240px] md:w-[300px] lg:w-[350px] mx-auto rounded-full bg-white shadow-sm border border-gray-200 
            focus-within:border-blue-500 focus-within:ring-1 focus-within:ring-blue-500
            hover:border-blue-500 hover:ring-1 hover:ring-blue-500
            transition-all duration-200">
        <input 
          type="text" 
          name="q" 
          placeholder="Search..." 
          class="w-full py-3 pl-5 pr-10 text-gray-700 rounded-full focus:outline-none bg-transparent text-base"
          autocomplete="off"
        >
        <button 
          type="submit" 
          class="absolute right-0 px-4 text-gray-400 hover:text-blue-500 transition-colors duration-200"
        >
          <i class='bx bx-search text-xl'></i>
        </button>

        <div id="search-results" 
            class="absolute top-full left-0 mt-2 bg-white shadow-lg rounded-xl hidden z-50">
        </div>
      </div>


          <div class="mobile-icons flex items-center gap-1 sm:gap-2 lg:gap-3 xl:gap-4">
              <a href="{{ route('wishlist.index') }}" class="relative p-1 sm:p-1.5 lg:p-2 text-gray-700 hover:text-blue-500 transition-colors duration-200">
                  <i class='bx bx-heart text-lg sm:text-xl lg:text-2xl'></i>
                  <span id="heart-count" class="absolute -top-1 -right-1 bg-blue-600 text-white text-[10px] xs:text-xs rounded-full h-4 w-4 xs:h-5 xs:w-5 flex items-center justify-center">
                      {{ auth()->check() ? auth()->user()->wishlists()->count() : 0 }}
                  </span>
              </a>

              <a href="{{ route('cart.index') }}" class="relative p-1 sm:p-1.5 lg:p-2 text-gray-700 hover:text-blue-500 transition-colors duration-200">
                  <i class='bx bx-cart text-lg sm:text-xl lg:text-2xl'></i>
                  <span id="cart-count" class="absolute -top-1 -right-1 bg-blue-600 text-white text-[10px] xs:text-xs rounded-full h-4 w-4 xs:h-5 xs:w-5 flex items-center justify-center">
                      {{ App\Http\Controllers\CartController::getCartCount() }}
                  </span>
              </a>

              @guest
                  <a href="/account" class="p-1 sm:p-1.5 lg:p-2 text-gray-700 hover:text-blue-500 transition-colors duration-200">
                      <i class='bx bx-user text-lg sm:text-xl lg:text-2xl'></i>
                  </a>
              @endguest
          </div>

        @auth
          <div class="relative" x-data="{ open: false, redeemOpen: false }" 
              x-init="
                  $el.style.visibility = 'hidden';
                  $nextTick(() => {
                      $el.style.visibility = '';
                      open = false;
                      redeemOpen = false;
                  })"
              @mouseenter="open = true" 
              @mouseleave="open = false"
              style="visibility: hidden;">
              
              <button @click="open = !open" 
                      class="p-1 sm:p-1.5 lg:p-2 text-gray-700 hover:text-blue-500 focus:outline-none transition-colors duration-200">
                  <i class='bx bx-user text-lg sm:text-xl lg:text-2xl'></i>
              </button>

              <div x-show="open" x-transition class="absolute right-0 mt-2 w-52 bg-white border border-gray-100 rounded-lg shadow-lg z-50">
                  <a href="{{ url('/profile') }}" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-blue-500 transition-colors duration-200">
                      <i class='bx bx-user-circle text-lg'></i> Account
                  </a>
                  <a href="{{ url('/profile/orders') }}" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-blue-500 transition-colors duration-200">
                      <i class='bx bx-package text-lg'></i> Orders
                  </a>

                  <button @click="redeemOpen = true" class="w-full text-left flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-blue-500 transition-colors duration-200">
                      <i class='bx bx-gift text-lg'></i> Redeem Code
                  </button>

                  <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <button type="submit" class="w-full text-left flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-blue-500 transition-colors duration-200">
                          <i class='bx bx-log-out text-lg'></i> Logout
                      </button>
                  </form>
              </div>

              <div x-show="redeemOpen" x-transition class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
                  <div class="bg-white rounded-lg p-6 w-full max-w-md">
                      <div class="flex justify-between items-center mb-4">
                          <h2 class="text-lg font-semibold">Redeem Promo Code</h2>
                          <button @click="redeemOpen = false; $dispatch('close-modal')" class="text-gray-600 hover:text-gray-800">&times;</button>
                      </div>

                      <form method="POST" action="{{ route('user.promocodes.apply') }}"
                            x-data="{
                              loading: false,
                              error: null,
                              success: null,
                              async submitForm(e) {
                                  e.preventDefault();
                                  this.loading = true;
                                  this.error = null;
                                  this.success = null;
                                  try {
                                      const response = await fetch(e.target.action, {
                                          method: 'POST',
                                          headers: {
                                              'Content-Type': 'application/json',
                                              'Accept': 'application/json',
                                              'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                          },
                                          body: JSON.stringify({ code: e.target.code.value })
                                      });
                                      const data = await response.json();
                                      if (!response.ok) throw data;
                                      this.success = data.message;
                                      setTimeout(() => {
                                          this.$dispatch('promo-applied', { 
                                              message: data.message,
                                              promoCode: data.promo_code
                                          });
                                          this.$dispatch('close-modal');
                                          window.location.reload();
                                      }, 1500);
                                  } catch (error) {
                                      this.error = error.message || 'An error occurred';
                                  } finally {
                                      this.loading = false;
                                  }
                              }
                            }"
                            @submit="submitForm">
                          <div x-show="error" class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                              <p x-text="error"></p>
                          </div>
                          <div x-show="success" class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                              <p x-text="success"></p>
                          </div>
                          <input type="text" name="code" placeholder="Enter your code" class="w-full border px-3 py-2 rounded mb-4" required>
                          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded w-full hover:bg-blue-700 flex items-center justify-center gap-2" :disabled="loading">
                              <span x-show="!loading">Apply</span>
                              <span x-show="loading">Processing...</span>
                              <svg x-show="loading" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                              </svg>
                          </button>
                      </form>
                  </div>
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

    <div id="mobileMenu" 
     class="fixed top-0 right-0 h-full w-64 bg-[#3254EC] shadow-lg transform translate-x-full transition-transform duration-300 z-50 flex flex-col p-6">
    </div>
    <div id="menuOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 opacity-0 invisible transition-opacity duration-300"></div>
  </header>

      <main>
        <script src="//unpkg.com/alpinejs" defer></script>
          @if(session('success'))
              <div 
                  x-data="{ show: true }" 
                  x-init="setTimeout(() => show = false, 4000)" 
                  x-show="show" 
                  x-transition 
                  class="fixed top-6 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-6 py-3 rounded-full shadow-lg z-50"
              >
                  {{ session('success') }}
              </div>
          @endif
          @if(session('promo_success'))
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
                                      {{ session('promo_success') }}
                                  </div>
                                  @if(session('promo_code'))
                                  <div class="mt-2">
                                      <span class="text-sm font-medium text-blue-600">
                                          Promo Code: {{ session('promo_code') }}
                                      </span>
                                  </div>
                                  @endif
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

<footer class="bg-gray-50 text-gray-800">
  <div class="container mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-5 gap-8 max-w-screen-xl text-center md:text-left">

    <div class="flex flex-col items-center md:items-start">
      <a href="/" class="flex items-center mb-4">
        <img src="{{ asset('images/SalmanLogo2.png') }}" alt="Salman Electric Logo" class="h-12 object-contain">
      </a>
        <p class="text-base text-gray-800 ">For inquiries, contact us anytime.</p>
    </div>
    
    <div class="flex flex-col items-center md:items-start md:ml-[25px]">
      <h3 class="font-bold text-lg uppercase mb-4 text-gray-900">Keep In Touch</h3>
      <ul class="space-y-2 text-base">
        <li><a href="#" class="hover:text-blue-600 transition-colors">About Us</a></li>
        <li><a href="#" class="hover:text-blue-600 transition-colors">Contact Us</a></li>
      </ul>
    </div>

    <div class="flex flex-col items-center md:items-start">
      <h3 class="font-bold text-lg uppercase mb-4 text-gray-900">Useful Links</h3>
      <ul class="space-y-2 text-base">
        <li><a href="#" class="hover:text-blue-600 transition-colors">Privacy Policy</a></li>
        <li><a href="#" class="hover:text-blue-600 transition-colors">Return & Exchange Policy</a></li>
      </ul>
    </div>

    
    <div class="flex flex-col items-center md:items-start">
      <h3 class="font-bold text-lg uppercase mb-4 text-gray-900">Contact Us</h3>
      <ul class="space-y-2 text-base">
        <li><a href="tel:+96176765561" class="hover:text-blue-600 transition-colors">+961 76 765 561</a></li>
        <li><a href="tel:+96181966742" class="hover:text-blue-600 transition-colors">+961 03 813 154</a></li>
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
 document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('toggleOpen');
    const mobileMenu = document.getElementById('mobileMenu');
    const menuOverlay = document.getElementById('menuOverlay');
    
    if (mobileMenu) {
        mobileMenu.innerHTML = `
            <div class="flex flex-col h-full">
                <button id="toggleClose" class="close-btn self-end text-2xl p-4">&times;</button>
                <div class="mt-4 px-4">
                    <!-- Mobile Search Container -->
                    <div class="mobile-search relative w-full mb-4">
                        <input 
                            type="text" 
                            placeholder="Search..." 
                            class="search-input w-full py-2 px-3 rounded-full border border-gray-300 focus:outline-none focus:border-amber-400"
                            id="mobile-search-input"
                        >
                        <!-- Mobile Search Results -->
                        <div id="mobile-search-results" 
                            class="absolute top-full left-0 w-full bg-white shadow-lg border border-gray-200 rounded-md mt-1 hidden z-50 max-h-80 overflow-y-auto">
                        </div>
                    </div>
                    <nav class="mt-4 space-y-2">
                        <a href="/home" class="block py-2 ${window.location.pathname === '/home' ? 'text-blue-400' : 'text-white'}">Home</a>
                        <a href="/shop" class="block py-2 ${window.location.pathname.includes('/shop') ? 'text-blue-400' : 'text-white'}">Shop</a>
                        <a href="/about" class="block py-2 ${window.location.pathname === '/about' ? 'text-blue-400' : 'text-white'}">About</a>
                        <a href="/contact" class="block py-2 ${window.location.pathname === '/contact' ? 'text-blue-400' : 'text-white'}">Contact</a>
                        <a href="/portfolio" class="block py-2 ${window.location.pathname.includes('/portfolio') ? 'text-blue-400' : 'text-white'}">Portfolio</a>
                    </nav>
                </div>
                <div class="social-icons mt-auto p-4">
                    <a href="#" class="text-white hover:text-blue-400 mr-3"><i class='bx bxl-facebook'></i></a>
                    <a href="#" class="text-white hover:text-pink-400"><i class='bx bxl-instagram'></i></a>
                </div>
            </div>
        `;
        
        const closeButton = document.getElementById('toggleClose');
        
        function openMenu() {
            mobileMenu.classList.add('open');
            menuOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        
        function closeMenu() {
            mobileMenu.classList.remove('open');
            menuOverlay.classList.remove('active');
            document.body.style.overflow = '';
            $('#mobile-search-results').hide();
        }
        
        if (toggleButton) toggleButton.addEventListener('click', openMenu);
        if (closeButton) closeButton.addEventListener('click', closeMenu);
        if (menuOverlay) menuOverlay.addEventListener('click', closeMenu);
        
        initMobileSearch();
    }

  const initialCartCount = {{ App\Http\Controllers\CartController::getCartCount() }};
  const initialWishlistCount = {{ auth()->check() ? auth()->user()->wishlists()->count() : 0 }};

  document.getElementById('cart-count').textContent = initialCartCount;
  document.getElementById('heart-count').textContent = initialWishlistCount;

  updateCartCount();
  updateWishlistCount();
      
      document.querySelectorAll('.add-to-wishlist').forEach(button => {
          button.addEventListener('click', function(e) {
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
              if (searchBar) searchBar.classList.toggle('hidden');
          });
      }
      
      const userMenuButton = document.getElementById("userMenuButton");
      const userDropdown = document.getElementById("userDropdown");
      
      if (userMenuButton && userDropdown) {
          userMenuButton.addEventListener("click", function(e) {
              e.stopPropagation();
              userDropdown.classList.toggle("hidden");
          });
          
          document.addEventListener("click", function() {
              if (!userDropdown.classList.contains("hidden")) {
                  userDropdown.classList.add("hidden");
              }
          });
      }
      
      function updateCartCount() {
          fetch('/cart/count')
              .then(res => {
                  if (!res.ok) throw new Error('Network response was not ok');
                  return res.json();
              })
              .then(data => {
                  const cartCount = document.getElementById('cart-count');
                  if (cartCount) {
                      cartCount.textContent = data.count;
                      animateCounter(cartCount);
                  }
                  const mobileCart = document.getElementById('cart-count-mobile');
                  if (mobileCart) {
                      mobileCart.textContent = data.count;
                      animateCounter(mobileCart);
                  }
              })
              .catch(error => console.error('Error updating cart count:', error));
      }
      
      function updateWishlistCount() {
          fetch('/wishlist/count')
              .then(res => {
                  if (!res.ok) throw new Error('Network response was not ok');
                  return res.json();
              })
              .then(data => {
                  const heartCount = document.getElementById('heart-count');
                  if (heartCount) {
                      heartCount.textContent = data.count;
                      animateCounter(heartCount);
                  }
                  const mobileHeart = document.getElementById('heart-count-mobile');
                  if (mobileHeart) {
                      mobileHeart.textContent = data.count;
                      animateCounter(mobileHeart);
                  }
              })
              .catch(error => console.error('Error updating wishlist count:', error));
      }
      
      function animateCounter(element) {
          element.classList.add('animate-pulse');
          setTimeout(() => element.classList.remove('animate-pulse'), 300);
      }
  });

  $(document).ready(function () {
      let $input = $('input[name="q"]');
      let $results = $('#search-results');

      $input.on('keyup', function () {
          let query = $(this).val();
          if (query.length < 2) {
              $results.hide();
              return;
          }

          console.log('Searching for:', query);
          
          $results.html('<div class="px-6 py-4 text-gray-500 text-lg">Searching...</div>').show();

          $.ajax({
              url: "{{ route('search.ajax') }}",
              method: 'GET',
              data: { q: query },
              dataType: 'json',
              success: function (data) {
                  console.log('Search results:', data);
                  
                  let html = "";

                  if (data.products && data.products.length > 0) {
                      html += "<div class='px-6 py-3 font-bold text-gray-800 border-b bg-gray-100 text-lg'>PRODUCTS</div>";
                      data.products.forEach(p => {
                          const imageUrl = p.image ? "{{ asset('storage/') }}/" + p.image : '/placeholder-image.jpg';
                          
                          html += `
                          <a href="/product-details/${p.id}" class="flex items-center px-6 py-4 hover:bg-gray-50 border-b">
                              <div class="flex-shrink-0 w-16 h-16 bg-gray-200 rounded-md overflow-hidden mr-4">
                                  <img src="${imageUrl}" alt="${p.name}" class="w-full h-full object-cover">
                              </div>
                              <div class="flex-grow">
                                  <div class="text-base font-medium text-gray-900">${p.name}</div>
                              </div>
                          </a>`;
                      });
                      
                      html += `
                      <div class="px-6 py-3 bg-gray-100 border-t">
                          <a href="/shop/all/brands/all/min-price/0/max-price/2500?search=${encodeURIComponent(query)}" 
                            class="text-base font-medium text-blue-600 hover:text-blue-800">
                              SEE ALL PRODUCTS... (${data.total_products_count})
                          </a>
                      </div>`;
                  }

                  if (data.categories && data.categories.length > 0) {
                      html += "<div class='px-6 py-3 font-bold text-gray-800 border-b bg-gray-100 text-lg'>CATEGORIES</div>";
                      data.categories.forEach(c => {
                          html += `
                          <a href="/shop/${c.slug}/brands/all/min-price/0/max-price/2500" 
                            class="block px-6 py-4 hover:bg-gray-50 border-b text-base text-gray-700">
                              ${c.name}
                          </a>`;
                      });
                  }

                  if (data.brands && data.brands.length > 0) {
                      html += "<div class='px-6 py-3 font-bold text-gray-800 border-b bg-gray-100 text-lg'>BRANDS</div>";
                      data.brands.forEach(b => {
                          html += `
                          <a href="/shop/all/brands/${b.slug}/min-price/0/max-price/2500" 
                            class="block px-6 py-4 hover:bg-gray-50 border-b text-base text-gray-700">
                              ${b.name}
                          </a>`;
                      });
                  }

                  if (html === "") {
                      html = "<div class='px-6 py-4 text-gray-500 text-base'>No results found</div>";
                  }

                  $results.html(html).show();
              },
              error: function(xhr, status, error) {
                  console.error("AJAX Error Details:");
                  console.error("Status:", status);
                  console.error("Error:", error);
                  
                  let errorMsg = "Error loading results";
                  if (xhr.status === 500) {
                      errorMsg += " (Server Error)";
                  } else if (xhr.status === 404) {
                      errorMsg += " (Endpoint Not Found)";
                  }
                  
                  $results.html(`<div class='px-6 py-4 text-red-500 text-base'>${errorMsg}</div>`).show();
              }
          });
      });

      $(document).click(function(e) {
          if (!$(e.target).closest('.desktop-search').length) {
              $results.hide();
          }
      });
      
      $results.on('click', function(e) {
          e.stopPropagation();
      });
  });

  function initMobileSearch() {
      let $mobileInput = $('#mobile-search-input');
      let $mobileResults = $('#mobile-search-results');
      let mobileSearchTimer;
    
      $mobileInput.on('keyup', function() {
          clearTimeout(mobileSearchTimer);
          let query = $(this).val();
          
          if (query.length < 2) {
              $mobileResults.hide();
              return;
          }
          
          mobileSearchTimer = setTimeout(function() {
              performMobileSearch(query, $mobileResults);
          }, 300);
      });
      
      $(document).on('click', function(e) {
          if (!$(e.target).closest('.mobile-search').length) {
              $mobileResults.hide();
          }
      });
    
      $mobileResults.on('click', function(e) {
          e.stopPropagation();
      });
  }

  function performMobileSearch(query, $results) {
      console.log('Mobile searching for:', query);
      
      $results.html('<div class="px-4 py-3 text-gray-500">Searching...</div>').show();
      
      $.ajax({
          url: "{{ route('search.ajax') }}",
          method: 'GET',
          data: { q: query },
          dataType: 'json',
          success: function(data) {
              console.log('Mobile search results:', data);
              
              let html = "";
              
              if (data.products && data.products.length > 0) {
                  html += "<div class='px-4 py-2 font-bold text-gray-800 border-b bg-gray-100'>PRODUCTS</div>";
                  data.products.forEach(p => {
                      const imageUrl = p.image ? "{{ asset('storage/') }}/" + p.image : '/placeholder-image.jpg';
                      
                      html += `
                      <a href="/product-items/${p.id}" class="flex items-center px-4 py-3 hover:bg-gray-50 border-b" onclick="closeMobileMenu()">
                          <div class="flex-shrink-0 w-12 h-12 bg-gray-200 rounded-md overflow-hidden mr-3">
                              <img src="${imageUrl}" alt="${p.name}" class="w-full h-full object-cover">
                          </div>
                          <div class="flex-grow">
                              <div class="text-sm font-medium text-gray-900">${p.name}</div>
                          </div>
                      </a>`;
                  });
                  
                  html += `
                  <div class="px-4 py-2 bg-gray-100 border-t">
                      <a href="/shop/all/brands/all/min-price/0/max-price/2500?search=${encodeURIComponent(query)}" 
                        class="text-sm font-medium text-blue-600 hover:text-blue-800" onclick="closeMobileMenu()">
                          SEE ALL PRODUCTS... (${data.total_products_count || data.products.length})
                      </a>
                  </div>`;
              }
              
              if (data.categories && data.categories.length > 0) {
                  html += "<div class='px-4 py-2 font-bold text-gray-800 border-b bg-gray-100'>CATEGORIES</div>";
                  data.categories.forEach(c => {
                      html += `
                      <a href="/shop/${c.slug}/brands/all/min-price/0/max-price/2500" 
                        class="block px-4 py-2 hover:bg-gray-50 border-b text-sm text-gray-700" onclick="closeMobileMenu()">
                          ${c.name}
                      </a>`;
                  });
              }
              
              if (data.brands && data.brands.length > 0) {
                  html += "<div class='px-4 py-2 font-bold text-gray-800 border-b bg-gray-100'>BRANDS</div>";
                  data.brands.forEach(b => {
                      html += `
                      <a href="/shop/all/brands/${b.slug}/min-price/0/max-price/2500" 
                        class="block px-4 py-2 hover:bg-gray-50 border-b text-sm text-gray-700" onclick="closeMobileMenu()">
                          ${b.name}
                      </a>`;
                  });
              }
              
              if (html === "") {
                  html = "<div class='px-4 py-3 text-gray-500'>No results found</div>";
              }
              
              $results.html(html).show();
          },
          error: function(xhr, status, error) {
              console.error("Mobile search error:", error);
              $results.html('<div class="px-4 py-3 text-red-500">Error loading results</div>').show();
          }
      });
  }

  function closeMobileMenu() {
      const mobileMenu = document.getElementById('mobileMenu');
      const menuOverlay = document.getElementById('menuOverlay');
      
      if (mobileMenu) mobileMenu.classList.remove('open');
      if (menuOverlay) menuOverlay.classList.remove('active');
      document.body.style.overflow = '';
      
      $('#mobile-search-results').hide();
      $('#mobile-search-input').val('');
  }
</script>
</html>
