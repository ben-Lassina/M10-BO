
<?php

use function Laravel\Folio\{name};

name('home');
?>




<x-layouts.marketing
    :seo="[
        'title'         => setting('site.title', 'Spreekwoorden en gezegden tool - Leer Nederlandse spreekwoorden met illustraties en betekenissen.'),
        'description'   => setting('site.description', 'spreekwoorden, gezegden, Nederlands leren, illustraties, betekenissen'),
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