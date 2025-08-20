// Page load animations
document.addEventListener('DOMContentLoaded', function() {
    // Add a class to the body when the page is loaded
    document.body.classList.add('page-loaded');
    
    // Animate elements with the 'initial-animate' class
    const animatedElements = document.querySelectorAll('.initial-animate');
    
    // Stagger the animations
    animatedElements.forEach((element, index) => {
        setTimeout(() => {
            element.classList.add('animate');
        }, 100 * index);
    });
    
    // Add smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80, // Offset for fixed header if needed
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Parallax effect for hero section
    const heroSection = document.querySelector('.hero-section');
    if (heroSection) {
        window.addEventListener('scroll', () => {
            const scrollPosition = window.scrollY;
            if (scrollPosition < 600) { // Only apply effect near the top of the page
                heroSection.style.backgroundPositionY = `${scrollPosition * 0.5}px`;
            }
        });
    }
    
    // Sticky navbar on scroll
    const navbar = document.querySelector('nav');
    const navbarHeight = navbar ? navbar.offsetHeight : 0;
    let lastScrollTop = 0;
    
    window.addEventListener('scroll', () => {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        if (navbar) {
            // Add sticky class when scrolling down
            if (scrollTop > navbarHeight) {
                navbar.classList.add('navbar-sticky');
                document.body.classList.add('has-sticky-nav');
                
                // Hide navbar when scrolling down, show when scrolling up
                if (scrollTop > lastScrollTop && scrollTop > navbarHeight * 2) {
                    navbar.classList.add('navbar-hidden');
                } else {
                    navbar.classList.remove('navbar-hidden');
                }
            } else {
                navbar.classList.remove('navbar-sticky');
                navbar.classList.remove('navbar-hidden');
                document.body.classList.remove('has-sticky-nav');
            }
            
            lastScrollTop = scrollTop;
        }
    });
    
    // Add hover effects for interactive elements
    const interactiveElements = document.querySelectorAll('.hover-shadow, .hover-glow, .hover-scale, .card-3d');
    
    interactiveElements.forEach(element => {
        element.addEventListener('mouseenter', function() {
            this.classList.add('active');
        });
        
        element.addEventListener('mouseleave', function() {
            this.classList.remove('active');
        });
    });
    
    // Animate sections as they appear in the viewport
    const sections = document.querySelectorAll('section, .section');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('section-visible');
                
                // Animate children with staggered delay
                const animatedChildren = entry.target.querySelectorAll('.section-animate');
                animatedChildren.forEach((child, index) => {
                    setTimeout(() => {
                        child.classList.add('animate');
                    }, 100 * index);
                });
                
                // Unobserve after animation
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1
    });
    
    sections.forEach(section => {
        section.classList.add('section-hidden');
        observer.observe(section);
    });
    
    // Add loading animation to the hero section
    if (heroSection) {
        heroSection.classList.add('hero-loaded');
    }
    
    // Animate text with typing effect
    const typingElements = document.querySelectorAll('.typing-text, .typing-animation');
    
    // Create an intersection observer for typing animations
    const typingObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const element = entry.target;
                const originalText = element.getAttribute('data-original-text');
                element.textContent = '';
                element.classList.add('typing');
                
                let i = 0;
                const typeWriter = () => {
                    if (i < originalText.length) {
                        element.textContent += originalText.charAt(i);
                        i++;
                        setTimeout(typeWriter, 50);
                    } else {
                        element.classList.remove('typing');
                        element.classList.add('typed');
                    }
                };
                
                // Start typing animation
                typeWriter();
                // Unobserve after animation starts
                typingObserver.unobserve(element);
            }
        });
    }, { threshold: 0.5 });
    
    typingElements.forEach(element => {
        // Store the original text
        element.setAttribute('data-original-text', element.textContent);
        element.textContent = ''; // Clear the text initially
        typingObserver.observe(element);
    });
});
