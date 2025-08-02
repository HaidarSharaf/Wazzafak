<div class="w-full flex flex-col items-stretch justify-around py-10">

    <h1 class="text-center md:text-4xl text-2xl font-bold text-white mb-16">
        {{ $user->name }}'s Developer Dashboard
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-base font-bold text-[#19468f]">Active Applications</p>
                    <p class="text-3xl font-bold text-lime-500">{{ $active_apps }}</p>
                </div>
                <div class="bg-blue-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-[#19468f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-base font-bold text-[#19468f]">Accepted Applications</p>
                    <p class="text-3xl font-bold text-lime-500">{{ $accepted_apps }}</p>
                </div>
                <div class="bg-green-100 rounded-full p-3">
                    <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M4 12.6111L8.92308 17.5L20 6.5" stroke="#008000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                </div>
            </div>
        </div>

    </div>

    <div class="bg-black/10 rounded-lg shadow-sm grid grid-cols-2 gap-8">
        <div class="col-span-2 space-y-6">
            <div class="p-6">
                <h3 class="text-2xl text-center font-semibold text-white">Featured Jobs</h3>
                <p class="text-base text-center text-lime-400 mt-1">Based on your skills and preferences</p>
            </div>
            <div class="p-2">
                @forelse($featured_jobs as $job)
                    <livewire:job-card-overview :job_listing="$job" />
                @empty
                    <div class="text-center p-4 mb-5">
                        <p class="text-lg font-semibold !mb-4">No opened jobs match your profile.</p>
                        <a
                            wire:navigate
                            href="{{ route('explore-jobs') }}"
                            class="px-5 py-4 md:text-xl text-lg text-white bg-[#19468f] hover:bg-lime-500 rounded-lg transition-colors duration-300 font-semibold !my-7"
                        >
                            Explore All Jobs
                        </a>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</div>
