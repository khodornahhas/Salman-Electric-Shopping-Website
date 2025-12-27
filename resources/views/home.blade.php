@extends('layouts.main')
@section('head')
    <title>Salman Electric - Solar Systems, Batteries, LED Lighting & 3D Printing in Lebanon</title>
    <meta name="description" content="Salman Electric in Lebanon – Solar systems, batteries, inverters, LED lighting, and 3D printing equipment. Quality products & service.">
    <meta property="og:title" content="Salman Electric - Home">
    <meta property="og:description" content="Your one-stop shop for solar systems, inverters, batteries, lighting, and 3D printing equipment in Lebanon.">
    <meta property="og:image" content="{{ asset('images/salman.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Salman Electric - Home">
    <meta name="twitter:description" content="Your one-stop shop for solar systems, inverters, batteries, lighting, and 3D printing equipment in Lebanon.">
    <meta name="twitter:image" content="{{ asset('images/salman.png') }}">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="robots" content="index, follow">

@endsection

@section('content')
<style>
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }

    .scrollbar-hide {
        -ms-overflow-style: none;  
        scrollbar-width: none;     
    }
    .swiper {
        width: 100%;
        padding: 20px 0;
    }

    .swiper-slide {
        display: flex;
        justify-content: center;
        align-items: center;
        height: auto;
    }

    .brand-item {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 15px;
    }

    .brand-item a {
        display: block;
        padding: 0.5rem;
        transition: all 0.3s ease;
    }

    .brand-item a:hover {
        transform: scale(1.02);
    }

    .brand-item img {
        max-height: 38px;
        width: auto;
        object-fit: contain;
    }

    .swiper-pagination-bullet {
        width: 12px !important;
        height: 12px !important;
        background: #d1d5db !important;
        opacity: 1 !important;
    }

    .swiper-pagination-bullet-active {
        background: #f59e0b !important;
        transform: scale(1.2) !important;
    }

    .swiper-button-next,
    .swiper-button-prev {
        background-color: rgba(255, 255, 255, 0.8);
        width: 40px !important;
        height: 40px !important;
        border-radius: 50%;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        transform: scale(1.1);
        background-color: rgba(255, 255, 255, 0.9);
    }

    .swiper-button-next:after,
    .swiper-button-prev:after {
        font-size: 20px !important;
        font-weight: bold !important;
        color: #f59e0b !important;
    }

    .desktop-slider {
        display: block;
    }

    .mobile-slider {
        display: none;
    }

    @media (max-width: 767px) {
        .desktop-slider {
            display: none;
        }
        .mobile-slider {
            display: block;
        }
        
        .swiper-button-next,
        .swiper-button-prev {
            width: 32px !important;
            height: 32px !important;
            display: none; 
        }
        
        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 16px !important;
        }
    }

    .brand-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 80px;
        width: 100%;
        padding: 0 15px;
    }

    @media (max-width: 1024px) {
        .brand-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .brand-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }
        
        .brand-item {
            padding: 10px;
        }
        
        .brand-item img {
            max-height: 30px;
        }
    }

    .logos {
        overflow: hidden;
        position: relative;
        width: 100%;
        white-space: nowrap;
    }

    .logos-slide {
        display: inline-block;
        white-space: nowrap;
        will-change: transform;
    }

    .logos-slide a {
        scroll-snap-align: start;
        margin: 0 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 50px;
        height: auto;
    }

    .logos-slide img {
        max-height: 50px;
        width: auto;
        max-width: 120px;
        object-fit: contain;
        display: inline-block;
        vertical-align: middle;
        user-select: none;
        pointer-events: auto;
    }

    @media (max-width: 767px) {
        .logos {
            padding: 0 10px;
        }
        
        .logos-slide a {
            margin: 0 10px;
        }
        
        .logos-slide img {
            max-height: 40px;
            max-width: 100px;
        }
    }

    .animate-float { 
        animation: float 3s ease-in-out infinite; 
    }

    .animate-float-slow { 
        animation: float 4s ease-in-out infinite; 
    }

    .animate-float-reverse { 
        animation: float-reverse 3.5s ease-in-out infinite; 
    }

    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
        100% { transform: translateY(0px); }
    }

    @keyframes float-reverse {
        0% { transform: translateY(-10px); }
        50% { transform: translateY(10px); }
        100% { transform: translateY(-10px); }
    }

    .product-card {
        transition: all 0.3s ease;
    }

    .show-more-btn {
        transition: all 0.2s ease;
    }

    .show-more-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .slide-enter-active, 
    .slide-leave-active {
        transition: all 0.5s ease;
    }

    .slide-enter-from {
        transform: translateX(100%);
        opacity: 0;
    }

    .slide-leave-to {
        transform: translateX(-100%);
        opacity: 0;
    }

    .slider-container {
        overflow: hidden;
    }

    .slider-track {
        display: flex;
        transition: transform 0.5s ease-in-out;
    }

    .slider-slide {
        flex: 0 0 25%;
        transition: all 0.3s ease;
    }

    .slider-dot {
        width: 12px;
        height: 12px;
        background: #d1d5db;
        opacity: 1;
        transition: all 0.3s ease;
        border-radius: 50%;
        cursor: pointer;
    }

    .slider-dot.active {
        background: #f59e0b;
        transform: scale(1.2);
    }

    .banner-overlay {
        background: linear-gradient(90deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.2) 100%);
    }

    .banner-text-shadow {
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .discount-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        background: #ef4444;
        color: white;
        padding: 8px 16px;
        border-radius: 30px;
        font-weight: bold;
        transform: rotate(5deg);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 10;
    }

    .electrical-icon {
        font-size: 2rem;
        color: #f59e0b;
        margin-bottom: 1rem;
    }

    @media (max-width: 640px) {
        .relative.h-\\[25\\.rem\\] {
            height: 20rem !important;
        }
        
        .banner-text-shadow {
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
        }
        
        .electrical-icon {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
        
        h2.text-4xl {
            font-size: 1.75rem !important;
            line-height: 2.25rem !important;
            margin-bottom: 0.5rem !important;
        }
        
        p.text-xl {
            font-size: 1rem !important;
            margin-bottom: 1.5rem !important;
            line-height: 1.5rem !important;
        }
        
        a.bg-blue-600 {
            padding: 0.75rem 1.5rem !important;
            font-size: 0.875rem !important;
            min-height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        .discount-badge {
            top: 10px;
            right: 10px;
            padding: 6px 12px;
            font-size: 0.75rem;
        }
        
        .absolute.bottom-8 {
            bottom: 1rem !important;
        }
        
        button.w-8 {
            width: 1.5rem !important;
            height: 0.25rem !important;
        }
        
        button.w-10 {
            width: 2rem !important;
        }
    }

    @media (max-width: 400px) {
        .relative.h-\\[25\\.rem\\] {
            height: 18rem !important;
        }
        
        h2.text-4xl {
            font-size: 1.5rem !important;
            line-height: 2rem !important;
        }
        
        .max-w-4xl.mx-auto {
            padding-left: 1rem;
            padding-right: 1rem;
        }
    }
</style>

<!-- Image Slider Banner -->
<div x-data="{
    activeSlide: 0,
    slides: [
        { 
            id: 3, 
            image: '{{ asset('images/try5.jpeg') }}',
            alt: 'Premium Electrical Products',
            headline: 'Your Electrical Partner',
            subtext: 'Explore our wide collection of products!',
            cta: 'Shop Now',
            link: '/shop',
        }
    ],
}" class="relative overflow-hidden pb-8"> 
    
    <div class="relative h-[25rem] md:h-[25rem] lg:h-[45rem] xl:h-[39rem]">
        <template x-for="(slide, index) in slides" :key="slide.id">
            <div 
                x-show="activeSlide === index"
                x-transition:enter="transition-opacity duration-1000 ease-in-out"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity duration-1000 ease-in-out"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="absolute inset-0 w-full h-full"
            >
                <div class="absolute inset-0 w-full h-full">
                    <img :src="slide.image" :alt="slide.alt" class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute inset-0 banner-overlay"></div>
                </div>
                
                <template x-if="slide.discount">
                    <div class="discount-badge animate-pulse" x-text="slide.discount"></div>
                </template>
                
                <div class="relative z-10 h-full flex items-center px-4 sm:px-8">
                    <div class="max-w-4xl mx-auto text-center px-4">
                        <template x-if="slide.highlight">
                            <div class="bg-amber-500 text-gray-900 text-sm font-bold px-4 py-2 rounded-full inline-block mb-4 sm:mb-6">
                                <span x-text="slide.highlight"></span>
                            </div>
                        </template>
                        
                        <template x-if="slide.tagline">
                            <div class="text-white text-base sm:text-lg mb-2 font-light" x-text="slide.tagline"></div>
                        </template>
                        
                        <i :class="slide.icon + ' electrical-icon animate-float'" x-show="slide.icon"></i>
                        
                        <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-5xl font-bold text-white mb-3 sm:mb-4 uppercase tracking-wide banner-text-shadow" 
                            x-text="slide.headline"></h2>
                        <p class="text-base sm:text-xl md:text-2xl mb-6 sm:mb-8 text-white/90 banner-text-shadow max-w-2xl mx-auto" 
                           x-text="slide.subtext"></p>
                        <a :href="slide.link" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 sm:py-3 px-6 sm:px-8 rounded-full text-base sm:text-lg transition-all transform hover:scale-105 shadow-lg inline-flex items-center mx-auto min-h-[44px]">
                            <span x-text="slide.cta"></span>
                        </a>
                    </div>
                </div>
                
            </div>
        </template>    
    </div>
</div>

@php
    $categoryImages = [
        '3d Printing' => 'images/3dprinting.png',
        'EV chargers' => 'images/evchargers.png',
        'Inverters' => 'images/inverter.jpg',
        'Batteries' => 'images/battery.avif',
    ];
@endphp

<div class="bg-white py-8">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl mb-10 text-center text-gray-800" style="font-family: 'Open Sans', sans-serif;">Our Categories</h2>
        <div class="grid gap-4 sm:gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($categories as $category)
                <a href="{{ route('shop.filters', [
                    'categorySlug' => $category->slug ?? Str::slug($category->name),
                    'brandSlugs' => 'all',
                    'minPrice' => 0,
                    'maxPrice' => 2500
                ]) }}" 
                class="group relative overflow-hidden rounded-xl shadow-md hover:shadow-lg transition-all duration-300 h-48 sm:h-56 md:h-64">
                    <img src="{{ asset($categoryImages[$category->name] ?? 'images/categories/default-showcase.jpg') }}" 
                         alt="{{ $category->name }}"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                         loading="lazy">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/70 via-gray-900/30 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-4 text-center">
                        <h3 class="text-xl font-bold text-white drop-shadow-md">{{ $category->name }}</h3>
                        <p class="text-blue-200 text-sm mt-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            Shop Now →
                        </p>
                    </div>
                    

                </a>
            @endforeach
        </div>
    </div>
</div>

<!-- Featured Products Section -->
<section class="bg-white py-12">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl mb-10" style="font-family: 'Open Sans', sans-serif;">Featured Items</h2>


        <div x-data="{
            activeSlide: 0,
            slides: {{ $featuredProducts->toJson() }},
            visibleSlides: 4,
            sliding: false,
            interval: null,
            isHovered: false, 
            
            get slidesWithClones() {
                if (this.slides.length <= this.visibleSlides) return this.slides;
                return [
                    ...this.slides,
                    ...this.slides.slice(0, this.visibleSlides)
                ];
            },
            
            prev() {
                if (this.sliding || this.slides.length <= this.visibleSlides) return;
                this.sliding = true;

                if (this.currentSlideGroup === 0) {
                    this.activeSlide = (this.totalSlideGroups - 1) * this.visibleSlides;
                } else {
                    this.activeSlide -= this.visibleSlides;
                }

                setTimeout(() => this.sliding = false, 500);
            },

            next() {
                if (this.sliding || this.slides.length <= this.visibleSlides || this.isHovered) return;
                this.sliding = true;

                if (this.currentSlideGroup >= this.totalSlideGroups - 1) {
                    this.activeSlide = 0;
                } else {
                    this.activeSlide += this.visibleSlides;
                }

                setTimeout(() => this.sliding = false, 500);
            },
            
            get totalSlideGroups() {
                return Math.ceil(this.slides.length / this.visibleSlides);
            },
            
            get currentSlideGroup() {
                if (this.activeSlide >= this.slides.length) {
                    return 0; 
                }
                return Math.floor(this.activeSlide / this.visibleSlides);
            },
            
            goToSlideGroup(groupIndex) {
                this.activeSlide = groupIndex * this.visibleSlides;
            },
            
            updateVisibleSlides() {
                this.visibleSlides = window.innerWidth < 640 ? 1 : 
                                    window.innerWidth < 768 ? 2 :
                                    window.innerWidth < 1024 ? 3 : 4;
            },
            
            pauseAutoplay() {
                this.isHovered = true;
                clearInterval(this.interval);
            },
            
            resumeAutoplay() {
                this.isHovered = false;
                this.interval = setInterval(() => {
                    this.next();
                }, 8000);
            },
            
            init() {
                this.updateVisibleSlides();
                window.addEventListener('resize', () => this.updateVisibleSlides());
                
                this.interval = setInterval(() => {
                    this.next();
                }, 8000);
                
                this.$el.addEventListener('alpine:destroy', () => {
                    clearInterval(this.interval);
                    window.removeEventListener('resize', this.updateVisibleSlides);
                });
            }
        }" 
        x-init="init()"
        class="relative">
            <div class="relative pb-2 overflow-x-auto sm:overflow-hidden snap-x snap-mandatory scrollbar-hide"
            @mouseenter="pauseAutoplay()"
            @mouseleave="resumeAutoplay()">

                <div class="flex transition-transform duration-500 ease-in-out sm:transition-transform" :style="window.innerWidth < 640 ? 'transform: none' : `transform: translateX(-${(activeSlide * 100) / visibleSlides}%)`">
                   <template x-for="(product, index) in slidesWithClones" :key="index">
                    <div class="flex-shrink-0 px-3 transition-all duration-300 snap-start" 
                        :class="{
                            'w-full': visibleSlides === 1,
                            'w-1/2': visibleSlides === 2,
                            'w-1/3': visibleSlides === 3,
                            'w-1/4': visibleSlides === 4
                        }">
                        <div class="bg-white rounded-lg overflow-hidden transition-all duration-300 h-full flex flex-col 
                            shadow-[0_2px_8px_rgba(0,0,0,0.1)] hover:shadow-[0_4px_12px_rgba(0,0,0,0.15)]">
                            <div class="relative h-64 p-0 flex items-center justify-center bg-white">
                                <template x-if="product.image">
                                    <a :href="'/product-details/' + product.id">
                                        <img 
                                            :src="'{{ asset('storage') }}/' + product.image"
                                            :alt="product.name"
                                            class="w-52 h-52 object-contain transition-transform duration-300 hover:scale-105"
                                            x-init="console.log('Featured Image debug', { id: product.id, raw: product.image, final: '{{ asset('storage') }}/' + product.image })"
                                        >
                                    </a>
                                </template>

                                <template x-if="!product.image">
                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                        <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" 
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14
                                                m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                </template>

                                <template x-if="product.is_on_sale">
                                    <div class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
                                        SALE
                                    </div>
                                </template>
                            </div>

                            <div class="p-4 flex-grow flex flex-col">
                                <div class="border-t border-gray-200 mb-4"></div>

                                <h3 class="font-medium text-gray-800 text-center mb-4" style="font-family: 'Open Sans', sans-serif; font-size:17px;" x-text="product.name"></h3>    

                                <div class="border-t border-gray-200 mt-auto mb-4"></div>                                  
                                <div class="flex justify-center items-center">
                                    <template x-if="product.is_on_sale && product.sale_price !== null">
                                        <div class="text-center">
                                            <span class="text-gray-400 line-through text-sm" x-text="'$' + product.price"></span>
                                            <span class="text-[#B70113] font-bold text-lg ml-2" x-text="'$' + product.sale_price"></span>
                                        </div>
                                    </template>
                                    <template x-if="!product.is_on_sale || product.sale_price === null">
                                        <span class="text-[#B70113] font-bold text-lg" x-text="'$' + product.price"></span>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <div class="flex justify-center mt-12 space-x-2 hidden sm:flex" x-show="slides.length > visibleSlides">
            <template x-for="(_, index) in totalSlideGroups" :key="index">
                <button @click="goToSlideGroup(index)" 
                        class="w-3 h-3 rounded-full transition-all"
                        :class="{
                            'bg-[#007BFF]': currentSlideGroup === index,  <!-- electric blue active -->
                            'bg-gray-300': currentSlideGroup !== index
                        }"
                        :aria-label="'Go to slide ' + (index + 1)">
                </button>
            </template>
        </div>

        <div class="text-center mt-8">
            <a href="{{ route('shop') }}" 
            class="inline-block bg-[#007BFF] hover:bg-[#0056b3] text-white font-medium py-3 px-8 rounded-full transition-all transform hover:scale-105 shadow-md">
                Show More
            </a>
        </div>
    </div>
</section>


<!-- On Sale Products Section -->
<section class="bg-white py-12">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl mt-6 mb-10" style="font-family: 'Open Sans', sans-serif;">
            On Sale
        </h2>

        <div x-data="{
            activeSlide: 0,
            slides: {{ $saleProducts->toJson() }},
            visibleSlides: 4,
            sliding: false,
            interval: null,
            isHovered: false,

            get slidesWithClones() {
                if (this.slides.length <= this.visibleSlides) return this.slides;
                return [...this.slides, ...this.slides.slice(0, this.visibleSlides)];
            },

            prev() {
                if (this.sliding || this.slides.length <= this.visibleSlides) return;
                this.sliding = true;
                this.activeSlide =
                    this.currentSlideGroup === 0
                        ? (this.totalSlideGroups - 1) * this.visibleSlides
                        : this.activeSlide - this.visibleSlides;
                setTimeout(() => this.sliding = false, 500);
            },

            next() {
                if (this.sliding || this.slides.length <= this.visibleSlides || this.isHovered) return;
                this.sliding = true;
                this.activeSlide =
                    this.currentSlideGroup >= this.totalSlideGroups - 1
                        ? 0
                        : this.activeSlide + this.visibleSlides;
                setTimeout(() => this.sliding = false, 500);
            },

            get totalSlideGroups() {
                return Math.ceil(this.slides.length / this.visibleSlides);
            },

            get currentSlideGroup() {
                if (this.activeSlide >= this.slides.length) return 0;
                return Math.floor(this.activeSlide / this.visibleSlides);
            },

            goToSlideGroup(i) {
                this.activeSlide = i * this.visibleSlides;
            },

            updateVisibleSlides() {
                this.visibleSlides =
                    window.innerWidth < 640 ? 1 :
                    window.innerWidth < 768 ? 2 :
                    window.innerWidth < 1024 ? 3 : 4;
            },

            pauseAutoplay() {
                this.isHovered = true;
                clearInterval(this.interval);
            },

            resumeAutoplay() {
                this.isHovered = false;
                this.interval = setInterval(() => this.next(), 8000);
            },

            init() {
                this.updateVisibleSlides();
                window.addEventListener('resize', () => this.updateVisibleSlides());
                this.interval = setInterval(() => this.next(), 8000);
            }
        }"
        x-init="init()"
        class="relative">

            <div class="relative pb-2
                        overflow-x-auto sm:overflow-hidden
                        snap-x snap-mandatory
                        scrollbar-hide"
                 @mouseenter="pauseAutoplay()"
                 @mouseleave="resumeAutoplay()">

                <div class="flex transition-transform duration-500 ease-in-out sm:transition-transform"
                     :style="window.innerWidth < 640
                        ? 'transform: none'
                        : `transform: translateX(-${(activeSlide * 100) / visibleSlides}%)`">

                    <template x-for="(product, index) in slidesWithClones" :key="index">
                        <div class="flex-shrink-0 px-3 transition-all duration-300 snap-start"
                             :class="{
                                'w-full': visibleSlides === 1,
                                'w-1/2': visibleSlides === 2,
                                'w-1/3': visibleSlides === 3,
                                'w-1/4': visibleSlides === 4
                             }">

                            <div class="bg-white rounded-lg overflow-hidden h-full flex flex-col
                                        shadow-[0_2px_8px_rgba(0,0,0,0.1)]
                                        hover:shadow-[0_4px_12px_rgba(0,0,0,0.15)]">

                                <div class="relative h-64 flex items-center justify-center bg-white">
                                    <template x-if="product.image">
                                        <a :href="'/product-details/' + product.id">
                                            <img
                                                :src="'{{ asset('storage') }}/' + product.image"
                                                :alt="product.name"
                                                class="w-52 h-52 object-contain transition-transform duration-300 hover:scale-105">
                                        </a>
                                    </template>

                                    <template x-if="!product.image">
                                        <div class="w-full h-full flex items-center justify-center text-gray-300">
                                            <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14
                                                         m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    </template>

                                    <template x-if="product.is_on_sale">
                                        <div class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
                                            SALE
                                        </div>
                                    </template>
                                </div>

                                <div class="p-5 flex-grow flex flex-col">
                                    <div class="border-t border-gray-200 mb-4"></div>

                                    <h3 class="font-medium text-gray-800 text-center mb-4"
                                        style="font-family: 'Open Sans', sans-serif; font-size:17px;"
                                        x-text="product.name"></h3>

                                    <div class="border-t border-gray-200 mt-auto mb-4"></div>

                                    <div class="flex justify-center">
                                        <template x-if="product.is_on_sale && product.sale_price !== null">
                                            <div>
                                                <span class="text-gray-400 line-through text-sm"
                                                      x-text="'$' + Number(product.price).toFixed(2)"></span>
                                                <span class="text-[#B70113] font-bold text-lg ml-2"
                                                      x-text="'$' + Number(product.sale_price).toFixed(2)"></span>
                                            </div>
                                        </template>
                                        <template x-if="!product.is_on_sale || product.sale_price === null">
                                            <span class="text-[#B70113] font-bold text-lg"
                                                  x-text="'$' + Number(product.price).toFixed(2)"></span>
                                        </template>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <div class="flex justify-center mt-12 space-x-2 hidden sm:flex" x-show="slides.length > visibleSlides">
                <template x-for="(_, index) in totalSlideGroups" :key="index">
                    <button @click="goToSlideGroup(index)"
                            class="w-3 h-3 rounded-full transition-all"
                            :class="{
                                'bg-[#007BFF]': currentSlideGroup === index,
                                'bg-gray-300': currentSlideGroup !== index
                            }">
                    </button>
                </template>
            </div>
        </div>

        <div class="text-center mt-8">
            <a href="{{ route('shop') }}"
               class="inline-block bg-[#007BFF] hover:bg-[#0056b3] text-white font-medium py-3 px-8 rounded-full transition-all transform hover:scale-105 shadow-md">
                Show More
            </a>
        </div>
    </div>
</section>


<!-- Latest Products Section -->
<section class="bg-white py-12">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl mb-10 latest-heading" style="font-family: 'Open Sans', sans-serif;">Latest Items</h2>

        <div x-data="{
            activeSlide: 0,
            slides: {{ $latestProducts->toJson() }},
            visibleSlides: 4,
            sliding: false,
            interval: null,
            isHovered: false,

            get slidesWithClones() {
                if (this.slides.length <= this.visibleSlides) return this.slides;
                return [
                    ...this.slides,
                    ...this.slides.slice(0, this.visibleSlides)
                ];
            },

            prev() {
                if (this.sliding || this.slides.length <= this.visibleSlides) return;
                this.sliding = true;

                if (this.currentSlideGroup === 0) {
                    this.activeSlide = (this.totalSlideGroups - 1) * this.visibleSlides;
                } else {
                    this.activeSlide -= this.visibleSlides;
                }

                setTimeout(() => this.sliding = false, 500);
            },

            next() {
                if (this.sliding || this.slides.length <= this.visibleSlides || this.isHovered) return;
                this.sliding = true;

                if (this.currentSlideGroup >= this.totalSlideGroups - 1) {
                    this.activeSlide = 0;
                } else {
                    this.activeSlide += this.visibleSlides;
                }

                setTimeout(() => this.sliding = false, 500);
            },

            get totalSlideGroups() {
                return Math.ceil(this.slides.length / this.visibleSlides);
            },

            get currentSlideGroup() {
                if (this.activeSlide >= this.slides.length) return 0;
                return Math.floor(this.activeSlide / this.visibleSlides);
            },

            goToSlideGroup(groupIndex) {
                this.activeSlide = groupIndex * this.visibleSlides;
            },

            updateVisibleSlides() {
                this.visibleSlides = window.innerWidth < 640 ? 1 :
                                    window.innerWidth < 768 ? 2 :
                                    window.innerWidth < 1024 ? 3 : 4;
            },

            pauseAutoplay() {
                this.isHovered = true;
                clearInterval(this.interval);
            },

            resumeAutoplay() {
                this.isHovered = false;
                this.interval = setInterval(() => this.next(), 8000);
            },

            init() {
                this.updateVisibleSlides();
                window.addEventListener('resize', () => this.updateVisibleSlides());
                this.interval = setInterval(() => this.next(), 8000);
                this.$el.addEventListener('alpine:destroy', () => {
                    clearInterval(this.interval);
                    window.removeEventListener('resize', this.updateVisibleSlides);
                });
            }
        }"
        x-init="init()"
        class="relative">

            <div class="relative pb-2
                        overflow-x-auto sm:overflow-hidden
                        snap-x snap-mandatory
                        scrollbar-hide"
                 @mouseenter="pauseAutoplay()"
                 @mouseleave="resumeAutoplay()">

                <div class="flex transition-transform duration-500 ease-in-out sm:transition-transform"
                     :style="window.innerWidth < 640
                        ? 'transform: none'
                        : `transform: translateX(-${(activeSlide * 100) / visibleSlides}%)`">

                    <template x-for="(product, index) in slidesWithClones" :key="index">
                        <div class="flex-shrink-0 px-3 transition-all duration-300 snap-start"
                             :class="{
                                 'w-full': visibleSlides === 1,
                                 'w-1/2': visibleSlides === 2,
                                 'w-1/3': visibleSlides === 3,
                                 'w-1/4': visibleSlides === 4
                             }">

                            <div class="bg-white rounded-lg overflow-hidden transition-all duration-300 h-full flex flex-col 
                                        shadow-[0_2px_8px_rgba(0,0,0,0.1)] hover:shadow-[0_4px_12px_rgba(0,0,0,0.15)]">
                                <div class="relative h-64 p-0 flex items-center justify-center bg-white">
                                    <template x-if="product.image">
                                        <a :href="'/product-details/' + product.id">
                                            <img :src="'{{ asset('storage') }}/' + product.image"
                                                 :alt="product.name"
                                                 class="w-52 h-52 object-contain transition-transform duration-300 hover:scale-105">
                                        </a>
                                    </template>

                                    <template x-if="!product.image">
                                        <div class="w-full h-full flex items-center justify-center text-gray-300">
                                            <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" 
                                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14
                                                         m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                    </template>

                                    <template x-if="product.is_on_sale">
                                        <div class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
                                            SALE
                                        </div>
                                    </template>
                                </div>

                                <div class="p-4 flex-grow flex flex-col">
                                    <div class="border-t border-gray-200 mb-4"></div>
                                    <h3 class="font-medium text-gray-800 text-center mb-4" style="font-family: 'Open Sans', sans-serif; font-size:17px;" x-text="product.name"></h3>
                                    <div class="border-t border-gray-200 mt-auto mb-4"></div>
                                    <div class="flex justify-center items-center">
                                        <template x-if="product.is_on_sale && product.sale_price !== null">
                                            <div class="text-center">
                                                <span class="text-gray-400 line-through text-sm" x-text="'$' + product.price"></span>
                                                <span class="text-[#B70113] font-bold text-lg ml-2" x-text="'$' + product.sale_price"></span>
                                            </div>
                                        </template>
                                        <template x-if="!product.is_on_sale || product.sale_price === null">
                                            <span class="text-[#B70113] font-bold text-lg" x-text="'$' + product.price"></span>
                                        </template>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </template>
                </div>
            </div>

            <div class="flex justify-center mt-12 space-x-2 hidden sm:flex" x-show="slides.length > visibleSlides">
                <template x-for="(_, index) in totalSlideGroups" :key="index">
                    <button @click="goToSlideGroup(index)" 
                            class="w-3 h-3 rounded-full transition-all"
                            :class="{
                                'bg-[#007BFF]': currentSlideGroup === index,
                                'bg-gray-300': currentSlideGroup !== index
                            }"
                            :aria-label="'Go to slide ' + (index + 1)">
                    </button>
                </template>
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('shop') }}"
                   class="inline-block bg-[#007BFF] hover:bg-[#0056b3] text-white font-medium py-3 px-8 rounded-full transition-all transform hover:scale-105 shadow-md">
                    Show More
                </a>
            </div>

        </div>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h2 class="text-4xl text-center mb-8 text-gray-800">Featured Brands</h2>

    <div class="swiper desktop-slider">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="brand-item"><a href="http://127.0.0.1:8000/shop/all/brands/foshan-ouyad/min-price/0/max-price/2500"><img src="images/foshan.png" alt="Foshan"></a></div>
                <div class="brand-item"><a href="http://127.0.0.1:8000/shop/all/brands/panasonic/min-price/0/max-price/2500"><img src="images/Panasonic.png" alt="Panasonic"></a></div>
                <div class="brand-item"><a href="http://127.0.0.1:8000/shop/all/brands/osram/min-price/0/max-price/2500"><img src="images/Osram.png" alt="Osram"></a></div>
                <div class="brand-item"><a href="http://127.0.0.1:8000/shop/all/brands/felicity/min-price/0/max-price/2500"><img src="images/Felicity.png" alt="Felicity"></a></div>
            </div>

            <div class="swiper-slide">
                <div class="brand-item"><a href="http://127.0.0.1:8000/shop/all/brands/hyundai/min-price/0/max-price/2500"><img src="images/Hyundai2.png" alt="Hyundai"></a></div>
                <div class="brand-item"><a href="http://127.0.0.1:8000/shop/all/brands/schneider/min-price/0/max-price/2500"><img src="images/Schneider.png" alt="Schneider"></a></div>
                <div class="brand-item"><a href="http://127.0.0.1:8000/shop/all/brands/kingroon/min-price/0/max-price/2500"><img src="images/Kingroon.png" alt="Kingroon"></a></div>
                <div class="brand-item"><a href="http://127.0.0.1:8000/shop/all/brands/printex/min-price/0/max-price/2500"><img src="images/Printex.png" alt="Printex"></a></div>
            </div>
        </div>
    </div>

    <div class="swiper mobile-slider">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="brand-item" style="width:50%;"><a href="http://127.0.0.1:8000/shop/all/brands/foshan-ouyad/min-price/0/max-price/2500"><img src="images/foshan.png" alt="Foshan"></a></div>
                <div class="brand-item" style="width:50%;"><a href="http://127.0.0.1:8000/shop/all/brands/panasonic/min-price/0/max-price/2500"><img src="images/Panasonic.png" alt="Panasonic"></a></div>
            </div>

            <div class="swiper-slide">
                <div class="brand-item" style="width:50%;"><a href="http://127.0.0.1:8000/shop/all/brands/osram/min-price/0/max-price/2500"><img src="images/Osram.png" alt="Osram"></a></div>
                <div class="brand-item" style="width:50%;"><a href="http://127.0.0.1:8000/shop/all/brands/felicity/min-price/0/max-price/2500"><img src="images/Felicity.png" alt="Felicity"></a></div>
            </div>

            <div class="swiper-slide">
                <div class="brand-item" style="width:50%;"><a href="http://127.0.0.1:8000/shop/all/brands/hyundai/min-price/0/max-price/2500"><img src="images/Hyundai2.png" alt="Hyundai"></a></div>
                <div class="brand-item" style="width:50%;"><a href="http://127.0.0.1:8000/shop/all/brands/schneider/min-price/0/max-price/2500"><img src="images/Schneider.png" alt="Schneider"></a></div>
            </div>

            <div class="swiper-slide">
                <div class="brand-item" style="width:50%;"><a href="http://127.0.0.1:8000/shop/all/brands/kingroon/min-price/0/max-price/2500"><img src="images/Kingroon.png" alt="Kingroon"></a></div>
                <div class="brand-item" style="width:50%;"><a href="http://127.0.0.1:8000/shop/all/brands/printex/min-price/0/max-price/2500"><img src="images/Printex.png" alt="Printex"></a></div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Swiper('.desktop-slider', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            pagination: { el: '.desktop-slider .swiper-pagination', clickable: true },
            navigation: { nextEl: '.desktop-slider .swiper-button-next', prevEl: '.desktop-slider .swiper-button-prev' },
            autoplay: { delay: 6000, disableOnInteraction: false }
        });

        new Swiper('.mobile-slider', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            pagination: { el: '.mobile-slider .swiper-pagination', clickable: true },
            navigation: { nextEl: '.mobile-slider .swiper-button-next', prevEl: '.mobile-slider .swiper-button-prev' },
            autoplay: { delay: 6000, disableOnInteraction: false }
        });
    });
</script>
@endsection