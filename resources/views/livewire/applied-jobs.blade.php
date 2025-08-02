<div class="w-full space-y-3">
    <h1 class="lg:text-3xl md:text-2xl text-xl font-bold text-white mb-8 ml-2">My Applications</h1>

    <div class="flex items-center justify-end gap-4 mb-10">

        <div class="w-48">
            <label class="block text-white font-medium">Status:</label>
            <select
                wire:model.live="status"
                class="w-full px-4 py-3 font-semibold text-gray-900 bg-white/90 rounded-xl border-0 focus:bg-white focus:ring-4 focus:ring-blue-500/30 transition-all"
            >
                <option value="" selected>Any</option>
                @foreach($statuses as $status)
                    <option
                        value="{{ $status }}"
                    >
                        {{ $status }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="w-48">
            <label class="text-white font-medium">Application Date:</label>
            <select
                wire:model.live="app_date"
                class="w-full px-4 py-3 font-semibold text-gray-900 bg-white/90 rounded-xl border-0 focus:bg-white focus:ring-4 focus:ring-blue-500/30 transition-all"
            >
                <option value="" selected>Any</option>
                <option value="this_week">This Week</option>
                <option value="this_month">This Month</option>
            </select>
        </div>

        <div class="w-48">
            <label class="block text-white font-medium">&nbsp;</label>
            <button
                wire:click="resetFilters"
                class="w-full px-4 py-3 font-semibold cursor-pointer text-white bg-red-500 hover:bg-red-600 rounded-xl transition-all"
            >
                Reset Filters
            </button>
        </div>
    </div>

    <div
        class="space-y-6"
        wire:loading.class="opacity-50 pointer-events-none"
    >
        @forelse($applied_jobs as $job_listing)
            <livewire:job-card-overview :job_listing="$job_listing" />
        @empty
            <div class="text-center text-white mt-20">
                <p class="md:text-2xl text-xl font-semibold !mb-7">No applications found!</p>
            </div>
        @endforelse
    </div>

    <div
        wire:loading
        class="w-full flex justify-center text-white py-10"
    >
        <div class="w-12 h-12 border-4 border-blue-900 border-t-transparent rounded-full animate-spin mx-auto"></div>
    </div>

</div>


