<div class="w-full flex flex-col items-center justify-center gap-4 p-4">
    <h1 class="text-3xl text-center font-bold text-white mt-10">Manage Job Posts</h1>

    <div class="my-4">
        {{ $pending_jobs->links() }}
    </div>


    <div class="w-full flex flex-col gap-5 mt-10">
        @forelse($pending_jobs as $job)
            <livewire:job-card-overview :job_listing="$job" :admin_page="true"/>
        @empty
            <div class="text-center text-white mt-20">
                <p class="md:text-2xl text-xl font-semibold !mb-7">No pending job posts found!</p>
            </div>
        @endforelse
    </div>


    <div class="my-4">
        {{ $pending_jobs->links() }}
    </div>
</div>
