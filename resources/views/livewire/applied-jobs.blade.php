<div class="w-full space-y-3">
            <h1 class="lg:text-3xl md:text-2xl text-xl font-bold text-white mb-8 ml-2">My Applications</h1>

            <div class="space-y-6">
                @forelse($applied_jobs as $job_listing)
                    <livewire:job-card-overview :job_listing="$job_listing" />
                @empty
                    <div class="text-center text-white mt-20">
                        <p class="md:text-2xl text-xl font-semibold !mb-7">You haven't applied to any job yet!</p>
                        <a
                            wire:navigate
                            href="{{ route('explore-jobs') }}"
                            class="p-4 !mt-4 bg-[#19468f] hover:bg-lime-600 text-base font-medium rounded-xl"
                        >
                            Explore jobs
                        </a>
                    </div>
                @endforelse
            </div>

    </div>


