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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<style>
    body {
    font-family: 'Urbanist', sans-serif !important;
    padding-top:40px;  
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
    padding-top: 15px;
    margin-top: 0;
  }
  #mobileMenu {
    position: fixed;
    top: 0;
    right: 0;
    width: 280px;
    height: 100vh;
    background-color: #0c1033;
    color: white;
    padding: 2rem 1.5rem;
    z-index: 60;
    transform: translateX(100%);
    transition: transform 0.3s ease;
    display: flex;
    flex-direction: column;
  }
  #mobileMenu.open { transform: translateX(0); }
  #mobileMenu .close-btn {
    position: absolute;
    top: 1.2rem;
    right: 1.2rem;
    font-size: 2rem;
    cursor: pointer;
  }
  #mobileMenu .icons-row {
    display: flex;
    align-items: center;
    gap: 1.2rem;
    font-size: 1.6rem;
    margin-bottom: 1.5rem;
  }
  #mobileMenu .icons-row a { color: white; position: relative; }
  #mobileMenu .icons-row span {
    font-size: 0.75rem;
    height: 1.2rem;
    width: 1.2rem;
    position: absolute;
    top: -8px;
    right: -10px;
    background: #c72c2c;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
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
  }
  #mobileMenu nav a:hover { color: #c72c2c; }
  #mobileMenu .social-icons {
    display: flex;
    gap: 1rem;
    font-size: 1.4rem;
    margin-top: auto;
  }
  #whatsapp-btn {
    position: fixed;
    bottom: 1.5rem;
    right: 1.5rem;
    background: #25d366;
    color: white;
    border-radius: 50%;
    padding: 0.8rem;
    font-size: 1.8rem;
    box-shadow: 0 3px 8px rgba(0,0,0,0.25);
    z-index: 70;
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

<header x-data="{ mobileOpen: false }" class="bg-white shadow-sm">
  <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8">
    <div class="flex items-start justify-between md:items-center md:h-20">

      <div class="flex items-center gap-3 md:gap-8 w-full md:w-auto">
        <button
          id="mobileSearchToggle"
          class="md:hidden text-gray-700 hover:text-blue-600 p-2"
          aria-label="Search">
          <i class='bx bx-search text-2xl'></i>
        </button>

        <a href="/home" aria-label="Home" class="flex-1 flex justify-center md:justify-start">
          <img src="{{ asset('images/salmanLogo2.png') }}"
            alt="Salman Electric Logo"
            class="h-10 w-auto object-contain">
        </a>

        <nav aria-label="Global" class="hidden md:block ml-8">
          <ul class="flex items-center gap-6 text-sm font-bold">
            <li><a class="text-gray-900 hover:text-blue-600 transition-colors" href="/home">HOME</a></li>
            <li><a class="text-gray-900 hover:text-blue-600 transition-colors" href="/shop">SHOP</a></li>
            <li><a class="text-gray-900 hover:text-blue-600 transition-colors" href="/about">ABOUT</a></li>
            <li><a class="text-gray-900 hover:text-blue-600 transition-colors" href="/contact">CONTACT</a></li>
          </ul>
        </nav>

      </div>

      <div class="flex items-center gap-6">
        <div class="relative hidden md:block">
          <input type="text" placeholder="Search products..."
            class="w-64 px-4 py-2 border border-gray-300 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <button class="absolute right-3 top-2 text-gray-500 hover:text-blue-600">
            <i class='bx bx-search text-xl'></i>
          </button>
        </div>

        <div class="flex items-center gap-4 hidden md:flex">
          <a href="{{ route('wishlist.index') }}" class="p-2 text-gray-700 hover:text-amber-500 transition-colors relative" aria-label="Wishlist">
            <i class='bx bx-heart text-2xl'></i>
            <span id="heart-count" class="absolute -top-1 -right-1 bg-blue-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center"></span>
          </a>
          <a href="{{ route('cart.index') }}" class="p-2 text-gray-700 hover:text-amber-500 transition-colors relative" aria-label="Cart">
            <i class='bx bx-cart text-2xl'></i>
            <span id="cart-count" class="absolute -top-1 -right-1 bg-blue-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center"></span>
          </a>
          <a href="{{ url('/account') }}" class="flex items-center space-x-1 text-gray-700 hover:text-blue-600 transition-colors">
            <i class='bx bx-user text-2xl'></i>
          </a>
        </div>

        <div class="block md:hidden">
          <button @click="mobileOpen = true" class="rounded-sm bg-white-100 p-2 text-gray-700 transition hover:text-blue-600"style="margin-left:10px;" aria-label="Menu">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>
      </div>

    </div>
  </div>

  <div id="mobileSearchBar" class="hidden md:hidden px-4 py-2 bg-white shadow">
    <form action="/search" method="GET" class="flex">
      <input
        type="text"
        name="q"
        placeholder="Search products..."
        class="flex-1 px-4 py-2 border border-gray-300 rounded-l-full text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
        autocomplete="off"
      />
      <button type="submit" class="px-4 bg-blue-600 text-white rounded-r-full">
        <i class='bx bx-search'></i>
      </button>
    </form>
  </div>

  <div id="mobileMenu" :class="{ 'open': mobileOpen }" x-show="mobileOpen" x-transition @click.away="mobileOpen = false" style="display: none;">

    <button @click="mobileOpen = false" aria-label="Close Menu" class="close-btn text-white hover:text-red-500">&times;</button>
    <div class="icons-row">
      <a href="{{ url('/account') }}"><i class='bx bx-user'></i></a>
      <a href="{{ route('wishlist.index') }}">
        <i class='bx bx-heart'></i>
        <span id="heart-count-mobile">0</span>
      </a>
      <a href="{{ route('cart.index') }}">
        <i class='bx bx-cart'></i>
        <span id="cart-count-mobile">0</span>
      </a>
    </div>

    <input type="text" placeholder="Search for product..." class="search-input">
    <nav>
      <a href="/home">Home</a>
      <a href="/shop">Shop Now</a>
      <a href="/about">About</a>
      <a href="/contact">Contact</a>
    </nav>

    <div class="social-icons">
      <a href="#"><i class='bx bxl-facebook'></i></a>
      <a href="#"><i class='bx bxl-instagram'></i></a>
      <a href="#"><i class='bx bx-map'></i></a>
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
    });

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

    document.getElementById('mobileSearchToggle').addEventListener('click', function() {
    const searchBar = document.getElementById('mobileSearchBar');
    searchBar.classList.toggle('hidden');
    });
</script>
</html>
