/**
 * Cosmo Fine Art - Global Animations
 * Handles soft 0.8s fade-ins and scroll reveals safely using vanilla JS without heavy libraries.
 */

document.addEventListener('DOMContentLoaded', () => {
    
    // 1. Initial Page Load Reveal (0.8s full body fade per requirements)
    const body = document.getElementById('body-content');
    if (body) {
        // Remove Tailwind's opacity-0 added directly on the body tag to trigger CSS transition
        requestAnimationFrame(() => {
            body.classList.remove('opacity-0');
        });
    }

    // 2. Intersection Observer for Scroll Reveals
    // Any element with 'reveal-on-scroll' will start invisible and slide up when viewed
    const revealOptions = {
        threshold: 0.15,
        rootMargin: "0px 0px -50px 0px"
    };

    const revealObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('opacity-100', 'translate-y-0');
                entry.target.classList.remove('opacity-0', 'translate-y-8');
                observer.unobserve(entry.target); // Reveal only once for premium feel
            }
        });
    }, revealOptions);

    // Initialize all reveal elements
    const revealElements = document.querySelectorAll('.reveal-on-scroll');
    revealElements.forEach(el => {
        // Set initial state
        el.classList.add('opacity-0', 'translate-y-8', 'transition-all', 'duration-1000', 'ease-out');
        revealObserver.observe(el);
    });
    
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
                navContainer.classList.remove('max-w-none', '-mx-4', 'sm:-mx-6', 'lg:-mx-8', 'border-b', 'border-cream/10');
                
                // Inner height adjustment slightly smaller for pill
                navInner.classList.add('h-14');
                navInner.classList.remove('h-20');
            } else {
                // Return to flat top bar
                header.classList.add('pt-0');
                header.classList.remove('pt-4');
                
                navContainer.classList.add('max-w-none', '-mx-4', 'sm:-mx-6', 'lg:-mx-8', 'border-b', 'border-cream/10', );
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

});
