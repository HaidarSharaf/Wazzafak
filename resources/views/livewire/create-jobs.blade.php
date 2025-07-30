<div class="w-full">
        <div class="max-w-3xl mx-auto bg-white/10 backdrop-blur-xl border border-white/20 p-8 rounded-3xl shadow-xl">
            <h2 class="text-2xl font-bold mb-6 text-white">Create a New Job</h2>

            <form action="/job/store" method="POST" class="space-y-6">
                <!-- Stack -->
                <div>
                    <label class="block text-sm mb-1 text-indigo-200">Stack</label>
                    <select name="stack" class="w-full bg-white/10 border border-white/20 rounded-xl p-3 text-white focus:outline-none focus:ring-2 focus:ring-lime-500">
                        <option value="">Select Stack</option>
                        <option value="frontend">Frontend</option>
                        <option value="backend">Backend</option>
                        <option value="fullstack">Full Stack</option>
                    </select>
                </div>

                <!-- Location -->
                <div>
                    <label class="block text-sm mb-1 text-indigo-200">Location</label>
                    <select name="location" class="w-full bg-white/10 border border-white/20 rounded-xl p-3 text-white focus:outline-none focus:ring-2 focus:ring-lime-500">
                        <option value="">Select Location</option>
                        <option value="remote">Remote</option>
                        <option value="beirut">Beirut</option>
                        <option value="dubai">Dubai</option>
                        <option value="newyork">New York</option>
                    </select>
                </div>

                <!-- Salary -->
                <div>
                    <label class="block text-sm mb-1 text-indigo-200">Salary Range</label>
                    <select name="salary" class="w-full bg-white/10 border border-white/20 rounded-xl p-3 text-white focus:outline-none focus:ring-2 focus:ring-lime-500">
                        <option value="">Select Salary Range</option>
                        <option value="40-60k">$40k - $60k</option>
                        <option value="60-100k">$60k - $100k</option>
                        <option value="100-150k">$100k - $150k</option>
                        <option value="150k+">$150k+</option>
                    </select>
                </div>

                <!-- Technologies -->
                <div x-data="{ techs: [] }">
                    <label class="block text-sm mb-2 text-indigo-200">Technologies</label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        <template x-for="tech in ['React', 'Vue', 'Laravel', 'Tailwind', 'Node.js', 'TypeScript']" :key="tech">
                            <label
                                :class="techs.includes(tech) ? 'bg-lime-500 text-black' : 'bg-white/10 text-white'"
                                class="cursor-pointer rounded-xl p-3 border border-white/20 text-sm font-medium flex items-center justify-center hover:bg-white/20 transition"
                            >
                                <input type="checkbox" :value="tech" name="technologies[]" class="hidden"
                                       @change="techs.includes(tech) ? techs = techs.filter(t => t !== tech) : techs.push(tech)">
                                <span x-text="tech"></span>
                            </label>
                        </template>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm mb-1 text-indigo-200">Job Description</label>
                    <textarea name="description" rows="6" placeholder="Write job responsibilities and requirements..."
                              class="w-full bg-white/10 border border-white/20 rounded-xl p-3 text-white focus:outline-none focus:ring-2 focus:ring-lime-500 resize-none"></textarea>
                </div>

                <!-- Submit -->
                <div>
                    <button type="submit"
                            class="w-full bg-lime-500 hover:bg-lime-600 transition text-black font-semibold py-3 px-6 rounded-xl shadow-lg">
                        Create Job
                    </button>
                </div>
            </form>
        </div>

</div>
