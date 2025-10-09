<div class="w-full min-h-screen py-12">
    <div class="max-w-5xl mx-auto px-4">
        <div class="bg-white/10 backdrop-blur-xl border border-white/20 p-8 rounded-3xl shadow-xl">

            <div class="mb-8">
                <div class="flex items-center justify-center space-x-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full {{ $currentStep >= 1 ? ($currentStep > 1 ? 'bg-green-500' : 'bg-[#1750b6]') : 'bg-white/20' }} flex items-center justify-center text-white font-semibold">
                            {{ $currentStep > 1 ? '✓' : '1' }}
                        </div>
                        <span class="ml-2 {{ $currentStep >= 1 ? 'text-white' : 'text-white/60' }} font-medium hidden sm:inline">Personal Info</span>
                    </div>
                    <div class="w-16 h-0.5 {{ $currentStep > 1 ? 'bg-green-500' : 'bg-white/30' }}"></div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full {{ $currentStep >= 2 ? ($currentStep > 2 ? 'bg-green-500' : 'bg-[#1750b6]') : 'bg-white/20' }} flex items-center justify-center text-white font-semibold">
                            {{ $currentStep > 2 ? '✓' : '2' }}
                        </div>
                        <span class="ml-2 {{ $currentStep >= 2 ? 'text-white' : 'text-white/60' }} font-medium hidden sm:inline">Skills</span>
                    </div>
                    <div class="w-16 h-0.5 {{ $currentStep > 2 ? 'bg-green-500' : 'bg-white/30' }}"></div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full {{ $currentStep >= 3 ? 'bg-[#1750b6]' : 'bg-white/20' }} flex items-center justify-center text-white font-semibold">3</div>
                        <span class="ml-2 {{ $currentStep >= 3 ? 'text-white' : 'text-white/60' }} font-medium hidden sm:inline">Experience</span>
                    </div>
                </div>
            </div>

            <h2 class="text-3xl text-center font-bold mb-8 text-white">AI CV Generator</h2>

            @if($currentStep == 1)
                <div
                    x-data
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-x-8"
                    x-transition:enter-end="opacity-100 transform translate-x-0"
                    class="space-y-6"
                >
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-white font-semibold mb-2">Full Name *</label>
                            <input wire:model="name" type="text" class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#1750b6]" placeholder="John Doe">
                            @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-white font-semibold mb-2">Email *</label>
                            <input wire:model="email" type="email" class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#1750b6]" placeholder="john@example.com">
                            @error('email') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-white font-semibold mb-2">Phone Number</label>
                            <input wire:model="phone" type="text" class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#1750b6]" placeholder="+961 70 123 456">
                        </div>

                        <div>
                            <label class="block text-white font-semibold mb-2">Location</label>
                            <input wire:model="location" type="text" class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#1750b6]" placeholder="Beirut, Lebanon">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-white font-semibold mb-2">LinkedIn URL</label>
                            <input wire:model="linkedin" type="text" class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#1750b6]" placeholder="linkedin.com/in/johndoe">
                        </div>

                        <div>
                            <label class="block text-white font-semibold mb-2">GitHub URL</label>
                            <input wire:model="github" type="text" class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#1750b6]" placeholder="github.com/johndoe">
                        </div>
                    </div>

                    <div class="flex justify-end mt-8">
                        <button wire:click="nextStep" type="button" class="cursor-pointer bg-[#1750b6] hover:bg-lime-600 transition-all text-white font-semibold py-3 px-8 rounded-xl shadow-lg">
                            Next
                        </button>
                    </div>
                </div>
            @endif

            @if($currentStep == 2)
                <div
                    x-data
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-x-8"
                    x-transition:enter-end="opacity-100 transform translate-x-0"
                    class="space-y-6"
                >
                    <div>
                        <label class="block text-white font-semibold mb-3">Stacks *</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                            @foreach($stacks as $stack)
                                <div
                                    wire:click="toggleStack({{ $stack->id }})"
                                    class="rounded-xl py-2 px-5 border text-sm min-w-[25px] font-semibold flex items-center justify-center transition cursor-pointer text-white relative overflow-hidden bg-white/10
                                    {{ in_array($stack->id, $chosenStacks) ? 'ring-2 ring-white shadow-lg transform scale-105' : 'hover:shadow-md hover:transform hover:scale-102' }}"
                                >
                                    @if(!in_array($stack->id, $chosenStacks))
                                        <div class="absolute inset-0 bg-white/20 bg-opacity-30"></div>
                                    @endif

                                    <div class="relative z-10 flex items-center">
                                        <span>{{ $stack->name }}</span>

                                        @if(in_array($stack->id, $chosenStacks))
                                            <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @error('chosenStacks') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-white font-semibold mb-3">Technologies *</label>
                        <div class="flex flex-wrap gap-3 max-h-66 overflow-y-auto p-4 rounded-xl">
                            @foreach($techs as $tech)
                                <div
                                    wire:click="toggleTech({{ $tech->id }})"
                                    class="rounded-xl py-3 px-5 border text-sm min-w-[25px]  font-semibold flex items-center justify-center transition cursor-pointer text-white relative overflow-hidden
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
                            @endforeach
                        </div>
                        @error('chosenTechs') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <div class="mb-2">
                            <label class="block text-white font-semibold">Languages</label>
                        </div>
                        @foreach($languages as $index => $language)
                            <div class="grid grid-cols-12 gap-3 mb-3">
                                <input wire:model="languages.{{ $index }}.name" type="text" placeholder="Language" class="col-span-5 bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#1750b6]">
                                <input wire:model="languages.{{ $index }}.level" type="text" placeholder="Level (e.g., Fluent)" class="col-span-5 bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#1750b6]">
                                @if(count($languages) > 1)
                                    <button wire:click="removeLanguage({{ $index }})" type="button" class="cursor-pointer col-span-2 bg-red-500 hover:bg-red-600 text-white rounded-xl font-semibold">Remove</button>
                                @endif
                            </div>
                        @endforeach
                        <div class="flex justify-end mb-3">
                            <button wire:click="addLanguage" type="button" class="cursor-pointer bg-lime-500 hover:bg-lime-600 py-3 px-4 rounded-xl text-white text-base font-semibold">+ Add Another Language</button>
                        </div>
                    </div>

                    <div class="flex justify-between mt-8">
                        <button wire:click="prevStep" type="button" class="cursor-pointer bg-white/20 hover:bg-white/30 transition text-white font-semibold py-3 px-8 rounded-xl">
                            Back
                        </button>
                        <button wire:click="nextStep" type="button" class="cursor-pointer bg-[#1750b6] hover:bg-lime-600 transition-all text-white font-semibold py-3 px-8 rounded-xl shadow-lg">
                            Next
                        </button>
                    </div>
                </div>
            @endif

            @if($currentStep == 3)
                <div
                    x-data
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-x-8"
                    x-transition:enter-end="opacity-100 transform translate-x-0"
                    class="space-y-8"
                >
                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-white">Work Experience</h3>
                            <button wire:click="addExperience" type="button" class="cursor-pointer bg-lime-500 hover:bg-lime-600 text-white font-semibold py-3 px-4 rounded-xl text-base">+ Add Experience</button>
                        </div>

                        @forelse($experiences as $index => $experience)
                            <div class="bg-white/5 rounded-xl p-5 mb-4 border border-white/10">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <input wire:model="experiences.{{ $index }}.title" type="text" placeholder="Job Title" class="bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#1750b6]">
                                    <input wire:model="experiences.{{ $index }}.company" type="text" placeholder="Company Name" class="bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#1750b6]">
                                </div>
                                <input wire:model="experiences.{{ $index }}.duration" type="text" placeholder="Duration (e.g., Jan 2020 - Present)" class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#1750b6] mb-4">
                                <textarea wire:model="experiences.{{ $index }}.description" placeholder="Job description and achievements..." rows="3" class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#1750b6] mb-3"></textarea>
                                <button wire:click="removeExperience({{ $index }})" type="button" class="cursor-pointer bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-xl text-sm">Remove</button>
                            </div>
                        @empty
                            <p class="text-white/60 text-center py-4">No experience added yet. Click "Add Experience" to start.</p>
                        @endforelse
                    </div>


                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-white">Education</h3>
                            <button wire:click="addEducation" type="button" class="cursor-pointer bg-lime-500 hover:bg-lime-600 text-white font-semibold py-3 px-4 rounded-xl text-base">+ Add Education</button>
                        </div>

                        @forelse($educations as $index => $education)
                            <div class="bg-white/5 rounded-xl p-5 mb-4 border border-white/10">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <input wire:model="educations.{{ $index }}.degree" type="text" placeholder="Degree (e.g., B.Sc. Computer Science)" class="bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#1750b6]">
                                    <input wire:model="educations.{{ $index }}.year" type="text" placeholder="Year (e.g., 2020 - Present)" class="bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#1750b6]">
                                </div>
                                <input wire:model="educations.{{ $index }}.institution" type="text" placeholder="Institution Name" class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#1750b6] mb-3">
                                <button wire:click="removeEducation({{ $index }})" type="button" class="cursor-pointer bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-3 rounded-xl text-sm">Remove</button>
                            </div>
                        @empty
                            <p class="text-white/60 text-center py-4">No education added yet. Click "Add Education" to start.</p>
                        @endforelse
                    </div>


                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-white">Certifications</h3>
                            <button wire:click="addCertification" type="button" class="cursor-pointer bg-lime-500 hover:bg-lime-600 text-white font-semibold py-3 px-4 rounded-xl text-base">+ Add Certification</button>
                        </div>

                        @forelse($certifications as $index => $certification)
                            <div class="bg-white/5 rounded-xl p-5 mb-4 border border-white/10">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <input wire:model="certifications.{{ $index }}.name" type="text" placeholder="Certification Name" class="bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#1750b6]">
                                    <input wire:model="certifications.{{ $index }}.issuer" type="text" placeholder="Issuing Organization" class="bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#1750b6]">
                                </div>
                                <textarea wire:model="certifications.{{ $index }}.description" placeholder="Brief description..." rows="2" class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#1750b6] mb-3"></textarea>
                                <button wire:click="removeCertification({{ $index }})" type="button" class="cursor-pointer bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-xl text-sm">Remove</button>
                            </div>
                        @empty
                            <p class="text-white/60 text-center py-4">No certifications added yet. Click "Add Certification" to start.</p>
                        @endforelse
                    </div>

                    <!-- AI Generation Section -->
                    @if(!$contentGenerated)
                        <div class="bg-gradient-to-r from-lime-500/20 to-green-500/20 border border-lime-400/30 rounded-2xl p-6">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0">
                                    <svg class="w-12 h-12 text-lime-400" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.45284 2.71266C7.8276 1.76244 9.1724 1.76245 9.54716 2.71267L10.7085 5.65732C10.8229 5.94743 11.0526 6.17707 11.3427 6.29148L14.2873 7.45284C15.2376 7.8276 15.2376 9.1724 14.2873 9.54716L11.3427 10.7085C11.0526 10.8229 10.8229 11.0526 10.7085 11.3427L9.54716 14.2873C9.1724 15.2376 7.8276 15.2376 7.45284 14.2873L6.29148 11.3427C6.17707 11.0526 5.94743 10.8229 5.65732 10.7085L2.71266 9.54716C1.76244 9.1724 1.76245 7.8276 2.71267 7.45284L5.65732 6.29148C5.94743 6.17707 6.17707 5.94743 6.29148 5.65732L7.45284 2.71266Z" fill="#84cc16"/>
                                        <path d="M16.9245 13.3916C17.1305 12.8695 17.8695 12.8695 18.0755 13.3916L18.9761 15.6753C19.039 15.8348 19.1652 15.961 19.3247 16.0239L21.6084 16.9245C22.1305 17.1305 22.1305 17.8695 21.6084 18.0755L19.3247 18.9761C19.1652 19.039 19.039 19.1652 18.9761 19.3247L18.0755 21.6084C17.8695 22.1305 17.1305 22.1305 16.9245 21.6084L16.0239 19.3247C15.961 19.1652 15.8348 19.039 15.6753 18.9761L13.3916 18.0755C12.8695 17.8695 12.8695 17.1305 13.3916 16.9245L15.6753 16.0239C15.8348 15.961 15.961 15.8348 16.0239 15.6753L16.9245 13.3916Z" fill="#84cc16"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-white mb-2">Enhance Your CV with AI</h3>
                                    <p class="text-white/80 mb-4">
                                        Let our AI generate a compelling professional summary and suggest project descriptions based on your skills and experience.
                                    </p>
                                    <div class="mt-5 flex justify-end">
                                        <button
                                            wire:click="generateWithAI"
                                            wire:loading.attr="disabled"
                                            wire:target="generateWithAI"
                                            type="button"
                                            class="cursor-pointer inline-flex items-center gap-2 bg-gradient-to-r from-lime-500 to-green-600 hover:from-lime-600 hover:to-green-700 text-white font-semibold px-6 py-3 rounded-xl transition-all duration-300 hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100 shadow-lg"
                                        >
                                            <svg
                                                wire:loading.remove
                                                wire:target="generateWithAI"
                                                class="w-5 h-5"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                            >
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>

                                            <div
                                                wire:loading
                                                wire:target="generateWithAI"
                                                class="animate-spin size-5 border-3 border-current border-t-transparent rounded-full"
                                            ></div>

                                            <span wire:loading.remove wire:target="generateWithAI">
                                                Generate with AI
                                            </span>
                                            <span wire:loading wire:target="generateWithAI">
                                                Generating...
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- AI Generated Content Preview -->
                        <div
                            class="bg-gradient-to-br from-green-500/20 to-lime-500/20 border-2 border-green-400/50 rounded-2xl p-6"
                            x-data
                            x-transition:enter="transition ease-out duration-500"
                            x-transition:enter-start="opacity-0 transform scale-90"
                            x-transition:enter-end="opacity-100 transform scale-100"
                        >
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-white">AI Content Generated!</h3>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <h4 class="text-sm font-semibold text-green-300 mb-2">Professional Summary:</h4>
                                    <p class="text-white/90 leading-relaxed bg-white/5 p-4 rounded-xl">{{ $aiContent['professional_summary'] }}</p>
                                </div>

                                @if(!empty($aiContent['project_suggestions']))
                                    <div>
                                        <h4 class="text-sm font-semibold text-green-300 mb-2">Suggested Projects:</h4>
                                        @foreach($aiContent['project_suggestions'] as $project)
                                            <div class="bg-white/5 p-4 rounded-xl mb-3">
                                                <h5 class="font-bold text-white mb-1">{{ $project['title'] }}</h5>
                                                <p class="text-sm text-white/80 mb-2">{{ $project['description'] }}</p>
                                                <p class="text-xs text-green-300 mb-2"><strong>Technologies:</strong> {{ $project['technologies'] }}</p>
                                                <ul class="text-sm text-white/90 space-y-1">
                                                    @foreach($project['highlights'] as $highlight)
                                                        <li class="flex items-start gap-2">
                                                            <svg class="w-4 h-4 text-lime-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                            </svg>
                                                            <span>{{ $highlight }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <button wire:click="$set('contentGenerated', false)" type="button" class="cursor-pointer text-white/80 hover:text-white text-sm font-semibold">
                                    ← Regenerate Content
                                </button>
                            </div>
                        </div>
                    @endif

                    <div class="flex justify-between mt-8">
                        <button wire:click="prevStep" type="button" class="cursor-pointer bg-white/20 hover:bg-white/30 transition text-white font-semibold py-3 px-8 rounded-xl">
                            Back
                        </button>
                        <button
                            wire:click="downloadPDF"
                            wire:loading.attr="disabled"
                            wire:target="downloadPDF"
                            type="button"
                            class="cursor-pointer bg-green-600 hover:bg-green-700 transition-all text-white font-semibold py-3 px-8 rounded-xl shadow-lg flex items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100"
                            @if(!$contentGenerated) disabled @endif
                        >
                            <svg
                                wire:loading.remove
                                wire:target="downloadPDF"
                                class="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>

                            <div
                                wire:loading
                                wire:target="downloadPDF"
                                class="animate-spin size-5 border-3 border-current border-t-transparent rounded-full"
                            ></div>

                            <span wire:loading.remove wire:target="downloadPDF">
                                Download PDF
                            </span>
                            <span wire:loading wire:target="downloadPDF">
                                Generating PDF...
                            </span>
                        </button>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
