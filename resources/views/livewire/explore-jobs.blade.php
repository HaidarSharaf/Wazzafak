<div
    x-data="{ showFilters: false }" x-cloak
    class="w-full mx-auto px-4 sm:px-6 lg:px-8 pb-16"
>
    <div class="bg-white/10 backdrop-blur-xl rounded-3xl p-6 mb-8 border border-white/20 shadow-2xl">

        <div class="flex flex-col md:flex-row gap-4 my-6">
            <div class="flex-1 relative">
                <input
                    wire:model.live="text"
                    type="text"
                    placeholder="Search jobs..."
                    class="w-full px-6 py-4 md:text-lg text-base text-gray-900 bg-white/90 backdrop-blur-sm rounded-2xl border-0 focus:bg-white focus:ring-4 focus:ring-blue-500/30 transition-all duration-300 shadow-lg placeholder-gray-500"
                >
                <div class="absolute right-4 md:top-4 top-5">
                    <svg class="md:w-6 md:h-6 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <button
                @click="showFilters = !showFilters"
                :class="
                    showFilters ? 'bg-lime-600' : 'bg-[#19468f]'
                "
                class="px-8 py-4 text-white font-semibold rounded-2xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 cursor-pointer"
            >
                Filters
            </button>
        </div>

        <div x-show="showFilters"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform -translate-y-4"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-4"
             class="bg-white/5 rounded-2xl backdrop-blur-sm p-6"
        >
            <div
                 class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4"
            >

                <div>
                    <label class="block text-white font-medium mb-2">Location</label>
                    <select
                        wire:model.live="location"
                        class="w-full px-4 py-3 font-semibold text-gray-900 bg-white/90 rounded-xl border-0 focus:bg-white focus:ring-4 focus:ring-blue-500/30 transition-all"
                    >
                        <option value="">All Locations</option>
                        @foreach($locations as $key => $location)
                            <option
                                value="{{ $key }}"
                            >
                                {{ $location }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-white font-medium mb-2">Job Stack</label>
                    <select
                        wire:model.live="stack"
                        class="w-full px-4 py-3 font-semibold text-gray-900 bg-white/90 rounded-xl border-0 focus:bg-white focus:ring-4 focus:ring-blue-500/30 transition-all"
                    >
                        <option value="">All Stacks</option>
                        @foreach($stacks as $stack)
                            <option
                                value="{{ $stack->id }}"
                                wire:key="{{ $stack->id }}"
                            >
                                {{ $stack->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-white font-medium mb-2">Experience</label>
                    <select
                        wire:model.live="experience"
                        class="w-full px-4 py-3 font-semibold text-gray-900 bg-white/90 rounded-xl border-0 focus:bg-white focus:ring-4 focus:ring-blue-500/30 transition-all"
                    >
                        <option value="" selected>All Levels</option>
                        @foreach($levels as $key => $level)
                            <option
                                value="{{ $key }}"
                            >
                                {{ $level}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-end">
                    <button
                        wire:click="clearFilters"
                        class="w-full px-4 py-3 bg-red-500 hover:bg-red-500/80 text-white font-medium rounded-xl transition-all duration-300 cursor-pointer"
                    >
                        Clear All
                    </button>
                </div>

            </div>

            <div class="mt-4">
                <label class="block text-white font-medium mb-2">Technologies</label>
                <div class="flex w-full items-center justify-center flex-wrap gap-4 h-44 overflow-y-scroll py-3">
                    @foreach($techs as $tech)
                        <div
                            wire:click="toggleTech({{ $tech->id }})"
                            style="backgroud-color: {{ $tech->color }} !important;"
                            class="rounded-xl py-2 px-5 border text-sm min-w-[25px]  font-semibold flex items-center justify-center transition cursor-pointer text-white relative overflow-hidden
                            {{ in_array($tech->id, $chosenTechs) ? 'ring-2 ring-white shadow-lg transform scale-105' : 'hover:shadow-md hover:transform hover:scale-102' }}"
                        >

                            @if(!in_array($tech->id, $chosenTechs))
                                <div class="absolute inset-0 bg-white/20 bg-opacity-30"></div>
                            @endif

                            <div class="relative z-10 flex items-center">
                                @if($tech->icon)
                                    <img src="{{ asset('storage/technologies_icons/' . $tech->icon) }}" alt="{{ $tech->name }}" class="min-w-5 min-h-5 max-w-6 max-h-6 mr-2">
                                @endif

                                <span>{{ $tech->name }}</span>

                                @if(in_array($tech->id, $chosenTechs))
                                    <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    <div class="flex flex-col md:flex-row justify-between items-center mb-8 bg-white/10 backdrop-blur-xl rounded-2xl p-6 border border-white/20">
        <div class="text-white mb-4 md:mb-0">
            <h2 class="text-2xl font-bold"> {{ $job_listings_count }} {{ Str::plural('Job', $job_listings_count) }} Found</h2>
            <p class="text-indigo-200">Find your perfect match</p>
        </div>

        <div class="flex items-center gap-4 w-auto">
            <label class="text-white font-medium">Sort:</label>
            <select
                wire:model.live="sortBy"
                class="w-full px-4 py-3 font-semibold text-gray-900 bg-white/90 rounded-xl border-0 focus:bg-white focus:ring-4 focus:ring-blue-500/30 transition-all"
            >
                <option value="latest">Latest</option>
                <option value="salary_high_to_low">Salary: High to Low</option>
                <option value="salary_low_to_high">Salary: Low to High</option>
            </select>
        </div>
    </div>

    <div class="my-4">
        {{ $job_listings->links() }}
    </div>

    <div
        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12"
        wire:loading.class="opacity-50 pointer-events-none"
    >

        @foreach($job_listings as $job_listing)
            <div class="w-full"
                 wire:key="{{ $job_listing->id }}"
            >
                <div class="group bg-white/10 backdrop-blur-xl rounded-3xl p-6 border border-white/20 hover:bg-white/20 transition-all duration-500 hover:transform hover:-translate-y-2 hover:shadow-2xl">

                    <a
                        href="{{ route('job-listing', $job_listing->id) }}"
                        wire:navigate
                        class="flex xl:justify-between justify-start items-start mb-4 gap-2"
                    >
                        <img
                            src="{{ asset('storage/users_avatars/' . $job_listing->getCompanyLogoAttribute()) }}"
                            class="lg:w-14 lg:h-14 md:w-12 md:h-12 sm:w-10 sm:h-10 w-8 h-8 rounded-2xl flex items-center justify-center font-bold text-2xl shadow-lg"
                        />
                        <div>
                            <h3 class="xl:text-xl md:text-lg text-base font-bold text-white mb-1 group-hover:text-lime-500 transition-colors">{{ $job_listing->experience }}: {{ $job_listing->getStackNameAttribute() }}</h3>
                            <p class="text-gray-300 xl:text-base text-sm font-medium">{{ $job_listing->getCompanyNameAttribute() }}</p>
                        </div>

                    </a>

                    <div class="mb-4 mt-2 flex flex-row lg:flex-col xl:flex-row items-center justify-between gap-2">
                        <div class="flex items-center gap-2 text-gray-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="sm:text-sm text-xs text-gray-300">{{ $job_listing->location }}</span>
                        </div>
                        <span class="text-white sm:text-base text-sm font-semibold">${{ $job_listing->salary }}</span>
                    </div>

                    <div class="space-y-3 my-6">

                        <a
                            href="{{ route('job-listing', $job_listing->id) }}"
                            wire:navigate
                            class="text-indigo-200 sm:text-base text-sm line-clamp-3"
                        >
                            {{ Str::limit($job_listing->description, 250) }}
                        </a>

                        <div class="flex flex-wrap gap-2 max-h-[30px] overflow-hidden">
                            @foreach($job_listing->technologies->take(3) as $technology)
                                <div class="relative z-10 flex items-center bg-white/20 px-2 py-1 rounded-xl mb-2 transition-all duration-200 w-fit">
                                    @if($technology->icon)
                                        <img src="{{ asset('storage/technologies_icons/' . $technology->icon) }}" alt="{{ $technology->name }}" class="min-w-3 min-h-3 max-w-4 max-h-4 mr-2">
                                    @endif

                                    <span class="text-xs">{{ $technology->name }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>


                    <div class="flex gap-3">
                        <a
                            wire:navigate
                            href="{{ route('job-listing', $job_listing->id) }}"
                            class="flex-1 md:text-base text-sm text-center p-3 bg-[#19468f] text-white font-semibold rounded-xl hover:bg-lime-600 cursor-pointer transition-all duration-300 shadow-lg hover:shadow-xl"
                        >
                            View Details
                        </a>
                    </div>

                    <div class="mt-4 pt-4 border-t border-white/20">
                        <span class="text-gray-300 text-xs">
                            {{ $job_listing->getPostedTimeAttribute() }}
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="my-4">
        {{ $job_listings->links() }}
    </div>

    <div
        wire:loading
        class="w-full flex justify-center text-white py-10"
    >
        <div class="w-12 h-12 border-4 border-blue-900 border-t-transparent rounded-full animate-spin mx-auto"></div>
    </div>
</div>
