document.addEventListener('DOMContentLoaded', () => {
    // Ensure Swiper elements are present in the DOM
    const mainSwiperContainer = document.querySelector('.swiper-container');

    if (mainSwiperContainer) {
        // Initialize the main Swiper slider
        const mainSwiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 20,
            autoplay: {
                delay: 3000, // 3 seconds delay before autoplay starts
                disableOnInteraction: false, // Keep autoplay running even after user interacts
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });

        console.log('Main Swiper Initialized:');
    } else {
        console.warn('Main Swiper container not found.');
    }
});
