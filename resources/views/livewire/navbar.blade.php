<nav x-data="{ mobileMenuIsOpen: false }" x-on:click.away="mobileMenuIsOpen = false" class="flex items-center justify-between px-6 py-4 ">

    <a
        wire:navigate
        href="{{ route('home') }}"
        class="xl:text-4xl lg:text-3xl md:text-3xl text-2xl font-bold flex items-center md:gap-4 gap-2"
    >
        <img src="{{ asset('images/Logo.png') }}" alt="Wazzafak logo" class="lg:w-14 md:w-12 w-10" />
        <span>Wazzafak</span>
    </a>

    <ul class="hidden items-center sm:justify-between gap-7 sm:flex">
        <li>
            <a
                wire:navigate
                href="{{ route('home') }}"
                wire:current.exact="text-lime-300 underline"
                class="font-bold lg:text-xl md:text-lg text-base text-primary hover:underline hover:text-lime-300 focus:outline-hidden focus:underline "
            >
                Home
            </a>
        </li>

        @guest
            <li>
                <a
                    wire:navigate
                    href="{{ route('login') }}"
                    wire:current.exact="text-lime-300 underline"
                    class="font-bold lg:text-xl md:text-lg text-base text-primary hover:underline hover:text-lime-300 focus:outline-hidden focus:underline "
                >
                    Login
                </a>
            </li>

            <li>
                <a
                    wire:navigate
                    href="{{ route('register') }}"
                    wire:current.exact="text-lime-300 underline"
                    class="font-bold lg:text-xl md:text-lg text-base text-primary hover:text-lime-300 hover:underline focus:outline-hidden focus:underline"
                >
                    Register
                </a>
            </li>
        @endguest

        @auth
            <li>
                <a
                    wire:navigate
                    href="{{ route('explore-jobs') }}"
                    wire:current.exact="text-lime-300 underline"
                    class="font-bold lg:text-xl md:text-lg text-base text-primary hover:underline hover:text-lime-300 focus:outline-hidden focus:underline "
                >
                    Explore Jobs
                </a>
            </li>

            <li class="md:mr-5">
                <a
                    wire:navigate
                    href="{{ route('my-applications') }}"
                    wire:current.exact="text-lime-300 underline"
                    class="font-bold lg:text-xl md:text-lg text-base text-primary hover:text-lime-300 hover:underline focus:outline-hidden focus:underline"
                >
                    Applications
                </a>
            </li>

            <li
                x-data="{ userDropDownIsOpen: false, openWithKeyboard: false }"
                x-on:keydown.esc.window="userDropDownIsOpen = false, openWithKeyboard = false"
                class="relative flex items-center"
            >
                <button
                    x-on:click="userDropDownIsOpen = ! userDropDownIsOpen"
                    x-bind:aria-expanded="userDropDownIsOpen" x-on:keydown.space.prevent="openWithKeyboard = true"
                    x-on:keydown.enter.prevent="openWithKeyboard = true" x-on:keydown.down.prevent="openWithKeyboard = true"
                    class="rounded-full focus-visible:outline-2 cursor-pointer"
                >
                    <img src="https://penguinui.s3.amazonaws.com/component-assets/avatar-8.webp" class="md:size-12 size-10 rounded-full object-cover" />
                </button>


                <ul
                    x-cloak x-show="userDropDownIsOpen || openWithKeyboard"
                    x-transition.opacity x-trap="openWithKeyboard"
                    x-on:click.outside="userDropDownIsOpen = false, openWithKeyboard = false"
                    x-on:keydown.down.prevent="$focus.wrap().next()"
                    x-on:keydown.up.prevent="$focus.wrap().previous()"
                    class="absolute right-0 top-12 flex w-fit min-w-48 flex-col items-center overflow-hidden rounded-lg border border-outline bg-gray-100 py-1.5"
                >

                    <li class="border-b border-outline">
                        <div class="flex flex-col items-center px-4 py-2">
                            <span class="text-base font-bold text-[#1750b6]">{{ $user->name }}</span>
                            <p class="text-sm font-medium text-[#1750b6]">{{ $user->email }}</p>
                        </div>
                    </li>

                    <li>
                        <a
                            href="{{ route('update-password') }}"
                            wire:current.exact="text-lime-300 underline"
                            wire:navigate
                            class="block font-semibold px-4 py-2 sm:text-base text-sm text-[#1b7af5] hover:text-lime-500 hover:underline"
                        >
                            Settings
                        </a>
                    </li>

                    <li>
                        <button
                            wire:click="logout"
                            class="block font-semibold px-4 py-2 sm:text-base text-sm text-[#1b7af5] hover:text-lime-500 hover:underline"
                        >
                            Logout
                        </button>
                    </li>
                </ul>
            </li>
        @endauth
    </ul>


    <button
        x-on:click="mobileMenuIsOpen = !mobileMenuIsOpen"
        x-bind:aria-expanded="mobileMenuIsOpen"
        x-bind:class="mobileMenuIsOpen ? 'fixed top-6 right-6 z-20' : null"
        type="button"
        class="flex text-on-surface sm:hidden"
    >
        <svg x-cloak x-show="!mobileMenuIsOpen" xmlns="http://www.w3.org/2000/svg" fill="none" aria-hidden="true" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6 cursor-pointer">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
        <svg x-cloak x-show="mobileMenuIsOpen" xmlns="http://www.w3.org/2000/svg" fill="none" aria-hidden="true" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="text-lime-300 size-6 cursor-pointer">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>
    </button>

    <div x-cloak x-show="mobileMenuIsOpen"
         x-transition:enter="transition motion-reduce:transition-none ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition motion-reduce:transition-none ease-out duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-5 backdrop-blur-xl bg-opacity-50"
         @click="mobileMenuIsOpen = false">
    </div>


    <ul x-cloak x-show="mobileMenuIsOpen"
        x-transition:enter="transition motion-reduce:transition-none ease-out duration-300"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition motion-reduce:transition-none ease-out duration-300"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed max-h-svh overflow-y-auto inset-y-0 right-0 z-10 flex flex-col rounded-l-radius border-l border-outline bg-gray-100 px-8 pb-6 pt-10"
    >

        @auth

            <li class="mb-4 border-none">
                <div class="flex items-center gap-4 py-2">
                    <img
                        src="https://penguinui.s3.amazonaws.com/component-assets/avatar-8.webp"
                        class="size-12 rounded-full object-cover"
                    />
                    <div>
                        <span class="text-base font-bold text-[#1750b6]">{{ $user->name }}</span>
                        <p class="text-sm font-medium text-[#1750b6]">{{ $user->email }}</p>
                    </div>
                </div>
            </li>

        @endauth

        <li class="mt-2 p-2 text-center">
            <a
                wire:navigate
                href="{{ route('home') }}"
                wire:current.exact="text-lime-300 underline" class="w-full text-xl font-bold text-[#1b7af5] hover:text-lime-300 hover:underline"
            >
                Home
            </a>
        </li>

        @auth
            <li class="p-2 text-center">
                <a
                    wire:navigate
                    href="{{ route('explore-jobs') }}"
                    wire:current.exact="text-lime-300 underline" class="w-full text-xl font-bold text-[#1b7af5] hover:text-lime-300 hover:underline"
                >
                    Explore Jobs
                </a>
            </li>

            <li class="p-2 text-center">
                <a
                    wire:navigate
                    href="{{ route('my-applications') }}"
                    wire:current.exact="text-lime-300 underline" class="w-full text-xl font-bold text-[#1b7af5] hover:text-lime-300 hover:underline"
                >
                    Applied Jobs
                </a>
            </li>

            <hr role="none" class="my-2 border-gray-300">

            <li class="p-2 text-center">
                <a
                    wire:navigate
                    href="{{ route('update-password') }}"
                    wire:current.exact="text-lime-300 underline"
                    class="w-full text-xl font-bold text-[#1b7af5] hover:text-lime-500 hover:underline"
                >
                    Settings
                </a>
            </li>

            <li class="p-2 text-center">
                <button
                    wire:click="logout"
                    class="w-full text-xl font-bold text-[#1b7af5] hover:text-lime-500 hover:underline"
                >
                    Logout
                </button>
            </li>
        @endauth

        @guest
            <li class="p-2 text-center">
                <a
                    wire:navigate
                    href="{{ route('login') }}"
                    wire:current.exact="text-lime-300 underline"
                    class="w-full text-xl font-bold text-[#1b7af5] hover:text-lime-500 hover:underline"
                >
                    Login
                </a>
            </li>

            <li class="p-2 text-center">
                <a
                    wire:navigate
                    href="{{ route('register') }}"
                    wire:current.exact="text-lime-300 underline"
                    class="w-full text-xl font-bold text-[#1b7af5] hover:text-lime-500 hover:underline"
                >
                    Register
                </a>
            </li>
        @endguest

    </ul>
</nav>
