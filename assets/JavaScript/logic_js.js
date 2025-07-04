// Create the button
const backToTopBtn = document.createElement('button');
backToTopBtn.textContent = 'Back to Top';
backToTopBtn.style.position = 'fixed';
backToTopBtn.style.bottom = '30px';
backToTopBtn.style.right = '30px';
backToTopBtn.style.display = 'none';
backToTopBtn.style.zIndex = '1000';
document.body.appendChild(backToTopBtn);

// Show/hide button on scroll
window.addEventListener('scroll', () => {
    if (window.scrollY > 200) {
        backToTopBtn.style.display = 'block';
    } else {
        backToTopBtn.style.display = 'none';
    }
});

// Scroll to top on click
backToTopBtn.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});
  