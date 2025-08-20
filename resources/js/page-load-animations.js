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
    const heroSection = document.querySelector('.hero-section');
    if (heroSection) {
        heroSection.classList.add('hero-loaded');
    }
    
    // Animate text with typing effect
    const typingElements = document.querySelectorAll('.typing-text');
    typingElements.forEach(element => {
        const text = element.textContent;
        element.textContent = '';
        element.classList.add('typing');
        
        let i = 0;
        const typeWriter = () => {
            if (i < text.length) {
                element.textContent += text.charAt(i);
                i++;
                setTimeout(typeWriter, 50);
            } else {
                element.classList.remove('typing');
                element.classList.add('typed');
            }
        };
        
        setTimeout(() => {
            typeWriter();
        }, 500);
    });
});
