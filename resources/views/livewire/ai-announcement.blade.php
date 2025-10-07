<section
    x-data="{ show: false }"
    x-init="setTimeout(() => show = true, 200)"
    x-show="show"
    x-transition:enter="transition ease-out duration-700"
    x-transition:enter-start="opacity-0 transform scale-95"
    x-transition:enter-end="opacity-100 transform scale-100"
    class="container mx-auto mb-10"
>
    <div class="relative overflow-hidden px-10 py-20 bg-black/20 rounded-lg">

        <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-yellow-400/20 rounded-full blur-3xl"></div>

        <div class="relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-8">
                <div class="flex-1 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 bg-yellow-400/20 border border-yellow-400/40 px-4 py-2 rounded-full mb-4">
                        <svg class="w-5 h-5 text-yellow-400" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.45284 2.71266C7.8276 1.76244 9.1724 1.76245 9.54716 2.71267L10.7085 5.65732C10.8229 5.94743 11.0526 6.17707 11.3427 6.29148L14.2873 7.45284C15.2376 7.8276 15.2376 9.1724 14.2873 9.54716L11.3427 10.7085C11.0526 10.8229 10.8229 11.0526 10.7085 11.3427L9.54716 14.2873C9.1724 15.2376 7.8276 15.2376 7.45284 14.2873L6.29148 11.3427C6.17707 11.0526 5.94743 10.8229 5.65732 10.7085L2.71266 9.54716C1.76244 9.1724 1.76245 7.8276 2.71267 7.45284L5.65732 6.29148C5.94743 6.17707 6.17707 5.94743 6.29148 5.65732L7.45284 2.71266Z" fill="#e2d20a"/>
                            <path d="M16.9245 13.3916C17.1305 12.8695 17.8695 12.8695 18.0755 13.3916L18.9761 15.6753C19.039 15.8348 19.1652 15.961 19.3247 16.0239L21.6084 16.9245C22.1305 17.1305 22.1305 17.8695 21.6084 18.0755L19.3247 18.9761C19.1652 19.039 19.039 19.1652 18.9761 19.3247L18.0755 21.6084C17.8695 22.1305 17.1305 22.1305 16.9245 21.6084L16.0239 19.3247C15.961 19.1652 15.8348 19.039 15.6753 18.9761L13.3916 18.0755C12.8695 17.8695 12.8695 17.1305 13.3916 16.9245L15.6753 16.0239C15.8348 15.961 15.961 15.8348 16.0239 15.6753L16.9245 13.3916Z" fill="#e2d20a"/>
                        </svg>
                        <span class="text-yellow-300 font-semibold text-sm">NEW</span>
                    </div>

                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4">
                        Powered by AI
                    </h2>

                    <p class="text-lg md:text-xl text-white/90 mb-6 max-w-xl">
                        Elevate your career with our free AI-powered tools. No signup required, instant results.
                    </p>

                    <div class="flex flex-wrap gap-4 justify-center lg:justify-start">
                        <a href="{{ route('ai-services') }}" wire:navigate class="inline-flex items-center gap-2 bg-white text-blue-950 font-semibold px-6 py-3 rounded-xl hover:bg-white/90 transition-all duration-300 hover:scale-105 hover:shadow-xl active:scale-95">
                            Explore AI Tools
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="flex-1 w-full max-w-md">
                    <div class="grid gap-4">

                        <a
                            x-data="{ hover: false }"
                            @mouseenter="hover = true"
                            @mouseleave="hover = false"
                            class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl p-5 transition-all duration-300 hover:bg-white/15 hover:scale-105 cursor-pointer"
                            href="{{ route('ai-cv-analyzer') }}"
                            wire:navigate
                        >
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center transition-transform duration-300" :class="hover ? 'scale-110 rotate-3' : ''">
                                    <svg class="w-6 h-6 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-bold text-white mb-1">CV Analyzer</h3>
                                    <p class="text-white/70 text-sm">Get instant feedback and improve your resume</p>
                                </div>
                                <svg class="w-5 h-5 text-white/50 transition-transform duration-300" :class="hover ? 'translate-x-1' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </a>

                        <a
                            x-data="{ hover: false }"
                            @mouseenter="hover = true"
                            @mouseleave="hover = false"
                            class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl p-5 transition-all duration-300 hover:bg-white/15 hover:scale-105 cursor-pointer"
                            href="{{ route('ai-cv-generator') }}"
                            wire:navigate
                        >
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-12 h-12 bg-emerald-500/20 rounded-xl flex items-center justify-center transition-transform duration-300" :class="hover ? 'scale-110 rotate-3' : ''">
                                    <svg class="w-6 h-6 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-bold text-white mb-1">CV Generator</h3>
                                    <p class="text-white/70 text-sm">Create a professional CV in minutes</p>
                                </div>
                                <svg class="w-5 h-5 text-white/50 transition-transform duration-300" :class="hover ? 'translate-x-1' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
