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
                    class="rounded-xl py-2 px-5 text-sm min-w-[25px] gap-5 font-semibold flex items-center justify-center transition text-white relative overflow-hidden"
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
                        wire:target="acceptJob"
                        class="flex-1 px-6 py-3 bg-blue-600 hover:bg-blue-700 transition-all rounded-xl text-white md:text-lg text-base font-semibold shadow-xl cursor-pointer disabled:cursor-not-allowed disabled:opacity-50"
                    >
                        Accept Job
                    </button>

                    <button
                        @click="modalReject = true"
                        class="flex-1 px-6 py-3 bg-red-600 hover:bg-red-700 transition-all rounded-xl text-white md:text-lg text-base font-semibold shadow-xl cursor-pointer"
                    >
                        Reject Job
                    </button>

                @elseif($this->job_listing->status === 'Rejected')

                    <span class="text-red-500 font-semibold">This job is rejected</span>

                @elseif(!$this->job_listing->is_disclosed)
                    <button
                        @click="modalDelete = true"
                        class="flex-1 px-6 py-3 bg-red-600 hover:bg-red-700 transition-all rounded-xl text-white md:text-lg text-base font-semibold shadow-xl cursor-pointer"
                    >
                        Delete Job
                    </button>
                @else
                    <span class="text-red-500 font-semibold">This job is disclosed</span>
                @endif

            @endcan

            @can('access-developer-dashboard')
                <button
                    wire:click="applyForJob"
                    wire:loading.attr="disabled"
                    wire:target="applyForJob"
                    class="flex-1 px-6 py-3 bg-[#19468f] hover:bg-lime-600 transition-all rounded-xl text-white md:text-lg text-base font-semibold shadow-xl cursor-pointer disabled:cursor-not-allowed disabled:opacity-50"
                >
                    Apply for this Job
                </button>
            @endcan

            @can('access-recruiter-dashboard')
                @if($this->job_listing->status === 'Pending')
                    <span>The job is yet to be approved by an admin!</span>
                @elseif($this->job_listing->status === 'Rejected')
                    <span class="text-red-500 font-semibold">This job is rejected</span>
                @elseif(!$this->job_listing->is_disclosed)
                    <a
                        href="{{ route('edit-job', $this->job_listing->id) }}"
                        class="flex-1 px-6 py-3 bg-[#19468f] hover:bg-lime-600 transition-all rounded-xl text-white md:text-lg text-base font-semibold shadow-xl cursor-pointer"
                    >
                        Edit Job Details
                    </a>

                    <button
                        @click="modalDisclose = true"
                        class="flex-1 px-6 py-3 bg-red-600 hover:bg-red-700 transition-all rounded-xl text-white md:text-lg text-base font-semibold shadow-xl cursor-pointer"
                    >
                        Disclose Job
                    </button>
                @else
                    <span class="text-red-500 font-semibold">This job is disclosed</span>
                @endif

            @endcan

            @guest
                <a
                    href="{{ route('register') }}"
                    wire:navigate
                    class="flex-1 px-6 py-3 bg-[#19468f] hover:bg-lime-600 text-center transition-all rounded-xl text-white md:text-lg text-base font-semibold shadow-xl cursor-pointer"
                >
                    Register/Login to apply for this Job
                </a>
            @endguest

            @if(!$this->job_listing->is_disclosed && $this->job_listing->status === 'Accepted')
                <button
                    x-data="{ copied: false }"
                    @click="
                            navigator.clipboard.writeText(window.location.href)
                            .then(() => {
                                copied = true;
                                setTimeout(() => copied = false, 5000);
                            })
                    "
                    class="px-6 py-3 bg-white/20 hover:bg-white/30 rounded-xl flex justify-center items-center text-white text-lg shadow-md cursor-pointer"
                >
                    <svg x-show="!copied" class="md:w-6 md:h-6 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"/>
                    </svg>
                    <span x-show="copied" class="text-sm">Copied!</span>
                </button>
            @endif
        </div>

        <div
            x-show="modalReject || modalDelete || modalDisclose"
            x-transition.opacity
            x-cloak
            class="fixed inset-0 bg-white/30 backdrop-blur-md z-50"
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
                                type="text"
                                class="w-full bg-black/20 border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-500"
                            />
                        </div>


                        <button
                            type="button"
                            @click="$wire.rejectJob; modalReject = false"
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

        <div
            x-show="modalDelete"
            x-cloak
            x-transition
            class="overflow-y-auto overflow-x-hidden fixed z-50 flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
        >
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow-sm">
                    <button
                        type="button"
                        @click="modalDelete = false"
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

                        <h3 class="mb-5 text-lg font-semibold text-[#0D1B2A]">Are you sure you want to delete this job post?</h3>

                        <button
                            type="button"
                            @click="$wire.deleteJob; modalDelete = false"
                            class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 cursor-pointer focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center"
                        >
                            Yes, I'm sure
                        </button>

                        <button
                            type="button"
                            @click="modalDelete = false"
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

                        <h3 class="mb-5 text-lg font-semibold text-[#0D1B2A]">Are you sure you want to delete this job post?</h3>
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
