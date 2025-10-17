<div
    class="w-full min-h-screen py-12"
    x-data="{ generating: @entangle('isGenerating') }"
>
    <div class="max-w-3xl mx-auto bg-white/10 backdrop-blur-xl border border-white/20 p-8 rounded-3xl shadow-xl">

        <div class="mb-8">
            <div class="flex items-center justify-center space-x-4">
                <div class="flex items-center">
                    <div
                        class="w-10 h-10 rounded-full {{ $currentStep >= 1 ? ($currentStep > 1 ? 'bg-green-500' : 'bg-[#1750b6]') : 'bg-white/20' }} flex items-center justify-center text-white font-semibold text-sm">
                        {{ $currentStep > 1 ? '✓' : '1' }}
                    </div>
                    <span
                        class="ml-2 {{ $currentStep >= 1 ? 'text-white' : 'text-white/60' }} font-medium">Job Details</span>
                </div>
                <div class="w-16 h-0.5 {{ $currentStep > 1 ? 'bg-green-500' : 'bg-white/30' }}"></div>
                <div class="flex items-center">
                    <div
                        class="w-10 h-10 rounded-full {{ $currentStep >= 2 ? ($currentStep > 2 ? 'bg-green-500' : 'bg-[#1750b6]') : 'bg-white/20' }} flex items-center justify-center text-white font-semibold text-sm">
                        {{ $currentStep > 2 ? '✓' : '2' }}
                    </div>
                    <span
                        class="ml-2 {{ $currentStep >= 2 ? 'text-white' : 'text-white/60' }} font-medium">Technologies</span>
                </div>
                <div class="w-16 h-0.5 {{ $currentStep > 2 ? 'bg-green-500' : 'bg-white/30' }}"></div>
                <div class="flex items-center">
                    <div
                        class="w-10 h-10 rounded-full {{ $currentStep >= 3 ? 'bg-[#1750b6]' : 'bg-white/20' }} flex items-center justify-center text-white font-semibold text-sm">
                        3
                    </div>
                    <span
                        class="ml-2 {{ $currentStep >= 3 ? 'text-white' : 'text-white/60' }} font-medium">Description</span>
                </div>
            </div>
        </div>

        <h2 class="md:text-3xl sm:text-2xl text-xl text-center font-bold mb-6 text-white">Create a New Job</h2>

        <form class="space-y-6" wire:submit.prevent="create">

            @if($currentStep == 1)
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
                        @foreach($levels as $key => $level)
                            <option
                                value="{{ $key}}"
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
                        @foreach($locations as $key => $location)
                            <option
                                value="{{ $key}}"
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

                <div class="flex justify-end">
                    <button
                        wire:click="nextStep"
                        wire:loading.class="opacity-50 pointer-events-none"
                        type="button"
                        class="bg-[#1750b6] hover:bg-lime-600 transition text-white md:text-base text-sm font-semibold cursor-pointer py-3 px-8 rounded-xl shadow-lg"
                    >
                        Next
                    </button>
                </div>

            @elseif($currentStep == 2)

                <label class="block text-sm md:text-base mb-3 text-white font-medium">Choose Technologies:</label>

                <div class="mb-4">
                    <div class="relative">
                        <input
                            wire:model.live.debounce.300ms="techSearch"
                            type="text"
                            placeholder="Search technologies..."
                            class="w-full bg-white border border-white/20 rounded-xl p-3 pl-10 text-gray-900 font-semibold focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>

                <div class="flex items-center justify-center flex-wrap gap-4 min-h-[150px] max-h-80 overflow-y-auto py-3">
                    @forelse($this->filteredTechs as $tech)
                        <div
                            wire:click="toggleTech({{ $tech->id }})"
                            class="rounded-xl py-2 px-5 border text-sm min-w-[25px]  font-semibold flex items-center justify-center transition cursor-pointer text-white relative overflow-hidden
                            {{ in_array($tech->id, $chosenTechs) ? 'ring-2 ring-white shadow-lg transform scale-105' : 'hover:shadow-md hover:transform hover:scale-102' }}"
                        >

                            @if(!in_array($tech->id, $chosenTechs))
                                <div class="absolute inset-0 bg-white/20 bg-opacity-30"></div>
                            @endif

                            <div class="relative z-10 flex items-center">
                                @if($tech->icon)
                                    <img src="{{ asset('storage/technologies_icons/' . $tech->icon) }}"
                                         alt="{{ $tech->name }}" class="min-w-5 min-h-5 max-w-6 max-h-6 mr-2">
                                @endif

                                <span class="w-full">{{ $tech->name }}</span>

                                @if(in_array($tech->id, $chosenTechs))
                                    <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-white/60 text-center py-8">
                            No technologies found matching "{{ $techSearch }}"
                        </div>
                    @endforelse
                </div>
                @error('form.technologies') <span class="text-xs text-red-600"> {{ $message }}</span> @enderror

                <div class="flex justify-between mt-4">
                    <button
                        wire:click="prevStep"
                        wire:loading.class="opacity-50 pointer-events-none"
                        type="button"
                        class="bg-white/20 hover:bg-white/30 transition text-white md:text-base text-sm font-semibold cursor-pointer py-3 px-8 rounded-xl"
                    >
                        Back
                    </button>
                    <button
                        wire:click="nextStep"
                        wire:loading.class="opacity-50 pointer-events-none"
                        type="button"
                        class="bg-[#1750b6] hover:bg-lime-600 transition text-white md:text-base text-sm font-semibold cursor-pointer py-3 px-8 rounded-xl shadow-lg"
                    >
                        Next
                    </button>
                </div>

            @elseif($currentStep == 3)
                <div class="!mb-4">
                    <label class="block text-sm md:text-base mb-1 text-white font-medium">Job Description:</label>
                    <textarea
                        wire:model.defer="form.description"
                        wire:key="description-{{ $descriptionGenerated ? 'generated' : 'manual' }}"
                        rows="10"
                        placeholder="Write job responsibilities and requirements..."
                        :class="generating ? 'opacity-50 cursor-not-allowed' : ''"
                        :disabled="generating"
                        class="w-full bg-white border placeholder-gray-900 border-white/20 rounded-xl p-3 font-semibold text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none {{ $isGenerating ? 'opacity-50' : '' }}"
                    ></textarea>
                    @error('form.description') <span class="text-xs text-red-600"> {{ $message }}</span> @enderror
                </div>

                <div class="mb-4 flex justify-end">
                    @if(!$descriptionGenerated)
                        <button
                            type="button"
                            x-data="{ generating: false }"
                            x-on:click="
                                generating = true;
                                $wire.generateDescription().then(() => {
                                    generating = false;
                                }).catch(() => {
                                    generating = false;
                                });
                            "
                            :disabled="generating"
                            :class="generating ? 'opacity-50 cursor-not-allowed' : 'hover:bg-lime-600'"
                            class="bg-[#1750b6] transition text-white md:text-base text-sm font-semibold cursor-pointer py-3 px-8 rounded-xl shadow-lg disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            <div x-show="generating"
                                 class="animate-spin inline-block size-5 border-3 mt-1 border-current border-t-transparent text-white rounded-full"
                                 role="status" aria-label="loading">
                                <span class="sr-only">Loading...</span>
                            </div>

                            <span x-show="!generating" class="flex gap-2 items-center">
                                <svg class="size-7" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M7.45284 2.71266C7.8276 1.76244 9.1724 1.76245 9.54716 2.71267L10.7085 5.65732C10.8229 5.94743 11.0526 6.17707 11.3427 6.29148L14.2873 7.45284C15.2376 7.8276 15.2376 9.1724 14.2873 9.54716L11.3427 10.7085C11.0526 10.8229 10.8229 11.0526 10.7085 11.3427L9.54716 14.2873C9.1724 15.2376 7.8276 15.2376 7.45284 14.2873L6.29148 11.3427C6.17707 11.0526 5.94743 10.8229 5.65732 10.7085L2.71266 9.54716C1.76244 9.1724 1.76245 7.8276 2.71267 7.45284L5.65732 6.29148C5.94743 6.17707 6.17707 5.94743 6.29148 5.65732L7.45284 2.71266Z"
                                            fill="#e2d20a"></path>
                                        <path
                                            d="M16.9245 13.3916C17.1305 12.8695 17.8695 12.8695 18.0755 13.3916L18.9761 15.6753C19.039 15.8348 19.1652 15.961 19.3247 16.0239L21.6084 16.9245C22.1305 17.1305 22.1305 17.8695 21.6084 18.0755L19.3247 18.9761C19.1652 19.039 19.039 19.1652 18.9761 19.3247L18.0755 21.6084C17.8695 22.1305 17.1305 22.1305 16.9245 21.6084L16.0239 19.3247C15.961 19.1652 15.8348 19.039 15.6753 18.9761L13.3916 18.0755C12.8695 17.8695 12.8695 17.1305 13.3916 16.9245L15.6753 16.0239C15.8348 15.961 15.961 15.8348 16.0239 15.6753L16.9245 13.3916Z"
                                            fill="#e2d20a"></path>
                                    </g>
                                </svg>
                                Generate with AI
                            </span>
                        </button>
                    @endif
                </div>

                <span
                    class="text-base font-bold text-red-500"
                >
                    The job will be reviewed by an admin to confirm that it aligns with the jobs posts policy.
                    Our team will notify you once it's reviewed.
                </span>

                <div class="flex justify-between mt-4">
                    <button
                        wire:click="prevStep"
                        wire:loading.class="opacity-50 pointer-events-none"
                        type="button"
                        class="bg-white/20 hover:bg-white/30 transition text-white md:text-base text-sm font-semibold cursor-pointer py-3 px-6 rounded-xl"
                    >
                        Back
                    </button>

                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        wire:target="create"
                        class="bg-[#1750b6] hover:bg-lime-600 transition text-white md:text-base text-sm font-semibold cursor-pointer py-3 px-6 rounded-xl shadow-lg disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:bg-[#1750b6] disabled:hover:text-white disabled:shadow-none disabled:transition-none"
                    >
                        Create Job
                    </button>
                </div>

            @endif
        </form>
    </div>

</div>
