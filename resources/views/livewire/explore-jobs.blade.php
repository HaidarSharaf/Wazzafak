<div
    x-data="{ showFilters: false, search: '', selectedLocation: '', selectedType: '', selectedExperience: '', selectedSalary: '', selectedTech: '' }" x-cloak
    class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16"
>
    <div class="bg-white/10 backdrop-blur-xl rounded-3xl p-6 mb-8 border border-white/20 shadow-2xl">

        <div class="flex flex-col md:flex-row gap-4 my-6">
            <div class="flex-1 relative">
                <input
                    type="text"
                    placeholder="Search jobs..."
                    class="w-full px-6 py-4 md:text-lg text-base bg-white/90 backdrop-blur-sm rounded-2xl border-0 focus:bg-white focus:ring-4 focus:ring-blue-500/30 transition-all duration-300 shadow-lg placeholder-gray-500"
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
             class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 p-6 bg-white/5 rounded-2xl backdrop-blur-sm">

            <div>
                <label class="block text-white font-medium mb-2">Location</label>
                <select
                    class="w-full px-4 py-3 font-semibold text-gray-900 bg-white/90 rounded-xl border-0 focus:bg-white focus:ring-4 focus:ring-blue-500/30 transition-all"
                >
                    <option value="" selected>All Locations</option>
                    <option value="Remote">Remote</option>
                    <option value="Hybrid">Hybrid</option>
                    <option value="OnSite">OnSite</option>
                </select>
            </div>

            <div>
                <label class="block text-white font-medium mb-2">Job Stack</label>
                <select
                    class="w-full px-4 py-3 font-semibold text-gray-900 bg-white/90 rounded-xl border-0 focus:bg-white focus:ring-4 focus:ring-blue-500/30 transition-all"
                >
                    <option value="" selected>All Types</option>
                    <option value="Backend">Backend</option>
                    <option value="Frontend">Frontend</option>
                    <option value="Fullstack">Fullstack</option>
                </select>
            </div>

            <div>
                <label class="block text-white font-medium mb-2">Experience</label>
                <select
                    class="w-full px-4 py-3 font-semibold text-gray-900 bg-white/90 rounded-xl border-0 focus:bg-white focus:ring-4 focus:ring-blue-500/30 transition-all"
                >
                    <option value="" selected>All Levels</option>
                    <option value="entry">Entry Level</option>
                    <option value="mid">Mid Level</option>
                    <option value="senior">Senior Level</option>
                    <option value="lead">Lead</option>
                    <option value="principal">Principal</option>
                </select>
            </div>

            <div>
                <label class="block text-white font-medium mb-2">Salary Range</label>
                <select
                    class="w-full px-4 py-3 font-semibold text-gray-900 bg-white/90 rounded-xl border-0 focus:bg-white focus:ring-4 focus:ring-blue-500/30 transition-all"
                >
                    <option value="" selected>Any Salary</option>
                    <option value="600-800">$600 - $800</option>
                    <option value="800-1200">$800 - $1200</option>
                    <option value="1200-2000">$1200 - $2000</option>
                    <option value="2000+">$2000+</option>
                </select>
            </div>

            <div>
                <label class="block text-white font-medium mb-2">Technology</label>
                <select
                    class="w-full px-4 py-3 font-semibold text-gray-900 bg-white/90 rounded-xl border-0 focus:bg-white focus:ring-4 focus:ring-blue-500/30 transition-all"
                >
                    <option value="" selected>All Tech</option>
                    <option value="javascript">JavaScript</option>
                    <option value="python">Python</option>
                    <option value="react">React</option>
                    <option value="vue">Vue.js</option>
                    <option value="laravel">Laravel</option>
                    <option value="node">Node.js</option>
                    <option value="php">PHP</option>
                    <option value="java">Java</option>
                </select>
            </div>

            <div class="flex items-end">
                <button
                    class="w-full px-4 py-3 bg-red-500 hover:bg-red-500/80 text-white font-medium rounded-xl transition-all duration-300 cursor-pointer"
                >
                    Clear All
                </button>
            </div>
        </div>
    </div>


    <div class="flex flex-col md:flex-row justify-between items-center mb-8 bg-white/10 backdrop-blur-xl rounded-2xl p-6 border border-white/20">
        <div class="text-white mb-4 md:mb-0">
            <h2 class="text-2xl font-bold">247 Jobs Found</h2>
            <p class="text-indigo-200">Find your perfect match</p>
        </div>

        <div class="flex items-center gap-4 w-auto">
            <label class="text-white font-medium">Sort:</label>
            <select
                class="w-full px-4 py-3 font-semibold text-gray-900 bg-white/90 rounded-xl border-0 focus:bg-white focus:ring-4 focus:ring-blue-500/30 transition-all"
            >
                <option value="latest">Latest</option>
                <option value="salary_high">Salary: High to Low</option>
                <option value="salary_low">Salary: Low to High</option>
                <option value="company">Company A-Z</option>
            </select>
        </div>
    </div>


    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">

        @for($i = 0; $i < 5; $i++)
            <livewire:job-card />
        @endfor
    </div>
</div>
