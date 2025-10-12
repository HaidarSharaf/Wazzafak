<div class="min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-8">
            <h1 class="text-4xl font-bold text-white text-center">Admin Dashboard</h1>
            <p class="text-2xl font-semibold text-white mt-2 text-center">Welcome back! Here's what's happening with Wazzafak today.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white/10 hover:bg-white/20 backdrop-blur-lg border border-white/20 rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xl text-white font-bold">Total Users</p>
                        <p class="text-3xl font-bold text-white mt-2">{{ number_format($overviewStats['total_users']) }}</p>
                        <p class="text-sm text-gray-500 mt-1">
                            <span class="text-blue-800 font-semibold">{{ $overviewStats['total_developers'] }} Developers</span> |
                            <span class="text-blue-800 font-semibold">{{ $overviewStats['total_recruiters'] }} Recruiters</span>
                        </p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white/10 hover:bg-white/20 backdrop-blur-lg border border-white/20 rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xl text-white font-bold">Total Jobs</p>
                        <p class="text-3xl font-bold text-white mt-2">{{ number_format($overviewStats['total_jobs']) }}</p>
                        <p class="text-sm text-gray-500 mt-1">
                            <span class="text-green-800 font-semibold">{{ $overviewStats['active_jobs'] }} Active</span>
                        </p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white/10 hover:bg-white/20 backdrop-blur-lg border border-white/20 rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xl text-white font-bold">Applications</p>
                        <p class="text-3xl font-bold text-white mt-2">{{ number_format($overviewStats['total_applications']) }}</p>
                        <p class="text-sm text-gray-500 mt-1">
                            <span class="text-amber-600 font-semibold">{{ $overviewStats['pending_applications'] }} Pending</span>
                        </p>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-full">
                        <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white/10 hover:bg-white/20 backdrop-blur-lg border border-white/20 rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xl text-white font-bold">Pending Jobs</p>
                        <p class="text-3xl font-bold text-white mt-2">{{ number_format($overviewStats['pending_jobs']) }}</p>
                        <p class="text-sm text-gray-500 mt-1">
                            <span class="text-orange-600 font-semibold">Needs Review</span>
                        </p>
                    </div>
                    <div class="bg-orange-100 p-3 rounded-full">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <div class="p-6 bg-white/10 hover:bg-white/20 backdrop-blur-lg border border-white/20 rounded-2xl">
                <h2 class="text-xl font-bold text-white mb-6 text-center">Job Statistics</h2>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-white font-semibold">Total Jobs:</span>
                        <span class="font-semibold text-blue-800">{{ $jobStats['total'] }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-white font-semibold">Accepted:</span>
                        <span class="font-semibold text-green-600">{{ $jobStats['accepted'] }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-white font-semibold">Rejected:</span>
                        <span class="font-semibold text-red-600">{{ $jobStats['rejected'] }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-white font-semibold">Pending:</span>
                        <span class="font-semibold text-yellow-600">{{ $jobStats['pending'] }}</span>
                    </div>
                    <div class="pt-3 border-t border-white">
                        <div class="flex justify-between items-center">
                            <span class="text-white font-semibold">Acceptance Rate:</span>
                            <span class="font-semibold text-blue-600">{{ $jobStats['acceptance_rate'] }}%</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-white/10 hover:bg-white/20 backdrop-blur-lg border border-white/20 rounded-2xl">
                <h2 class="text-xl font-bold text-white mb-6 text-center">Application Statistics</h2>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-white font-semibold">Total Applications:</span>
                        <span class="font-semibold text-blue-800">{{ $applicationStats['total'] }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-white font-semibold">Accepted:</span>
                        <span class="font-semibold text-green-600">{{ $applicationStats['accepted'] }}</span>
                    </div>
                    <div class="flex justify-between items-center"><span class="text-white font-semibold">Rejected:</span>
                        <span class="font-semibold text-red-600">{{ $applicationStats['rejected'] }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-white font-semibold">Pending:</span>
                        <span class="font-semibold text-yellow-600">{{ $applicationStats['pending'] }}</span>
                    </div>
                    <div class="pt-3 border-t border-white">
                        <div class="flex justify-between items-center">
                            <span class="text-white font-semibold">Success Rate:</span>
                            <span class="font-semibold text-blue-600">{{ $applicationStats['success_rate'] }}%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl p-6 mb-8">
            <h2 class="text-xl font-semibold text-white mb-4 text-center">Top 10 Technologies in Demand</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($topTechnologies as $index => $tech)
                    <div class="flex items-center justify-between p-4 bg-white/10 rounded-lg hover:bg-white/15 transition">
                        <div class="flex items-center gap-3">
                            <span class="text-lg font-bold text-white w-6">{{ $index + 1 }}</span>
                            @if($tech->icon)
                                <img src="{{ asset('storage/technologies_icons/' . $tech->icon) }}" alt="{{ $tech->name }}" class="w-6 h-6">
                            @endif
                            <span class="font-semibold text-gray-900">{{ $tech->name }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl p-6 mb-8">
            <h2 class="text-xl font-semibold text-white mb-4 text-center">Top Stacks In Demand</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($topStacks as $index => $stack)
                    <div class="flex items-center justify-between p-4 bg-white/10 rounded-lg hover:bg-white/15 transition">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl font-bold text-white">{{ $index + 1 }}</span>
                            <div>
                                <p class="font-semibold text-gray-900">{{ $stack['name'] }}</p>
                                <p class="text-sm text-white font-semibold">{{ $stack['jobs_count'] }} {{Str::plural('job', $stack['jobs_count'])}} | Average salary: ${{ number_format($stack['avg_salary']) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
