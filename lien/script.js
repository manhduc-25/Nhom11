// nut back-to-top
document.addEventListener("DOMContentLoaded", function () {
    const backToTop = document.querySelector('.back-to-top');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 300) {
            backToTop.classList.add('show');
        } else {
            backToTop.classList.remove('show');
        }
    });
});

// hiệu ứng mưa
document.addEventListener("DOMContentLoaded", function () {
    const rainContainer = document.querySelector('.rain-container');

    function createRaindrop() {
        const drop = document.createElement('div');
        drop.classList.add('raindrop');

        drop.style.left = Math.random() * window.innerWidth + 'px';
        drop.style.animationDuration = (0.5 + Math.random()) + 's';
        drop.style.height = (10 + Math.random() * 20) + 'px';
        drop.style.opacity = 0.2 + Math.random() * 0.4;

        rainContainer.appendChild(drop);

        setTimeout(() => drop.remove(), 2000);
    }

    setInterval(createRaindrop, 50);
});