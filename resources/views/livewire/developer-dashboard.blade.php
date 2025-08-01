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

    <div class="grid grid-cols-2 gap-8">
        <div class="col-span-2 space-y-6">
            <div class="bg-white rounded-lg shadow-sm">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-2xl text-center font-semibold text-[#19468f]">Featured Jobs</h3>
                    <p class="text-base text-center text-lime-600 mt-1">Based on your skills and preferences</p>
                </div>
                <div class="divide-y divide-gray-200">
                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">

                                <div class="flex items-center justify-between mb-2 gap-1">
                                    <div class="flex items-center">
                                        <div class="md:w-12 md:h-12 w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold mr-4">
                                            TG
                                        </div>
                                        <div>
                                            <h4 class="md:text-lg text-base font-semibold text-[#19468f]">Senior React Developer</h4>
                                            <p class="text-lime-600 text-sm sm:text-base">TechGlobal Inc.</p>
                                        </div>
                                    </div>

                                    <button class="bg-[#19468f] text-white sm:text-base text-sm px-4 py-2 rounded-lg hover:bg-lime-500 cursor-pointer transition">Apply</button>
                                </div>

                                <p class="text-gray-800 mb-3">Looking for an experienced React developer to join our growing team...</p>
                                <div class="flex flex-wrap gap-2 mb-3">
                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">React</span>
                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">Node.js</span>
                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">TypeScript</span>
                                </div>

                            </div>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            San Francisco, CA • $120k-$150k
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
