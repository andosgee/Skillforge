document.addEventListener("DOMContentLoaded", function() {
    const wrapper = document.querySelector(".marquee__wrapper");
    const slides = wrapper.querySelectorAll("img");
    const prevBtn = document.querySelector(".button__prev");
    const nextBtn = document.querySelector(".button__next");
    const selectors = document.querySelectorAll(".marquee__selector__image");
    const slideWidth = slides[0].clientWidth;
    const interval = 5000; // Adjust the interval time in milliseconds
    let currentIndex = 0;
    let timer;

    function goToSlide(index) {
        wrapper.style.transform = `translateX(-${index * slideWidth}px)`;
        currentIndex = index;
        updateSelectors();
    }

    function nextSlide() {
        if (currentIndex < slides.length - 1) {
            goToSlide(currentIndex + 1);
        } else {
            goToSlide(0);
        }
    }

    function prevSlide() {
        if (currentIndex > 0) {
            goToSlide(currentIndex - 1);
        } else {
            goToSlide(slides.length - 1);
        }
    }

    function updateSelectors() {
        selectors.forEach(selector => {
            selector.classList.remove("active");
        });
        selectors[currentIndex].classList.add("active");
    }

    function startTimer() {
        timer = setInterval(nextSlide, interval);
    }

    // Function to stop the timer
    function stopTimer() {
        clearInterval(timer);
    }

    startTimer();

    // Event listeners for next and previous buttons
    nextBtn.addEventListener("click", function() {
        nextSlide();
        stopTimer();
        startTimer();
    });
    prevBtn.addEventListener("click", function() {
        prevSlide();
        stopTimer();
        startTimer();
    });
    // Event Listeners for the selector
    selectors.forEach((selector, index) => {
        selector.addEventListener("click", function() {
            goToSlide(index);
            stopTimer();
            startTimer();
        });
    });
});