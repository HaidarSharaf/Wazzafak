<div class="w-full">
    <div class="grid grid-cols-2 gap-8">
        <div class="col-span-2 space-y-6">
            <div class="bg-white rounded-lg shadow-sm">
                <div class="py-4 px-6 border-b border-gray-200 flex justify-between items-center">
                    <div>
                        <h3 class="md:text-2xl text-xl font-bold text-[#19468f]">Recent Applications</h3>
                        <p class="md:text-base text-sm text-lime-600 mt-1">New candidates for your open positions</p>
                    </div>
                    <a
                        wire:navigate
                        href=""
                        class="text-[#19468f] hover:text-lime-600 font-semibold sm:text-base text-sm"
                    >
                        View All
                    </a>
                </div>
                <div class="divide-y divide-gray-200">
                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center flex-1">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold mr-4">
                                    JS
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center mb-1">
                                        <a
                                            href=""
                                            wire:navigate
                                            class="md:text-lg text-base font-semibold text-[#19468f] mr-2"
                                        >
                                            John Smith
                                        </a>
                                    </div>
                                    <p class="text-gray-600 md:text-base sm:text-sm text-xs mb-2">Applied for: Senior React Developer</p>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 ml-4">
                                <button class="bg-[#19468f] text-white md:px-4 py-2 px-2 rounded-lg hover:bg-lime-600 transition sm:text-base text-sm cursor-pointer">
                                    View Profile
                                </button>
                                <div class="flex gap-2">
                                    <button class="bg-green-500 text-white md:px-3 px-1 py-1  rounded sm:text-sm text-sm hover:bg-green-600 transition cursor-pointer">
                                        ✓ Accept
                                    </button>
                                    <button class="bg-red-500 text-white md:px-3 px-1 py-1 rounded sm:text-sm text-sm hover:bg-red-600 transition cursor-pointer">
                                        ✗ Reject
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Job Performance -->
            <div class="bg-white rounded-lg shadow-sm">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-2xl font-bold text-[#19468f]">Job Performance</h3>
                    <p class="text-base text-lime-600 mt-1">Your most active job postings this week</p>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex-1">

                                <h4 class="font-semibold text-[#19468f]">Senior React Developer</h4>
                                <p class="text-sm text-gray-600">Posted 5 days ago</p>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-[#19468f]">47</p>
                                <p class="text-sm text-gray-600">Applications</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
