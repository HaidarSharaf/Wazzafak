<div
    x-data="{ showFilters: false, search: '', selectedLocation: '', selectedType: '', selectedExperience: '', selectedSalary: '', selectedTech: '' }" x-cloak
    class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16"
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
                        @foreach($locations as $location)
                            <option
                                value="{{ $location}}"
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
                        @foreach($levels as $level)
                            <option
                                value="{{ $level}}"
                            >
                                {{ $level}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-end">
                    <button
                        wire:click="clearFilters; showFilters = false"
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


    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">

        @foreach($job_listings as $job_listing)
            <livewire:job-card :job_listing="$job_listing"/>
        @endforeach
    </div>
</div>
