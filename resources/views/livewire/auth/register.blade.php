<div class="w-full">
    <div class="max-w-3xl mx-auto bg-white/10 backdrop-blur-xl border border-white/20 p-8 rounded-3xl shadow-xl">


        <div class="mb-8">
            <div class="flex items-center justify-center space-x-4">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full {{ $currentStep >= 1 ? ($currentStep > 1 ? 'bg-green-500' : 'bg-[#1750b6]') : 'bg-white/20' }} flex items-center justify-center text-white font-semibold text-sm">
                        {{ $currentStep > 1 ? '✓' : '1' }}
                    </div>
                    <span class="ml-2 {{ $currentStep >= 1 ? 'text-white' : 'text-white/60' }} font-medium">Account Type</span>
                </div>
                <div class="w-16 h-0.5 {{ $currentStep > 1 ? 'bg-green-500' : 'bg-white/30' }}"></div>
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full {{ $currentStep >= 2 ? ($currentStep > 2 ? 'bg-green-500' : 'bg-[#1750b6]') : 'bg-white/20' }} flex items-center justify-center text-white font-semibold text-sm">
                        {{ $currentStep > 2 ? '✓' : '2' }}
                    </div>
                    <span class="ml-2 {{ $currentStep >= 2 ? 'text-white' : 'text-white/60' }} font-medium">Details</span>
                </div>
                <div class="w-16 h-0.5 {{ $currentStep > 2 ? 'bg-green-500' : 'bg-white/30' }}"></div>
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full {{ $currentStep >= 3 ? 'bg-[#1750b6]' : 'bg-white/20' }} flex items-center justify-center text-white font-semibold text-sm">3</div>
                    <span class="ml-2 {{ $currentStep >= 3 ? 'text-white' : 'text-white/60' }} font-medium">Security</span>
                </div>
            </div>
        </div>

        <h2 class="md:text-3xl sm:text-2xl text-xl text-center font-bold mb-6 text-white">Create an Account</h2>

        <form wire:submit.prevent="register">

            @if($currentStep == 1)
                <div class="space-y-6">
                    <div>
                        <label class="block font-medium text-sm md:text-base mb-1 text-white">Email:</label>
                        <input
                            wire:model="email"
                            type="email"
                            class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                        @error('email')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>

                        <label class="block font-medium text-sm md:text-base mb-3 text-white">I am a:</label>
                        <ul class="grid w-full gap-6 md:grid-cols-2">

                            <li>
                                <input wire:model="account_type" id="dev" type="radio" value="developer" name="account_type" class="hidden peer" required />
                                <label for="dev"
                                       class="inline-flex items-center justify-between w-full p-6 bg-white/10 border border-white/20 rounded-xl cursor-pointer text-white hover:bg-[#1750b6]/20 hover:border-white/40 peer-checked:bg-[#1750b6]/20 peer-checked:border-[#1750b6] transition-all duration-300"
                                >
                                    <svg class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:#76C2AF;} .st1{opacity:0.2;} .st2{fill:#231F20;} .st3{fill:#FFFFFF;} </style> <g id="Layer_1"> <g> <circle class="st0" cx="32" cy="32" r="32"></circle> </g> <g class="st1"> <g> <g> <path class="st2" d="M42.5,44c-0.7,0-1.3-0.3-1.7-1c-0.6-0.9-0.3-2.2,0.7-2.8l10.1-6.2c0,0,0,0,0-0.1s0,0,0-0.1l-10.1-6.2 c-0.9-0.6-1.2-1.8-0.7-2.8c0.6-0.9,1.8-1.2,2.8-0.7l10.6,6.6l0.2,0.2c0.8,0.8,1.2,1.9,1.2,3c0,1.1-0.4,2.2-1.2,3l-0.2,0.2 l-10.6,6.6C43.2,43.9,42.8,44,42.5,44z"></path> </g> </g> <g> <g> <path class="st2" d="M21.5,44c-0.4,0-0.7-0.1-1-0.3L9.9,37.1L9.7,37c-0.8-0.8-1.2-1.9-1.2-3c0-1.1,0.4-2.2,1.2-3l0.2-0.2 l10.6-6.6c0.9-0.6,2.2-0.3,2.8,0.7c0.6,0.9,0.3,2.2-0.7,2.8l-10.1,6.2c0,0,0,0,0,0.1s0,0,0,0.1l10.1,6.2 c0.9,0.6,1.2,1.8,0.7,2.8C22.9,43.7,22.2,44,21.5,44z"></path> </g> </g> </g> <g class="st1"> <g> <path class="st2" d="M25.5,53c-0.2,0-0.5,0-0.7-0.1c-1-0.4-1.5-1.6-1.2-2.6l13-34c0.4-1,1.6-1.5,2.6-1.2c1,0.4,1.5,1.6,1.2,2.6 l-13,34C27.1,52.5,26.3,53,25.5,53z"></path> </g> </g> <g> <g> <path class="st3" d="M42.5,42c-0.7,0-1.3-0.3-1.7-1c-0.6-0.9-0.3-2.2,0.7-2.8l10.1-6.2c0,0,0-0.1,0-0.1l-10.1-6.2 c-0.9-0.6-1.2-1.8-0.7-2.8c0.6-0.9,1.8-1.2,2.8-0.7l10.6,6.6l0.2,0.2c1.6,1.6,1.6,4.3,0,6l-0.2,0.2l-10.6,6.6 C43.2,41.9,42.8,42,42.5,42z"></path> </g> <g> <path class="st3" d="M21.5,42c-0.4,0-0.7-0.1-1-0.3L9.9,35.1L9.7,35c-1.6-1.6-1.6-4.3,0-6l0.2-0.2l10.6-6.6 c0.9-0.6,2.2-0.3,2.8,0.7c0.6,0.9,0.3,2.2-0.7,2.8l-10.1,6.2c0,0,0,0.1,0,0.1l10.1,6.2c0.9,0.6,1.2,1.8,0.7,2.8 C22.9,41.7,22.2,42,21.5,42z"></path> </g> </g> <g> <path class="st3" d="M25.5,51c-0.2,0-0.5,0-0.7-0.1c-1-0.4-1.5-1.6-1.2-2.6l13-34c0.4-1,1.6-1.5,2.6-1.2c1,0.4,1.5,1.6,1.2,2.6 l-13,34C27.1,50.5,26.3,51,25.5,51z"></path> </g> </g> <g id="Layer_2"> </g> </g></svg>
                                    <div class="block">
                                        <div class="w-full text-lg font-semibold text-center">Developer</div>
                                        <div class="w-full text-center">Looking for opportunities</div>
                                    </div>
                                </label>
                            </li>

                            <li>
                                <input wire:model="account_type" id="rec" type="radio" value="recruiter" name="account_type" class="hidden peer">
                                <label for="rec"
                                       class="inline-flex items-center justify-between w-full p-6 bg-white/10 border border-white/20 rounded-xl cursor-pointer text-white hover:bg-[#1750b6]/20 hover:border-white/40 peer-checked:bg-[#1750b6]/20 peer-checked:border-[#1750b6] transition-all duration-300"
                                >
                                    <svg class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path style="fill:#E6AF78;" d="M335.448,347.948v-47.81H176.552v47.81c0,8.193-5.636,15.309-13.611,17.186L53.706,390.837 c-15.95,3.752-27.223,17.985-27.223,34.37v69.138c0,9.751,7.904,17.655,17.655,17.655h423.724c9.751,0,17.655-7.904,17.655-17.655 v-69.138c0-16.386-11.273-30.618-27.223-34.371l-109.235-25.703C341.085,363.257,335.448,356.141,335.448,347.948z"></path> <path style="fill:#5B5D6E;" d="M458.294,390.836l-87.588-20.609l-8.775-8.296l-17.458,1.356L256,414.897l-85.023-54.105 l-20.908,1.14l-0.001,6.231l-96.362,22.674c-15.95,3.753-27.223,17.985-27.223,34.371v69.138c0,9.751,7.904,17.655,17.655,17.655 h423.724c9.751,0,17.655-7.904,17.655-17.655v-69.138C485.517,408.822,474.244,394.589,458.294,390.836z"></path> <polygon style="fill:#D7DEED;" points="150.069,361.931 203.034,512 308.966,512 361.931,361.931 256,414.897 "></polygon> <polygon style="fill:#5B5D6E;" points="278.069,512 233.931,512 241.288,432.552 270.712,432.552 "></polygon> <path style="fill:#D29B6E;" d="M176.552,347.948c0,5.927-2.975,11.257-7.625,14.482c104.728,52.467,166.521-51.283,166.521-51.283 v-11.009H176.552V347.948z"></path> <path style="fill:#F0C087;" d="M141.241,97.103l7.692,169.237c0.718,15.81,8.47,30.472,21.131,39.967l36.501,27.375 c9.169,6.876,20.319,10.593,31.779,10.593h35.31c11.46,0,22.611-3.717,31.779-10.593l36.5-27.375 c12.661-9.496,20.413-24.157,21.131-39.967l7.693-169.237H141.241z"></path> <path style="fill:#E6AF78;" d="M141.241,97.103l7.692,169.236c0.718,15.811,8.47,30.472,21.132,39.968l36.5,27.375 c9.169,6.877,20.319,10.593,31.779,10.593H256c-26.483-8.828-44.138-79.448-44.138-79.448v-96.345 c0-6.637,5.062-12.093,11.668-12.733c49.448-4.79,105.321-17.207,147.229-46.508V97.103H141.241z"></path> <path style="fill:#7D7878;" d="M123.586,88.276v8.828l8.828,97.103h17.655l17.655-52.966c0,0,114.759,0,176.552-35.31l17.655,88.276 h17.655l8.828-97.103v-8.828C388.414,39.522,348.892,0,300.138,0h-88.276C163.108,0,123.586,39.522,123.586,88.276z"></path> <path style="fill:#F0C087;" d="M387.859,208.084l-9.97,39.876c-1.181,4.725-5.426,8.039-10.296,8.039l0,0 c-5.353,0-9.867-3.986-10.531-9.297l-5.098-40.785c-1.362-10.905,7.143-20.538,18.133-20.538h0.034 C382.019,185.379,390.742,196.552,387.859,208.084z"></path> <path style="fill:#E6AF78;" d="M124.141,208.084l9.97,39.876c1.181,4.725,5.426,8.039,10.296,8.039l0,0 c5.353,0,9.867-3.986,10.531-9.297l5.098-40.785c1.362-10.905-7.143-20.538-18.133-20.538h-0.034 C129.981,185.379,121.258,196.552,124.141,208.084z"></path> <g> <path style="fill:#515262;" d="M91.289,454.709l-57.203-51.384c-4.793,6.069-7.604,13.707-7.604,21.884v69.137 c0,9.751,7.904,17.655,17.655,17.655h61.793v-24.456C105.931,475.017,100.608,463.081,91.289,454.709z"></path> <path style="fill:#515262;" d="M420.711,454.709l57.203-51.384c4.793,6.069,7.604,13.707,7.604,21.884v69.137 c0,9.751-7.904,17.655-17.655,17.655h-61.793v-24.456C406.069,475.017,411.392,463.081,420.711,454.709z"></path> </g> <path style="fill:#65687A;" d="M269.241,414.897h-26.483c-4.875,0-8.828,3.953-8.828,8.828v17.655c0,4.875,3.953,8.828,8.828,8.828 h26.483c4.875,0,8.828-3.953,8.828-8.828v-17.655C278.069,418.849,274.116,414.897,269.241,414.897z"></path> <g> <path style="fill:#E4EAF6;" d="M175.311,342.277L256,414.897c0,0-22.598,11.407-50.483,34.4 c-5.752,4.743-14.454,2.822-17.539-3.966l-37.909-83.4l11.992-17.988C165.047,339.464,171.311,338.677,175.311,342.277z"></path> <path style="fill:#E4EAF6;" d="M336.689,342.277L256,414.897c0,0,22.598,11.407,50.483,34.4c5.752,4.743,14.454,2.822,17.539-3.966 l37.909-83.4l-11.992-17.988C346.953,339.464,340.689,338.677,336.689,342.277z"></path> </g> <g> <path style="fill:#65687A;" d="M203.034,512l-52.966-150.069l-21.306,7.102c-3.172,1.057-5.474,3.816-5.948,7.126l-7.317,51.218 c-0.456,3.191,0.864,6.377,3.443,8.31l24.448,18.336c3.748,2.812,4.648,8.061,2.048,11.959l-9.759,14.638 c-1.976,2.965-1.976,6.828,0,9.793L150.069,512H203.034z"></path> <path style="fill:#65687A;" d="M308.966,512l52.966-150.069l21.306,7.102c3.172,1.057,5.474,3.816,5.948,7.126l7.317,51.218 c0.456,3.191-0.864,6.377-3.443,8.31l-24.448,18.336c-3.748,2.812-4.648,8.061-2.048,11.959l9.759,14.638 c1.976,2.965,1.976,6.828,0,9.793L361.931,512H308.966z"></path> </g> <path style="fill:#515262;" d="M361.931,176.552h-88.276c-4.875,0-8.828,3.953-8.828,8.828h-17.655c0-4.875-3.953-8.828-8.828-8.828 h-88.276c-4.875,0-8.828,3.953-8.828,8.828c0,4.875,3.953,8.828,8.828,8.828h11.35l4.14,28.98 c1.242,8.697,8.692,15.158,17.478,15.158h41.525c8.102,0,15.162-5.514,17.128-13.373l3.342-13.372 c1.258-5.034,5.782-8.565,10.97-8.564l0,0c5.187,0.001,9.708,3.531,10.966,8.564l3.343,13.373 c1.965,7.859,9.026,13.373,17.128,13.373h41.524c8.786,0,16.235-6.461,17.478-15.158l4.14-28.981h11.35 c4.875,0,8.828-3.953,8.828-8.828C370.759,180.504,366.806,176.552,361.931,176.552z"></path> </g></svg>
                                    <div class="block">
                                        <div class="w-full text-lg font-semibold text-center">Recruiter</div>
                                        <div class="w-full text-center">Hiring talented developers</div>
                                    </div>
                                </label>
                            </li>

                        </ul>
                        @error('account_type')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
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
                </div>
            @endif


            @if($currentStep == 2 && $account_type == 'developer')

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm md:text-base mb-1 text-white">Full Name:</label>
                        <input
                            wire:model="name"
                            type="text"
                            class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                        @error('name')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm md:text-base mb-1 text-white">Experience Level:</label>
                        <select
                            wire:model="experience_level"
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
                        @error('experience_level')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-sm md:text-base mb-3 text-white">Stacks:</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
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
                        @error('chosenStacks')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-white text-sm md:text-base font-medium mb-2">Technologies:</label>
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
                        @error('chosenTechs')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-medium text-sm md:text-base mb-1 text-white">LinkedIn URL:</label>
                            <input
                                wire:model="linkedin_url"
                                type="text"
                                class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="linkedin.com/in/username"
                            />
                            @error('linkedin_url')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block font-medium text-sm md:text-base mb-1 text-white">GitHub URL:</label>
                            <input
                                wire:model="github_url"
                                type="text"
                                class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="github.com/username"
                            />
                            @error('github_url')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block font-medium text-sm md:text-base mb-1 text-white">Upload CV:</label>
                        <div class="relative">
                            <input
                                wire:model="cv"
                                type="file"
                                accept=".pdf,.doc,.docx"
                                class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            />
                            <p class="text-white/60 text-xs mt-1">PDF, DOC, DOCX (Max 5MB)</p>
                            @error('cv')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div wire:loading wire:target="cv" class="text-white/70 text-sm mt-1">
                            Uploading...
                        </div>
                    </div>

                    <div class="flex justify-between">
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
                </div>
            @endif

            @if($currentStep == 2 && $account_type == 'recruiter')
                <div class="space-y-6">

                    <div>
                        <label class="block font-medium text-sm md:text-base mb-1 text-white">Company Name:</label>
                        <input
                            wire:model="company_name"
                            type="text"
                            class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your company name"
                        />
                        @error('company_name')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm md:text-base mb-1 text-white">City:</label>
                        <select
                            wire:model="city"
                            class="w-full font-semibold bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            <option value="">Select your city</option>
                            @foreach($cities as $city)
                                <option value="{{ $city }}">{{ $city }}</option>
                            @endforeach
                        </select>
                        @error('city')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-sm md:text-base mb-1 text-white">Company Logo:</label>
                        <div class="relative">
                            <input
                                wire:model="company_logo"
                                type="file"
                                accept="image/*"
                                class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            />
                            <p class="text-white/60 text-xs mt-1">PNG, JPG, SVG (Max 2MB)</p>
                            @error('company_logo')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div wire:loading wire:target="company_logo" class="text-white/70 font-semibold text-base mt-1">
                            Uploading...
                        </div>
                        @if($company_logo)
                            <div class="mt-3 flex items-center justify-center">
                                <img src="{{ $company_logo->temporaryUrl() }}" class="w-20 h-20 object-contain rounded-lg border border-white/20">
                            </div>
                        @endif
                    </div>

                    <div class="flex justify-between">
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
                </div>
            @endif

            @if($currentStep == 3)
                <div class="space-y-6">
                    <div>
                        <label class="block font-medium text-sm md:text-base mb-1 text-white">Password:</label>
                        <input
                            wire:model="password"
                            type="password"
                            class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                        @error('password')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-sm md:text-base mb-1 text-white">Confirm Password:</label>
                        <input
                            wire:model="password_confirmation"
                            type="password"
                            class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                    </div>

                    <div class="flex justify-between">
                        <button
                            wire:click="prevStep"
                            wire:loading.class="opacity-50 pointer-events-none"
                            type="button"
                            class="bg-white/20 hover:bg-white/30 transition text-white md:text-base text-sm font-semibold cursor-pointer py-3 px-8 rounded-xl"
                        >
                            Back
                        </button>
                        <button
                            type="submit"
                            wire:loading.attr="disabled"
                            wire:loading.class="pointer-events-none"
                            class="bg-[#1750b6] hover:bg-lime-600 transition text-white md:text-base text-sm font-semibold cursor-pointer py-3 px-8 rounded-xl shadow-lg disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            <span wire:loading.remove>Create Account</span>
                            <span wire:loading>Creating...</span>
                        </button>
                    </div>
                </div>
            @endif
        </form>

        <div class="mt-4 flex justify-center">
            <p class="text-sm text-white">
                Already have an account?
                <a
                    wire:navigate
                    href="{{ route('login') }}"
                    class="text-[#19468f] hover:underline"
                >
                    Log in here.
                </a>
            </p>
        </div>
    </div>
</div>
