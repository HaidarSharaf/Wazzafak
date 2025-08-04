<div
    class="w-full"
     x-data="{ modalReject: false, modalDelete: false, modalDisclose: false }"
>
    <div class="max-w-5xl mx-auto bg-white/10 backdrop-blur-2xl border border-white/20 rounded-3xl p-6 sm:p-10 shadow-2xl">


        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 border-b border-white/20 pb-6 mb-6">
            <div class="flex items-center gap-4">
                <img
                    src="{{ asset('storage/users_avatars/' . $this->job_listing->getCompanyLogoAttribute()) }}"
                    class="lg:w-16 lg:h-16 md:w-14 md:h-14 sm:w-12 sm:h-12 w-10 h-10 rounded-2xl flex items-center justify-center  font-bold text-2xl shadow-lg"
                />
                <div>
                    <h1 class="text-xl md:text-2xl lg:text-3xl font-bold text-white">{{ $this->job_listing->experience }}: {{ $this->job_listing->getStackNameAttribute() }}</h1>
                    <p class="text-gray-300 text-sm sm:text-base font-medium">{{ $this->job_listing->getCompanyNameAttribute() }}</p>
                </div>
            </div>
            <div class="text-right">
                <div class="text-white text-base sm:text-lg md:text-xl font-semibold">${{ $this->job_listing->salary }}</div>
                <div class="text-gray-300 text-sm">{{ $this->job_listing->location }}</div>
            </div>
        </div>

        <div class="space-y-6">
            <div>
                <h2 class="text-xl font-semibold text-lime-400 mb-2">Job Stack</h2>
                <p class="text-gray-300 md:text-lg text-base font-semibold leading-relaxed">
                    {{ $this->job_listing->getStackNameAttribute() }}
                </p>
            </div>

            <div>
                <h2 class="text-xl font-semibold text-lime-400 mb-2">Job Level</h2>
                <p class="text-gray-300 md:text-lg text-base font-semibold leading-relaxed">
                    {{ $this->job_listing->experience }}
                </p>
            </div>

            <div>
                <h2 class="text-xl font-semibold text-lime-400 mb-2">Job Description</h2>
                <p class="text-gray-300 md:text-lg text-base leading-relaxed">
                    {{ $this->job_listing->description }}
                </p>
            </div>

            <div>
                <h2 class="text-xl font-semibold text-lime-400 mb-2">Required Technologies</h2>
                <div
                    class="rounded-xl py-2 px-5 text-sm min-w-[25px] gap-5 font-semibold flex items-center justify-center flex-wrap transition text-white relative overflow-hidden"
                >
                    @foreach($this->job_listing->technologies as $technology)
                        <div class="relative z-10 flex items-center bg-white/20 px-4 py-3 rounded-xl mb-2 transition-all duration-200 w-fit">
                            @if($technology->icon)
                                <img src="{{ asset('storage/technologies_icons/' . $technology->icon) }}" alt="{{ $technology->name }}" class="min-w-5 min-h-5 max-w-6 max-h-6 mr-2">
                            @endif

                            <span>{{ $technology->name }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            @can('view-job-applicants', $job_listing)
                <div x-data="{ showApplicants: true }">
                <div class="flex items-center mb-2 gap-2 cursor-pointer" @click="showApplicants = !showApplicants">
                    <h2 class="text-xl font-semibold text-lime-400">Applicants</h2>
                    <svg x-show="!showApplicants" class="w-5 h-5 text-bold text-lime-400 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                    <svg x-show="showApplicants" class="w-5 h-5 text-bold  text-lime-400 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                    </svg>
                </div>
                <div
                    x-show="showApplicants"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-95"
                >
                    <livewire:job-applicants :job_listing="$job_listing"/>
                </div>
            </div>
            @endcan

            <div class="text-sm text-gray-300 pt-4 border-t border-white/20">
                 {{ $this->job_listing->getPostedTimeAttribute() }}
            </div>

        </div>

        <div
            class="mt-10 flex flex-col sm:flex-row gap-4 sm:items-center"
        >

            @can('access-admin-panel')

                @if($this->job_listing->status === 'Pending')

                    <button
                        wire:click="acceptJob"
                        wire:loading.attr="disabled"
                        wire:target="acceptJob, rejectJob"
                        class="flex-1 px-6 py-3 bg-blue-600 hover:bg-blue-700 transition-all rounded-xl text-white md:text-lg text-base font-semibold shadow-xl cursor-pointer disabled:cursor-not-allowed disabled:opacity-50"
                    >
                        Accept Job
                    </button>

                    <button
                        @click="modalReject = true"
                        wire:loading.attr="disabled"
                        wire:target="acceptJob, rejectJob"
                        class="flex-1 px-6 py-3 bg-red-600 hover:bg-red-700 transition-all rounded-xl text-white md:text-lg text-base font-semibold shadow-xl cursor-pointer disabled:cursor-not-allowed disabled:opacity-50"
                    >
                        Reject Job
                    </button>

                @elseif($this->job_listing->status === 'Rejected')
                    <span class="text-red-600 text-xl font-semibold w-full text-center">This job was rejected.</span>
                @elseif($this->job_listing->is_disclosed)
                    <span class="text-red-600 text-xl font-semibold w-full text-center">This job was disclosed.</span>

                @elseif($this->job_listing->status === 'Accepted')
                    <span class="text-green-600 text-xl font-semibold w-full text-center">This job was accepted.</span>
                @endif


            @endcan

            @can('access-developer-dashboard')
                @if($this->job_listing->is_disclosed)
                    <span class="text-red-600 text-xl font-semibold w-full text-center">This job was disclosed.</span>
                        @if($this->hasUserApplied())
                            <button
                                @class([
                                    'flex-1 px-6 py-3 rounded-xl text-white md:text-lg text-base font-semibold shadow-xl cursor-not-allowed',
                                    'bg-green-600' => $this->isUserAccepted(),
                                    'bg-red-600' => $this->isUserRejected(),
                                ])
                            >
                                {{ $this->isUserAccepted() ? 'Accepted. The recruiter should reach you out soon...'
                                    : 'Rejected'
                                }}
                            </button>
                        @endif
                @else
                    @if($this->job_listing->status === 'Accepted')
                        @if($this->hasUserApplied())
                            <button
                                @class([
                                    'flex-1 bg-amber-600 px-6 py-3 rounded-xl text-white md:text-lg text-base font-semibold shadow-xl cursor-not-allowed',
                                    'bg-red-600' => $this->isUserRejected(),
                                ])
                            >
                                {{ $this->isUserRejected() ? 'Rejected'
                                    : 'Applied. Pending Application...'
                                }}
                            </button>
                        @else
                            <button
                                wire:click="applyForJob"
                                wire:loading.attr="disabled"
                                wire:target="applyForJob"
                                class="flex-1 px-6 py-3 bg-[#19468f] hover:bg-lime-600 transition-all rounded-xl text-white md:text-lg text-base font-semibold shadow-xl cursor-pointer disabled:cursor-not-allowed disabled:opacity-50"
                            >
                                Apply
                            </button>
                        @endif
                    @endif
                @endif
            @endcan

            @can('manage-job-applicants', $this->job_listing)
                @if($this->job_listing->status === 'Pending')
                    <p class="text-amber-600 text-xl font-semibold w-full text-center">The job is yet to be approved by an admin.</p>
                @elseif($this->job_listing->status === 'Rejected')
                    <span class="text-red-600 text-xl font-semibold w-full text-center">This job has been rejected by an admin. An email was sent including the problem behind rejecting it.</span>
                @elseif(!$this->job_listing->is_disclosed)
                    <button
                        @click="modalDisclose = true"
                        class="flex-1 px-6 py-3 bg-red-600 hover:bg-red-700 transition-all rounded-xl text-white md:text-lg text-base font-semibold shadow-xl cursor-pointer"
                    >
                        Disclose Job
                    </button>
                @else
                    <span class="text-red-600 text-xl font-semibold w-full text-center">This job is disclosed.</span>
                @endif
            @endcan


            @if(!$this->job_listing->is_disclosed && $this->job_listing->status === 'Accepted')
                <livewire:share-button />
            @endif
        </div>

        <div
            x-show="modalReject || modalDisclose"
            x-transition.opacity
            x-cloak
            class="fixed inset-0 bg-white/30 backdrop-blur-md z-50 rounded-2xl"
        ></div>

        <div
            x-show="modalReject"
            x-cloak
            x-transition
            class="overflow-y-auto overflow-x-hidden fixed z-50 flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
        >
            <div class="relative p-4 w-full max-w-md max-h-full">
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


                        <h3 class="mb-5 text-lg font-semibold text-[#0D1B2A]">Are you sure you want to reject this job post?</h3>

                        <div class="mb-7">
                            <label class="block text-xs md:text-sm mb-1 text-red-500 text-left font-semibold">Rejection Message:</label>
                            <input
                                wire:model.live="rejection_message"
                                type="text"
                                class="w-full bg-black/20 border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-500"
                            />
                        </div>


                        <button
                            type="button"
                            @disabled($rejection_message === '')
                            @click="$wire.rejectJob; modalReject = false"
                            class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 cursor-pointer focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center disabled:opacity-50 disabled:cursor-not-allowed"
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

        <div
            x-show="modalDisclose"
            x-cloak
            x-transition
            class="overflow-y-auto overflow-x-hidden fixed z-50 flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
        >
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow-sm">
                    <button
                        type="button"
                        @click="modalDisclose = false"
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

                        <h3 class="mb-5 text-lg font-semibold text-[#0D1B2A]">Are you sure you want to disclose this job post?</h3>
                        <p class="mb-5 text-gray-500">Disclosing a job post will make it invisible to all users, including developers.</p>
                        <button
                            type="button"
                            @click="$wire.discloseJob; modalDisclose = false"
                            class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 cursor-pointer focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center"
                        >
                            Yes, I'm sure
                        </button>

                        <button
                            type="button"
                            @click="modalDisclose = false"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-[#0D1B2A] cursor-pointer focus:outline-none bg-white hover:bg-gray-200 rounded-lg border border-gray-200 focus:z-10 focus:ring-4 focus:ring-gray-100"
                        >
                            No, cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
