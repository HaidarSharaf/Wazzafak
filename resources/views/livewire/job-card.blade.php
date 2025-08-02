<div class="w-full">
    <div class="group bg-white/10 backdrop-blur-xl rounded-3xl p-6 border border-white/20 hover:bg-white/20 transition-all duration-500 hover:transform hover:-translate-y-2 hover:shadow-2xl">

        <a
            href="{{ route('job-listing', $this->job_listing->id) }}"
            wire:navigate
            class="flex xl:justify-between justify-start items-start mb-4 gap-2"
        >
            <img
                src="{{ asset('storage/users_avatars/' . $this->job_listing->getCompanyLogoAttribute()) }}"
                class="lg:w-14 lg:h-14 md:w-12 md:h-12 sm:w-10 sm:h-10 w-8 h-8 rounded-2xl flex items-center justify-center font-bold text-2xl shadow-lg"
            />
            <div>
                <h3 class="xl:text-xl md:text-lg text-base font-bold text-white mb-1 group-hover:text-lime-500 transition-colors">{{ $this->job_listing->experience }}: {{ $this->job_listing->getStackNameAttribute() }}</h3>
                <p class="text-gray-300 xl:text-base text-sm font-medium">{{ $this->job_listing->getCompanyNameAttribute() }}</p>
            </div>

        </a>

        <div class="mb-4 mt-2 flex flex-row lg:flex-col xl:flex-row items-center justify-between gap-2">
            <div class="flex items-center gap-2 text-gray-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span class="sm:text-sm text-xs text-gray-300">{{ $this->job_listing->location }}</span>
            </div>
            <span class="text-white sm:text-base text-sm font-semibold">${{ $this->job_listing->salary }}</span>
        </div>

        <div class="space-y-3 my-6">

            <a
                href="{{ route('job-listing', $this->job_listing->id) }}"
                wire:navigate
                class="text-indigo-200 sm:text-base text-sm line-clamp-3"
            >
                {{ Str::limit($this->job_listing->description, 250) }}
            </a>

            <div class="flex flex-wrap gap-2">
                @foreach($this->job_listing->technologies->take(3) as $technology)
                    <div class="relative z-10 flex items-center bg-white/20 px-2 py-1 rounded-xl mb-2 transition-all duration-200 w-fit">
                        @if($technology->icon)
                            <img src="{{ asset('storage/technologies_icons/' . $technology->icon) }}" alt="{{ $technology->name }}" class="min-w-3 min-h-3 max-w-4 max-h-4 mr-2">
                        @endif

                        <span class="text-xs">{{ $technology->name }}</span>
                    </div>
                @endforeach
            </div>
        </div>


        <div class="flex gap-3">
            <button class="flex-1 md:text-base text-sm px-3 py-2 bg-[#19468f] text-white font-semibold rounded-xl hover:bg-lime-600 cursor-pointer transition-all duration-300 shadow-lg hover:shadow-xl">
                Apply Now
            </button>

            @if(!$this->job_listing->is_disclosed && $this->job_listing->status === 'Accepted')
                <livewire:share-button />
            @endif
        </div>

        <div class="mt-4 pt-4 border-t border-white/20">
            <span class="text-gray-300 text-xs">
                {{ $this->job_listing->getPostedTimeAttribute() }}
            </span>
        </div>
    </div>
</div>
