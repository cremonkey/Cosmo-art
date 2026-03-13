<x-layout>
    @php
        $settings = app(\App\Settings\GlobalSettings::class);
    @endphp

    <!-- HERO SECTION (User Story 1) -->
    <section class="relative h-screen w-full flex items-center justify-center overflow-hidden bg-transparent">

        <!-- Optional Particle Shimmer (Very Minimal) -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0IiBoZWlnaHQ9IjQiPjxyZWN0IHdpZHRoPSI0IiBoZWlnaHQ9IjQiIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wMyIvPjwvc3ZnPg==')] z-0 opacity-40 mix-blend-overlay"></div>

        <!-- Hero Content -->
        <div class="relative z-10 flex flex-col items-center justify-center text-center px-4 max-w-4xl mx-auto mt-16">

            <!-- Tagline Reveal -->
            <p class="reveal-on-scroll font-sans text-medical text-sm md:text-base tracking-[0.2em] uppercase mb-4" style="transition-delay: 0.5s;">
                Advanced Nutrition & NAD+ Medi-Therapy.
            </p>

            <!-- Main Headline -->
            <h1 class="reveal-on-scroll mb-6 drop-shadow-lg flex justify-center" style="transition-delay: 0.8s;">
                <img src="{{ asset('assets/SVG/Logo.svg') }}" alt="{{ $settings->site_name }}" class="h-12 md:h-16 lg:h-20 w-auto" />
            </h1>

            <!-- Subheading -->
            <p class="reveal-on-scroll font-sans text-beige text-lg md:text-xl font-light tracking-wide max-w-2xl mb-12 drop-shadow-md" style="transition-delay: 1.2s;">
                {{ $about?->hero_title ?? 'INNOVATION FLOW LIKE SEA' }}
            </p>

            <!-- CTA Button -->
            <div class="reveal-on-scroll" style="transition-delay: 1.6s;">
                <a href="{{ url('/products') }}" class="inline-block border border-medical text-medical hover:bg-medical hover:text-cream px-10 py-4 uppercase tracking-[0.15em] text-sm transition-all duration-500 ease-out hover:shadow-[0_0_25px_rgba(229,138,74,0.4)] relative overflow-hidden group backdrop-blur-sm bg-forest/20">
                    <span class="relative z-10">Explore Our Solutions</span>
                </a>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="reveal-on-scroll absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center" style="transition-delay: 2.2s;">
            <span class="text-beige/70 text-xs tracking-widest uppercase mb-2 font-sans drop-shadow-md">Scroll</span>
            <div class="w-[1px] h-12 bg-gradient-to-b from-medical/90 to-transparent"></div>
        </div>
    </section>

    <!-- ABOUT SNIPPET SECTION -->
    <section class="py-24 bg-sage/90 relative overflow-hidden border-b border-white/10">
        <!-- Decorative fine line -->
        <div class="absolute top-0 right-1/3 w-[1px] h-full bg-white/10 pointer-events-none"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                
                <!-- Left: Clinic Imagery Mask -->
                <div class="reveal-on-scroll relative aspect-[4/5] rounded-tl-[100px] rounded-br-[100px] overflow-hidden group shadow-2xl lg:order-last" style="transition-delay: 0.2s;">
                    <img src="{{ ($about && $about?->philosophy_image) ? Storage::url($about?->philosophy_image) : 'https://www.alo-medical.com/wp-content/uploads/2022/05/Title-Mesothearpy2.jpg' }}" alt="Luxury Clinic Interior" class="absolute inset-0 w-full h-full object-cover transition-transform duration-[1.5s] ease-in-out group-hover:scale-105">
                    <div class="absolute inset-0 bg-forest/20 mix-blend-multiply transition-colors group-hover:bg-transparent pointer-events-none"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-forest/80 to-transparent pointer-events-none"></div>
                </div>

                <!-- Right: Text Content -->
                <div class="reveal-on-scroll flex flex-col justify-center" style="transition-delay: 0.4s;">
                    <h3 class="font-sans text-beige/80 text-xs uppercase tracking-[0.2em] mb-4">{{ $about?->philosophy_subtitle ?? 'Philosophy' }}</h3>
                    <h2 class="font-serif text-4xl md:text-5xl text-cream tracking-wide mb-8">{{ $about?->philosophy_title ?? 'Where Science Meets Art.' }}</h2>
                    <div class="space-y-6 mb-10">
                        @if($about && $about?->philosophy_content)
                            <div class="font-sans text-cream/90 font-light leading-relaxed">
                                {!! nl2br(e($about?->philosophy_content)) !!}
                            </div>
                        @else
                            <p class="font-sans text-cream/90 font-light leading-relaxed">
                                We believe true luxury is longevity. Our approach to cellular regeneration is rooted in precise, methodical Swedish innovation, elevating restorative nutrition into an art form.
                            </p>
                            <p class="font-sans text-cream/90 font-light leading-relaxed">
                                Our protocols are developed with a foundational understanding of the body's intrinsic healing capabilities, utilizing highly bioavailable nutrients to target mitochondrial decline.
                            </p>
                        @endif
                    </div>
                    <a href="{{ url('/about') }}" class="inline-flex items-center text-medical tracking-wider text-sm font-medium uppercase hover:text-cream transition-colors w-max group">
                        Discover the Science
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- CATEGORY SHOWCASE SECTION -->
    @if($about?->is_visible ?? true)
    <section class="py-24 bg-forest/10 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 reveal-on-scroll">
                <h3 class="font-sans text-beige/80 text-xs uppercase tracking-[0.2em] mb-4">{{ $about?->showcase_subtitle ?? 'Our Focus' }}</h3>
                <h2 class="font-serif text-4xl md:text-5xl text-cream tracking-wide">{{ $about?->showcase_title ?? 'Pioneering Solutions' }}</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 lg:gap-16">
                @foreach($categories as $index => $category)
                    @php
                        // Force Nutrition to be tl/br and Derma to be tr/bl + mt-16
                        $isNutrition = $category->slug === 'nutrition';
                        $shapeClass = $isNutrition ? 'rounded-tl-[80px] rounded-br-[80px]' : 'rounded-tr-[80px] rounded-bl-[80px] lg:mt-16';
                        $imgSrc = $category->image ? Storage::url($category->image) : ($isNutrition ? 'https://images.unsplash.com/photo-1550831107-1553da8c8464?q=80&w=800&auto=format&fit=crop' : 'https://images.unsplash.com/photo-1616394584738-fc6e612e71b9?q=80&w=800&auto=format&fit=crop');
                        $tag = $isNutrition ? 'Oral & IV' : 'Topical & Mesotherapy';
                    @endphp
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="group relative aspect-[4/5] md:aspect-square overflow-hidden {{ $shapeClass }} shadow-xl reveal-on-scroll flex flex-col justify-end" style="transition-delay: {{ 0.2 * ($index + 1) }}s;">
                        <img src="{{ $imgSrc }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-[2s] group-hover:scale-105" alt="{{ $category->name }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-forest/90 via-forest/40 to-transparent"></div>
                        <div class="relative z-10 p-8 md:p-12 transition-transform duration-500 transform translate-y-4 group-hover:translate-y-0">
                            <span class="inline-block px-4 py-1 border border-cream/30 rounded-full text-cream text-xs uppercase tracking-widest mb-4">{{ $tag }}</span>
                            <h3 class="font-serif text-3xl text-cream mb-4">{{ $category->name }}</h3>
                            <p class="font-sans text-cream/80 font-light text-sm leading-relaxed mb-6 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                {{ $category->description }}
                            </p>
                            <span class="inline-flex items-center text-medical text-sm uppercase tracking-wider font-semibold group-hover:underline underline-offset-4 decoration-1">
                                Explore <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- BEFORE / AFTER SLIDER SECTION -->
    <section class="bg-forest/20 relative overflow-hidden border-b border-olive/30">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            
            <!-- Left Content Area -->
            <div class="flex flex-col justify-center px-8 py-20 lg:p-24 2xl:p-32 order-2 lg:order-1 relative z-10">
                <div class="reveal-on-scroll max-w-xl mx-auto lg:mx-0">
                    <span class="inline-block bg-medical text-white text-[10px] sm:text-xs font-sans tracking-[0.2em] px-4 py-1.5 uppercase mb-8 shadow-sm">
                        Anti-aging experts
                    </span>
                    
                    <h2 class="font-sans text-4xl sm:text-5xl lg:text-6xl text-cream tracking-tight font-light mb-8 leading-[1.1]">
                        EVERY FACIAL <br>PROCEDURE IS A <br>PIECE OF ART
                    </h2>
                    
                    <p class="font-sans text-beige/70 font-light text-sm sm:text-base leading-relaxed mb-12">
                        We offer the most advanced anti-aging techniques and technologies to restore a fresh, young appearance to the face and neck. Our products will be customized to enhance your natural facial harmony. Let us help you highlight your most beautiful features by smoothing wrinkles, lines, and folds, for a more vital, dynamic, and youthful appearance that looks completely natural.
                    </p>
                    
                    <a href="{{ url('/products') }}" class="inline-block border border-cream text-cream hover:bg-forest hover:text-cream px-8 py-3.5 uppercase tracking-widest text-xs font-medium transition-colors duration-300">
                        Facial Procedures
                    </a>
                </div>
            </div>

            <!-- Right Slider Area -->
            <div class="flex items-center justify-center p-8 lg:p-12 order-1 lg:order-2 w-full">
                
                <!-- Aesthetic Shape Wrapper (Fixes the shape and size) -->
                <div class="relative w-full max-w-md mx-auto aspect-[4/5] rounded-[40px] border-[8px] border-white shadow-2xl overflow-hidden bg-white">
                    
                    <!-- EXACT User Requested Div -->
                    <div class="relative w-full aspect-[4/5] lg:aspect-auto lg:h-full overflow-hidden order-1 lg:order-2 group cursor-ew-resize select-none" id="before-after-slider">
                        
                        <!-- After Image (Background) -->
                        <img src="{{ asset('assets/after-image.jpg') }}" alt="After treatment" class="absolute inset-0  top-0 left-0 w-[200%]  h-full object-cover object-right pointer-events-none select-none">
                        
                        <!-- Before Image (Foreground/Clipped) -->
                        <div class="absolute inset-0 w-1/2 overflow-hidden border-r-2 border-white shadow-[2px_0_10px_rgba(0,0,0,0.1)] z-10" id="slider-clipper">
                            <img src="{{ asset('assets/before-image.jpg') }}" alt="Before treatment" class="absolute top-0 left-0 w-[200%] h-full max-w-none object-cover object-right pointer-events-none select-none" id="slider-image-before">
                        </div>

                        <!-- Slider Handle -->
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-10 h-10 bg-white rounded-full shadow-lg z-20 flex items-center justify-center text-forest/50 transition-transform duration-300 group-hover:scale-110 pointer-events-none" id="slider-handle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline><polyline points="21 18 15 12 21 6"></polyline><polyline points="3 18 9 12 3 6" class="rotate-180 origin-center"></polyline></svg>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <!-- HOMEPAGE PRODUCTS SECTION (4 cards) -->
    <section class="py-24 bg-forest relative border-b border-olive/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <p class="reveal-on-scroll font-sans text-medical text-sm tracking-[0.2em] uppercase mb-4" style="transition-delay: 0.1s;">Our Solutions</p>
                <h2 class="reveal-on-scroll font-serif text-4xl md:text-5xl text-cream tracking-wide mb-6" style="transition-delay: 0.3s;">Featured Therapies</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-10">
                @foreach($featuredProducts as $index => $product)
                <article class="reveal-on-scroll bg-forest/20 rounded-2xl overflow-hidden shadow-sm hover:-translate-y-2 hover:shadow-[0_10px_30px_rgba(229,138,74,0.15)] border border-white/5 hover:border-medical/40 transition-all duration-500 group flex flex-col" style="transition-delay: {{ 0.2 + (0.1 * $index) }}s;">
                    <a href="{{ url('/products/' . $product->slug) }}" class="block flex-grow flex flex-col inset-0">
                        <div class="relative w-full aspect-square overflow-hidden bg-cream/10 flex items-center justify-center p-6 border-b border-white/5">
                             @if($product->featured_image)
                                <img src="{{ Storage::url($product->featured_image) }}" alt="{{ $product->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                             @else
                                 <svg class="w-1/2 h-1/2 text-beige/20 group-hover:scale-110 group-hover:text-medical/60 transition-all duration-700 ease-out" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="0.5">
                                      <circle cx="12" cy="12" r="10" />
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3" />
                                 </svg>
                             @endif
                        </div>
                        <div class="p-6 flex-grow flex flex-col">
                            <h3 class="font-serif text-xl text-cream mb-2">{{ $product->title }}</h3>
                            <p class="font-sans text-beige/70 text-sm font-light leading-relaxed mb-6 flex-grow">{{ Str::limit(strip_tags($product->short_description ?? $product->description), 80) }}</p>
                            <div class="inline-flex items-center text-medical tracking-wider text-xs font-medium uppercase group-hover:text-cream transition-colors mt-auto">
                                View Protocol
                                <svg class="w-3 h-3 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </div>
                        </div>
                    </a>
                </article>
                @endforeach
            </div>
            
            <div class="mt-16 text-center reveal-on-scroll" style="transition-delay: 0.7s;">
                <a href="{{ url('/products') }}" class="inline-block border border-medical text-medical hover:bg-medical hover:text-cream px-10 py-4 uppercase tracking-[0.15em] text-sm transition-all duration-500 ease-out hover:shadow-[0_0_25px_rgba(229,138,74,0.4)] relative overflow-hidden group">
                    <span class="relative z-10">View All Therapies</span>
                </a>
            </div>
        </div>
    </section>
    <!-- LOCATION SECTION -->
    <section id="location" class="py-24 bg-forest relative border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center mb-16">
                <h2 class="reveal-on-scroll font-serif text-4xl md:text-5xl text-cream tracking-wide mb-4">Our Clinic</h2>
                <p class="reveal-on-scroll font-sans text-beige/70 font-light max-w-xl mx-auto" style="transition-delay: 0.2s;">Located in the heart of Stockholm, designed for tranquility and advanced cellular care.</p>
            </div>

            <div class="reveal-on-scroll relative w-full h-[500px] md:h-[600px] rounded-2xl overflow-hidden group bg-forest/40 border border-white/10 shadow-sm" style="transition-delay: 0.4s;">
                
                <!-- Full Background SVG Map (Abstract/Minimal) -->
                <div class="absolute inset-0 bg-forest transition-colors duration-1000 group-hover:bg-black/90 flex items-center justify-center overflow-hidden">
                    <!-- Huge abstract map lines -->
                    <svg class="w-[150%] h-[150%] text-beige/10 transition-transform duration-[3s] ease-out group-hover:scale-105 group-hover:rotate-2" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="0.4">
                        <path d="M10,20 Q40,30 50,70 T90,80" />
                        <path d="M20,10 Q50,40 30,90 T80,50" />
                        <circle cx="50" cy="50" r="30" stroke-dasharray="2 4" />
                        <path d="M0,50 Q50,0 100,50 T0,50" opacity="0.3"/>
                        <path d="M50,0 Q100,50 50,100 T50,0" opacity="0.3"/>
                    </svg>
                </div>

                <!-- Glowing Marker -->
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-10">
                    <div class="relative flex items-center justify-center group-hover:-translate-y-2 transition-transform duration-700 ease-out">
                        <!-- Pulse ring -->
                        <div class="absolute w-12 h-12 bg-medical/40 rounded-full animate-[ping_2s_cubic-bezier(0,0,0.2,1)_infinite] opacity-75"></div>
                        <div class="absolute w-20 h-20 bg-medical/20 rounded-full animate-[ping_3s_cubic-bezier(0,0,0.2,1)_infinite_1s] opacity-50"></div>
                        <!-- Core dot -->
                        <div class="relative w-4 h-4 bg-medical rounded-full shadow-[0_0_15px_rgba(229,138,74,1)] group-hover:shadow-[0_0_30px_rgba(229,138,74,1)] transition-shadow duration-500"></div>
                    </div>
                </div>

                <!-- Glass Overlay Info Card -->
                <div class="absolute bottom-10 left-6 right-6 md:left-1/2 md:-translate-x-1/2 md:w-[450px] bg-black/60 backdrop-blur-xl border border-white/20 rounded-2xl p-8 transform translate-y-8 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-700 ease-out z-20 shadow-[0_20px_50px_rgba(0,0,0,0.5)]">
                    <h3 class="font-serif text-cream text-2xl mb-3 tracking-wide">{{ $settings->site_name }}</h3>
                    <p class="font-sans text-beige/70 text-sm font-light mb-8 leading-relaxed">
                        @if($settings->address)
                            {!! nl2br(e($settings->address)) !!}
                        @else
                            Strandvägen 1<br>114 51 Stockholm, Sweden
                        @endif
                    </p>
                    
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-8">
                        <a href="mailto:{{ $settings->contact_email }}" class="text-medical text-[10px] uppercase tracking-[0.2em] hover:text-cream transition-colors flex items-center gap-3 group/btn">
                            <span class="bg-white/10 p-3 rounded-full group-hover/btn:bg-medical/30 transition-all duration-300 border border-white/10 group-hover/btn:border-medical/50 group-hover/btn:scale-110 shadow-lg">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </span>
                            <span class="border-b border-medical/0 group-hover/btn:border-medical/100 transition-all duration-300">EMAIL US</span>
                        </a>

                        @if($settings->contact_phone)
                        <a href="tel:{{ $settings->contact_phone }}" class="text-medical text-[10px] uppercase tracking-[0.2em] hover:text-cream transition-colors flex items-center gap-3 group/btn">
                            <span class="bg-white/10 p-3 rounded-full group-hover/btn:bg-medical/30 transition-all duration-300 border border-white/10 group-hover/btn:border-medical/50 group-hover/btn:scale-110 shadow-lg">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5.5A1.5 1.5 0 014.5 4m15 1.5A1.5 1.5 0 0118 4M4.5 4h15M4.5 4a1.5 1.5 0 00-1.5 1.5V18a1.5 1.5 0 001.5 1.5h15a1.5 1.5 0 001.5-1.5V5.5a1.5 1.5 0 00-1.5-1.5m-3 12a3 3 0 100-6 3 3 0 000 6z"></path></svg>
                            </span>
                            <span class="border-b border-medical/0 group-hover/btn:border-medical/100 transition-all duration-300">{{ $settings->contact_phone }}</span>
                        </a>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </section>
</x-layout>
