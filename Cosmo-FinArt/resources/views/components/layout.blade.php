@php
$settings = app(\App\Settings\GlobalSettings::class);
@endphp
<!doctype html>
<html lang="en" class="scroll-smooth">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <!-- SEO and Meta -->
    @php
        $siteName = $settings->site_name ?: 'Cosmo FinArt';
        $finalTitle = '';
        $finalDescription = $settings->seo_description;
        $finalKeywords = is_array($settings->meta_keywords) ? implode(', ', $settings->meta_keywords) : $settings->meta_keywords;

        if (isset($seo)) {
            if ($seo instanceof \App\Models\Product) {
                $finalTitle = ($seo->title ?? 'Therapy') . ' | ' . $siteName;
                $finalDescription = $seo->short_description ?: $finalDescription;
            } elseif ($seo instanceof \App\Models\Category) {
                $finalTitle = ($seo->name ?? 'Category') . ' | ' . $siteName;
                $finalDescription = $seo->description ?: $finalDescription;
            } else {
                $finalTitle = $siteName;
            }
        } else {
            $finalTitle = $settings->seo_title ?: $siteName;
        }
    @endphp

    <title>{{ $finalTitle }}</title>
    <meta name="description" content="{{ $finalDescription }}" />
    @if($finalKeywords)
        <meta name="keywords" content="{{ $finalKeywords }}" />
    @endif

    <!-- Open Graph / Social (Minimal fallback) -->
    <meta property="og:title" content="{{ $finalTitle }}" />
    <meta property="og:description" content="{{ $finalDescription }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    @if($settings->site_logo)
        <meta property="og:image" content="{{ Storage::url($settings->site_logo) }}" />
    @endif

    <!-- Favicons -->
    @if($settings->favicon)
        <link rel="icon" type="image/x-icon" href="{{ Storage::url($settings->favicon) }}">
        <link rel="apple-touch-icon" href="{{ Storage::url($settings->favicon) }}">
    @else
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  </head>
  <body
    class="bg-sage text-beige font-sans antialiased overflow-x-hidden min-h-screen flex flex-col transition-opacity duration-1000 opacity-0 relative"
    id="body-content"
  >
    <!-- GLOBAL FIXED VIDEO OVERLAY -->
    <div class="fixed inset-0 z-[-1] pointer-events-none flex items-center justify-center overflow-hidden bg-forest">
        <video playsinline autoplay muted loop class="absolute h-screen w-full object-cover " style="opacity: 20%;">
            <source src="{{ asset('assets/Sea.mp4') }}" type="video/mp4">
        </video>
        <div class="absolute inset-0 bg-black/40 mix-blend-overlay"></div>
    </div>
    
    <!-- Navigation Area -->
    <header
      class="fixed top-0 left-0 w-full z-50 transition-all duration-300 px-4 sm:px-6 lg:px-8 pt-0"
      id="main-nav"
    >
      <div id="nav-container" class="mx-auto max-w-none transition-all duration-500 bg-forest/80 backdrop-blur-md border-b border-white/10 px-4 sm:px-6 lg:px-8 -mx-4 sm:-mx-6 lg:-mx-8">
        <div class="max-w-7xl mx-auto flex justify-between items-center h-20 transition-all duration-500" id="nav-inner">
          <!-- Logo -->
          <div class="flex-shrink-0 flex items-center">
            <a href="{{ url('/') }}" class="flex items-center">
              <img src="{{ $settings->site_logo ? Storage::url($settings->site_logo) : asset('assets/SVG/Logo.svg') }}" alt="{{ $settings->site_name }}" class="h-6 w-auto" />
            </a>
          </div>

          <!-- Desktop Navigation -->
          <nav class="hidden md:flex items-center space-x-8">
            <a href="{{ url('/') }}" class="transition-all duration-300 text-sm font-medium tracking-wide {{ request()->is('/') ? 'text-medical underline underline-offset-8' : 'text-cream/80 hover:text-medical' }}">Home</a>
            <a href="{{ url('/about') }}" class="transition-all duration-300 text-sm font-medium tracking-wide {{ request()->is('about') ? 'text-medical underline underline-offset-8' : 'text-cream/80 hover:text-medical' }}">About</a>
            
            <div class="relative group">
              <a href="{{ url('/products') }}" class="transition-all duration-300 text-sm font-medium tracking-wide flex items-center {{ request()->is('products*') ? 'text-medical underline underline-offset-8' : 'text-cream/80 hover:text-medical' }}">
                Solutions <svg class="w-3 h-3 ml-1 transform group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
              </a>
              <div class="absolute left-0 mt-2 w-48 rounded-xl bg-forest/95 backdrop-blur-md border border-white/10 shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top-left group-hover:translate-y-0 -translate-y-2 z-50">
                <div class="py-2">
                  <a href="{{ route('products.index', ['category' => 'nutrition']) }}" class="block px-4 py-2 text-sm text-cream/80 hover:text-medical hover:bg-white/5 transition-colors">Nutrition Therapies</a>
                  <a href="{{ route('products.index', ['category' => 'derma']) }}" class="block px-4 py-2 text-sm text-cream/80 hover:text-medical hover:bg-white/5 transition-colors">Derma Treatments</a>
                </div>
              </div>
            </div>
            
            <a href="#location" class="transition-all duration-300 text-sm font-medium tracking-wide text-cream/80 hover:text-medical">Contact</a>
            
            <a href="{{ url('/products') }}" class="group relative inline-flex items-center justify-center gap-2 rounded-full font-medium transition-all duration-300 border px-6 py-2.5 text-xs border-cream/40 text-cream hover:bg-cream/10 ml-4">
              Explore Solutions
              <div class="flex h-5 w-5 items-center justify-center rounded-full bg-cream/10 transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-3.5 w-3.5" aria-hidden="true"><path d="M7 7h10v10"></path><path d="M7 17 17 7"></path></svg>
              </div>
            </a>
          </nav>

          <!-- Mobile Menu Toggle -->
          <div class="md:hidden flex items-center">
            <button id="mobile-menu-btn" type="button" class="text-cream hover:text-medical p-2 min-w-[44px] min-h-[44px] transition-colors relative z-[60]" aria-expanded="false" aria-label="Toggle navigation">
              <svg id="menu-icon" class="h-6 w-6 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16" /></svg>
            </button>
          </div>
        </div>
      </div>
    </header>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu" class="fixed inset-0 z-[55] bg-forest/95 backdrop-blur-lg flex flex-col items-center justify-center opacity-0 pointer-events-none transition-all duration-500">
        <nav class="flex flex-col items-center space-y-8 text-center translate-y-8 transition-transform duration-500" id="mobile-nav-links">
            <a href="{{ url('/') }}" class="mobile-link text-2xl font-serif tracking-widest border-b pb-2 {{ request()->is('/') ? 'text-medical border-medical' : 'text-cream/70 hover:text-medical border-transparent' }}">Home</a>
            <a href="{{ url('/about') }}" class="mobile-link text-2xl font-serif tracking-widest border-b pb-2 {{ request()->is('about') ? 'text-medical border-medical' : 'text-cream/70 hover:text-medical border-transparent' }}">About</a>
            <div class="flex flex-col items-center w-full group/mobile-dropdown relative">
                <a href="{{ url('/products') }}" class="mobile-link text-2xl font-serif tracking-widest flex items-center border-b pb-2 {{ request()->is('products*') ? 'text-medical border-medical' : 'text-cream/70 hover:text-medical border-transparent' }}">
                    Solutions
                    <svg class="w-5 h-5 ml-2 transition-transform duration-300 group-focus-within/mobile-dropdown:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </a>
                <div class="h-0 overflow-hidden group-focus-within/mobile-dropdown:h-auto group-focus-within/mobile-dropdown:mt-4 transition-all duration-300 w-full">
                    <div class="flex flex-col items-center space-y-4">
                        <a href="{{ route('products.index', ['category' => 'nutrition']) }}" class="text-cream/50 hover:text-medical text-lg font-serif tracking-widest transition-colors">Nutrition</a>
                        <a href="{{ route('products.index', ['category' => 'derma']) }}" class="text-cream/50 hover:text-medical text-lg font-serif tracking-widest transition-colors">Derma</a>
                    </div>
                </div>
            </div>
            <a href="#location" class="mobile-link text-cream/70 hover:text-medical transition-colors text-2xl font-serif tracking-widest border-b pb-2 border-transparent">Contact</a>
        </nav>
    </div>

    <!-- Main Content Area -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer Area -->
    <footer class="bg-forest/90 text-beige py-16 mt-auto relative z-10 w-full overflow-hidden" id="location">
        
        <!-- Background subtle glow -->
        <div class="absolute top-0 right-1/4 w-[30vw] h-[30vw] bg-sage/10 rounded-full blur-[100px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                
                <!-- Brand Info -->
                <div class="col-span-1 md:col-span-2">
                    <!-- Text Logo COSMO as per design -->
                    <a href="{{ url('/') }}" class="inline-block mb-6">
                    <img src="{{ $settings->site_logo ? Storage::url($settings->site_logo) : asset('assets/SVG/Logo.svg') }}" alt="{{ $settings->site_name }}" class="h-8 w-auto mb-6" />                    </a>
                    
                    <p class="font-sans text-sm text-beige/80 max-w-sm leading-relaxed mb-8 font-light">
                        Premium Swedish Regenerative Medicine & Longevity Focus. Elevating clinical science into an art form.
                    </p>
                    
                    <!-- Social Icons -->
                    <div class="flex space-x-4">
                        @php
                            $socialLinks = count($settings->social_links) > 0 ? $settings->social_links : ['instagram' => '#', 'linkedin' => '#'];
                        @endphp
                        @foreach($socialLinks as $platform => $url)
                        <a href="{{ $url }}" class="w-10 h-10 rounded-full border border-olive/50 flex items-center justify-center text-beige/70 hover:text-medical hover:border-medical transition-all duration-300 hover:-translate-y-1">
                             <span class="sr-only">{{ $platform }}</span>
                             @if(Str::contains(Str::lower($platform), 'instagram'))
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
                             @elseif(Str::contains(Str::lower($platform), 'linkedin'))
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/></svg>
                             @endif
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="col-span-1">
                    <h3 class="font-sans text-xs uppercase tracking-widest text-cream/50 mb-6">Explore</h3>
                    <ul class="space-y-4">
                        <li><a href="{{ url('/') }}" class="text-sm font-light text-beige/80 hover:text-medical transition-colors inline-block relative group">Home<span class="absolute -bottom-1 left-0 w-0 h-[1px] bg-medical transition-all duration-300 group-hover:w-full"></span></a></li>
                        <li><a href="{{ url('/products') }}" class="text-sm font-light text-beige/80 hover:text-medical transition-colors inline-block relative group">Therapies<span class="absolute -bottom-1 left-0 w-0 h-[1px] bg-medical transition-all duration-300 group-hover:w-full"></span></a></li>
                        <li><a href="{{ url('/about') }}" class="text-sm font-light text-beige/80 hover:text-medical transition-colors inline-block relative group">Philosophy<span class="absolute -bottom-1 left-0 w-0 h-[1px] bg-medical transition-all duration-300 group-hover:w-full"></span></a></li>
                    </ul>
                </div>

                <!-- Contact Block -->
                <div class="col-span-1">
                    <h3 class="font-sans text-xs uppercase tracking-widest text-cream/50 mb-6">Contact</h3>
                    <ul class="space-y-4 font-light text-sm text-beige/80">
                        <li>{!! nl2br(e($settings->address)) !!}</li>
                        <li><a href="mailto:{{ $settings->contact_email }}" class="hover:text-medical transition-colors">{{ $settings->contact_email }}</a></li>
                        @if($settings->contact_phone)
                            <li><a href="tel:{{ $settings->contact_phone }}" class="hover:text-medical transition-colors">{{ $settings->contact_phone }}</a></li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="pt-8 border-t border-olive/30 flex flex-col md:flex-row justify-between items-center text-xs text-beige/50 font-light">
                <p>{{ $settings->copyright_text }}</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="hover:text-cream transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-cream transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Global Animations & Interaction -->
    <script src="{{ asset('assets/js/animations.js') }}"></script>
  </body>
</html>
