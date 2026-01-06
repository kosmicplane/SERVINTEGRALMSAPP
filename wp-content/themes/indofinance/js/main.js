const indofinance_toggleSearch = () => {
    const search = document.querySelector('.search');

    if (!search) {
        return;
    }

    const searchBtn = document.querySelector('.search__btn');
    const searchForm = document.querySelector('.search__form-wrapper');
    const searchInput = searchForm.querySelector('input[type="search"]');
    const searchIcon = searchBtn.querySelector('svg'); // Target the icon inside the button

    const toggleVal = value => value === 'true' ? 'false' : 'true';

    searchBtn.addEventListener('click', () => {
        const isVisible = searchForm.classList.toggle('is-visible');
        searchBtn.setAttribute('aria-expanded', toggleVal(searchBtn.getAttribute('aria-expanded')));

        if (isVisible) {
            searchInput.focus();
            // Change to cross icon
            searchIcon.innerHTML = `
                <line x1="1" y1="1" x2="15" y2="15" stroke="#808080" stroke-width="2"/>
                <line x1="15" y1="1" x2="1" y2="15" stroke="#808080" stroke-width="2"/>
            `;
        } else {
            // Restore search icon
            searchIcon.innerHTML = `
                <path d="M5.59882 0.764236C4.11392 0.764236 2.68984 1.35441 1.63986 2.40491C0.589873 3.45542 0 4.88021 0 6.36586C0 7.8515 0.589873 9.27629 1.63986 10.3268C2.68984 11.3773 4.11392 11.9675 5.59882 11.9675C6.94562 11.9644 8.24618 11.4758 9.26205 10.5911L9.59798 10.9272V11.9675L14.069 16.4328C14.2812 16.645 14.5689 16.7642 14.8689 16.7642C15.1689 16.7642 15.4566 16.645 15.6687 16.4328C15.8808 16.2205 16 15.9327 16 15.6325C16 15.3324 15.8808 15.0445 15.6687 14.8323L11.1976 10.367H10.1659L9.82993 10.0229C10.7095 9.00747 11.1949 7.70954 11.1976 6.36586C11.1976 4.88021 10.6078 3.45542 9.55778 2.40491C8.5078 1.35441 7.08372 0.764236 5.59882 0.764236ZM5.59882 2.3647C6.65946 2.3647 7.67666 2.78625 8.42665 3.53661C9.17664 4.28697 9.59798 5.30468 9.59798 6.36586C9.59798 7.42703 9.17664 8.44474 8.42665 9.1951C7.67666 9.94547 6.65946 10.367 5.59882 10.367C4.53818 10.367 3.52098 9.94547 2.77099 9.1951C2.021 8.44474 1.59966 7.42703 1.59966 6.36586C1.59966 5.30468 2.021 4.28697 2.77099 3.53661C3.52098 2.78625 4.53818 2.3647 5.59882 2.3647Z" fill="#808080"/>
            `;
        }
    });

    // Disable Search when clicked outside
    document.addEventListener('click', event => {
        if (!searchForm.contains(event.target) && !searchBtn.contains(event.target)) {
            searchForm.classList.remove('is-visible');
            searchBtn.setAttribute('aria-expanded', 'false');

            // Restore search icon when closing
            searchIcon.innerHTML = `
                <path d="M5.59882 0.764236C4.11392 0.764236 2.68984 1.35441 1.63986 2.40491C0.589873 3.45542 0 4.88021 0 6.36586C0 7.8515 0.589873 9.27629 1.63986 10.3268C2.68984 11.3773 4.11392 11.9675 5.59882 11.9675C6.94562 11.9644 8.24618 11.4758 9.26205 10.5911L9.59798 10.9272V11.9675L14.069 16.4328C14.2812 16.645 14.5689 16.7642 14.8689 16.7642C15.1689 16.7642 15.4566 16.645 15.6687 16.4328C15.8808 16.2205 16 15.9327 16 15.6325C16 15.3324 15.8808 15.0445 15.6687 14.8323L11.1976 10.367H10.1659L9.82993 10.0229C10.7095 9.00747 11.1949 7.70954 11.1976 6.36586C11.1976 4.88021 10.6078 3.45542 9.55778 2.40491C8.5078 1.35441 7.08372 0.764236 5.59882 0.764236ZM5.59882 2.3647C6.65946 2.3647 7.67666 2.78625 8.42665 3.53661C9.17664 4.28697 9.59798 5.30468 9.59798 6.36586C9.59798 7.42703 9.17664 8.44474 8.42665 9.1951C7.67666 9.94547 6.65946 10.367 5.59882 10.367C4.53818 10.367 3.52098 9.94547 2.77099 9.1951C2.021 8.44474 1.59966 7.42703 1.59966 6.36586C1.59966 5.30468 2.021 4.28697 2.77099 3.53661C3.52098 2.78625 4.53818 2.3647 5.59882 2.3647Z" fill="#808080"/>
            `;
        }
    });
};

indofinance_toggleSearch();


// Scroll to top functionality
function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Update circle progress based on scroll
function updateProgress() {
    const scrollTop = window.scrollY;
    const docHeight = document.documentElement.scrollHeight - window.innerHeight;
    const progress = (scrollTop / docHeight) * 100;
    const circle = document.querySelector('.progress-ring__circle');
    const radius = circle.r.baseVal.value;
    const circumference = 2 * Math.PI * radius;
    const offset = circumference - (progress / 100) * circumference;

    circle.style.strokeDashoffset = offset;
}

// Show/hide button on scroll
window.addEventListener('scroll', function () {
    const scrollButton = document.querySelector('.scroll-to-top');
    if (window.scrollY > 300) {
        scrollButton.classList.add('show');
    } else {
        scrollButton.classList.remove('show');
    }
    updateProgress();
});


document.addEventListener('DOMContentLoaded', function() {
    const tickerTrack = document.querySelector('.ticker-track');
    let isPaused = false;

    // Create Play/Pause button
    const playPauseBtn = document.createElement('button');
    playPauseBtn.classList.add('ticker-control-btn');
    
    // Create Dashicons for play and pause
    const playIcon = document.createElement('span');
    playIcon.classList.add('dashicons', 'dashicons-controls-play'); // Dashicon for play
    const pauseIcon = document.createElement('span');
    pauseIcon.classList.add('dashicons', 'dashicons-controls-pause'); // Dashicon for pause

    // Initially append the pause icon (as the default state)
    playPauseBtn.appendChild(pauseIcon);
    document.querySelector('.indofinance-ticker').appendChild(playPauseBtn);

    // Auto-scroll effect
    function startTicker() {
        if (!isPaused) {
            tickerTrack.style.animationPlayState = 'running';
        }
    }

    function stopTicker() {
        tickerTrack.style.animationPlayState = 'paused';
    }

    // Toggle Play/Pause
    playPauseBtn.addEventListener('click', function() {
        isPaused = !isPaused;
        if (isPaused) {
            stopTicker();
            // Switch to play icon when paused
            playPauseBtn.innerHTML = ''; // Clear current content
            playPauseBtn.appendChild(playIcon); // Add play icon
        } else {
            startTicker();
            // Switch to pause icon when playing
            playPauseBtn.innerHTML = ''; // Clear current content
            playPauseBtn.appendChild(pauseIcon); // Add pause icon
        }
    });

    // Pause on hover, resume on leave
    tickerTrack.addEventListener('mouseenter', stopTicker);
    tickerTrack.addEventListener('mouseleave', startTicker);
});
