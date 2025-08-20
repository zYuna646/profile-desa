// Animation and scroll effects
document.addEventListener('DOMContentLoaded', function() {
    // Scroll reveal animation
    const revealElements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .stagger');
    
    function checkReveal() {
        const windowHeight = window.innerHeight;
        const revealPoint = 150;
        
        revealElements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            
            if (elementTop < windowHeight - revealPoint) {
                element.classList.add('active');
            } else {
                element.classList.remove('active');
            }
        });
    }
    
    // Initial check
    checkReveal();
    
    // Check on scroll
    window.addEventListener('scroll', checkReveal);
    
    // UMKM slider controls
    const sliderTrack = document.querySelector('.umkm-track');
    const prevButton = document.querySelector('.umkm-slider button:first-child');
    const nextButton = document.querySelector('.umkm-slider button:last-child');
    
    if (sliderTrack && prevButton && nextButton) {
        const cardWidth = 288; // 72rem (width) + 1.5rem (gap)
        
        prevButton.addEventListener('click', () => {
            sliderTrack.style.transition = 'transform 0.5s ease';
            sliderTrack.style.transform = `translateX(${cardWidth}px)`;
            
            setTimeout(() => {
                sliderTrack.style.transition = 'none';
                sliderTrack.style.transform = '';
                
                // Move last item to the beginning
                const lastItem = sliderTrack.lastElementChild;
                sliderTrack.prepend(lastItem);
            }, 500);
        });
        
        nextButton.addEventListener('click', () => {
            sliderTrack.style.transition = 'transform 0.5s ease';
            sliderTrack.style.transform = `translateX(-${cardWidth}px)`;
            
            setTimeout(() => {
                sliderTrack.style.transition = 'none';
                sliderTrack.style.transform = '';
                
                // Move first item to the end
                const firstItem = sliderTrack.firstElementChild;
                sliderTrack.append(firstItem);
            }, 500);
        });
    }
    
    // Pause animation on hover
    const animatedElements = document.querySelectorAll('.animate-float, .animate-pulse-slow, .animate-spin-slow, .animate-blob, .animate-scroll');
    
    animatedElements.forEach(element => {
        element.addEventListener('mouseenter', () => {
            element.style.animationPlayState = 'paused';
        });
        
        element.addEventListener('mouseleave', () => {
            element.style.animationPlayState = 'running';
        });
    });
});
