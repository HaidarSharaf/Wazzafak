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
        class="fixed left-0 z-80 flex h-svh w-60 shrink-0 flex-col bg-blue-500/20 p-4 transition-transform duration-300 md:w-72 lg:translate-x-0 lg:relative"
        x-bind:class="showSidebar ? 'translate-x-0' : '-translate-x-full'"
    >

        <a
            href="#"
            wire:navigate
            class="ml-2 mb-10 w-fit text-2xl font-bold text-on-surface-strong flex items-center gap-4 text-[#1750b6]"
        >
            <img src="{{ asset('images/Logo.png') }}" class="sm:max-w-12 max-w-8">
            <span>&lt;Wazzafak /&gt;</span>
        </a>

        <div class="flex flex-col gap-4 overflow-y-auto pb-6 pl-2">

            <a
                href="{{ route('admin.dashboard') }}"
                wire:navigate
                wire:current.exact="text-lime-600"
                class="flex items-center rounded-radius gap-4 px-2 py-1.5 text-lg font-bold text-[#1750b6] hover:text-lime-600 transition-colors duration-300 focus-visible:underline focus:outline-hidden"
            >
                <svg class="size-6 shrink-0"  viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="currentColor"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M15 13V14H1.5L1 13.5V0H2V13H15Z"></path><path d="M13 3.20714L7.85353 8.35359H7.14642L5.49998 6.70714L1.85353 10.3536L1.14642 9.64648L5.14642 5.64648H5.85353L7.49998 7.29293L12.6464 2.14648H13.3535L15.3535 4.14648L14.6464 4.85359L13 3.20714Z"></path></g></svg>
                <span>Dashboard</span>
            </a>

            <a
                href="{{ route('admin.manage-jobs') }}"
                wire:navigate
                wire:current="text-lime-600"
                class="flex items-center rounded-radius gap-4 px-2 py-1.5 text-lg font-bold text-[#1750b6] hover:text-lime-600 transition-colors duration-300 focus-visible:underline focus:outline-hidden"
            >
                <svg viewBox="0 0 20 20" class="size-7 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="currentColor"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <rect x="0" fill="none" width="20" height="20"></rect> <g> <path d="M5.5 7C4.67 7 4 6.33 4 5.5 4 4.68 4.67 4 5.5 4 6.32 4 7 4.68 7 5.5 7 6.33 6.32 7 5.5 7zM8 5h9v1H8V5zm-2.5 7c-.83 0-1.5-.67-1.5-1.5C4 9.68 4.67 9 5.5 9c.82 0 1.5.68 1.5 1.5 0 .83-.68 1.5-1.5 1.5zM8 10h9v1H8v-1zm-2.5 7c-.83 0-1.5-.67-1.5-1.5 0-.82.67-1.5 1.5-1.5.82 0 1.5.68 1.5 1.5 0 .83-.68 1.5-1.5 1.5zM8 15h9v1H8v-1z"></path> </g> </g></svg>
                <span>Manage Job Posts</span>
            </a>

            <a
                href="{{ route('admin.manage-technologies') }}"
                wire:navigate
                wire:current="text-lime-600"
                class="flex items-center rounded-radius gap-4 px-2 py-1.5 text-lg font-bold text-[#1750b6] hover:text-lime-600 transition-colors duration-300 focus-visible:underline focus:outline-hidden"
            >
                <svg fill="currentColor" class="size-7 shrink-0" version="1.1" id="Artwork" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M12.3,95.5v321.1c0,20.3,16.5,36.9,36.9,36.9h413.7c20.3,0,36.8-16.5,36.8-36.9V95.5c0-20.3-16.5-36.9-36.8-36.9H49.2 C28.9,58.6,12.3,75.1,12.3,95.5z M462.8,428.9H49.2c-6.8,0-12.4-5.5-12.4-12.4V175.7h438.3v240.9 C475.2,423.3,469.6,428.9,462.8,428.9z M475.2,95.5v55.7H36.8V95.5c0-6.8,5.5-12.4,12.4-12.4h413.7 C469.6,83.1,475.2,88.7,475.2,95.5z"></path> <path d="M70.9,129.4c3.2,0,6.4-1.3,8.7-3.6c2.3-2.3,3.6-5.4,3.6-8.7c0-3.2-1.3-6.4-3.6-8.7c-4.6-4.6-12.8-4.6-17.3,0 c-2.3,2.3-3.6,5.4-3.6,8.7c0,3.2,1.3,6.4,3.6,8.7C64.5,128.1,67.6,129.4,70.9,129.4z"></path> <path d="M117.2,129.4c3.2,0,6.4-1.3,8.6-3.6c2.3-2.3,3.6-5.4,3.6-8.7c0-3.2-1.3-6.4-3.6-8.7c-4.6-4.6-12.7-4.6-17.3,0 c-2.3,2.3-3.6,5.4-3.6,8.7c0,3.2,1.3,6.4,3.6,8.7C110.7,128.1,113.9,129.4,117.2,129.4z"></path> <path d="M163.4,129.4c3.2,0,6.4-1.3,8.7-3.6c2.3-2.3,3.6-5.4,3.6-8.7c0-3.2-1.3-6.4-3.6-8.7c-4.6-4.6-12.8-4.6-17.3,0 c-2.3,2.3-3.6,5.4-3.6,8.7c0,3.2,1.3,6.4,3.6,8.7C157,128.1,160.2,129.4,163.4,129.4z"></path> <path d="M337.6,232.3c-5.2-4.4-12.9-3.7-17.3,1.4c-4.4,5.2-3.7,12.9,1.4,17.3l61.8,52.3l-61.8,52.5c-5.2,4.4-5.8,12.1-1.4,17.3 c2.4,2.9,5.9,4.3,9.3,4.3c2.8,0,5.6-1,7.9-2.9l72.9-61.8c2.7-2.3,4.3-5.7,4.3-9.4c0-3.6-1.6-7-4.3-9.3L337.6,232.3z"></path> <path d="M128.4,303.3l61.7-52.3c5.2-4.4,5.8-12.1,1.4-17.3c-4.4-5.2-12.1-5.8-17.3-1.4l-72.8,61.6c-2.7,2.3-4.3,5.7-4.3,9.3 c0,3.6,1.6,7,4.3,9.3l72.8,61.8c2.3,2,5.1,2.9,7.9,2.9c3.5,0,6.9-1.5,9.3-4.3c4.4-5.2,3.8-12.9-1.4-17.3L128.4,303.3z"></path> <path d="M291.1,214.9c-6.3-2.5-13.4,0.5-15.9,6.8L213.5,376c-2.5,6.3,0.5,13.4,6.8,15.9c1.5,0.6,3,0.9,4.5,0.9 c4.9,0,9.5-2.9,11.4-7.7l61.7-154.3C300.5,224.5,297.4,217.4,291.1,214.9z"></path> </g> </g></svg>
                <span>Manage Technologies</span>
            </a>

            <a
                href="{{ route('admin.manage-stacks') }}"
                wire:navigate
                wire:current="text-lime-600"
                class="flex items-center rounded-radius gap-4 px-2 py-1.5 text-lg font-bold text-[#1750b6] hover:text-lime-600 transition-colors duration-300 focus-visible:underline focus:outline-hidden"
            >
                <svg fill="currentColor" class="size-7 shrink-0" version="1.1" id="Artwork" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M363.4,384.5c33,0,59.9-26.9,59.9-59.9c0-33-26.9-59.9-59.9-59.9c-33,0-59.9,26.9-59.9,59.9 C303.5,357.6,330.4,384.5,363.4,384.5z M363.4,289.1c19.5,0,35.4,15.9,35.4,35.4c0,19.5-15.9,35.4-35.4,35.4S328,344.1,328,324.5 C328,305,343.9,289.1,363.4,289.1z"></path> <path d="M247.2,292.9c-11.3,0-20.5,9.2-20.5,20.5v22.4c0,11.3,9.2,20.5,20.5,20.5h9c2.2,7.6,5.2,14.9,9,21.8l-6.4,6.4 c-3.9,3.9-6,9-6,14.5c0,5.5,2.1,10.6,6,14.5l15.8,15.8c3.9,3.9,9,6,14.5,6c5.5,0,10.6-2.1,14.5-6l6.4-6.4c6.9,3.8,14.2,6.8,21.8,9 v9c0,11.3,9.2,20.5,20.5,20.5h22.4c11.3,0,20.5-9.2,20.5-20.5v-9c7.6-2.2,14.9-5.2,21.8-9l6.4,6.4c3.9,3.9,9,6,14.5,6 c5.5,0,10.6-2.1,14.5-6l15.8-15.8c8-8,8-21,0-28.9l-6.4-6.4c3.8-6.9,6.8-14.2,9-21.8h9c11.3,0,20.5-9.2,20.5-20.5v-22.4 c0-11.3-9.2-20.5-20.5-20.5h-9c-2.2-7.6-5.2-14.9-9-21.8l6.4-6.4c3.9-3.9,6-9,6-14.5s-2.1-10.6-6-14.5L452.2,220 c-3.9-3.9-9-6-14.5-6c-5.5,0-10.6,2.1-14.5,6l-6.4,6.4c-6.9-3.8-14.2-6.8-21.8-9v-9c0-11.3-9.2-20.5-20.5-20.5h-22.4 c-11.3,0-20.5,9.2-20.5,20.5v9c-7.6,2.2-14.9,5.2-21.8,9l-6.4-6.4c-3.9-3.9-9-6-14.5-6c-5.5,0-10.6,2.1-14.5,6l-15.8,15.8 c-3.9,3.9-6,9-6,14.5s2.1,10.6,6,14.5l6.4,6.4c-3.8,6.9-6.8,14.2-9,21.8H247.2z M265.8,317.4c5.8,0,10.9-4.1,12-9.9 c2.2-11.3,6.6-21.9,13-31.5c3.3-4.9,2.6-11.3-1.5-15.5l-10.3-10.3l10.1-10.1l10.3,10.3c4.1,4.1,10.6,4.8,15.5,1.5 c9.6-6.4,20.2-10.8,31.5-13c5.7-1.1,9.9-6.2,9.9-12v-14.6h14.3v14.6c0,5.9,4.1,10.9,9.9,12c11.3,2.2,21.9,6.6,31.5,13 c4.9,3.3,11.3,2.6,15.5-1.5l10.3-10.3l10.1,10.1l-10.3,10.3c-4.1,4.1-4.8,10.6-1.5,15.5c6.4,9.6,10.8,20.2,13,31.5 c1.1,5.7,6.2,9.9,12,9.9h14.6v14.3h-14.6c-5.8,0-10.9,4.1-12,9.9c-2.2,11.3-6.6,21.9-13,31.5c-3.3,4.9-2.6,11.3,1.5,15.5l10.3,10.3 l-10.1,10.1l-10.3-10.3c-4.1-4.1-10.6-4.8-15.5-1.5c-9.6,6.4-20.2,10.8-31.5,13.1c-5.7,1.1-9.9,6.2-9.9,12v14.6h-14.3v-14.6 c0-5.9-4.1-10.9-9.9-12c-11.3-2.2-21.9-6.6-31.5-13.1c-4.9-3.2-11.3-2.6-15.5,1.5l-10.3,10.3l-10.1-10.1l10.3-10.3 c4.1-4.1,4.8-10.6,1.5-15.5c-6.4-9.6-10.8-20.2-13-31.5c-1.1-5.7-6.2-9.9-12-9.9h-14.6v-14.3H265.8z"></path> <path d="M11.9,83.7v269.8c0,18.2,14.8,32.9,32.9,32.9h173.8c6.8,0,12.3-5.5,12.3-12.3c0-6.8-5.5-12.3-12.3-12.3H44.8 c-4.6,0-8.4-3.8-8.4-8.4V153.1h364.5v24c0,6.8,5.5,12.3,12.3,12.3s12.3-5.5,12.3-12.3V83.7c0-18.2-14.8-32.9-32.9-32.9H44.8 C26.6,50.8,11.9,65.5,11.9,83.7z M400.9,83.7v44.9H36.4V83.7c0-4.6,3.8-8.4,8.4-8.4h347.6C397.1,75.3,400.9,79,400.9,83.7z"></path> <path d="M63,114.1c3.2,0,6.4-1.3,8.7-3.6c2.3-2.3,3.6-5.4,3.6-8.7c0-3.2-1.3-6.4-3.6-8.7c-4.6-4.5-12.8-4.5-17.3,0.1 c-2.3,2.3-3.6,5.4-3.6,8.6c0,3.2,1.3,6.4,3.6,8.7C56.6,112.9,59.8,114.1,63,114.1z"></path> <path d="M101.9,114.1c3.2,0,6.4-1.3,8.6-3.6c2.3-2.3,3.6-5.4,3.6-8.7c0-3.2-1.3-6.4-3.6-8.7c-4.6-4.5-12.8-4.5-17.3,0.1 c-2.3,2.3-3.6,5.4-3.6,8.6c0,3.2,1.3,6.4,3.6,8.7C95.5,112.9,98.7,114.1,101.9,114.1z"></path> <path d="M140.8,114.1c3.2,0,6.4-1.3,8.7-3.6c2.3-2.3,3.6-5.4,3.6-8.7c0-3.2-1.3-6.4-3.6-8.6c-4.6-4.6-12.8-4.6-17.3,0 c-2.3,2.3-3.6,5.4-3.6,8.6c0,3.2,1.3,6.4,3.6,8.7C134.4,112.9,137.6,114.1,140.8,114.1z"></path> </g> </g></svg>
                <span>Manage Stacks</span>
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
