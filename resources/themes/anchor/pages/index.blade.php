<?php

use function Laravel\Folio\{name};

name('home');
?>

<meta name="description" content="{{ $page['description'] ?? 'Spreekwoorden en gezegden tool - Leer Nederlandse spreekwoorden met illustraties en betekenissen.' }}">
<meta name="keywords" content="spreekwoorden, gezegden, Nederlands leren, illustraties, betekenissen">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="og:image" content="{{ url($page['image'] ?? '/og_image.png') }}">
<meta property="og:type" content="website">


<x-layouts.marketing
    :seo="[
        'title'         => setting('site.title', 'Spreekwoorden en gezegden tool'),
        'description'   => setting('site.description', 'Spreekwoorden en gezegden tool'),
        'image'         => url('/og_image.png'),
        'type'          => 'website'
    ]">

    <x-marketing.sections.hero />

    <x-container class="py-12 border-t sm:py-24 border-zinc-200">
        <x-marketing.sections.features />
    </x-container>

    <x-container class="py-12 border-t sm:py-24 border-zinc-200">
        <x-marketing.sections.testimonials />
    </x-container>

    <x-container class="py-12 border-t sm:py-24 border-zinc-200">
        <x-marketing.sections.pricing />
    </x-container>

</x-layouts.marketing>