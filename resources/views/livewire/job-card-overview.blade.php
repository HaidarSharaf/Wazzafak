<div
    class="bg-white/10 backdrop-blur-xl rounded-3xl p-6 border border-white/20 hover:bg-white/20 transition-all duration-300"
>
    <a
        wire:navigate
        href="{{ $admin_page ? route('admin.job.manage', $job_listing->id) : route('job-listing', $job_listing->id) }}"
    >
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6">

            <div class="flex items-start gap-4">
                <img
                    src="{{ asset('storage/users_avatars/' . $job_listing->getCompanyLogoAttribute()) }}"
                    class="lg:w-14 lg:h-14 md:w-12 md:h-12 sm:w-10 sm:h-10 w-8 h-8 rounded-2xl flex items-center justify-center font-bold text-2xl shadow-lg"
                />
                <div>
                    <h2 class="text-xl font-semibold text-white">{{ $job_listing->experience }}: {{ $job_listing->getStackNameAttribute() }}</h2>
                    <p class="text-gray-300 text-sm">{{ $job_listing->getCompanyNameAttribute() }}</p>
                    <p class="text-gray-300 text-xs mt-1">{{ $job_listing->getPostedTimeAttribute() }}</p>
                </div>
            </div>


            <div class="text-right space-y-2">
                @if($job_listing->is_disclosed)
                    <span
                        class="bg-red-500 md:px-5 md:py-3 md:text-base px-3 py-1 text-sm font-semibold rounded-lg text-white"
                    >
                        Disclosed
                    </span>
                @elseif($user->role === 'developer')
                    @if($this->hasUserApplied())
                        <span
                            @php
                                $status = $user->getApplicationStatus($job_listing->id);
                            @endphp
                            @class([
                                'bg-green-500' => $status === 'Accepted',
                                'bg-red-500' => $status === 'Rejected',
                                'bg-amber-500' => $status === 'Pending',
                                'md:px-5 md:py-3 md:text-base px-3 py-1 text-sm font-semibold rounded-lg text-white',
                            ])
                        >
                            Application {{ $status }}
                        </span>
                    @else
                        <span
                            class="bg-blue-500 md:px-5 md:py-3 md:text-base px-3 py-1 text-sm font-semibold rounded-lg text-white"
                        >
                            View Details
                        </span>
                    @endif
                @else
                    <span
                        @class([
                            'bg-green-500' => $job_listing->status === 'Accepted',
                            'bg-red-500' => $job_listing->status === 'Rejected',
                            'bg-amber-500' => $job_listing->status === 'Pending',
                            'md:px-5 md:py-3 md:text-base px-3 py-1 text-sm font-semibold rounded-lg text-white',
                        ])
                    >
                        {{ $job_listing->status }}
                    </span>
                @endif

            </div>
        </div>
    </a>
</div>
