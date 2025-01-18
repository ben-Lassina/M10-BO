<?php
    use function Laravel\Folio\{middleware, name};
    middleware('auth');
    name('dashboard');
?>

<x-layouts.app>
    <x-app.container x-data class="lg:space-y-6" x-cloak>
        
    <x-app.alert id="dashboard_alert" class="hidden lg:flex">
        This is the Spreekwoorden en Gezegden tool, where you can explore Dutch proverbs and sayings. <a href="https://www.example.com/docs" target="_blank" class="mx-1 underline">View the docs</a> to learn more.
    </x-app.alert>

    <x-app.heading
            title="Spreekwoorden en Gezegden"
            description="Explore a collection of Dutch proverbs and sayings. Click on any card to learn more."
            :border="false"
        />

        <div class="flex flex-col w-full mt-6 space-y-5 md:flex-row lg:mt-0 md:space-y-0 md:space-x-5">
        <x-app.dashboard-card
            href="{{ route('main') }}"
            title="Gezegde 1"
            description="A well-known Dutch saying that teaches a lesson about life."
            link_text="Learn More"
         
        />
        <x-app.dashboard-card
            href="{{ route('main') }}"
            title="Gezegde 2"
            description="A proverb about patience and wisdom passed down through generations."
            link_text="Learn More"
           
        />
        <div class="flex flex-col w-full mt-5 space-y-5 md:flex-row md:space-y-0 md:mb-0 md:space-x-5">
        <x-app.dashboard-card
            href="{{ route('main') }}"
            title="Gezegde 3"
            description="An insightful Dutch saying about the value of hard work and perseverance."
            link_text="Learn More"
           
        />
        <x-app.dashboard-card
            href="{{ route('main') }}"
            title="Gezegde 4"
            description="A saying that reminds us to be cautious and consider all options."
            link_text="Learn More"
            
        />
    </div>
        <div class="mt-5 space-y-5">
            @if(auth()->user())
                @subscriber
                    @php
                        $role = auth()->user()->roles()->first();
                    @endphp

                    @if($role)
                        <p>You are a subscribed user with the <strong>{{ $role->name }}</strong> role. Learn <a href="https://devdojo.com/wave/docs/features/roles-permissions" target="_blank" class="underline">more about roles</a> here.</p>
                        <x-app.message-for-subscriber />
                    @else
                        <p>You are a subscribed user, but no roles are assigned.</p>
                    @endif
                @else
                    <p>This current logged in user has a <strong>{{ auth()->user()->roles()->first()->name ?? 'No Role Assigned' }}</strong> role. To upgrade, <a href="{{ route('settings.subscription') }}" class="underline">subscribe to a plan</a>. Learn <a href="https://devdojo.com/wave/docs/features/roles-permissions" target="_blank" class="underline">more about roles</a> here.</p>
                @endsubscriber
            @else
                <p>You are not logged in. Please <a href="{{ route('login') }}" class="underline">log in</a> to access your dashboard.</p>
            @endif
            
            @if(auth()->user() && auth()->user()->hasRole('admin'))
                <x-app.message-for-admin />
            @endif
        </div>
    </x-app.container>
</x-layouts.app>
