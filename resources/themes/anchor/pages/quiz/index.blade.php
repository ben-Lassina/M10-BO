
<?php
use function Laravel\Folio\{name};
name('quiz');
?>

<x-layouts.marketing>


    @auth
<div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center mb-6">Dutch Proverbs Quiz</h1>

        <div class="bg-white p-6 rounded-lg shadow-lg max-w-xl mx-auto">
            <!-- Question Section -->
            <div id="question-container" class="mb-4">
                <h2 class="text-xl font-semibold" id="question-text">Wie A zegt moet ook B zeggen.</h2>
            </div>

            <!-- Answer Buttons -->
            <div class="grid grid-cols-2 gap-4 mb-6">
                <button class="answer-btn bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600" data-answer="Als je ergens aan begonnen bent, moet je het ook afmaken.">Als je ergens aan begonnen bent, moet je het ook afmaken.</button>
                <button class="answer-btn bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600" data-answer="Je kunt beter zelf tot actie overgaan in een strijd of ruzie, dan afwachten.">Je kunt beter zelf tot actie overgaan in een strijd of ruzie, dan afwachten.</button>
                <button class="answer-btn bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600" data-answer="Wie volhoudt, bereikt ten slotte zijn doel.">Wie volhoudt, bereikt ten slotte zijn doel.</button>
                <button class="answer-btn bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600" data-answer="Graafwerk is zeer inspannend en vermoeiend.">Graafwerk is zeer inspannend en vermoeiend.</button>
            </div>

            <!-- Result Section -->
            <div id="result-container" class="hidden">
                <h3 class="text-lg font-semibold" id="result-text"></h3>
            </div>

            <!-- Next Question Button -->
            <div id="next-button-container" class="hidden text-center">
                <button id="next-button" class="bg-green-500 text-white py-2 px-6 rounded hover:bg-green-600">
                    Next Question
                </button>
            </div>
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

    <script>
        // Define quiz questions and answers
        const questions = [
            {
                question: "Wie A zegt moet ook B zeggen.",
                correctAnswer: "Als je ergens aan begonnen bent, moet je het ook afmaken.",
                answers: [
                    "Als je ergens aan begonnen bent, moet je het ook afmaken.",
                    "Je kunt beter zelf tot actie overgaan in een strijd of ruzie, dan afwachten.",
                    "Wie volhoudt, bereikt ten slotte zijn doel.",
                    "Graafwerk is zeer inspannend en vermoeiend."
                ]
            },
            {
                question: "De aanval is de beste verdediging.",
                correctAnswer: "Je kunt beter zelf tot actie overgaan in een strijd of ruzie, dan afwachten.",
                answers: [
                    "Als je ergens aan begonnen bent, moet je het ook afmaken.",
                    "Je kunt beter zelf tot actie overgaan in een strijd of ruzie, dan afwachten.",
                    "Wie volhoudt, bereikt ten slotte zijn doel.",
                    "Graafwerk is zeer inspannend en vermoeiend."
                ]
            },
            {
                question: "Een aal is geen paling.",
                correctAnswer: "Wat van slechte kwaliteit is, kan niet beter worden gemaakt dan dat het is.",
                answers: [
                    "Wat van slechte kwaliteit is, kan niet beter worden gemaakt dan dat het is.",
                    "Je kunt beter zelf tot actie overgaan in een strijd of ruzie, dan afwachten.",
                    "Wie volhoudt, bereikt ten slotte zijn doel.",
                    "Graafwerk is zeer inspannend en vermoeiend."
                ]
            },
            {
                question: "Aangetrouwd is aangedouwd.",
                correctAnswer: "Iemand die door huwelijk in de familie opgenomen is, zou men onder andere omstandigheden wellicht liever gemeden hebben.",
                answers: [
                    "Iemand die door huwelijk in de familie opgenomen is, zou men onder andere omstandigheden wellicht liever gemeden hebben.",
                    "Wie volhoudt, bereikt ten slotte zijn doel.",
                    "Je kunt beter zelf tot actie overgaan in een strijd of ruzie, dan afwachten.",
                    "Graafwerk is zeer inspannend en vermoeiend."
                ]
            },
            {
                question: "De aanhouder wint.",
                correctAnswer: "Wie volhoudt, bereikt ten slotte zijn doel.",
                answers: [
                    "Wie volhoudt, bereikt ten slotte zijn doel.",
                    "Als je ergens aan begonnen bent, moet je het ook afmaken.",
                    "Je kunt beter zelf tot actie overgaan in een strijd of ruzie, dan afwachten.",
                    "Graafwerk is zeer inspannend en vermoeiend."
                ]
            },
            {
                question: "Ook aan een goede visser ontglipt weleens een aal.",
                correctAnswer: "Ook een vakbekwaam iemand maakt weleens een fout.",
                answers: [
                    "Ook een vakbekwaam iemand maakt weleens een fout.",
                    "Wie volhoudt, bereikt ten slotte zijn doel.",
                    "Je kunt beter zelf tot actie overgaan in een strijd of ruzie, dan afwachten.",
                    "Graafwerk is zeer inspannend en vermoeiend."
                ]
            },
            {
                question: "Al draagt een aap een gouden ring, het is en blijft een lelijk ding.",
                correctAnswer: "Iets wat in wezen lelijk is, zal nooit mooi worden, ook niet als het uitgedost wordt in mooie kleren of als het ‘verpakt’ wordt in mooie woorden.",
                answers: [
                    "Iets wat in wezen lelijk is, zal nooit mooi worden, ook niet als het uitgedost wordt in mooie kleren of als het ‘verpakt’ wordt in mooie woorden.",
                    "Wie volhoudt, bereikt ten slotte zijn doel.",
                    "Je kunt beter zelf tot actie overgaan in een strijd of ruzie, dan afwachten.",
                    "Graafwerk is zeer inspannend en vermoeiend."
                ]
            },
            {
                question: "Een ouwe aap leer je geen kunstjes.",
                correctAnswer: "Oude mensen kun je niet makkelijk iets nieuws leren.",
                answers: [
                    "Oude mensen kun je niet makkelijk iets nieuws leren.",
                    "Wie volhoudt, bereikt ten slotte zijn doel.",
                    "Je kunt beter zelf tot actie overgaan in een strijd of ruzie, dan afwachten.",
                    "Graafwerk is zeer inspannend en vermoeiend."
                ]
            },
            {
                question: "Je moet een oude aap geen smoelen leren trekken.",
                correctAnswer: "Het is niet gepast iemand die ouder is en meer ervaring heeft, belerend toe te spreken.",
                answers: [
                    "Het is niet gepast iemand die ouder is en meer ervaring heeft, belerend toe te spreken.",
                    "Wie volhoudt, bereikt ten slotte zijn doel.",
                    "Je kunt beter zelf tot actie overgaan in een strijd of ruzie, dan afwachten.",
                    "Graafwerk is zeer inspannend en vermoeiend."
                ]
            },
            {
                question: "Aardewerk is paardenwerk.",
                correctAnswer: "Graafwerk is zeer inspannend en vermoeiend.",
                answers: [
                    "Graafwerk is zeer inspannend en vermoeiend.",
                    "Wie volhoudt, bereikt ten slotte zijn doel.",
                    "Je kunt beter zelf tot actie overgaan in een strijd of ruzie, dan afwachten.",
                    "Als je ergens aan begonnen bent, moet je het ook afmaken."
                ]
            },
            {
                question: "Je krijgt het niet cadeau.",
                correctAnswer: "Overal moet je hard voor werken, je krijgt niets voor niets.",
                answers: [
                    "Overal moet je hard voor werken, je krijgt niets voor niets.",
                    "Mensen van wie men voorbeeldig gedrag zou verwachten, vertonen dat in de praktijk vaak het minst.",
                    "Ergens zijn goedkeuring aan verlenen.",
                    "Iemand tegen de grond slaan."
                ]
            },
            {
                question: "Hoe dichter bij Rome, hoe slechter de christen.",
                correctAnswer: "Mensen van wie men voorbeeldig gedrag zou verwachten, vertonen dat in de praktijk vaak het minst.",
                answers: [
                    "Overal moet je hard voor werken, je krijgt niets voor niets.",
                    "Mensen van wie men voorbeeldig gedrag zou verwachten, vertonen dat in de praktijk vaak het minst.",
                    "Ergens zijn goedkeuring aan verlenen.",
                    "Iemand tegen de grond slaan."
                ]
            },
            {
                question: "Ergens zijn cachet op drukken.",
                correctAnswer: "Ergens zijn goedkeuring aan verlenen.",
                answers: [
                    "Overal moet je hard voor werken, je krijgt niets voor niets.",
                    "Mensen van wie men voorbeeldig gedrag zou verwachten, vertonen dat in de praktijk vaak het minst.",
                    "Ergens zijn goedkeuring aan verlenen.",
                    "Iemand tegen de grond slaan."
                ]
            },
            {
                question: "Een plan de campagne maken.",
                correctAnswer: "Iets goed voorbereiden.",
                answers: [
                    "Iets goed voorbereiden.",
                    "Mensen van wie men voorbeeldig gedrag zou verwachten, vertonen dat in de praktijk vaak het minst.",
                    "Overal moet je hard voor werken, je krijgt niets voor niets.",
                    "Iemand tegen de grond slaan."
                ]
            },
            {
                question: "Met het canvas kennismaken.",
                correctAnswer: "Iemand tegen de grond slaan.",
                answers: [
                    "Iemand tegen de grond slaan.",
                    "Overal moet je hard voor werken, je krijgt niets voor niets.",
                    "Mensen van wie men voorbeeldig gedrag zou verwachten, vertonen dat in de praktijk vaak het minst.",
                    "Ergens zijn goedkeuring aan verlenen."
                ]
            },
            {
                question: "Hij is niet capabel.",
                correctAnswer: "Hij is niet tegen zijn taak opgewassen.",
                answers: [
                    "Hij is niet tegen zijn taak opgewassen.",
                    "Iemand tegen de grond slaan.",
                    "Ergens zijn goedkeuring aan verlenen.",
                    "Overal moet je hard voor werken, je krijgt niets voor niets."
                ]
            },
            {
                question: "Capriolen uithalen.",
                correctAnswer: "Kunsten vertonen.",
                answers: [
                    "Kunsten vertonen.",
                    "Iemand tegen de grond slaan.",
                    "Ergens zijn goedkeuring aan verlenen.",
                    "Overal moet je hard voor werken, je krijgt niets voor niets."
                ]
            },
            {
                question: "Dat is net de Markies van Carabas.",
                correctAnswer: "Hij doet zich voor als een rijk man, terwijl hij in werkelijkheid niets heeft.",
                answers: [
                    "Hij doet zich voor als een rijk man, terwijl hij in werkelijkheid niets heeft.",
                    "Overal moet je hard voor werken, je krijgt niets voor niets.",
                    "Capriolen uithalen.",
                    "Mensen van wie men voorbeeldig gedrag zou verwachten, vertonen dat in de praktijk vaak het minst."
                ]
            },
            {
                question: "Ze behoren tot de lichte cavalerie.",
                correctAnswer: "Dat zijn meisjes van lichte zeden.",
                answers: [
                    "Dat zijn meisjes van lichte zeden.",
                    "Iemand tegen de grond slaan.",
                    "Capriolen uithalen.",
                    "Overal moet je hard voor werken, je krijgt niets voor niets."
                ]
            },
            {
                question: "De centen dansen hem in de zak.",
                correctAnswer: "Zodra hij geld heeft, geeft hij het uit.",
                answers: [
                    "Zodra hij geld heeft, geeft hij het uit.",
                    "Iemand tegen de grond slaan.",
                    "Overal moet je hard voor werken, je krijgt niets voor niets.",
                    "Capriolen uithalen."
                ]
            }
        ];

        let currentQuestionIndex = 0;

        // Load the first question
        function loadQuestion() {
            const question = questions[currentQuestionIndex];
            document.getElementById('question-text').textContent = question.question;
            const buttons = document.querySelectorAll('.answer-btn');
            buttons.forEach((button, index) => {
                button.textContent = question.answers[index];
                button.classList.remove('bg-green-500', 'bg-red-500');
                button.disabled = false;
            });

            document.getElementById('result-container').classList.add('hidden');
            document.getElementById('next-button-container').classList.add('hidden');
        }

        // Handle answer selection
        function handleAnswerSelection(event) {
            const selectedAnswer = event.target.getAttribute('data-answer');
            const correctAnswer = questions[currentQuestionIndex].correctAnswer;

            if (selectedAnswer === correctAnswer) {
                event.target.classList.add('bg-green-500');
                document.getElementById('result-text').textContent = "Correct!";
            } else {
                event.target.classList.add('bg-red-500');
                document.getElementById('result-text').textContent = `Wrong! The correct answer was: ${correctAnswer}.`;
            }

            // Disable all buttons after an answer is selected
            const buttons = document.querySelectorAll('.answer-btn');
            buttons.forEach(button => {
                button.disabled = true;
            });

            document.getElementById('result-container').classList.remove('hidden');
            document.getElementById('next-button-container').classList.remove('hidden');
        }

        // Handle next question button click
        function handleNextQuestion() {
            currentQuestionIndex++;
            if (currentQuestionIndex < questions.length) {
                loadQuestion();
            } else {
                document.getElementById('question-container').innerHTML = "<h2 class='text-xl font-semibold'>Quiz Complete!</h2>";
                document.getElementById('next-button-container').classList.add('hidden');
            }
        }

        // Add event listeners
        document.querySelectorAll('.answer-btn').forEach(button => {
            button.addEventListener('click', handleAnswerSelection);
        });

        document.getElementById('next-button').addEventListener('click', handleNextQuestion);

        // Load the first question when the page is loaded
        window.onload = loadQuestion;
    </script>
</x-layouts.marketing>