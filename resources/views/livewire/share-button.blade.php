<button
        x-data="{ copied: false }"
        @click="
                            navigator.clipboard.writeText(window.location.href)
                            .then(() => {
                                copied = true;
                                setTimeout(() => copied = false, 5000);
                            })
                    "
        class="px-6 py-3 bg-white/20 hover:bg-white/30 rounded-xl flex justify-center items-center text-white text-lg shadow-md cursor-pointer"
    >
        <svg x-show="!copied" class="md:w-6 md:h-6 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"/>
        </svg>
        <span x-show="copied" class="text-sm">Copied!</span>
    </button>

