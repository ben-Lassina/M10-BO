<header
    x-data="{ 
        mobileMenuOpen: false, 
        scrolled: false, 
        showOverlay: false, 
        dropdownOpen: false, 
        topOffset: '5',
        evaluateScrollPosition(){
            if(window.pageYOffset > this.topOffset){
                this.scrolled = true;
            } else {
                this.scrolled = false;
            }
        } 
    }"
    x-init="
        window.addEventListener('resize', function() {
            if(window.innerWidth > 768) {
                mobileMenuOpen = false;
            }
        });
        $watch('mobileMenuOpen', function(value){
            if(value){ document.body.classList.add('overflow-hidden'); } else { document.body.classList.remove('overflow-hidden'); }
        });
        evaluateScrollPosition();
        window.addEventListener('scroll', function() {
            evaluateScrollPosition(); 
        })
    "
    :class="{ 'border-gray-200/60 bg-white/90 border-b backdrop-blur-lg' : scrolled, 'border-transparent border-b bg-transparent translate-y-0' : !scrolled }"
    class="box-content sticky top-0 z-50 w-full h-24">
    <div
        x-show="showOverlay"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        class="absolute inset-0 w-full h-screen pt-24" x-cloak>
        <div class="w-screen h-full bg-black/50"></div>
    </div>
    <x-container>
        <div class="z-30 flex items-center justify-between h-24 md:space-x-8">
            <div class="z-20 flex items-center justify-between w-full md:w-auto">
                <div class="relative z-20 inline-flex">
                    <a href="{{ route('home') }}"
                        class="flex items-center justify-center space-x-3 font-bold text-zinc-900 transition-transform duration-300 hover:scale-105 hover:rotate-3">
                        <x-logo class=""></x-logo>
                    </a>
                </div>
                <div class="flex justify-end flex-grow md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="inline-flex items-center justify-center p-2 transition duration-150 ease-in-out rounded-full text-zinc-400 hover:text-zinc-500 hover:bg-zinc-100">
                        <svg x-show="!mobileMenuOpen" class="w-6 h-6" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
                        </svg>
                        <svg x-show="mobileMenuOpen" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <nav :class="{ 'hidden' : !mobileMenuOpen, 'block md:relative absolute top-0 left-0 md:w-auto w-screen md:h-auto h-screen pointer-events-none md:z-10 z-10' : mobileMenuOpen }" class="h-full md:flex">
                <ul
                    :class="{ 'hidden md:flex' : !mobileMenuOpen, 'flex flex-col absolute md:relative md:w-auto w-screen h-full md:h-full md:overflow-auto overflow-scroll md:pt-0 mt-24 md:pb-0 pb-48 bg-white md:bg-transparent' : mobileMenuOpen  }"
                    id="menu"
                    class="flex items-stretch justify-start flex-1 w-full h-full ml-0 border-t border-gray-100 pointer-events-auto md:items-center md:justify-center gap-x-8 md:w-auto md:border-t-0 md:flex-row">
                    <li>
                        <a href="{{ route('home') }}"
                            class="flex items-center w-full h-16 gap-1 text-sm font-semibold text-gray-700 transition duration-300 px-7 md:h-full md:px-0 md:w-auto hover:text-gray-900 relative group">
                            <span>Home</span>
                            <span class="absolute bottom-0 left-0 w-0 h-1 bg-gradient-to-r from-blue-500 to-green-500 transition-all duration-300 group-hover:w-full"></span>
                        </a>
                    </li>
                    <li class="relative group">
                        <a href="home"
                            x-on:click.prevent="dropdownOpen = !dropdownOpen"
                            class="flex items-center w-full h-16 gap-1 text-sm font-semibold text-gray-700 transition duration-300 px-7 md:h-full md:px-0 md:w-auto hover:text-gray-900 relative group">
                            <span>Spreekwoorden/Gezegden</span>
                            <span class="absolute bottom-0 left-0 w-0 h-1 bg-gradient-to-r from-pink-500 to-purple-500 transition-all duration-300 group-hover:w-full"></span>
                        </a>
                        <!-- Dropdown menu -->
                        <ul
                            x-show="dropdownOpen"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute left-0 z-20 w-40 mt-2 origin-top-left bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg">
                            <li>
                                <a href="home"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Spreekwoorden</a>
                            </li>
                            <li>
                                <a href="home"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Gezegden</a>
                            </li>
                        </ul>
                    </li>



                    <li>
                        <a href="{{ route('pricing') }}"
                            class="flex items-center w-full h-16 gap-1 text-sm font-semibold text-gray-700 transition duration-300 px-7 md:h-full md:px-0 md:w-auto hover:text-gray-900 relative group">
                            <span>Plannen</span>
                            <span class="absolute bottom-0 left-0 w-0 h-1 bg-gradient-to-r from-teal-500 to-cyan-500 transition-all duration-300 group-hover:w-full"></span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('blog') }}"
                            class="flex items-center w-full h-16 gap-1 text-sm font-semibold text-gray-700 transition duration-300 px-7 md:h-full md:px-0 md:w-auto hover:text-gray-900 relative group">
                            <span>Quiz</span>
                            <span class="absolute bottom-0 left-0 w-0 h-1 bg-gradient-to-r from-red-500 to-pink-500 transition-all duration-300 group-hover:w-full"></span>
                        </a>
                    </li>

                    @guest
                    <li class="relative z-30 flex flex-col items-center justify-center flex-shrink-0 w-full h-auto pt-3 space-y-3 text-sm md:hidden px-7">
                        <x-button href="{{ route('login') }}" tag="a" class="w-full text-sm" color="secondary">Login</x-button>
                        <x-button href="{{ route('register') }}" tag="a" class="w-full text-sm">Sign Up</x-button>
                    </li>
                    @else
                    <li class="flex items-center justify-center w-full pt-3 md:hidden px-7">
                        <x-button href="{{ route('login') }}" tag="a" class="w-full text-sm">View Dashboard</x-button>
                    </li>
                    @endguest

                </ul>
            </nav>

            @guest
            <div class="relative z-30 items-center justify-center flex-shrink-0 hidden h-full space-x-3 text-sm md:flex">
                <x-button href="{{ route('login') }}" tag="a" class="text-sm" color="secondary">Login</x-button>
                <x-button href="{{ route('register') }}" tag="a" class="text-sm">Sign Up</x-button>
            </div>
            @else
            <x-button href="{{ route('login') }}" tag="a" class="text-sm" class="relative z-20 flex-shrink-0 hidden ml-2 md:block">View Dashboard</x-button>
            @endguest

        </div>
    </x-container>

</header>