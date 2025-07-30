<div class="w-full">
    <div class="max-w-3xl mx-auto bg-white/10 backdrop-blur-xl border border-white/20 p-8 rounded-3xl shadow-xl">
        <h2 class="md:text-3xl sm:text-2xl text-xl text-center font-bold mb-6 text-white">Create a New Job</h2>

        <form class="space-y-6" wire:submit.prevent="create">

            <div>
                <label class="block text-sm md:text-base mb-1 text-white">Stack:</label>
                <select
                    class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <option value="">Select Stack</option>
                    <option value="frontend">Frontend</option>
                </select>
            </div>


            <div>
                <label class="block text-sm md:text-base mb-1 text-white">Location:</label>
                <select
                    class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <option value="">Select Location</option>
                    <option value="remote">Remote</option>
                    <option value="beirut">Beirut</option>
                    <option value="dubai">Dubai</option>
                    <option value="newyork">New York</option>
                </select>
            </div>


            <div>
                <label class="block text-sm md:text-base mb-1 text-white">Salary Range:</label>
                <select
                    class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <option value="">Select Salary Range</option>
                    <option value="40-60k">$40k - $60k</option>
                    <option value="60-100k">$60k - $100k</option>
                    <option value="100-150k">$100k - $150k</option>
                    <option value="150k+">$150k+</option>
                </select>
            </div>


            <div x-data="{ techs: [] }">
                <label class="block text-sm md:text-base mb-2 text-white">Technologies:</label>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    <template x-for="tech in ['React', 'Vue', 'Laravel', 'Tailwind', 'Node.js', 'TypeScript']"
                              :key="tech">
                        <label
                            :class="techs.includes(tech) ? 'bg-[#1750b6]/60 text-white' : 'bg-white text-gray-900'"
                            class="rounded-xl p-3 border border-white/20 text-sm font-semibold flex items-center justify-center transition cursor-pointer"
                        >
                            <input type="checkbox" :value="tech" name="technologies[]" class="hidden"
                                   @change="techs.includes(tech) ? techs = techs.filter(t => t !== tech) : techs.push(tech)">
                            <span x-text="tech"></span>
                        </label>
                    </template>
                </div>
            </div>


            <div>
                <label class="block text-sm md:text-base mb-1 text-white">Job Description:</label>
                <textarea
                    rows="6"
                    placeholder="Write job responsibilities and requirements..."
                    class="w-full bg-white border placeholder-gray-900 border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
                ></textarea>
            </div>

            <span class="text-sm font-bold">*Note: The job will be automatically disclosed after 15 days if no applications were submitted.</span>


            <div>
                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    wire:target="create"
                    class="w-full bg-[#1750b6] hover:bg-lime-600 transition text-white md:text-base text-sm font-semibold cursor-pointer py-3 px-6 rounded-xl shadow-lg !mt-3 disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    Create Job
                </button>
            </div>
        </form>
    </div>

</div>
