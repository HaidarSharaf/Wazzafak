<div class="container mx-auto px-4 py-6 md:py-10">

    <div
        x-data="{ show: false }"
        x-init="setTimeout(() => show = true, 100)"
        x-show="show"
        x-transition:enter="transition ease-out duration-700"
        x-transition:enter-start="opacity-0 transform -translate-y-8"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        class="text-center mb-16"
    >
        <div class="inline-flex items-center justify-center gap-3 mb-6">
            <svg class="w-14 h-14 md:w-16 md:h-16 text-yellow-400" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.45284 2.71266C7.8276 1.76244 9.1724 1.76245 9.54716 2.71267L10.7085 5.65732C10.8229 5.94743 11.0526 6.17707 11.3427 6.29148L14.2873 7.45284C15.2376 7.8276 15.2376 9.1724 14.2873 9.54716L11.3427 10.7085C11.0526 10.8229 10.8229 11.0526 10.7085 11.3427L9.54716 14.2873C9.1724 15.2376 7.8276 15.2376 7.45284 14.2873L6.29148 11.3427C6.17707 11.0526 5.94743 10.8229 5.65732 10.7085L2.71266 9.54716C1.76244 9.1724 1.76245 7.8276 2.71267 7.45284L5.65732 6.29148C5.94743 6.17707 6.17707 5.94743 6.29148 5.65732L7.45284 2.71266Z" fill="#e2d20a"/>
                <path d="M16.9245 13.3916C17.1305 12.8695 17.8695 12.8695 18.0755 13.3916L18.9761 15.6753C19.039 15.8348 19.1652 15.961 19.3247 16.0239L21.6084 16.9245C22.1305 17.1305 22.1305 17.8695 21.6084 18.0755L19.3247 18.9761C19.1652 19.039 19.039 19.1652 18.9761 19.3247L18.0755 21.6084C17.8695 22.1305 17.1305 22.1305 16.9245 21.6084L16.0239 19.3247C15.961 19.1652 15.8348 19.039 15.6753 18.9761L13.3916 18.0755C12.8695 17.8695 12.8695 17.1305 13.3916 16.9245L15.6753 16.0239C15.8348 15.961 15.961 15.8348 16.0239 15.6753L16.9245 13.3916Z" fill="#e2d20a"/>
            </svg>
            <h1 class="text-4xl md:text-6xl font-bold text-white">AI Career Tools</h1>
        </div>

        <p class="text-lg md:text-xl text-white/90 max-w-2xl mx-auto mb-4">
            Supercharge your CV with AI-powered tools
        </p>

        <div class="inline-flex items-center gap-2 bg-white-500/20 border border-blue-400/50 px-4 py-2 rounded-full">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span class="text-white font-semibold text-sm md:text-base">100% Free • No Registration Required</span>
        </div>
    </div>


    <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-8 md:gap-12">

        <div
            x-data="{ show: false, hover: false }"
            x-init="setTimeout(() => show = true, 300)"
            x-show="show"
            x-transition:enter="transition ease-out duration-700 delay-100"
            x-transition:enter-start="opacity-0 transform translate-y-8"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            @mouseenter="hover = true"
            @mouseleave="hover = false"
            class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-8 md:p-10 transition-all duration-300 hover:bg-white/15 hover:-translate-y-2 hover:shadow-2xl"
        >
            <div class="flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl mb-6 mx-auto transition-transform duration-300" :class="hover ? 'scale-110 rotate-3' : ''">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>

            <h2 class="text-2xl md:text-3xl font-bold text-white text-center mb-4">CV Analyzer</h2>

            <p class="text-white/80 text-center mb-6 leading-relaxed">
                Get instant AI-powered feedback on your resume. Discover your strengths, weaknesses, and receive actionable improvements to land your dream job.
            </p>

            <div class="space-y-3 mb-8">
                <div class="flex items-center gap-3 text-white/90">
                    <svg class="w-5 h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-sm md:text-base">Detailed strength analysis</span>
                </div>
                <div class="flex items-center gap-3 text-white/90">
                    <svg class="w-5 h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-sm md:text-base">Identify areas for improvement</span>
                </div>
                <div class="flex items-center gap-3 text-white/90">
                    <svg class="w-5 h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-sm md:text-base">Get a professional rating (0-10)</span>
                </div>
                <div class="flex items-center gap-3 text-white/90">
                    <svg class="w-5 h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-sm md:text-base">Instant results in seconds</span>
                </div>
            </div>

            <a href="{{ route('ai-cv-analyzer') }}" wire:navigate class="block w-full bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-700 hover:to-blue-800 text-white font-semibold text-center py-4 px-6 rounded-xl transition-all duration-300 hover:scale-105 hover:shadow-lg active:scale-95">
                Analyze CV
                <svg class="inline-block w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>

        <div
            x-data="{ show: false, hover: false }"
            x-init="setTimeout(() => show = true, 500)"
            x-show="show"
            x-transition:enter="transition ease-out duration-700 delay-200"
            x-transition:enter-start="opacity-0 transform translate-y-8"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            @mouseenter="hover = true"
            @mouseleave="hover = false"
            class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-8 md:p-10 transition-all duration-300 hover:bg-white/15 hover:-translate-y-2 hover:shadow-2xl"
        >
            <div class="flex items-center justify-center w-20 h-20 bg-gradient-to-br bg-linear-to-r from-green-500 via-emerald-500 to-teal-500 rounded-2xl mb-6 mx-auto transition-transform duration-300" :class="hover ? 'scale-110 rotate-3' : ''">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
            </div>

            <h2 class="text-2xl md:text-3xl font-bold text-white text-center mb-4">CV Generator</h2>

            <p class="text-white/80 text-center mb-6 leading-relaxed">
                Create a professional, ATS-friendly CV in minutes. Our AI crafts compelling content tailored to your experience and target role.
            </p>

            <div class="space-y-3 mb-8">
                <div class="flex items-center gap-3 text-white/90">
                    <svg class="w-5 h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-sm md:text-base">AI-powered content generation</span>
                </div>
                <div class="flex items-center gap-3 text-white/90">
                    <svg class="w-5 h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-sm md:text-base">ATS-optimized formatting</span>
                </div>
                <div class="flex items-center gap-3 text-white/90">
                    <svg class="w-5 h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-sm md:text-base">Using professional templates</span>
                </div>
                <div class="flex items-center gap-3 text-white/90">
                    <svg class="w-5 h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-sm md:text-base">Download in PDF format</span>
                </div>
            </div>

            <a href="{{ route('ai-cv-generator') }}" wire:navigate class="block w-full bg-gradient-to-r bg-linear-to-r from-green-500 via-emerald-500 to-teal-500 hover:from-teal-700 hover:via-teal-700 hover:to-teal-800 text-white font-semibold text-center py-4 px-6 rounded-xl transition-all duration-300 hover:scale-105 hover:shadow-lg active:scale-95">
                Create CV
                <svg class="inline-block w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>

    </div>

    <div
        x-data="{ show: false }"
        x-init="setTimeout(() => show = true, 700)"
        x-show="show"
        x-transition:enter="transition ease-out duration-700"
        x-transition:enter-start="opacity-0 transform translate-y-8"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        class="max-w-4xl mx-auto mt-20 text-center"
    >
        <h3 class="text-2xl md:text-3xl font-bold text-white mb-8">Why Choose Our AI Tools?</h3>

        <div class="grid sm:grid-cols-3 gap-6">
            <div class="bg-white/10 hover:bg-white/20 backdrop-blur-lg border border-white/20 rounded-2xl p-6">
                <div class="w-12 h-12 bg-yellow-600/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="size-7 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h4 class="text-lg font-semibold text-white mb-2">Lightning Fast</h4>
                <p class="text-white/70 text-sm">Get results in seconds</p>
            </div>

            <div class="bg-white/10 hover:bg-white/20 backdrop-blur-lg border border-white/20 rounded-2xl p-6">
                <div class="w-12 h-12 bg-green-600/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="size-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h4 class="text-lg font-semibold text-white mb-2">100% Private</h4>
                <p class="text-white/70 text-sm">Your data is never stored or shared</p>
            </div>

            <div class="bg-white/10 hover:bg-white/20 backdrop-blur-lg border border-white/20 rounded-2xl p-6">
                <div class="w-12 h-12 bg-blue-600/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="size-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h4 class="text-lg font-semibold text-white mb-2">Totally Free</h4>
                <p class="text-white/70 text-sm">No hidden fees or subscriptions</p>
            </div>
        </div>
    </div>

</div>
