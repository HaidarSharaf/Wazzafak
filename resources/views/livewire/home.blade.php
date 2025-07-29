<div class="w-full space-y-10">

    <livewire:guest-dashboard />

    @auth

        <livewire:developer-dashboard />
        <livewire:recruiter-dashboard />
    @endauth

    <livewire:home-stats />

</div>
