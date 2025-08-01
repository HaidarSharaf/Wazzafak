<div class="w-full space-y-10">

    @guest
        <livewire:guest-dashboard />
    @endguest

    @auth
        @if($user->role === 'developer')
            <livewire:developer-dashboard />
        @elseif($user->role === 'recruiter')
            <livewire:recruiter-dashboard />
        @endif
    @endauth

    <livewire:home-stats />

</div>
