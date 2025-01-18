<?php
use function Laravel\Folio\{name};
name('main');
?>

<x-layouts.marketing>
    <div class="container mx-auto py-10">
        <h1 class="text-3xl font-bold text-center mb-6">Spreekwoorden en Gezegden</h1>

        @auth
        <!-- Search Bar -->
        <div class="flex justify-center mb-6">
            <input 
                id="search-bar" 
                type="text" 
                placeholder="Zoek spreekwoorden..." 
                class="w-full max-w-md px-4 py-2 border rounded-lg"
                onkeypress="handleSearchKeypress(event)"
            />
        </div>

        <!-- Alphabet Buttons -->
        <div class="flex flex-wrap justify-center gap-2 md:gap-4 mb-6">
            @foreach(range('A', 'Z') as $letter)
                <button 
                    onclick="fetchImages('{{ $letter }}')" 
                    class="px-4 py-2 text-sm md:text-base border rounded-lg hover:bg-blue-500 hover:text-white transition"
                >
                    {{ $letter }}
                </button>
            @endforeach
        </div>
        @endauth

        @guest
        <!-- Message for Unauthenticated Users -->
        <div class="flex justify-center mb-6">
            <p class="text-lg text-center text-red-500">
                U moet zich aanmelden om toegang te krijgen tot deze content. 
                <a href="/login" class="text-blue-500 underline">Aanmelden</a>
                of 
                <a href="/register" class="text-blue-500 underline">Registreren</a>.
            </p>
        </div>
        @endguest

        <!-- Modal -->
        @auth
        <div 
            id="image-modal" 
            class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50 hidden z-50"
        >
            <div class="bg-white p-6 rounded-lg w-11/12 max-w-4xl relative z-50">
                <!-- Close Button -->
                <button 
                    id="close-modal-btn" 
                    class="absolute top-4 right-4 text-xl font-bold z-50">&times;
                </button>
                
                <!-- Image Slider -->
                <div id="image-slider" class="flex items-center justify-center space-x-4">
                    <button onclick="previousImage()" class="text-2xl font-bold">&larr;</button>
                    <img id="modal-image" src="" alt="" class="max-h-96 rounded shadow">
                    <button onclick="nextImage()" class="text-2xl font-bold">&rarr;</button>
                </div>
            </div>
        </div>
        @endauth
    </div>

    @auth
    <script>
         // Global variables
         let quotes = [];
        let currentIndex = 0;

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


        // Update the carousel
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


        let images = [];
        let currentIndexs = 0;

        // Fetch images by letter
        function fetchImages(letter) {
            fetch(`/images/letter/${letter}`)
                .then(response => {
                    if (!response.ok) throw new Error(`Error: ${response.statusText}`);
                    return response.json();
                })
                .then(data => {
                    images = data;
                    currentIndexs = 0;

                    if (images.length > 0) {
                        showModal(images[0].path);
                    } else {
                        alert('Geen afbeeldingen gevonden.');
                    }
                })
                .catch(error => console.error('Error fetching images:', error));
        }

        // Handle keypress on search bar
        function handleSearchKeypress(event) {
            if (event.key === 'Enter') {
                const query = event.target.value.trim();
                if (query.length > 0) {
                    const firstLetter = query.charAt(0).toUpperCase();
                    if (/^[A-Z]$/.test(firstLetter)) {
                        fetchImages(firstLetter); // Fetch images for the first letter
                    } else {
                        alert('De eerste letter moet een alfabetische letter zijn (A-Z).'); // Notify user for invalid input
                    }
                } else {
                    alert('Voer tekst in om te zoeken.'); // Notify user for empty input
                }
            }
        }

        // Show image modal
        function showModal(imagePath) {
            document.getElementById('modal-image').src = imagePath;
            document.getElementById('image-modal').classList.remove('hidden');
        }

        // Close the modal
        function closeModal() {
            document.getElementById('image-modal').classList.add('hidden');
        }

        // Show previous image
        function previousImage() {
            if (currentIndexs > 0) {
                currentIndexs--;
                document.getElementById('modal-image').src = images[currentIndexs].path;
            }
        }

        // Show next image
        function nextImage() {
            if (currentIndexs < images.length - 1) {
                currentIndexs++;
                document.getElementById('modal-image').src = images[currentIndexs].path;
            }
        }

        // Add event listener to close the modal
        document.getElementById('close-modal-btn').addEventListener('click', closeModal);
    </script>
    @endauth

    <x-container class="py-12 border-t sm:py-24 border-zinc-200">
        <x-marketing.sections.quote />
    </x-container>
</x-layouts.marketing>
