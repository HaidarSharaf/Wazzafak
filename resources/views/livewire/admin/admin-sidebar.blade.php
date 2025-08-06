<div
    x-data="{ showSidebar: false }"
>

    <div
        x-cloak
        x-show="showSidebar"
        class="fixed inset-0 z-10 bg-surface-dark/10 backdrop-blur-xs"
        x-on:click="showSidebar = false"
        x-transition.opacity
    >

    </div>

    <nav
        x-cloak
        class="fixed left-0 z-80 flex h-svh w-60 shrink-0 flex-col bg-white p-4 transition-transform duration-300 md:w-72 lg:translate-x-0 lg:relative"
        x-bind:class="showSidebar ? 'translate-x-0' : '-translate-x-full'"
    >

        <a
            href="#"
            wire:navigate
            class="ml-2 mb-10 w-fit text-2xl font-bold text-on-surface-strong flex items-center gap-4 text-[#1750b6]"
        >
            <img src="/images/Logo.png" class="sm:max-w-14 max-w-8">
            <span>Wazzafak</span>
        </a>

        <div class="flex flex-col gap-4 overflow-y-auto pb-6">

            <a
                href="{{ route('admin.dashboard') }}"
                wire:navigate
                wire:current.exact="text-lime-600"
                class="flex items-center rounded-radius gap-4 px-2 py-1.5 text-lg font-bold text-[#1750b6] hover:text-lime-600 transition-colors duration-300 focus-visible:underline focus:outline-hidden"
            >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-6 shrink-0" aria-hidden="true">
                    <path fill-rule="evenodd" d="M1 2.75A.75.75 0 0 1 1.75 2h16.5a.75.75 0 0 1 0 1.5H18v8.75A2.75 2.75 0 0 1 15.25 15h-1.072l.798 3.06a.75.75 0 0 1-1.452.38L13.41 18H6.59l-.114.44a.75.75 0 0 1-1.452-.38L5.823 15H4.75A2.75 2.75 0 0 1 2 12.25V3.5h-.25A.75.75 0 0 1 1 2.75ZM7.373 15l-.391 1.5h6.037l-.392-1.5H7.373Zm7.49-8.931a.75.75 0 0 1-.175 1.046 19.326 19.326 0 0 0-3.398 3.098.75.75 0 0 1-1.097.04L8.5 8.561l-2.22 2.22A.75.75 0 1 1 5.22 9.72l2.75-2.75a.75.75 0 0 1 1.06 0l1.664 1.663a20.786 20.786 0 0 1 3.122-2.74.75.75 0 0 1 1.046.176Z" clip-rule="evenodd"/>
                </svg>
                <span>Dashboard</span>
            </a>

            <a
                href="{{ route('admin.manage') }}"
                wire:navigate
                wire:current="text-lime-600"
                class="flex items-center rounded-radius gap-4 px-2 py-1.5 text-lg font-bold text-[#1750b6] hover:text-lime-600 transition-colors duration-300 focus-visible:underline focus:outline-hidden"
            >
                <svg viewBox="0 0 20 20" class="size-7 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="currentColor"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <rect x="0" fill="none" width="20" height="20"></rect> <g> <path d="M5.5 7C4.67 7 4 6.33 4 5.5 4 4.68 4.67 4 5.5 4 6.32 4 7 4.68 7 5.5 7 6.33 6.32 7 5.5 7zM8 5h9v1H8V5zm-2.5 7c-.83 0-1.5-.67-1.5-1.5C4 9.68 4.67 9 5.5 9c.82 0 1.5.68 1.5 1.5 0 .83-.68 1.5-1.5 1.5zM8 10h9v1H8v-1zm-2.5 7c-.83 0-1.5-.67-1.5-1.5 0-.82.67-1.5 1.5-1.5.82 0 1.5.68 1.5 1.5 0 .83-.68 1.5-1.5 1.5zM8 15h9v1H8v-1z"></path> </g> </g></svg>
                <span>Manage Job Posts</span>
            </a>

        </div>

        <div
            x-data="{ menuIsOpen: false }"
            class="mt-auto"
            x-on:keydown.esc.window="menuIsOpen = false"
        >
            <button
                type="button"
                class="flex w-full items-center rounded-radius gap-2 p-2 text-left text-[#1750b6] font-bold hover:text-lime-600 cursor-pointer focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary"
                x-bind:class="menuIsOpen ? 'text-lime-600 bg-gray-200' : ''"
                x-on:click="menuIsOpen = ! menuIsOpen"
                x-bind:aria-expanded="menuIsOpen"
            >

                <div class="md:size-12 sm:size-10 size-8 rounded-2xl bg-gradient-to-br from-[#1750b6]/60 to-lime-400 flex items-center justify-center text-lg font-bold text-white">
                    {{ $user->name[0] }}
                </div>

                <div class="flex flex-col">
                    <span class="md:text-base text-sm font-bold overflow-hidden">{{ $user->name }}</span>
                    <span class="w-32 overflow-hidden text-ellipsis md:text-sm text-xs md:w-36 opacity-90">{{ $user->email }}</span>
                </div>

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2" class="ml-auto size-5 shrink-0 -rotate-90 md:rotate-0">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                </svg>

            </button>

            <div
                x-cloak
                x-show="menuIsOpen"
                class="absolute bottom-20 right-6 z-20 -mr-1 w-48 border-2 divide-y-2 divide-slate-300 border-slate-300 bg-white rounded-lg md:-right-44 md:bottom-4"
                role="menu"
                x-on:click.outside="menuIsOpen = false"
                x-on:keydown.down.prevent="$focus.wrap().next()"
                x-on:keydown.up.prevent="$focus.wrap().previous()"
                x-transition=""
                x-trap="menuIsOpen"
            >

                <div class="flex flex-col items-center justify-center py-2 px-3 gap-3">

                    <a
                        wire:navigate
                        href="{{ route('update-password') }}"
                        wire:current.exact="text-lime-300 underline"
                        class="w-full md:text-lg sm:text-base text-sm text-center font-bold text-[#1750b6] hover:text-lime-600 hover:underline cursor-pointer"
                    >
                        Update Password
                    </a>

                    <button
                        wire:click="logout"
                        class="w-full md:text-lg sm:text-base text-sm font-bold text-[#1750b6] hover:text-lime-600 hover:underline cursor-pointer"
                    >
                        Logout
                    </button>

                </div>

            </div>
        </div>
    </nav>

    <button
        class="fixed right-4 top-4 z-20 rounded-full bg-[#1750b6] text-white p-4 cursor-pointer lg:hidden"
        x-on:click="showSidebar = ! showSidebar"
    >
        <svg x-show="showSidebar" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-5" aria-hidden="true">
            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
        </svg>

        <svg x-show="! showSidebar" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-5" aria-hidden="true">
            <path d="M0 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm5-1v12h9a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1zM4 2H2a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h2z"/>
        </svg>
    </button>
</div>
