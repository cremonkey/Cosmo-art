<x-layout>
    <!-- Philosophy Manifesto -->
    <section class="min-h-[70vh] flex items-center justify-center pt-32 pb-24 px-4 text-center mt-20 relative">
        @if($about && $about?->hero_image)
            <div class="absolute inset-0 z-[-1] opacity-20">
                <img src="{{ Storage::url($about?->hero_image) }}" class="w-full h-full object-cover">
            </div>
            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-beige z-[-1]"></div>
        @else
             <!-- Space for Hero Image / Background Effect -->
             <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0IiBoZWlnaHQ9IjQiPjxyZWN0IHdpZHRoPSI0IiBoZWlnaHQ9IjQiIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wMyIvPjwvc3ZnPg==')] z-0 opacity-40 mix-blend-overlay"></div>
        @endif

        <div class="max-w-4xl mx-auto relative z-10">
            <h1 class="reveal-on-scroll font-serif text-5xl md:text-7xl lg:text-8xl text-forest tracking-wide font-light mb-8" style="transition-delay: 0.2s;">
                {!! nl2br(e($about?->hero_title ?? "Where Science \nMeets Art.")) !!}
            </h1>
            
            <div class="reveal-on-scroll w-24 h-[1px] bg-medical/50 mx-auto mb-10" style="transition-delay: 0.4s;"></div>
            
            <p class="reveal-on-scroll font-sans text-forest/80 text-lg md:text-2xl font-light leading-relaxed mb-6" style="transition-delay: 0.6s;">
                {{ $about?->hero_text ?? 'We believe true luxury is longevity. Our approach to cellular regeneration is rooted in precise, methodical Swedish innovation, elevating restorative nutrition into an art form.' }}
            </p>
        </div>
    </section>

    <!-- Swedish Innovation Split Section -->
    <section class="py-24 bg-sage relative overflow-hidden flex-shrink-0">
        <!-- Decorative fine line -->
        <div class="absolute top-0 right-1/3 w-[1px] h-full bg-cream/10"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                
                <!-- Left: Clinic Imagery Mask -->
                <div class="reveal-on-scroll relative aspect-[4/5] rounded-tl-[100px] rounded-br-[100px] overflow-hidden group shadow-2xl" style="transition-delay: 0.2s;">
                    <img src="{{ ($about && $about?->philosophy_image) ? Storage::url($about?->philosophy_image) : 'https://www.alo-medical.com/wp-content/uploads/2022/05/Title-Mesothearpy2.jpg' }}" alt="Luxury Clinic Interior" class="absolute inset-0 w-full h-full object-cover transition-transform duration-[1.5s] ease-in-out group-hover:scale-105">
                    <div class="absolute inset-0 bg-forest/20 mix-blend-multiply transition-colors group-hover:bg-transparent pointer-events-none"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-forest/80 to-transparent pointer-events-none"></div>
                </div>

                <!-- Right: Text Content -->
                <div class="reveal-on-scroll flex flex-col justify-center" style="transition-delay: 0.4s;">
                    <h3 class="font-sans text-medical text-xs uppercase tracking-[0.2em] mb-4">{{ $about?->philosophy_subtitle ?? 'Swedish Innovation' }}</h3>
                    <h2 class="font-serif text-4xl md:text-5xl text-cream tracking-wide mb-8">{{ $about?->philosophy_title ?? 'Cellular Regeneration' }}</h2>
                    <div class="space-y-6">
                        @if($about && $about?->philosophy_content)
                            <div class="font-sans text-cream/80 font-light leading-relaxed prose prose-p:text-cream/80 max-w-none">
                                {!! nl2br(e($about?->philosophy_content)) !!}
                            </div>
                        @else
                            <p>
                                Our protocols are developed with a foundational understanding of the body's intrinsic healing capabilities. We utilize highly bioavailable nutrients to target mitochondrial decline.
                            </p>
                            <p>
                                Drawing inspiration from Swedish minimalism, our therapies deliver exactly what the cell requires to repair epigenetic damage—nothing more, nothing less.
                            </p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- The Science of NAD+ -->
    <section class="py-32 bg-forest relative border-t border-olive/30 flex-shrink-0">
        <!-- Subtle molecular line animation background -->
        <div class="absolute inset-0 opacity-10 pointer-events-none overflow-hidden">
            @if($about && $about?->science_image)
                <img src="{{ Storage::url($about?->science_image) }}" class="w-full h-full object-cover opacity-30">
            @else
                <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none" stroke="white" stroke-width="0.1" fill="none">
                    <path class="animate-[draw_15s_infinite_alternate]" d="M10,90 Q30,10 50,50 T90,10" />
                    <path class="animate-[draw_20s_infinite_alternate-reverse]" d="M10,10 Q30,90 50,50 T90,90" />
                </svg>
            @endif
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-20">
                <h2 class="reveal-on-scroll font-serif text-4xl md:text-5xl text-cream tracking-wide mb-6">{{ $about?->science_title ?? 'The Science of NAD+' }}</h2>
                @if($about && $about?->science_content)
                    <div class="reveal-on-scroll font-sans text-cream/70 font-light max-w-2xl mx-auto">
                        {!! nl2br(e($about?->science_content)) !!}
                    </div>
                @else
                    <p class="reveal-on-scroll font-sans text-cream/70 font-light max-w-2xl mx-auto">Nicotinamide Adenine Dinucleotide is the cornerstone of cellular metabolism and the ultimate currency of energy and longevity.</p>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @if($about && !empty($about?->infographics))
                    @foreach($about?->infographics as $index => $item)
                    <div class="reveal-on-scroll border border-olive/40 bg-sage/10 backdrop-blur-sm p-8 rounded-xl hover:border-medical/40 transition-colors duration-500 group" style="transition-delay: {{ 0.1 * ($index + 1) }}s;">
                        <div class="w-12 h-12 rounded-full bg-sage/30 flex items-center justify-center mb-6 text-medical group-hover:scale-110 transition-transform duration-500">
                             <!-- Dynamic Icon Handler -->
                             @if(!empty($item['icon']) && str_starts_with($item['icon'], 'heroicon-'))
                                @if(class_exists('\BladeUI\Icons\Components\Icon'))
                                    <x-icon name="{{ $item['icon'] }}" class="w-6 h-6" />
                                @else
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                @endif
                             @else
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                             @endif
                        </div>
                        <h4 class="font-serif text-cream text-xl mb-3">{{ $item['title'] ?? '' }}</h4>
                        <p class="font-sans text-sm text-cream/60 font-light leading-relaxed">{{ $item['description'] ?? '' }}</p>
                    </div>
                    @endforeach
                @else
                    <!-- Fallback to original static content if database is empty -->
                    <!-- Infographic Block 1 -->
                    <div class="reveal-on-scroll border border-olive/40 bg-sage/10 backdrop-blur-sm p-8 rounded-xl hover:border-medical/40 transition-colors duration-500 group" style="transition-delay: 0.1s;">
                        <div class="w-12 h-12 rounded-full bg-sage/30 flex items-center justify-center mb-6 text-medical group-hover:scale-110 transition-transform duration-500">
                             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <h4 class="font-serif text-cream text-xl mb-3">Cellular Energy</h4>
                        <p class="font-sans text-sm text-cream/60 font-light leading-relaxed">NAD+ acts as a critical coenzyme in the mitochondria, facilitating the conversion of nutrients into ATP fuel.</p>
                    </div>

                    <!-- Infographic Block 2 -->
                    <div class="reveal-on-scroll border border-olive/40 bg-sage/10 backdrop-blur-sm p-8 rounded-xl hover:border-medical/40 transition-colors duration-500 group" style="transition-delay: 0.3s;">
                        <div class="w-12 h-12 rounded-full bg-sage/30 flex items-center justify-center mb-6 text-medical group-hover:scale-110 transition-transform duration-500">
                             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h4 class="font-serif text-cream text-xl mb-3">Anti-Aging Support</h4>
                        <p class="font-sans text-sm text-cream/60 font-light leading-relaxed">Activates sirtuins, longevity proteins responsible for repairing DNA replication errors.</p>
                    </div>

                    <!-- Infographic Block 3 -->
                    <div class="reveal-on-scroll border border-olive/40 bg-sage/10 backdrop-blur-sm p-8 rounded-xl hover:border-medical/40 transition-colors duration-500 group" style="transition-delay: 0.5s;">
                        <div class="w-12 h-12 rounded-full bg-sage/30 flex items-center justify-center mb-6 text-medical group-hover:scale-110 transition-transform duration-500">
                             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                        </div>
                        <h4 class="font-serif text-cream text-xl mb-3">Cognitive Enhancement</h4>
                        <p class="font-sans text-sm text-cream/60 font-light leading-relaxed">Promotes neurogenesis and protects against neurodegenerative stress, ensuring mental acuity.</p>
                    </div>

                    <!-- Infographic Block 4 -->
                    <div class="reveal-on-scroll border border-olive/40 bg-sage/10 backdrop-blur-sm p-8 rounded-xl hover:border-medical/40 transition-colors duration-500 group" style="transition-delay: 0.7s;">
                        <div class="w-12 h-12 rounded-full bg-sage/30 flex items-center justify-center mb-6 text-medical group-hover:scale-110 transition-transform duration-500">
                             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>
                        </div>
                        <h4 class="font-serif text-cream text-xl mb-3">Skin Regeneration</h4>
                        <p class="font-sans text-sm text-cream/60 font-light leading-relaxed">Restores structural integrity at the dermal matrix, delaying the visible signs of chronological aging.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Push global animations if missing (Layout component handles this, but including inline keyframes if needed) -->
    <style>
        /* Define molecular line drawing animation */
        @keyframes draw {
            from { stroke-dasharray: 0 1000; stroke-dashoffset: 0; }
            to { stroke-dasharray: 1000 0; stroke-dashoffset: 0; }
        }
    </style>
</x-layout>

