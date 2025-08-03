<div class="w-full">
    <section class="p-10">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                @guest
                    <h2 class="sm:text-4xl text-3xl font-bold mb-4">Join Thousands of Success Stories</h2>
                @endguest
                <p class="sm:text-3xl text-2xl font-semibold text-white/80">Real-time platform statistics</p>
            </div>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="text-center md:p-8 p-6 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20 hover:bg-white/20 transition-all duration-300">
                    <div class="sm:text-4xl text-2xl font-bold text-lime-300 mb-2">{{ $devs_count }}</div>
                    <div class="md:text-3xl sm:text-xl text-sm text-white/80 font-medium">Active Developers</div>
                </div>
                <div class="text-center md:p-8 p-6 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20 hover:bg-white/20 transition-all duration-300">
                    <div class="sm:text-4xl text-2xl font-bold text-lime-300 mb-2">{{ $recruiters_count }}</div>
                    <div class="md:text-3xl sm:text-xl text-sm text-white/80 font-medium">Recruiters</div>
                </div>
                <div class="text-center md:p-8 p-6 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20 hover:bg-white/20 transition-all duration-300">
                    <div class="sm:text-4xl text-2xl font-bold text-lime-300 mb-2">{{ $jobs_count }}</div>
                    <div class="md:text-3xl sm:text-xl text-sm text-white/80 font-medium">Open Positions</div>
                </div>
                <div class="text-center md:p-8 p-6 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20 hover:bg-white/20 transition-all duration-300">
                    <div class="sm:text-4xl text-2xl font-bold text-lime-300 mb-2">{{ $accepted_apps_count }}</div>
                    <div class="md:text-3xl sm:text-xl text-sm text-white/80 font-medium">Successful Matches</div>
                </div>
            </div>
        </div>
    </section>
</div>
