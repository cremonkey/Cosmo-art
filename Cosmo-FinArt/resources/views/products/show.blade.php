<x-layout :seo="$product">
    <div class="pt-32 pb-24 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Breadcrumbs -->
            <div class="reveal-on-scroll mb-8" style="transition-delay: 0.1s;">
                 <a href="{{ route('products.index') }}" class="text-xs font-sans uppercase tracking-widest text-beige/60 hover:text-medical transition-colors flex items-center">
                     <svg class="w-3 h-3 mr-2 transform rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                     Back to Therapies
                 </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24 items-start">
                
                <!-- Hero Product Image (Parallax) -->
                <div class="reveal-on-scroll relative aspect-[4/5] w-full rounded-2xl overflow-hidden bg-cream/40 flex items-center justify-center border border-cream/20 shadow-sm" style="transition-delay: 0.2s;">
                    @if($product->featured_image)
                        <img src="{{ Storage::url($product->featured_image) }}" alt="{{ $product->title }}" class="w-full h-full object-cover">
                    @else
                        <!-- Floating abstract representation of the therapy -->
                        <svg class="w-1/2 h-1/2 text-sage/50 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 animate-[pulse_4s_infinite_ease-in-out]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="0.3">
                            <circle cx="12" cy="12" r="10" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3" />
                        </svg>
                    @endif
                </div>

                <!-- Product Information -->
                <div class="reveal-on-scroll flex flex-col" style="transition-delay: 0.4s;">
                    
                    <h1 class="font-serif text-4xl md:text-5xl text-cream tracking-wide mb-4">{{ $product->title }}</h1>
                    
                    @if($product->short_description)
                        <p class="font-sans text-beige/80 text-lg leading-relaxed mb-6">{{ $product->short_description }}</p>
                    @endif

                    <div class="font-sans text-beige/70 text-lg font-light leading-relaxed mb-8 prose prose-p:text-beige/70 max-w-none">
                        {!! $product->description !!}
                    </div>
                    
                    @if($product->clinical_focus)
                    <div class="bg-forest/20 border border-olive/20 rounded-xl p-6 mb-12">
                         <h3 class="font-sans text-xs uppercase tracking-widest text-beige/60 mb-2">Clinical Focus</h3>
                         <p class="font-serif text-beige text-xl">{{ $product->clinical_focus }}</p>
                    </div>
                    @endif

                    <!-- Clean Tab System with Alpine.js -->
                    <div class="w-full" x-data="{ tab: 'benefits' }">
                        <!-- Tab Headers -->
                        <div class="flex space-x-8 border-b border-olive/20 mb-8 overflow-x-auto pb-[1px]" role="tablist">
                            @if(!empty($product->benefits))
                            <button @click="tab = 'benefits'" :class="{ 'active text-medical border-medical': tab === 'benefits', 'text-beige/60 border-transparent hover:text-medical': tab !== 'benefits' }" class="pb-4 text-sm font-sans uppercase tracking-[0.15em] transition-colors border-b whitespace-nowrap" role="tab">Benefits</button>
                            @endif
                            @if(!empty($product->composition))
                            <button @click="tab = 'ingredients'" :class="{ 'active text-medical border-medical': tab === 'ingredients', 'text-beige/60 border-transparent hover:text-medical': tab !== 'ingredients' }" class="pb-4 text-sm font-sans uppercase tracking-[0.15em] transition-colors border-b whitespace-nowrap" role="tab">Ingredients</button>
                            @endif
                            @if(!empty($product->protocol_summary) || !empty($product->protocol_details))
                            <button @click="tab = 'protocol'" :class="{ 'active text-medical border-medical': tab === 'protocol', 'text-beige/60 border-transparent hover:text-medical': tab !== 'protocol' }" class="pb-4 text-sm font-sans uppercase tracking-[0.15em] transition-colors border-b whitespace-nowrap" role="tab">Protocol</button>
                            @endif
                        </div>

                        <!-- Tab Content -->
                        <div class="relative min-h-[200px]">
                            
                            @if(!empty($product->benefits))
                            <!-- Benefits -->
                            <div x-show="tab === 'benefits'" x-transition:enter="transition opacity-0" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="tab-content" role="tabpanel">
                                <ul class="space-y-4">
                                    @foreach($product->benefits as $benefit)
                                    <li class="flex items-start">
                                        <svg class="w-5 h-5 text-medical mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"></path></svg>
                                        <span class="font-sans font-light text-beige/80 leading-relaxed">{{ $benefit['benefit'] ?? $benefit }}</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            @if(!empty($product->composition))
                            <!-- Ingredients -->
                            <div x-show="tab === 'ingredients'" x-transition:enter="transition opacity-0" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="tab-content" role="tabpanel" style="display: none;">
                                <div class="grid grid-cols-2 gap-4">
                                    @foreach($product->composition as $composition)
                                    <div class="bg-white/5 p-4 rounded-lg border border-cream/10">
                                        <span class="block font-serif text-beige mb-1">{{ $composition['name'] ?? '' }}</span>
                                        <span class="text-xs font-sans text-beige/60 uppercase tracking-wider">{{ $composition['description'] ?? '' }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            @if(!empty($product->protocol_summary) || !empty($product->protocol_details))
                            <!-- Protocol -->
                            <div x-show="tab === 'protocol'" x-transition:enter="transition opacity-0" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="tab-content" role="tabpanel" style="display: none;">
                                @if($product->protocol_summary)
                                <p class="font-sans font-light text-beige/80 leading-relaxed mb-6">{{ $product->protocol_summary }}</p>
                                @endif
                                @if(!empty($product->protocol_details))
                                <div class="border-l border-medical/30 pl-6 space-y-6">
                                    @foreach($product->protocol_details as $detail)
                                    <div>
                                        <h4 class="font-serif text-beige mb-1">{{ $detail['step'] ?? '' }}</h4>
                                        <p class="font-sans text-sm text-beige/70 font-light">{{ $detail['value'] ?? '' }}</p>
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                            @endif

                        </div>
                    </div>
                </div>

            </div>

            <!-- Enhanced Gallery Section -->
            @if(!empty($product->gallery) && is_array($product->gallery))
            <div class="mt-24 reveal-on-scroll border-t border-olive/20 pt-16 group/gallery">
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
                    <div>
                        <h2 class="font-serif text-3xl md:text-4xl text-cream tracking-wide">Gallery</h2>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                    @foreach($product->gallery as $imagePath)
                        <div class="group relative aspect-[4/3] rounded-2xl overflow-hidden bg-cream/40 border border-cream/20 shadow-sm transition-all duration-500 hover:shadow-xl hover:border-cream/40">
                            <img src="{{ Storage::url($imagePath) }}" alt="{{ $product->title }} Gallery Image" class="w-full h-full object-cover transition-transform duration-1000 ease-out group-hover:scale-110">

                            <!-- Elegant overlay on hover -->
                            <div class="absolute inset-0 bg-gradient-to-t from-forest/80 via-forest/0 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <div class="absolute inset-0 ring-1 ring-inset ring-black/10 rounded-2xl"></div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>
</x-layout>
