<section class="flex flex-col items-center justify-center p-4 gap-2 text-center">
  
    <x-marketing.elements.heading class="flex-col justify-center gap-y-2"
        level="h2"
        title="Abonnementen"
        description="Bekijk hier welk abonnement bij je past!"
    />
</section>

    <?php
// Array of data for each tier
$tiers = [
    [
        "title" => "Nieuwsgierige liefhebbers van taal",
        "monthly_price" => "€2,49",
        "yearly_price" => "€24,99",
        "features" => [
            "Basisgebruik van de website - op termijn app",
            "Beperkte selectie van 25 plaatjes",
            "Ideaal als instapper",
            "Favorieten opslaan"
        ],
        "stripe_price_id_monthly" => "price_1QiCBgFllnWu1kBS8o06btGE",
        "stripe_price_id_yearly" => "price_1QiCBgFllnWu1kBS8o06btGE"
    ],
    [
        "title" => "Liefhebbers van taal",
        "monthly_price" => "€3,99",
        "yearly_price" => "€39,99",
        "features" => [
            "Toegang tot uitgebreide functies",
            "Versturen van 30 plaatjes per maand",
            "Ideaal voor liefhebbers die de app intensiever willen gebruiken",
            "Exclusieve content"
        ],
        "stripe_price_id_monthly" => "price_1QiCE4FllnWu1kBSTu2ofYLd",
        "stripe_price_id_yearly" => "price_1QiCLAFllnWu1kBSzvkLUELc"
    ],
    [
        "title" => "Onderwijs Professionals",
        "monthly_price" => "€6,99",
        "yearly_price" => "€69,99",
        "features" => [
            "Toegang tot extra lesmateriaal",
            "Versturen van 60 plaatjes per maand",
            "Beperkt downloaden - 20 plaatjes per maand"
        ],
        "stripe_price_id_monthly" => "price_1QiCIhFllnWu1kBSZFuoW4Is",
        "stripe_price_id_yearly" => "price_1QiCIhFllnWu1kBSXza1zyib"
    ],
    [
        "title" => "Docenten Nederlands",
        "monthly_price" => "€14,99",
        "yearly_price" => "€149,99",
        "features" => [
            "Onbeperkt versturen en downloaden",
            "Volledige toegang tot alle tools",
            "Speciaal ontworpen voor docenten met intensieve lesvoorbereidingen"
        ],
        "stripe_price_id_monthly" => "price_1QiCPDFllnWu1kBS2lyet8pK",
        "stripe_price_id_yearly" => "price_1QiCPmFllnWu1kBS4QTOvj6x"
    ],
    [
        "title" => "Scholen",
        "monthly_price" => "€49,99",
        "yearly_price" => "€149,99",
        "features" => [
            "Volledige toegan voor het hele schoolteam",
            "Onbeperkt gebruik door alle aangesloten docenten",
            "Ideaal voor onderwijsinstellingen",
        ],
        "stripe_price_id_monthly" => "price_1QiCQkFllnWu1kBS0rDzxGN4",
        "stripe_price_id_yearly" => "price_1QiCQkFllnWu1kBS0rDzxGN4"
    ]
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css"> <!-- Add your CSS file here -->
    <title>Subscription Plans</title>
</head>
<body>
    <div class="plans-container space-y-8">
        <?php foreach ($tiers as $tier): ?>
        <article class="plan">
            <div class="rounded-3xl rounded-t-3xl bg-white/60 p-8 ring-1 ring-gray-900/10 sm:mx-8 rounded-lg">
                <h2 id="tier-hobby" class="text-base/7 font-semibold text-indigo-600">
                    <?= htmlspecialchars($tier['title']) ?>
                </h2>
                <p class="mt-4 flex items-baseline gap-x-2">
                    <span class="text-5xl font-semibold tracking-tight text-gray-900">
                        <?= htmlspecialchars($tier['monthly_price']) ?>
                    </span>
                    <span class="text-base text-gray-500">/maand</span>
                </p>
                <p class="mt-4 text-gray-400">of</p>
                <p class="mt-4 flex items-baseline gap-x-2">
                    <span class="text-3xl font-semibold tracking-tight text-gray-900">
                        <?= htmlspecialchars($tier['yearly_price']) ?>
                    </span>
                    <span class="text-base text-gray-500">/jaar</span>
                </p>
                <ul role="list" class="mt-8 space-y-3 text-sm/6 text-gray-600 sm:mt-10">
                    <?php foreach ($tier['features'] as $feature): ?>
                    <li class="flex gap-x-3">
                        <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                        </svg>
                        <?= htmlspecialchars($feature) ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
                

                <form action="{{ url('/checkout') }}" method="GET">
                    <input type="hidden" name="billing" value="monthly">
                    <div class="flex gap-4 mt-6">
                        <button type="submit" 
                            class="rounded-md px-3.5 py-2.5 text-sm font-semibold text-indigo-600 ring-1 ring-inset ring-indigo-200 hover:bg-indigo-600 hover:text-white">
                            Kies Maandelijks
                        </button>
                        <button type="submit" 
                            name="billing" value="yearly" 
                            class="rounded-md px-3.5 py-2.5 text-sm font-semibold text-indigo-600 ring-1 ring-inset ring-indigo-200 hover:bg-indigo-600 hover:text-white">
                            Kies Jaarlijks
                        </button>
                    </div>
                </form>


            </div>
        </article>
        <?php endforeach; ?>
    </div>
</body>
</html>
