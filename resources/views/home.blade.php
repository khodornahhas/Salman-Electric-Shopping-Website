@extends('layouts.main')
@section('head')
    <title>Salman Electric - Home</title>
    <link rel="icon" type="image/png" href="{{ asset('images/salmanlogo.png') }}?v={{ time() }}">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
@endsection
@section('content')
<style>
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
    .swiper-slide {
        width: auto !important;
        height: auto !important;
    }

    .swiper-pagination-bullet {
        width: 12px !important;
        height: 12px !important;
        background: #d1d5db !important;
        opacity: 1 !important;
        transition: all 0.3s ease !important;
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
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease !important;
    }

    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        background-color: rgba(255, 255, 255, 0.9);
        transform: scale(1.1);
    }

    .swiper-button-next:after,
    .swiper-button-prev:after {
        font-size: 20px !important;
        font-weight: bold !important;
        color: #f59e0b !important;
    }
    .slide-enter-active, .slide-leave-active {
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
</style>
<!-- Image Slider DISPLAY -->
<div x-data="{
    activeSlide: 0,
    slides: [
        { 
            id: 1, 
            image: '{{ asset('images/PO.png') }}', 
            alt: 'Salman Electric Promotion',
            headline: 'PREMIUM ELECTRICAL SOLUTIONS',
            subtext: 'Trusted by homes & businesses since 1995',
            cta: 'SHOP NOW',
            link: '/shop'

        },
        { 
            id: 2, 
            bgType: 'split',
            bgLeft: '#2C3E50',
            bgRight: '#83A0AF',
            alt: 'EV Charger Special',
            headline: 'EV CHARGER INSTALLATION',
            subtext: 'Driven by innovation, powered by electricity.',
            cta: 'LEARN MORE',
            imageRight: '{{ asset('images/pack-charge.png') }}' 
        },
        { 
            id: 4,
            bgType: 'custom',
            bgColor: 'rgba(253, 230, 138, 0.7)', /* Amber-200 with 70% opacity */
            image: '{{ asset('images/essentials.png') }}',
            alt: 'Electrical Essentials',
            headline: 'ELECTRICAL ESSENTIALS',
            subtext: 'Quality components for every need',
            cta: 'EXPLORE',
            pack1: '{{ asset('images/pack1.png') }}',
            pack2: '{{ asset('images/pack2.png') }}'
        }
    ],
    prev() {
        this.activeSlide = this.activeSlide === 0 ? this.slides.length - 1 : this.activeSlide - 1;
    },
    next() {
        this.activeSlide = this.activeSlide === this.slides.length - 1 ? 0 : this.activeSlide + 1;
    }
}" class="relative overflow-hidden pb-8"> 
    
    <div class="relative h-[30rem]">
        <template x-for="(slide, index) in slides" :key="slide.id">
            <div 
                x-show="activeSlide === index"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="absolute inset-0 w-full h-full"
            >
                <template x-if="slide.bgType === 'split'">
                    <div class="absolute inset-0 w-full h-full flex">
                        <div class="w-1/2 h-full" :style="`background-color: ${slide.bgLeft}`"></div>
                        <div class="w-1/2 h-full" :style="`background-color: ${slide.bgRight}`"></div>
                    </div>
                </template>

                <template x-if="!slide.bgType">
                    <img :src="slide.image" :alt="slide.alt" class="absolute inset-0 w-full h-full object-cover">
                </template>

                <template x-if="slide.bgType === 'custom'">
                    <div class="absolute inset-0 w-full h-full" :style="`background-color: ${slide.bgColor}`">
                        <img :src="slide.image" :alt="slide.alt" class="absolute inset-0 w-full h-full object-cover mix-blend-multiply">
                        <img :src="slide.pack1" alt="Electrical product 1" class="absolute left-12 bottom-12 h-80 object-contain animate-float-slow">
                        <img :src="slide.pack2" alt="Electrical product 2" class="absolute right-12 top-12 h-80 object-contain animate-float-reverse">
                    </div>
                </template>
                
                <div x-show="!slide.bgType" class="absolute inset-0 bg-black/30"></div>
                
                <div class="relative z-10 h-full flex items-center px-8">
                    <template x-if="slide.bgType === 'split'">
                        <div class="container mx-auto flex items-center">
                            <div class="w-1/2 pl-20 pr-12">
                            <h2 class="text-4xl md:text-5xl font-bold text-white mb-4 uppercase tracking-wide" 
                                x-text="slide.headline"></h2>
                            <p class="text-xl mb-8 text-white" 
                            x-text="slide.subtext"></p>
                            <a :href="slide.link" class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 px-8 rounded-full text-lg transition-all transform hover:scale-105 shadow-lg">
                                <span x-text="slide.cta"></span>
                            </a>
                        </div>
                            
                            <div class="w-1/2 flex justify-center">
                                <img :src="slide.imageRight" :alt="slide.alt" class="max-h-80 object-contain animate-float">
                            </div>
                        </div>
                    </template>
                    
                    <template x-if="!slide.bgType">
                        <div class="max-w-2xl mx-auto text-center">
                            <h2 class="text-4xl md:text-5xl font-bold text-white mb-4 uppercase tracking-wide" 
                                x-text="slide.headline"></h2>
                            <p class="text-xl mb-8 text-white/90" 
                               x-text="slide.subtext"></p>
                            <button class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 px-8 rounded-full text-lg transition-all transform hover:scale-105 shadow-lg">
                                <span x-text="slide.cta"></span>
                            </button>
                        </div>
                    </template>
                    
                    <template x-if="slide.bgType === 'custom'">
                        <div class="max-w-2xl mx-auto text-center">
                            <h2 class="text-4xl md:text-5xl font-bold text-white mb-4 uppercase tracking-wide drop-shadow-lg" 
                                x-text="slide.headline"></h2>
                            <p class="text-xl mb-8 text-white drop-shadow-lg" 
                            x-text="slide.subtext"></p>
                            <button class="bg-amber-600 hover:bg-amber-700 text-white font-bold py-3 px-8 rounded-full text-lg transition-all transform hover:scale-105 shadow-lg">
                                <span x-text="slide.cta"></span>
                            </button>
                        </div>
                    </template>
                </div>
            </div>
        </template>    
    </div>
        
    <button @click="prev()" 
        class="absolute left-4 top-1/2 -translate-y-1/2 bg-transparent text-white p-3 rounded-full hover:bg-black/20 transition-all z-20">
    <i class='bx bx-chevron-left text-2xl'></i>
    </button>
    <button @click="next()" 
            class="absolute right-4 top-1/2 -translate-y-1/2 bg-transparent text-white p-3 rounded-full hover:bg-black/20 transition-all z-20">
        <i class='bx bx-chevron-right text-2xl'></i>
    </button>
    
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex space-x-2 z-20">
        <template x-for="(slide, index) in slides" :key="slide.id">
            <button @click="activeSlide = index" 
                    class="w-8 h-1.5 rounded-full transition-all"
                    :class="{ 'bg-amber-500 w-10': activeSlide === index, 'bg-white/50': activeSlide !== index }">
            </button>
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
        <h2 class="text-2xl md:text-3xl  text-gray-800 mb-6 text-center">Explore Our Categories</h2>
        
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
                
                if (this.activeSlide === 0) {
                    this.activeSlide = this.slides.length;
                    setTimeout(() => {
                        this.activeSlide = this.slides.length - 1;
                        this.sliding = false;
                    }, 10);
                } else {
                    this.activeSlide--;
                    setTimeout(() => this.sliding = false, 500);
                }
            },
            
            next() {
                if (this.sliding || this.slides.length <= this.visibleSlides || this.isHovered) return;
                this.sliding = true;
                
                if (this.activeSlide >= this.slides.length) {
                    this.activeSlide = 1; // Small jump for smooth reset
                    setTimeout(() => {
                        this.activeSlide = 0;
                        this.sliding = false;
                    }, 500);
                } else {
                    this.activeSlide++;
                    setTimeout(() => this.sliding = false, 500);
                }
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
                }, 5000);
            },
            
            init() {
                this.updateVisibleSlides();
                window.addEventListener('resize', () => this.updateVisibleSlides());
                
                this.interval = setInterval(() => {
                    this.next();
                }, 5000);
                
                this.$el.addEventListener('alpine:destroy', () => {
                    clearInterval(this.interval);
                    window.removeEventListener('resize', this.updateVisibleSlides);
                });
            }
        }" 
        x-init="init()"
        class="relative">
            <div class="relative overflow-hidden pb-2"
                 @mouseenter="pauseAutoplay()"
                 @mouseleave="resumeAutoplay()">
                <div class="flex transition-transform duration-500 ease-in-out"
                     :style="`transform: translateX(-${(activeSlide * 100) / visibleSlides}%)`">
                   <template x-for="(product, index) in slidesWithClones" :key="index">
                    <div class="flex-shrink-0 px-3 transition-all duration-300"
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

        <div class="text-center mt-8">
            <a href="{{ route('shop') }}" class="inline-block bg-amber-500 hover:bg-amber-600 text-white font-medium py-3 px-8 rounded-full transition-all transform hover:scale-105 shadow-md">
                Show More
            </a>
        </div>
    </div>
</section>

<!-- On Sale Products Section -->
<section class="bg-white py-12">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl  mt-6 mb-10"style="font-family: 'Open Sans', sans-serif;">On Sale</h2>

        <div x-data="{
            activeSlide: 0,
            slides: {{ $saleProducts->toJson() }}, 
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
                
                if (this.activeSlide === 0) {
                    this.activeSlide = this.slides.length;
                    setTimeout(() => {
                        this.activeSlide = this.slides.length - 1;
                        this.sliding = false;
                    }, 10);
                } else {
                    this.activeSlide--;
                    setTimeout(() => this.sliding = false, 500);
                }
            },
            
            next() {
                if (this.sliding || this.slides.length <= this.visibleSlides || this.isHovered) return;
                this.sliding = true;
                
                if (this.activeSlide >= this.slides.length) {
                    this.activeSlide = 1; // Small jump for smooth reset
                    setTimeout(() => {
                        this.activeSlide = 0;
                        this.sliding = false;
                    }, 500);
                } else {
                    this.activeSlide++;
                    setTimeout(() => this.sliding = false, 500);
                }
            },
            
            get totalSlideGroups() {
                return Math.ceil(this.slides.length / this.visibleSlides);
            },
            
            get currentSlideGroup() {
                if (this.activeSlide >= this.slides.length) {
                    return 0; // When showing cloned items
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
                }, 5000);
            },
            
            init() {
                this.updateVisibleSlides();
                window.addEventListener('resize', () => this.updateVisibleSlides());
                
                this.interval = setInterval(() => {
                    this.next();
                }, 5000);
                
                this.$el.addEventListener('alpine:destroy', () => {
                    clearInterval(this.interval);
                    window.removeEventListener('resize', this.updateVisibleSlides);
                });
            }
        }" 
        x-init="init()"
        class="relative">
            <div class="relative overflow-hidden pb-2"
                 @mouseenter="pauseAutoplay()"
                 @mouseleave="resumeAutoplay()">
                <div class="flex transition-transform duration-500 ease-in-out"
                     :style="`transform: translateX(-${(activeSlide * 100) / visibleSlides}%)`">
                    <template x-for="(product, index) in slidesWithClones" :key="index">
                        <div class="flex-shrink-0 px-3 transition-all duration-300"
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
                                                x-init="console.log('Image debug', { id: product.id, raw: product.image, final: '{{ asset('storage') }}/' + product.image })"
                                            />

                                        </a>
                                    </template>

                                    <template x-if="!product.image">
                                        <div class="w-full h-full flex items-center justify-center text-gray-300">
                                            <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
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
                                    <h3 class="font-medium text-gray-800 text-center mb-4"style="font-family: 'Open Sans', sans-serif;font-size:17px;" x-text="product.name"></h3>                                  
                                    <div class="border-t border-gray-200 mt-auto mb-4"></div>
                                    
                                    <div class="flex justify-center items-center">
                                    <template x-if="product.is_on_sale && product.sale_price !== null">
                                        <div class="text-center">
                                            <span class="text-gray-400 line-through text-sm" x-text="'$' + Number(product.price).toFixed(2)"></span>
                                            <span class="text-[#B70113] font-bold text-lg ml-2" x-text="'$' + Number(product.sale_price).toFixed(2)"></span>
                                        </div>
                                    </template>
                                    <template x-if="!product.is_on_sale || product.sale_price === null">
                                        <span class="text-[#B70113] font-bold text-lg" x-text="'$' + Number(product.price).toFixed(2)"></span>
                                    </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <div class="flex justify-center mt-12 space-x-2" x-show="slides.length > visibleSlides">
                <template x-for="(_, index) in totalSlideGroups" :key="index">
                    <button @click="goToSlideGroup(index)" 
                            class="w-3 h-3 rounded-full transition-all"
                            :class="{
                                'bg-amber-500': currentSlideGroup === index, 
                                'bg-gray-300': currentSlideGroup !== index
                            }"
                            :aria-label="'Go to slide ' + (index + 1)">
                    </button>
                </template>
            </div>
        </div>

        <div class="text-center mt-8">
            <a href="#" class="inline-block bg-amber-500 hover:bg-amber-600 text-white font-medium py-3 px-8 rounded-full transition-all transform hover:scale-105 shadow-md">
                Show More
            </a>
        </div>
    </div>
</section>

<!-- Latest Products Section -->
<section class="bg-white py-12">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl mb-10 latest-heading"style="font-family: 'Open Sans', sans-serif;">Latest Items</h2>

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
                
                if (this.activeSlide === 0) {
                   
                    this.activeSlide = this.slides.length;
                    setTimeout(() => {
                        this.activeSlide = this.slides.length - 1;
                        this.sliding = false;
                    }, 10);
                } else {
                    this.activeSlide--;
                    setTimeout(() => this.sliding = false, 500);
                }
            },
            
            next() {
                if (this.sliding || this.slides.length <= this.visibleSlides || this.isHovered) return;
                this.sliding = true;
                
                if (this.activeSlide >= this.slides.length) {
                    this.activeSlide = 1; // Small jump for smooth reset
                    setTimeout(() => {
                        this.activeSlide = 0;
                        this.sliding = false;
                    }, 500);
                } else {
                    this.activeSlide++;
                    setTimeout(() => this.sliding = false, 500);
                }
            },
            
            get totalSlideGroups() {
                return Math.ceil(this.slides.length / this.visibleSlides);
            },
            
            get currentSlideGroup() {
                if (this.activeSlide >= this.slides.length) {
                    return 0; // When showing cloned items
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
                }, 5000);
            },
            
            init() {
                this.updateVisibleSlides();
                window.addEventListener('resize', () => this.updateVisibleSlides());
                
                this.interval = setInterval(() => {
                    this.next();
                }, 5000);
                
                this.$el.addEventListener('alpine:destroy', () => {
                    clearInterval(this.interval);
                    window.removeEventListener('resize', this.updateVisibleSlides);
                });
            }
        }" 
        x-init="init()"
        class="relative">
        <div class="relative overflow-hidden pb-2"
            @mouseenter="pauseAutoplay()"
            @mouseleave="resumeAutoplay()">
            <div class="flex transition-transform duration-500 ease-in-out"
             :style="`transform: translateX(-${(activeSlide * 100) / visibleSlides}%)`">
            <template x-for="(product, index) in slidesWithClones" :key="index">
                <div class="flex-shrink-0 px-3 transition-all duration-300"
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
                                        x-init="console.log('Latest Image debug', { id: product.id, raw: product.image, final: '{{ asset('storage') }}/' + product.image })"
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
    <div class="text-center mt-8">
        <a href="#" class="inline-block bg-amber-500 hover:bg-amber-600 text-white font-medium py-3 px-8 rounded-full transition-all transform hover:scale-105 shadow-md">
            Show More
        </a>
    </div>
</div>
</section>

<section class="bg-blue-900 py-10 mt-6">
    <div class="max-w-6xl mx-auto px-4">
        <h2 class="text-2xl md:text-3xl font-bold text-white mb-6 text-center">Featured Brands</h2>
        <div class="logos bg-white rounded-xl shadow-lg py-6 px-4 relative overflow-hidden">
            <div class="absolute inset-y-0 left-0 w-16 bg-gradient-to-r from-blue-900 to-transparent z-10 pointer-events-none"></div>
            <div class="absolute inset-y-0 right-0 w-16 bg-gradient-to-l from-blue-900 to-transparent z-10 pointer-events-none"></div>
            
            <div class="logos-slide" id="brandSlide">
                @foreach ($brands as $brand)
                    <a href="{{ route('shop.filters', [
                        'categorySlug' => 'all',
                        'brandSlugs' => $brand->slug ?? Str::slug($brand->name),
                        'minPrice' => 0,
                        'maxPrice' => 2500
                    ]) }}" 
                    class="mx-6 sm:mx-8 transition-all duration-300 hover:scale-105 hover:brightness-110">
                        <img src="{{ asset('images/' . $brand->image) }}" 
                             alt="{{ $brand->name }}"
                             class="max-h-12 sm:max-h-14 w-auto object-contain"
                             loading="lazy">
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sliderContainer = document.querySelector('.logos');
        const sliderTrack = document.getElementById('brandSlide');
        const brandItems = Array.from(sliderTrack.children);
        const itemCount = brandItems.length;
        
        brandItems.forEach(item => {
            sliderTrack.appendChild(item.cloneNode(true));
        });
        
        let currentIndex = 0;
        let stepInterval;
        const stepDuration = 4000; 
        const itemWidth = brandItems[0].offsetWidth + 70; 
        
        function stepToNextBrand() {
            currentIndex = (currentIndex + 1) % itemCount;
            const newPosition = -currentIndex * itemWidth;
            
            sliderTrack.style.transition = 'transform 0.5s ease-in-out';
            sliderTrack.style.transform = `translateX(${newPosition}px)`;
            
            if (currentIndex === 0) {
                setTimeout(() => {
                    sliderTrack.style.transition = 'none';
                    sliderTrack.style.transform = 'translateX(0)';
                }, 800);
            }
        }
        
        function startAnimation() {
            stepInterval = setInterval(stepToNextBrand, stepDuration);
        }
        
        sliderContainer.addEventListener('mouseenter', () => {
            clearInterval(stepInterval);
        });
        
        sliderContainer.addEventListener('mouseleave', () => {
            startAnimation();
        });
        
        function handleVisibility() {
            if (document.hidden) {
                clearInterval(stepInterval);
            } else {
                startAnimation();
            }
        }
        
        document.addEventListener('visibilitychange', handleVisibility);
        startAnimation();
        
        return () => {
            clearInterval(stepInterval);
            document.removeEventListener('visibilitychange', handleVisibility);
        };
    });
</script>
@endsection