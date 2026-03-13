<x-layout>
    <div class="pt-32 pb-24">
        <!-- Page Header -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16 text-center">
            <p class="reveal-on-scroll font-sans text-medical text-sm tracking-[0.2em] uppercase mb-4" style="transition-delay: 0.1s;">Our Solutions</p>
        <!-- Page Header -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16 text-center">
            <p class="reveal-on-scroll font-sans text-medical text-sm tracking-[0.2em] uppercase mb-4" style="transition-delay: 0.1s;">Our Solutions</p>
            <h1 class="reveal-on-scroll font-serif text-4xl md:text-6xl text-cream tracking-wider font-light mb-6" style="transition-delay: 0.3s;">{{ $about?->banner_title ?? 'Advanced Therapies' }}</h1>
            <p class="reveal-on-scroll font-sans text-beige/90 text-lg font-light max-w-2xl mx-auto" style="transition-delay: 0.5s;">{{ $about?->banner_description ?? 'Discover our protocols designed for cellular regeneration and longevity.' }}</p>
        </div>

        <!-- Category Filter -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12 flex justify-center">
            <div class="inline-flex items-center space-x-2 bg-forest/20 backdrop-blur-sm p-1 rounded-full border border-olive/20" id="product-filters">
                <a href="{{ route('products.index') }}" class="filter-btn {{ !$categorySlug ? 'active bg-medical text-white shadow-md' : 'text-beige/70 hover:text-medical' }} px-6 py-2 rounded-full text-sm font-sans uppercase tracking-widest transition-all duration-300">All</a>
                @foreach($categories as $category)
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="filter-btn {{ $categorySlug === $category->slug ? 'active bg-medical text-white shadow-md' : 'text-beige/70 hover:text-medical' }} px-6 py-2 rounded-full text-sm font-sans uppercase tracking-widest transition-all duration-300">{{ $category->name }}</a>
                @endforeach
            </div>
        </div>

        <!-- Product Grid -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 lg:gap-16" id="product-grid">
                @foreach($products as $index => $product)
                <!-- Product Card -->
                <article class="product-item reveal-on-scroll bg-forest/10 rounded-2xl overflow-hidden shadow-sm hover:-translate-y-2 hover:shadow-xl border border-white/5 hover:border-medical/40 transition-all duration-500 group flex flex-col" data-category="{{ $product->category->slug }}" style="transition-delay: {{ 0.2 + ($index * 0.2) }}s;">
                    <!-- Image -->
                    <div class="relative w-full aspect-square overflow-hidden bg-cream/10 flex items-center justify-center p-8">
                        @if($product->featured_image)
                            <img src="{{ Storage::url($product->featured_image) }}" alt="{{ $product->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out" />
                        @else
                            <svg class="w-full h-full text-beige/20 group-hover:scale-105 transition-transform duration-700 ease-out" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="0.5">
                                <circle cx="12" cy="12" r="10" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3" />
                            </svg>
                        @endif
                    </div>
                    <!-- Content -->
                    <div class="p-8 flex-grow flex flex-col">
                        <h2 class="font-serif text-2xl text-cream mb-3">{{ $product->title }}</h2>
                        <p class="font-sans text-beige/70 text-sm font-light leading-relaxed mb-8 flex-grow">{{ $product->short_description }}</p>
                        
                        <a href="{{ route('products.show', $product->slug) }}" class="inline-flex items-center text-medical tracking-wider text-sm font-medium uppercase group-hover:text-cream transition-colors mt-auto">
                            View Protocol
                            <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>

            @if($about && $about?->disclaimer_text)
                <div class="mt-20 p-8 border border-olive/20 bg-forest/10 rounded-xl max-w-3xl mx-auto text-center reveal-on-scroll">
                    <p class="font-sans text-xs text-beige/60 italic leading-relaxed">
                        {{ $about?->disclaimer_text }}
                    </p>
                </div>
            @endif
        </div>
    </div>
</x-layout>
