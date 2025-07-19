<div>
    <div class="!mt-12">
        @auth
            <button wire:click="logout" class="w-52 shadow-xl py-2.5 px-4 text-[15px] font-medium rounded-md text-white bg-[#FF4D30] hover:bg-[#F53003] focus:outline-none cursor-pointer">
                Logout
            </button>
        @endauth

        @guest
            <a
                href="{{ route('login') }}"
                wire:navigate
                class="w-52 shadow-xl py-2.5 px-4 text-[15px] font-medium rounded-md text-white bg-[#FF4D30] hover:bg-[#F53003] focus:outline-none cursor-pointer"
            >
                Login
            </a>
        @endguest
    </div>
</div>
