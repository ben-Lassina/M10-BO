<section>
    <div class="container mx-auto py-10">
        <!-- Daily Quote Section -->
        @auth
        <div id="daily-quote" class="mb-10 text-center border p-4 rounded-lg shadow-md">
            <h1>Quote of the day</h1>
            <img id="daily-quote-image" src="" alt="Quote of the Day" class="w-full max-w-md mx-auto rounded-lg">
            <h2 id="daily-quote-text" class="text-xl font-semibold mt-4"></h2>
            <p id="daily-quote-meaning" class="text-gray-600 mt-2"></p>
        </div>

        <!-- Language Buttons -->
        <div class="flex justify-center gap-2 mb-6">
            <button onclick="fetchQuotes('en')">
                <img src="/images/download.png" alt="English" class="w-10 h-10">
            </button>
            <button onclick="fetchQuotes('nl')">
                <img src="/images/download (1).png" alt="Dutch" class="w-10 h-10">
            </button>
            <button onclick="fetchQuotes('du')">
                <img src="/images/download (2).png" alt="Dutch" class="w-10 h-10">
            </button>
            <button onclick="fetchQuotes('fr')">
                <img src="/images/download (3).png" alt="French" class="w-10 h-10">
            </button>
            <button onclick="fetchQuotes('it')">
                <img src="/images/download (4).png" alt="Italian" class="w-10 h-10">
            </button>
            <button onclick="fetchQuotes('sp')">
                <img src="/images/download (5).png" alt="Spanish" class="w-10 h-10">
            </button>
            <button onclick="fetchQuotes('ru')">
                <img src="/images/download (6).png" alt="Russian" class="w-10 h-10">
            </button>
        </div>

        <!-- Quote Carousel -->
        <div id="quote-carousel" class="hidden">
            <div class="flex items-center justify-center space-x-4">
                <button onclick="navigateQuotes(-1)" class="text-2xl font-bold">&larr;</button>
                <div id="quote-card" class="w-full max-w-md border p-4 rounded-lg shadow-md">
                    <img id="carousel-image" src="" alt="Quote" class="w-full rounded-lg">
                    <h3 id="carousel-quote" class="text-lg font-semibold mt-4"></h3>
                    <p id="carousel-meaning" class="text-gray-600 mt-2"></p>
                </div>
                <button onclick="navigateQuotes(1)" class="text-2xl font-bold">&rarr;</button>
            </div>
        </div>
        @endauth

        @guest
        <!-- Message for Unauthenticated Users -->
        <div class="flex justify-center mb-6">
            <p class="text-lg text-center text-red-500">
            U moet zich aanmelden om toegang te krijgen tot deze content.
                <a href="/login" class="text-blue-500 underline">Aanmelden </a> of
                <a href="/register" class="text-blue-500 underline">Registeren</a>.
            </p>
        </div>
        @endguest
    </div>

    <style>
        /* Add smooth transition effect to flag buttons */
        button img {
            transition: transform 0.3s ease, opacity 0.3s ease;
            margin: 0 10px; /* Add horizontal spacing between flag icons */
        }

        /* Hover effect for flag icons */
        button:hover img {
            transform: scale(1.1);  /* Slightly increase the size */
            opacity: 0.8;  /* Fade slightly */
        }

        /* Optional: You can also add more space between buttons */
        button {
            margin: 0 12px; /* Add space between each button */
        }
    </style>

    @auth
    <script>
        // Fetch daily quote
        function fetchDailyQuote() {
            fetch('/quote-of-the-day')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('daily-quote-image').src = data.image_path;
                    document.getElementById('daily-quote-text').innerText = data.quote;
                    document.getElementById('daily-quote-meaning').innerText = data.meaning;
                })
                .catch(error => console.error('Error fetching daily quote:', error));
        }

        // Fetch quotes based on language
        function fetchQuotes(language) {
            fetch(`/quotes/${language}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }
                    quotes = data;
                    currentIndex = 0; // Reset index
                    updateQuoteCarousel();
                    document.getElementById('quote-carousel').classList.remove('hidden');
                })
                .catch(error => console.error('Error fetching quotes:', error));
        }

        // Update the carousel with the current quote
        function updateQuoteCarousel() {
            const quote = quotes[currentIndex];
            document.getElementById('carousel-image').src = quote.image_path;
            document.getElementById('carousel-quote').innerText = quote.quote;
            document.getElementById('carousel-meaning').innerText = quote.meaning;
        }

        // Navigate through the quotes
        function navigateQuotes(direction) {
            currentIndex = (currentIndex + direction + quotes.length) % quotes.length;
            updateQuoteCarousel();
        }

        // Initialize daily quote fetch
        document.addEventListener('DOMContentLoaded', fetchDailyQuote);
    </script>
    @endauth
</section>
