<div
    class="bg-white/10 backdrop-blur-xl rounded-3xl p-6 border border-white/20 hover:bg-white/20 transition-all duration-300"
>
    <a
        wire:navigate
        href="{{ route('job-listing', $job->id) }}"
        class="flex items-center justify-between w-full"
    >
        <div class="flex-1">
            <h4 class="font-bold lg:text-xl md:text-lg text-base text-white">{{ $job->experience }}: {{ $job->getStackNameAttribute() }}</h4>
            <p class="sm:text-sm text-xs text-gray-300">{{ $job->getPostedTimeAttribute() }}</p>
        </div>
        <div class="text-right">
            <p class="sm:text-2xl text-lg font-bold text-white">{{ $job->getApplicationCountAttribute() }}</p>
            <p class="sm:text-sm text-xs text-gray-300">{{ Str::plural('Application', $job->getApplicationCountAttribute()) }}</p>
        </div>
    </a>
</div>
