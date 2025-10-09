<div
    class="lg:overflow-x-hidden overflow-x-scroll"
    x-data="{ modalReject: false, modalAccept: false, modalProfile: false, selectedApplicationId: null }"
>
    @if($this->getPendingApplicationsCount() >= 2 && !$aiRecommendation)
        <div
            class="my-6 bg-[#1750b6]/20 rounded-2xl p-6"
            x-data
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100"
        >
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <svg class="lg:size-10 size-7" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
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

                </div>
                <div class="flex-1">
                    <h3 class="text-2xl font-bold text-white mb-2">AI-Powered Analysis</h3>
                    <p class="text-white font-semibold text-base mb-4">
                        Let our AI analyze the pending applications and recommend the best candidate based on the job
                        requirements and applicants CVs.
                    </p>
                    <div class="flex justify-end">
                        <button
                            wire:click="analyzeCVsWithAI"
                            wire:loading.attr="disabled"
                            wire:loading.class="pointer-events-none"
                            wire:target="analyzeCVsWithAI"
                            class="inline-flex cursor-pointer items-center gap-2 bg-[#1750b6] hover:bg-lime-600 text-white font-semibold px-6 py-3 rounded-xl transition-all duration-300 hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100 shadow-lg"
                        >
                            <svg
                                wire:loading.remove
                                wire:target="analyzeCVsWithAI"
                                class="lg:size-7 md:size-6 size-5 text-yellow-500"
                                viewBox="0 0 24 24"
                                fill="none"
                            >
                                <path d="M13 10V3L4 14h7v7l9-11h-7z" fill="currentColor"/>
                            </svg>

                            <div
                                wire:loading
                                wire:target="analyzeCVsWithAI"
                                class="animate-spin size-5 border-3 border-current border-t-transparent rounded-full"
                            ></div>

                            <span wire:loading.remove wire:target="analyzeCVsWithAI">
                                Analyze with AI
                            </span>
                            <span wire:loading wire:target="analyzeCVsWithAI">
                                Analyzing CVs...
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($aiRecommendation)
        @if($aiRecommendation['has_suitable_candidate'])
            <div
                class="mb-6 bg-gradient-to-br from-green-500/20 to-emerald-500/20 border-2 border-green-400/50 rounded-2xl p-6 shadow-xl"
                x-data
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
            >
                <div class="flex items-start gap-4 mb-4">
                    <div class="flex-shrink-0">
                        <div class="w-14 h-14 bg-green-200 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold text-white mb-1">AI Recommendation</h3>
                        <p class="text-green-300 font-semibold">Best Match Found!</p>
                    </div>
                </div>

                @php
                    $recommendedApp = $applications->first(function($application) use ($aiRecommendation) {
                        return $application->user->email === $aiRecommendation['best_applicant_email'];
                    });
                    if ($recommendedApp) {
                        $recName = $recommendedApp->user->name;
                        $recEmail = $recommendedApp->user->email;
                        $recExperience = $recommendedApp->getApplicantExperienceAttribute();
                        $recStacks = $recommendedApp->getApplicantStacksAttribute();
                        $recTechnologies = $recommendedApp->getApplicantTechnologiesAttribute();
                        $recFirstLetter = $recName[0];
                    }
                @endphp

                @if($recommendedApp)
                    <div class="bg-white/50 backdrop-blur-sm rounded-xl p-5 mb-4">
                        <div class="flex items-center gap-4 mb-4">
                            <div
                                class="size-16 rounded-2xl bg-gradient-to-br from-[#1750b6]/60 to-lime-400 flex items-center justify-center text-2xl font-bold text-white">
                                {{ $recFirstLetter }}
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-white">{{ $recName }}</h4>
                                <p class="text-white/80 text-sm">{{ $recEmail }}</p>
                                <p class="text-green-300 font-semibold text-sm mt-1">Match
                                    Score: {{ $aiRecommendation['score'] }}/100</p>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <div>
                                <h5 class="text-lg font-semibold text-green-400 mb-1">Experience Level:</h5>
                                <p class="text-white text-base">{{ $recExperience }}</p>
                            </div>

                            <div>
                                <h5 class="text-lg font-semibold text-green-400 mb-1">Why This Candidate:</h5>
                                <p class="text-white leading-relaxed text-base">{{ $aiRecommendation['reasoning'] }}</p>
                            </div>

                            @if(!empty($aiRecommendation['strengths']))
                                <div>
                                    <h5 class="text-lg font-semibold text-green-400 mb-2">Key Strengths:</h5>
                                    <ul class="space-y-1">
                                        @foreach($aiRecommendation['strengths'] as $strength)
                                            <li class="flex items-start gap-2 text-white">
                                                <svg class="md:size-7 size-5 text-green-400 flex-shrink-0 mt-0.5"
                                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                <span>{{ $strength }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if(!empty($aiRecommendation['concerns']))
                                <div>
                                    <h5 class="text-sm font-semibold text-amber-500 mb-2">Points to Consider:</h5>
                                    <ul class="space-y-1">
                                        @foreach($aiRecommendation['concerns'] as $concern)
                                            <li class="flex items-start gap-2 text-white">
                                                <svg
                                                    class="lg:size-7 md:size-6 size-5 text-amber-400 flex-shrink-0 mt-0.5"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                                </svg>
                                                <span>{{ $concern }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div>
                                <h5 class="text-lg font-semibold text-green-400 mb-2">Stacks:</h5>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($recStacks as $stack)
                                        <span class="bg-white/20 px-3 py-2 rounded-lg text-white text-sm font-semibold">
                                                {{ $stack->name }}
                                            </span>
                                    @endforeach
                                </div>
                            </div>

                            <div>
                                <h5 class="text-lg font-semibold text-green-400 mb-2">Technologies:</h5>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($recTechnologies as $tech)
                                        <span
                                            class="bg-white/20 px-3 py-2 rounded-lg text-white text-sm font-semibold flex items-center gap-1">
                                                @if($tech->icon)
                                                <img src="{{ asset('storage/technologies_icons/' . $tech->icon) }}"
                                                     class="lg:size-6 md:size-5 size-4">
                                            @endif
                                            {{ $tech->name }}
                                            </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-3 mt-5 pt-4 border-t border-white/20">

                            <button
                                @click="modalAccept = true, selectedApplicationId = '{{ $recommendedApp->id }}'"
                                class="flex-1 bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 hover:scale-105 cursor-pointer"
                            >
                                Accept This Candidate
                            </button>

                            <button
                                wire:click="$set('aiRecommendation', null)"
                                class="bg-white/10 hover:bg-white/20 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 cursor-pointer"
                            >
                                Ignore AI Analysis
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        @else
            <div
                class="mb-6 bg-gradient-to-br from-red-500/20 to-orange-500/20 border-2 border-red-400/50 rounded-2xl p-6 shadow-xl"
                x-data
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
            >
                <div class="flex items-start gap-4 mb-4">
                    <div class="flex-shrink-0">
                        <div class="w-14 h-14 bg-red-200 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold text-white mb-1">AI Analysis Complete</h3>
                        <p class="text-red-500 font-semibold">No Suitable Candidates Found</p>
                    </div>
                </div>

                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-5 space-y-4">
                    <div>
                        <h5 class="text-lg font-semibold text-red-500 mb-2">Analysis Result:</h5>
                        <p class="text-white leading-relaxed">{{ $aiRecommendation['reasoning'] }}</p>
                    </div>

                    @if(!empty($aiRecommendation['mismatches']))
                        <div>
                            <h5 class="text-lg font-semibold text-red-500 mb-2">Key Mismatches:</h5>
                            <ul class="space-y-2">
                                @foreach($aiRecommendation['mismatches'] as $mismatch)
                                    <li class="flex items-start gap-2 text-white">
                                        <svg class="lg:size-7 md:size-6 size-5 text-red-400 flex-shrink-0 mt-0.5"
                                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        <span>{{ $mismatch }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="pt-4 border-t border-white/20">
                        <h5 class="text-lg font-semibold text-amber-500 mb-2">Recommendations:</h5>
                        <ul class="space-y-2 text-white/80">
                            <li class="flex items-start gap-2">
                                <svg class="lg:size-7 md:size-6 size-5 text-amber-500 flex-shrink-0 mt-0.5" fill="none"
                                     stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Consider revising job requirements or expanding your search</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="lg:size-7 md:size-6 size-5 text-amber-500 flex-shrink-0 mt-0.5" fill="none"
                                     stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Wait for more qualified candidates to apply</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="lg:size-7 md:size-6 size-5 text-amber-500 flex-shrink-0 mt-0.5" fill="none"
                                     stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>You can still review individual applications manually below</span>
                            </li>
                        </ul>
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button
                            wire:click="$set('aiRecommendation', null)"
                            class="flex-1 bg-white/10 hover:bg-white/20 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 cursor-pointer"
                        >
                            Review Applicants Manually
                        </button>
                    </div>
                </div>
            </div>
        @endif
    @endif

    @if($analysisError)
        <div
            class="mb-6 bg-red-500/20 border border-red-400/50 rounded-xl p-4"
            x-data
            x-transition
        >
            <p class="text-white">{{ $analysisError }}</p>
        </div>
    @endif

    <div class="min-w-[800px]">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="grid grid-cols-12 gap-4 text-base font-medium text-white">
                <div class="col-span-3">Applicant</div>
                <div class="col-span-2 text-center">Status</div>
                <div class="col-span-1 flex justify-center items-center">
                    LinkedIn
                </div>
                <div class="col-span-1 flex justify-center items-center">
                    GitHub
                </div>
                <div class="col-span-1 flex justify-center">CV</div>
                <div class="col-span-2 flex justify-center">Chat</div>
                <div class="col-span-2 flex justify-center">Actions</div>
            </div>
        </div>

        <div class="divide-y divide-gray-200">

            @forelse($applications as $application)

                @php
                    $name = $application->user->name;
                    $first_letter = $name[0];
                    $email = $application->user->email;
                    $experience_level = $application->getApplicantExperienceAttribute();
                    $stacks = $application->getApplicantStacksAttribute();
                    $technologies = $application->getApplicantTechnologiesAttribute();

                    $status = $application->status;
                    $linkedin_url = $application->user?->developer?->linkedin_url;
                    $github_url = $application->user?->developer?->github_url;
                @endphp

                <div
                    class="px-2 py-4 rounded-lg hover:bg-black/10 transition-all duration-200">
                    <div class="grid grid-cols-12 gap-4 items-center">
                        <div class="col-span-3">
                            <div
                                class="flex items-center gap-3 cursor-pointer"
                                title="Click to view applicant details."
                                @click="modalProfile = true, selectedApplicationId = '{{ $application->id }}'"
                            >
                                <div
                                    class="md:size-12 size-10 rounded-2xl bg-gradient-to-br from-[#1750b6]/60 to-lime-400 flex items-center justify-center text-lg font-bold text-white">
                                    {{ $first_letter }}
                                </div>

                                <div class="overflow-hidden">
                                    <h3 class="font-bold text-white">{{ $name }}</h3>
                                    <p class="text-sm font-semibold text-white">{{ $email }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-2 overflow-hidden flex justify-center">
                            <span
                                @class([
                                    'bg-green-600' => $status === 'Accepted',
                                    'bg-red-600' => $status === 'Rejected',
                                    'bg-amber-600' => $status === 'Pending',
                                    'inline-flex px-3 py-2 text-base font-medium rounded-lg text-white',
                                ])
                            >
                                {{ $status }}
                            </span>
                        </div>


                        @if($status !== 'Rejected')
                            <div class="col-span-1 overflow-hidden flex justify-center">
                                <a
                                    href="{{ 'https://' . $linkedin_url }} "
                                    target="_blank"
                                >
                                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128">
                                        <path fill="#0076b2"
                                              d="M116 3H12a8.91 8.91 0 00-9 8.8v104.42a8.91 8.91 0 009 8.78h104a8.93 8.93 0 009-8.81V11.77A8.93 8.93 0 00116 3z"/>
                                        <path fill="#fff"
                                              d="M21.06 48.73h18.11V107H21.06zm9.06-29a10.5 10.5 0 11-10.5 10.49 10.5 10.5 0 0110.5-10.49M50.53 48.73h17.36v8h.24c2.42-4.58 8.32-9.41 17.13-9.41C103.6 47.28 107 59.35 107 75v32H88.89V78.65c0-6.75-.12-15.44-9.41-15.44s-10.87 7.36-10.87 15V107H50.53z"/>
                                    </svg>
                                </a>
                            </div>

                            <div class="col-span-1 overflow-hidden flex justify-center">
                                <a
                                    href="{{ 'https://' . $github_url }} "
                                    target="_blank"
                                >
                                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128">
                                        <g fill="#181616">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M64 5.103c-33.347 0-60.388 27.035-60.388 60.388 0 26.682 17.303 49.317 41.297 57.303 3.017.56 4.125-1.31 4.125-2.905 0-1.44-.056-6.197-.082-11.243-16.8 3.653-20.345-7.125-20.345-7.125-2.747-6.98-6.705-8.836-6.705-8.836-5.48-3.748.413-3.67.413-3.67 6.063.425 9.257 6.223 9.257 6.223 5.386 9.23 14.127 6.562 17.573 5.02.542-3.903 2.107-6.568 3.834-8.076-13.413-1.525-27.514-6.704-27.514-29.843 0-6.593 2.36-11.98 6.223-16.21-.628-1.52-2.695-7.662.584-15.98 0 0 5.07-1.623 16.61 6.19C53.7 35 58.867 34.327 64 34.304c5.13.023 10.3.694 15.127 2.033 11.526-7.813 16.59-6.19 16.59-6.19 3.287 8.317 1.22 14.46.593 15.98 3.872 4.23 6.215 9.617 6.215 16.21 0 23.194-14.127 28.3-27.574 29.796 2.167 1.874 4.097 5.55 4.097 11.183 0 8.08-.07 14.583-.07 16.572 0 1.607 1.088 3.49 4.148 2.897 23.98-7.994 41.263-30.622 41.263-57.294C124.388 32.14 97.35 5.104 64 5.104z"/>
                                            <path
                                                d="M26.484 91.806c-.133.3-.605.39-1.035.185-.44-.196-.685-.605-.543-.906.13-.31.603-.395 1.04-.188.44.197.69.61.537.91zm2.446 2.729c-.287.267-.85.143-1.232-.28-.396-.42-.47-.983-.177-1.254.298-.266.844-.14 1.24.28.394.426.472.984.17 1.255zM31.312 98.012c-.37.258-.976.017-1.35-.52-.37-.538-.37-1.183.01-1.44.373-.258.97-.025 1.35.507.368.545.368 1.19-.01 1.452zm3.261 3.361c-.33.365-1.036.267-1.552-.23-.527-.487-.674-1.18-.343-1.544.336-.366 1.045-.264 1.564.23.527.486.686 1.18.333 1.543zm4.5 1.951c-.147.473-.825.688-1.51.486-.683-.207-1.13-.76-.99-1.238.14-.477.823-.7 1.512-.485.683.206 1.13.756.988 1.237zm4.943.361c.017.498-.563.91-1.28.92-.723.017-1.308-.387-1.315-.877 0-.503.568-.91 1.29-.924.717-.013 1.306.387 1.306.88zm4.598-.782c.086.485-.413.984-1.126 1.117-.7.13-1.35-.172-1.44-.653-.086-.498.422-.997 1.122-1.126.714-.123 1.354.17 1.444.663zm0 0"/>
                                        </g>
                                    </svg>
                                </a>
                            </div>

                            <div class="col-span-1 overflow-hidden lg:ml-2 md:ml-1">
                                <button
                                    wire:click="downloadCV('{{ $application->user?->id }}')"
                                    wire:target="downloadCV('{{ $application->user?->id }}')"
                                    wire:loading.class="pointer-events-none"
                                    class="cursor-pointer bg-blue-500 p-1 rounded-lg hover:bg-blue-600 transition"
                                >
                                    <div
                                        wire:loading
                                        wire:target="downloadCV('{{ $application->user?->id }}')"
                                        class="animate-spin inline-block size-5 border-3 mt-1 border-current border-t-transparent text-white rounded-full"
                                        role="status" aria-label="loading"
                                    >
                                        <span class="sr-only">Loading...</span>
                                    </div>

                                    <svg
                                        wire:target="downloadCV('{{ $application->user?->id }}')"
                                        wire:loading.remove
                                        class="size-4 lg:size-6"
                                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        stroke="#ffffff" stroke-width="1.344">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                           stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M12.5535 16.5061C12.4114 16.6615 12.2106 16.75 12 16.75C11.7894 16.75 11.5886 16.6615 11.4465 16.5061L7.44648 12.1311C7.16698 11.8254 7.18822 11.351 7.49392 11.0715C7.79963 10.792 8.27402 10.8132 8.55352 11.1189L11.25 14.0682V3C11.25 2.58579 11.5858 2.25 12 2.25C12.4142 2.25 12.75 2.58579 12.75 3V14.0682L15.4465 11.1189C15.726 10.8132 16.2004 10.792 16.5061 11.0715C16.8118 11.351 16.833 11.8254 16.5535 12.1311L12.5535 16.5061Z"
                                                fill="#ffffff"></path>
                                            <path
                                                d="M3.75 15C3.75 14.5858 3.41422 14.25 3 14.25C2.58579 14.25 2.25 14.5858 2.25 15V15.0549C2.24998 16.4225 2.24996 17.5248 2.36652 18.3918C2.48754 19.2919 2.74643 20.0497 3.34835 20.6516C3.95027 21.2536 4.70814 21.5125 5.60825 21.6335C6.47522 21.75 7.57754 21.75 8.94513 21.75H15.0549C16.4225 21.75 17.5248 21.75 18.3918 21.6335C19.2919 21.5125 20.0497 21.2536 20.6517 20.6516C21.2536 20.0497 21.5125 19.2919 21.6335 18.3918C21.75 17.5248 21.75 16.4225 21.75 15.0549V15C21.75 14.5858 21.4142 14.25 21 14.25C20.5858 14.25 20.25 14.5858 20.25 15C20.25 16.4354 20.2484 17.4365 20.1469 18.1919C20.0482 18.9257 19.8678 19.3142 19.591 19.591C19.3142 19.8678 18.9257 20.0482 18.1919 20.1469C17.4365 20.2484 16.4354 20.25 15 20.25H9C7.56459 20.25 6.56347 20.2484 5.80812 20.1469C5.07435 20.0482 4.68577 19.8678 4.40901 19.591C4.13225 19.3142 3.9518 18.9257 3.85315 18.1919C3.75159 17.4365 3.75 16.4354 3.75 15Z"
                                                fill="#ffffff"></path>
                                        </g>
                                    </svg>
                                </button>
                            </div>
                            <div class="col-span-2 overflow-hidden lg:ml-1">
                                <button
                                    class="flex cursor-pointer font-semibold items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 text-xs sm:text-sm text-white bg-blue-500 hover:bg-blue-600 rounded-lg transition-colors flex-shrink-0"
                                >
                                    <span class="hidden sm:inline">Message</span>
                                    <span class="sm:hidden">Message</span>
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M14.4376 15.3703L12.3042 19.5292C11.9326 20.2537 10.8971 20.254 10.525 19.5297L4.24059 7.2971C3.81571 6.47007 4.65077 5.56156 5.51061 5.91537L18.5216 11.2692C19.2984 11.5889 19.3588 12.6658 18.6227 13.0704L14.4376 15.3703ZM14.4376 15.3703L5.09594 6.90886"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                                    </svg>
                                </button>
                            </div>
                        @endif

                        @if($status === 'Pending')
                            <div class="col-span-2 overflow-hidden">
                                <div class="flex justify-center items-center gap-4">
                                    <button
                                        @click="modalReject = true, selectedApplicationId = '{{ $application->id }}'"
                                        class="cursor-pointer"
                                    >
                                        <svg class="w-9 h-9" viewBox="0 0 512 512" version="1.1" xml:space="preserve"
                                             xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g
                                                id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                               stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <style type="text/css"> .st0 {
                                                        fill: #e60000;
                                                    }

                                                    .st1 {
                                                        fill: none;
                                                        stroke: #e60000;
                                                        stroke-width: 32;
                                                        stroke-linecap: round;
                                                        stroke-linejoin: round;
                                                        stroke-miterlimit: 10;
                                                    } </style>
                                                <g id="Layer_1"></g>
                                                <g id="Layer_2">
                                                    <g>
                                                        <path class="st0"
                                                              d="M263.24,43.5c-117.36,0-212.5,95.14-212.5,212.5s95.14,212.5,212.5,212.5s212.5-95.14,212.5-212.5 S380.6,43.5,263.24,43.5z M367.83,298.36c17.18,17.18,17.18,45.04,0,62.23v0c-17.18,17.18-45.04,17.18-62.23,0l-42.36-42.36 l-42.36,42.36c-17.18,17.18-45.04,17.18-62.23,0v0c-17.18-17.18-17.18-45.04,0-62.23L201.01,256l-42.36-42.36 c-17.18-17.18-17.18-45.04,0-62.23v0c17.18-17.18,45.04-17.18,62.23,0l42.36,42.36l42.36-42.36c17.18-17.18,45.04-17.18,62.23,0v0 c17.18,17.18,17.18,45.04,0,62.23L325.46,256L367.83,298.36z"></path>
                                                    </g>
                                                </g>
                                            </g></svg>
                                    </button>
                                    <button
                                        @click="modalAccept = true, selectedApplicationId = '{{ $application->id }}'"
                                        class="cursor-pointer"
                                    >
                                        <svg class="w-8 h-8" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"
                                             fill="#000000">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                               stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <defs>
                                                    <style> .cls-1 {
                                                            fill: #008200;
                                                            fill-rule: evenodd;
                                                        } </style>
                                                </defs>
                                                <path class="cls-1"
                                                      d="M800,510a30,30,0,1,1,30-30A30,30,0,0,1,800,510Zm-16.986-23.235a3.484,3.484,0,0,1,0-4.9l1.766-1.756a3.185,3.185,0,0,1,4.574.051l3.12,3.237a1.592,1.592,0,0,0,2.311,0l15.9-16.39a3.187,3.187,0,0,1,4.6-.027L817,468.714a3.482,3.482,0,0,1,0,4.846l-21.109,21.451a3.185,3.185,0,0,1-4.552.03Z"
                                                      id="check" transform="translate(-770 -450)"></path>
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <template x-teleport="body">
                    <div
                        x-show="selectedApplicationId === '{{ $application->id }}' && modalProfile"
                        x-cloak
                        x-transition
                        class="fixed inset-0 bg-white/30 backdrop-blur-md z-50 rounded-2xl flex justify-center items-center"
                    >
                        <div
                            class="relative p-4 w-full max-w-xl max-h-full"
                            @click.outside="modalProfile = false; selectedApplicationId = null;"
                        >
                            <div class="relative bg-gradient-to-br from-blue-600 to-indigo-300 rounded-lg shadow-sm">
                                <button
                                    type="button"
                                    @click="selectedApplicationId = null; modalProfile = false"
                                    class="absolute top-3 end-2.5 text-white bg-transparent cursor-pointer hover:text-gray-500 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                >
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                         fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                </button>

                                <div class="flex flex-col items-center p-10">
                                    <div
                                        class="md:size-18 size-12 rounded-2xl bg-gradient-to-br from-[#1750b6]/60 to-lime-400 flex items-center justify-center text-xl font-bold text-white">
                                        {{ $first_letter }}
                                    </div>

                                    <h5 class="mb-1 text-base lg:text-xl font-semibold text-white mt-2">{{ $name }}</h5>
                                    <p class="text-sm lg:text-base font-semibold text-white">{{ $email }}</p>

                                    <h2 class="w-full text-xl mt-4 font-semibold text-lime-400 mb-2 text-left">
                                        Experience Level:
                                        <span
                                            class="text-base lg:text-xl font-bold text-white">{{ $experience_level }}</span>
                                    </h2>

                                    <div class="mt-2 w-full">
                                        <h2 class="text-xl font-semibold text-lime-400 mb-2 text-left">Stacks:</h2>
                                        <div
                                            class="rounded-xl p-2 text-sm min-w-[25px] gap-3 font-semibold flex items-center justify-center flex-wrap transition text-white relative overflow-hidden"
                                        >
                                            @foreach($stacks as $stack)
                                                <div
                                                    class="relative z-10 flex items-center bg-white/20 px-4 py-3 rounded-xl mb-2 transition-all duration-200 w-fit">
                                                    <span class="text-white font-semibold">{{ $stack->name }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="w-full">
                                        <h2 class="text-xl font-semibold text-lime-400 mb-2">Technologies:</h2>
                                        <div
                                            class="rounded-xl p-2 text-sm min-w-[25px] gap-3 font-semibold flex items-center justify-center flex-wrap transition text-white relative overflow-hidden"
                                        >
                                            @foreach($technologies as $technology)
                                                <div
                                                    class="relative z-10 flex items-center bg-white/20 px-4 py-3 rounded-xl mb-2 transition-all duration-200 w-fit">
                                                    @if($technology->icon)
                                                        <img
                                                            src="{{ asset('storage/technologies_icons/' . $technology->icon) }}"
                                                            alt="{{ $technology->name }}"
                                                            class="min-w-5 min-h-5 max-w-6 max-h-6 mr-2">
                                                    @endif

                                                    <span
                                                        class="text-white font-semibold">{{ $technology->name }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            @empty
                <div class="px-6 py-4 text-center text-white font-bold text-lg mt-3">
                    <span class="grid-cols-12">No applications found.</span>
                </div>
            @endforelse

        </div>


        <template x-teleport="body">
            <div
                x-show="modalReject"
                x-cloak
                x-transition
                class="fixed inset-0 bg-white/30 backdrop-blur-md z-50 rounded-2xl flex justify-center items-center"
            >
                <div
                    class="relative p-4 w-full max-w-md max-h-full"
                    @click.outside="modalReject = false; selectedApplicationId = null;"
                >
                    <div class="relative bg-white rounded-lg shadow-sm">
                        <button
                            type="button"
                            @click="modalReject = false"
                            class="absolute top-3 end-2.5 text-[#0D1B2A] bg-transparent cursor-pointer hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        >
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>

                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 text-red-500 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>

                            <h3 class="mb-5 text-lg font-semibold text-[#0D1B2A]">Are you sure you want to reject this application?</h3>
                            <p class="mb-5 text-gray-500">By doing so, you will not be able to undo it later.</p>
                            <button
                                type="button"
                                @click="$wire.rejectApplicant(selectedApplicationId); modalReject = false; selectedApplicationId = null"
                                class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 cursor-pointer focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center"
                            >
                                Yes, I'm sure
                            </button>

                            <button
                                type="button"
                                @click="modalReject = false"
                                class="py-2.5 px-5 ms-3 text-sm font-medium text-[#0D1B2A] cursor-pointer focus:outline-none bg-white hover:bg-gray-200 rounded-lg border border-gray-200 focus:z-10 focus:ring-4 focus:ring-gray-100"
                            >
                                No, cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <template x-teleport="body">
            <div
                x-show="modalAccept"
                x-cloak
                x-transition
                class="fixed inset-0 bg-white/30 backdrop-blur-md z-50 rounded-2xl flex justify-center items-center"
            >
                <div
                    class="relative p-4 w-full max-w-md max-h-full"
                    @click.outside="modalAccept = false; selectedApplicationId = null;"
                >
                    <div class="relative bg-white rounded-lg shadow-sm">
                        <button
                            type="button"
                            @click="modalAccept = false"
                            class="absolute top-3 end-2.5 text-[#0D1B2A] bg-transparent cursor-pointer hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        >
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>

                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 text-green-500 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>

                            <h3 class="mb-5 text-lg font-semibold text-[#0D1B2A]">Are you sure you want to accept this application?</h3>
                            <p class="mb-5 text-gray-500">By doing so, all other applications will be rejected.</p>
                            <button
                                type="button"
                                @click="$wire.acceptApplicant(selectedApplicationId); modalAccept = false; selectedApplicationId = null"
                                class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 cursor-pointer focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center"
                            >
                                Yes, I'm sure
                            </button>

                            <button
                                type="button"
                                @click="modalAccept = false"
                                class="py-2.5 px-5 ms-3 text-sm font-medium text-[#0D1B2A] cursor-pointer focus:outline-none bg-white hover:bg-gray-200 rounded-lg border border-gray-200 focus:z-10 focus:ring-4 focus:ring-gray-100"
                            >
                                No, cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
