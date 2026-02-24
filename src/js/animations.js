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
    
    // 3. Simple Header minimization on scroll
    const header = document.getElementById('main-nav');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.classList.add('py-2', 'shadow-md');
            header.classList.remove('py-4');
        } else {
            header.classList.add('py-4');
            header.classList.remove('py-2', 'shadow-md');
        }
    }, { passive: true });

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
});
