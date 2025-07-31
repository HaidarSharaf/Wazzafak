<div class="w-full">
    <div class="max-w-3xl mx-auto bg-white/10 backdrop-blur-xl border border-white/20 p-8 rounded-3xl shadow-xl">
        <h2 class="md:text-3xl sm:text-2xl text-xl text-center font-bold mb-6 text-white">Create a New Job</h2>

        <form class="space-y-6" wire:submit.prevent="create">

            <div>
                <label class="block text-sm md:text-base mb-1 text-white">Stack:</label>
                <select
                    class="w-full font-semibold bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <option value="">Select Stack</option>
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
                <label class="block text-sm md:text-base mb-1 text-white">Location:</label>
                <select
                    class="w-full font-semibold bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <option value="">Select Location</option>
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
                <label class="block text-sm md:text-base mb-1 text-white">Salary Range($):</label>
                <input
                    wire:model="salary"
                    type="number"
                    min="400"
                    class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
            </div>


            <label class="block text-sm md:text-base mb-3 text-white">Choose Technologies:</label>
            <div class="flex items-center justify-center flex-wrap gap-4 h-44 overflow-y-scroll py-3">
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
