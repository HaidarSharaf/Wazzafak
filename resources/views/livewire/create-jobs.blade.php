<div class="w-full">
    <div class="max-w-3xl mx-auto bg-white/10 backdrop-blur-xl border border-white/20 p-8 rounded-3xl shadow-xl">
        <h2 class="md:text-3xl sm:text-2xl text-xl text-center font-bold mb-6 text-white">Create a New Job</h2>

        <form class="space-y-6" wire:submit.prevent="create">

            <div>
                <label class="block text-sm md:text-base mb-1 text-white font-medium">Stack:</label>
                <select
                    wire:model="form.stack"
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
                @error('form.stack') <span class="text-xs text-red-600"> {{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-white font-medium mb-2">Experience Level:</label>
                <select
                    wire:model="form.experience"
                    class="w-full px-4 py-3 font-semibold text-gray-900 bg-white/90 rounded-xl border-0 focus:bg-white focus:ring-4 focus:ring-blue-500/30 transition-all"
                >
                    <option value="" selected>Select Level</option>
                    @foreach($levels as $level)
                        <option
                            value="{{ $level}}"
                        >
                            {{ $level}}
                        </option>
                    @endforeach
                </select>
                @error('form.experience') <span class="text-xs text-red-600"> {{ $message }}</span> @enderror
            </div>


            <div>
                <label class="block text-sm md:text-base mb-1 text-white font-medium">Location:</label>
                <select
                    wire:model="form.location"
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
                @error('form.location') <span class="text-xs text-red-600"> {{ $message }}</span> @enderror
            </div>


            <div>
                <label class="block text-sm md:text-base mb-1 text-white font-medium">Salary/M($):</label>
                <input
                    wire:model="form.salary"
                    type="number"
                    min="400"
                    class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 font-semibold focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
                @error('form.salary') <span class="text-xs text-red-600"> {{ $message }}</span> @enderror
            </div>


            <label class="block text-sm md:text-base mb-3 text-white font-medium">Choose Technologies:</label>
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
            @error('form.technologies') <span class="text-xs text-red-600"> {{ $message }}</span> @enderror

            <div class="!mb-4">
                <label class="block text-sm md:text-base mb-1 text-white font-medium">Job Description:</label>
                <textarea
                    wire:model="form.description"
                    rows="6"
                    placeholder="Write job responsibilities and requirements..."
                    class="w-full bg-white border placeholder-gray-900 border-white/20 rounded-xl p-3 font-semibold text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
                ></textarea>
                @error('form.description') <span class="text-xs text-red-600"> {{ $message }}</span> @enderror
            </div>

            <span
                class="text-base font-bold text-red-600"
            >
                *Note: The job will be reviewed by an admin to confirm that it aligns with the jobs posts policy.
                Our team will notify you once it's reviewed.
            </span>

            <div>
                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    wire:target="create"
                    class="w-full bg-[#1750b6] hover:bg-lime-600 transition text-white md:text-base text-sm font-semibold cursor-pointer py-3 px-6 rounded-xl shadow-lg !mt-7 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:bg-[#1750b6] disabled:hover:text-white disabled:shadow-none disabled:transition-none"
                >
                    Create Job
                </button>
            </div>
        </form>
    </div>

</div>
