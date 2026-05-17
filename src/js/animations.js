/**
 * Cosmo Fine Art - Global Animations
 * Uses Framer Motion's DOM APIs for cinematic reveals, image drift, and polished interactions.
 */

document.addEventListener('DOMContentLoaded', () => {
    const Motion = window.Motion || {};
    const { animate, hover, inView, press, scroll } = Motion;
    const canUseMotion = Boolean(animate && inView);
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const easeOutExpo = [0.16, 1, 0.3, 1];
    const easeOutQuart = [0.25, 1, 0.5, 1];

    const parseDelay = (element, fallback = 0) => {
        const inlineDelay = element.style.transitionDelay || '';
        if (!inlineDelay) return fallback;
        return inlineDelay.endsWith('ms') ? parseFloat(inlineDelay) / 1000 : parseFloat(inlineDelay) || fallback;
    };

    const getBaseTransform = (element) => {
        const transform = window.getComputedStyle(element).transform;
        return transform && transform !== 'none' ? transform : '';
    };
    
    // 1. Initial Page Load Reveal
    const body = document.getElementById('body-content');
    if (body) {
        requestAnimationFrame(() => {
            body.classList.remove('opacity-0');
            if (canUseMotion && !prefersReducedMotion) {
                animate(body, { opacity: [0, 1] }, { duration: 0.9, ease: easeOutExpo });
            }
        });
    }

    // 2. Framer Motion page choreography
    const revealElements = Array.from(document.querySelectorAll('.reveal-on-scroll'));

    if (canUseMotion && !prefersReducedMotion) {
        revealElements.forEach((element) => {
            const isHero = Boolean(element.closest('section:first-of-type'));
            const isCard = element.matches('article, a') || element.querySelector('article, a');
            const isImageBlock = Boolean(element.querySelector('img, video, svg')) && !element.matches('p, h1, h2, h3');
            const startY = isHero ? 26 : isCard ? 48 : 36;
            const startScale = isImageBlock || isCard ? 0.965 : 1;
            const delay = parseDelay(element, 0);
            const baseTransform = getBaseTransform(element);
            const startTransform = `${baseTransform} translate3d(0, ${startY}px, 0) scale(${startScale})`.trim();
            const finalTransform = baseTransform || 'translate3d(0, 0, 0) scale(1)';

            element.classList.remove('opacity-0', 'translate-y-8', 'transition-all', 'duration-1000', 'ease-out');
            element.style.opacity = '0';
            element.style.transform = startTransform;
            element.style.filter = isImageBlock ? 'blur(10px)' : 'blur(8px)';
            element.style.willChange = 'transform, opacity, filter';

            inView(
                element,
                () => {
                    animate(
                        element,
                        {
                            opacity: [0, 1],
                            transform: [startTransform, finalTransform],
                            filter: [element.style.filter, 'blur(0px)'],
                        },
                        {
                            delay,
                            duration: isHero ? 1.05 : 0.85,
                            ease: easeOutExpo,
                        },
                    ).finished.then(() => {
                        element.style.willChange = '';
                    });
                },
                { margin: '0px 0px -12% 0px', amount: isHero ? 0.1 : 0.22 },
            );
        });

        const sections = Array.from(document.querySelectorAll('main > section, footer'));
        sections.forEach((section) => {
            section.style.transformOrigin = '50% 40%';
            inView(
                section,
                () => {
                    animate(
                        section,
                        {
                            opacity: [0.96, 1],
                            transform: ['translate3d(0, 24px, 0) scale(0.995)', 'translate3d(0, 0, 0) scale(1)'],
                        },
                        { duration: 1, ease: easeOutQuart },
                    );
                },
                { margin: '0px 0px -18% 0px', amount: 0.12 },
            );
        });

        const heroVideo = document.querySelector('video');
        if (heroVideo && scroll) {
            scroll(
                animate(
                    heroVideo,
                    { transform: ['scale(1.08)', 'scale(1.18)'], opacity: [0.1, 0.16] },
                    { ease: 'linear' },
                ),
                { target: document.querySelector('main > section:first-of-type'), offset: ['start start', 'end start'] },
            );
        }

        const artDirectedImages = Array.from(document.querySelectorAll('main section img, main section svg'));
        artDirectedImages.forEach((element) => {
            const section = element.closest('section');
            if (!section || element.closest('#before-after-slider')) return;

            scroll(
                animate(
                    element,
                    {
                        transform: ['translate3d(0, -18px, 0) scale(1.035)', 'translate3d(0, 22px, 0) scale(1.01)'],
                    },
                    { ease: 'linear' },
                ),
                { target: section, offset: ['start end', 'end start'] },
            );
        });

        const interactiveCards = document.querySelectorAll('article, .grid a.group, #location .reveal-on-scroll.group');
        interactiveCards.forEach((card) => {
            hover(card, () => {
                animate(card, { y: -8, scale: 1.012 }, { duration: 0.45, ease: easeOutQuart });
                return () => animate(card, { y: 0, scale: 1 }, { duration: 0.5, ease: easeOutExpo });
            });

            press(card, () => {
                animate(card, { scale: 0.992 }, { duration: 0.14, ease: easeOutQuart });
                return () => animate(card, { scale: 1 }, { duration: 0.28, ease: easeOutExpo });
            });
        });
    } else {
        const revealOptions = {
            threshold: 0.15,
            rootMargin: '0px 0px -50px 0px',
        };

        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('opacity-100', 'translate-y-0');
                    entry.target.classList.remove('opacity-0', 'translate-y-8');
                    observer.unobserve(entry.target);
                }
            });
        }, revealOptions);

        revealElements.forEach(el => {
            el.classList.add('opacity-0', 'translate-y-8', 'transition-all', 'duration-1000', 'ease-out');
            revealObserver.observe(el);
        });
    }
    
    // 3. Header scroll pill animation
    const header = document.getElementById('main-nav');
    const navContainer = document.getElementById('nav-container');
    const navInner = document.getElementById('nav-inner');
    
    if (header && navContainer && navInner) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                // Header gets top margin for floating effect
                header.classList.add('pt-4');
                header.classList.remove('pt-0');
                
                // Container becomes a rounded pill, smaller width, with padding
                navContainer.classList.add('rounded-full', 'shadow-lg', 'border', 'border-cream/20', 'max-w-5xl', 'px-6', 'py-1', 'mx-auto');
                navContainer.classList.remove('max-w-none', '-mx-4', 'sm:-mx-6', 'lg:-mx-8', 'border-b', 'border-cream/10', 'w-full');
                
                // Inner height adjustment slightly smaller for pill
                navInner.classList.add('h-14');
                navInner.classList.remove('h-20');
            } else {
                // Return to flat top bar
                header.classList.add('pt-0');
                header.classList.remove('pt-4');
                
                navContainer.classList.add('max-w-none', '-mx-4', 'sm:-mx-6', 'lg:-mx-8', 'border-b', 'border-cream/10', 'w-full');
                navContainer.classList.remove('rounded-full', 'shadow-lg', 'border', 'border-cream/20', 'max-w-5xl', 'px-6', 'py-1', 'mx-auto');
                
                navInner.classList.add('h-20');
                navInner.classList.remove('h-14');
            }
        }, { passive: true });
    }

    // 4. Mobile Menu Logic
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');
    const mobileNavLinks = document.getElementById('mobile-nav-links');
    let isMenuOpen = false;

    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', () => {
            isMenuOpen = !isMenuOpen;
            mobileMenuBtn.setAttribute('aria-expanded', isMenuOpen.toString());
            
            if (isMenuOpen) {
                // Open menu
                mobileMenu.classList.remove('opacity-0', 'pointer-events-none');
                mobileMenu.classList.add('opacity-100', 'pointer-events-auto');
                mobileNavLinks.classList.remove('translate-y-8');
                mobileNavLinks.classList.add('translate-y-0');
                document.body.classList.add('overflow-hidden'); // Prevent scrolling
                // Change icon to close (X)
                menuIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />';
                // Rotate the icon for flourish effect
                menuIcon.classList.add('rotate-90');
            } else {
                // Close menu
                mobileMenu.classList.remove('opacity-100', 'pointer-events-auto');
                mobileMenu.classList.add('opacity-0', 'pointer-events-none');
                mobileNavLinks.classList.remove('translate-y-0');
                mobileNavLinks.classList.add('translate-y-8');
                document.body.classList.remove('overflow-hidden'); // Allow scrolling
                // Change icon back to hamburger
                menuIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16" />';
                // Remove rotation
                menuIcon.classList.remove('rotate-90');
            }
        });

        // Close menu when a link is clicked
        const mobileLinks = document.querySelectorAll('.mobile-link');
        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (isMenuOpen) {
                    mobileMenuBtn.click();
                }
            });
        });
    }

    // 5. Before/After Slider Logic
    const slider = document.getElementById('before-after-slider');
    const clipper = document.getElementById('slider-clipper');
    const handle = document.getElementById('slider-handle');

    if (slider && clipper && handle) {
        let isSliding = false;

        const slide = (e) => {
            if (!isSliding) return;
            
            // Get X coordinate of mouse or touch
            let clientX = e.clientX || (e.touches && e.touches[0].clientX);
            if (!clientX) return;

            // Get slider dimensions
            const rect = slider.getBoundingClientRect();
            
            // Calculate percentage (0 to 1)
            let xPos = clientX - rect.left;
            let percent = xPos / rect.width;

            // Clamp between 0% and 100%
            if (percent < 0) percent = 0;
            if (percent > 1) percent = 1;

            const percentString = (percent * 100) + '%';

            // Apply to the clipper (which holds the before image)
            clipper.style.width = percentString;
            
            // Apply to the handle
            handle.style.left = percentString;
            
            // Add grabbing cursor
            slider.classList.add('cursor-grabbing');
            slider.classList.remove('cursor-ew-resize');
        };

        const stopSliding = () => {
            isSliding = false;
            slider.classList.remove('cursor-grabbing');
            slider.classList.add('cursor-ew-resize');
        };

        // Mouse Events
        slider.addEventListener('mousedown', (e) => {
            isSliding = true;
            slide(e);
        });
        window.addEventListener('mousemove', slide);
        window.addEventListener('mouseup', stopSliding);

        // Touch Events
        slider.addEventListener('touchstart', (e) => {
            isSliding = true;
            slide(e);
        }, { passive: true });
        window.addEventListener('touchmove', slide, { passive: true });
        window.addEventListener('touchend', stopSliding);
    }

    // 6. Product Category Filtering
    const filterContainer = document.getElementById('product-filters');
    const productGrid = document.getElementById('product-grid');
    
    // Also parse URL query parameters
    let activeCategory = 'all';
    const params = new URLSearchParams(window.location.search);
    if (params.has('category')) {
        activeCategory = params.get('category').toLowerCase();
    }

    if (filterContainer && productGrid) {
        const filterBtns = filterContainer.querySelectorAll('.filter-btn');
        const products = productGrid.querySelectorAll('.product-item');

        const applyFilter = (category) => {
            // Update active button state
            filterBtns.forEach(btn => {
                const btnCategory = btn.getAttribute('data-filter');
                if (btnCategory === category) {
                    btn.classList.add('active', 'bg-forest', 'text-cream', 'shadow-md');
                    btn.classList.remove('text-forest/70', 'hover:text-forest');
                } else {
                    btn.classList.remove('active', 'bg-forest', 'text-cream', 'shadow-md');
                    btn.classList.add('text-forest/70', 'hover:text-forest');
                }
            });

            // Filter products with a smooth transition
            products.forEach(product => {
                const productCategory = product.getAttribute('data-category');
                
                // Fade out before hiding
                product.style.opacity = '0';
                product.style.transform = 'scale(0.95)';
                
                setTimeout(() => {
                    if (category === 'all' || productCategory === category) {
                        product.style.display = 'flex'; // our items are flex cols
                        
                        // Force reflow
                        void product.offsetWidth;
                        
                        // Fade in
                        product.style.opacity = '1';
                        product.style.transform = 'scale(1)';
                    } else {
                        product.style.display = 'none';
                    }
                }, 300); // 300ms matches the transition duration
            });
        };

        // Apply initial filter based on URL or default
        applyFilter(activeCategory);

        // Click Event Listeners
        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const category = btn.getAttribute('data-filter');
                // Optional: update URL
                const url = new URL(window.location);
                url.searchParams.set('category', category);
                window.history.pushState({}, '', url);

                applyFilter(category);
            });
        });
    }
});
