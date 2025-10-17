<div class="w-full min-h-screen py-12">
    <div class="max-w-4xl mx-auto bg-white/10 backdrop-blur-xl border border-white/20 p-8 rounded-3xl shadow-xl">

        <h2 class="md:text-3xl sm:text-2xl text-xl text-center font-bold mb-6 text-white">Update Your Profile</h2>

        <form class="space-y-8" wire:submit.prevent="save">

            <div class="bg-white/5 p-6 rounded-2xl border border-white/10">
                <h3 class="text-xl font-bold text-white mb-4">Select Your Stacks</h3>

                <div class="mb-4">
                    <div class="relative">
                        <input
                            wire:model.live.debounce.300ms="stackSearch"
                            type="text"
                            placeholder="Search stacks..."
                            class="w-full bg-white border border-white/20 rounded-xl p-3 pl-10 text-gray-900 font-semibold focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>

                <div
                    class="flex items-center justify-center flex-wrap gap-4 min-h-[200px] max-h-80 overflow-y-auto py-3">
                    @forelse($this->filteredStacks as $stack)
                        <div
                            wire:click="toggleStack({{ $stack->id }})"
                            class="rounded-xl py-2 px-5 border text-sm min-w-[25px] font-semibold flex items-center justify-center transition cursor-pointer text-white relative overflow-hidden bg-white/10
                            {{ in_array($stack->id, $selectedStacks) ? 'ring-2 ring-white shadow-lg transform scale-105' : 'hover:shadow-md hover:transform hover:scale-102' }}"
                        >
                            @if(!in_array($stack->id, $selectedStacks))
                                <div class="absolute inset-0 bg-white/20 bg-opacity-30"></div>
                            @endif

                            <span class="w-full text-center">{{ $stack->name }}</span>

                            @if(in_array($stack->id, $selectedStacks))
                                <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                          clip-rule="evenodd"></path>
                                </svg>
                            @endif
                        </div>
                    @empty
                        <div class="text-white/60 text-center py-8">
                            No stacks found matching "{{ $stackSearch }}"
                        </div>
                    @endforelse
                </div>
                <input type="hidden" wire:model="selectedStacks">
                @error('selectedStacks') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="bg-white/5 p-6 rounded-2xl border border-white/10">
                <h3 class="text-xl font-bold text-white mb-4">Choose Your Technologies</h3>

                <div class="mb-4">
                    <div class="relative">
                        <input
                            wire:model.live.debounce.300ms="techSearch"
                            type="text"
                            placeholder="Search technologies..."
                            class="w-full bg-white border border-white/20 rounded-xl p-3 pl-10 text-gray-900 font-semibold focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>

                <div
                    class="flex items-center justify-center flex-wrap gap-4 min-h-[200px] max-h-80 overflow-y-auto py-3">
                    @forelse($this->filteredTechs as $tech)
                        <div
                            wire:click="toggleTech({{ $tech->id }})"
                            style="background-color: {{ $tech->color }} !important;"
                            class="rounded-xl py-2 px-5 border text-sm min-w-[25px] font-semibold flex items-center justify-center transition cursor-pointer text-white relative overflow-hidden
                            {{ in_array($tech->id, $selectedTechs) ? 'ring-2 ring-white shadow-lg transform scale-105' : 'hover:shadow-md hover:transform hover:scale-102' }}"
                        >
                            @if(!in_array($tech->id, $selectedTechs))
                                <div class="absolute inset-0 bg-white/20 bg-opacity-30"></div>
                            @endif

                            <div class="relative z-10 flex items-center">
                                @if($tech->icon)
                                    <img src="{{ asset('storage/technologies_icons/' . $tech->icon) }}"
                                         alt="{{ $tech->name }}" class="min-w-5 min-h-5 max-w-6 max-h-6 mr-2">
                                @endif

                                <span class="w-full">{{ $tech->name }}</span>

                                @if(in_array($tech->id, $selectedTechs))
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
                <input type="hidden" wire:model="selectedTechs">
                @error('selectedTechs') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="bg-white/5 p-6 rounded-2xl border border-white/10">
                <h3 class="text-xl font-bold text-white mb-4">Upload Your CV</h3>

                @if($existingCv)
                    <div
                        class="bg-white/10 border border-white/20 rounded-xl p-4 flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <div>
                                <p class="text-white font-semibold">Current CV</p>
                                <p class="text-white/60 text-sm">{{ basename($existingCv) }}</p>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ asset('storage/dev_cvs/' . $existingCv) }}"
                               target="_blank"
                               class="bg-[#1750b6] hover:bg-lime-600 transition text-white text-sm font-semibold py-2 px-4 rounded-lg">
                                View
                            </a>
                        </div>
                    </div>
                @endif

                <div class="relative">
                    <input
                        wire:model="cv"
                        type="file"
                        accept=".pdf,.doc,.docx"
                        class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    <p class="text-white/60 text-xs mt-1">PDF, DOC, DOCX (Max 5MB)</p>
                </div>

                @error('cv') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror

                <div wire:loading wire:target="cv" class="text-white text-sm mt-2">
                    Uploading...
                </div>
            </div>

            <div class="flex justify-end">
                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    wire:target="save"
                    class="bg-[#1750b6] hover:bg-lime-600 transition text-white md:text-base text-sm font-semibold cursor-pointer py-3 px-8 rounded-xl shadow-lg disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    <span wire:loading.remove wire:target="save">Save Profile</span>
                    <div
                        wire:loading
                        wire:target="save"
                        class="animate-spin inline-block size-5 border-3 mt-1 border-current border-t-transparent text-white rounded-full"
                        role="status" aria-label="loading"
                    >
                        <span class="sr-only">Loading...</span>
                    </div>
                </button>
            </div>

        </form>
    </div>
</div>
