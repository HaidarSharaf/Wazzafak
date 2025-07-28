<div class="w-full">

    <section class="flex flex-col md:flex-row items-center justify-between px-10 py-20 bg-black/20 rounded-lg">

        <div class="md:w-1/2 mb-10 md:mb-0">
            <h2 class="text-4xl md:text-5xl font-extrabold leading-tight mb-6">
                We Match Developers with Recruiters Instantly!
            </h2>

            <p
                class="text-lg text-white text-opacity-90 mb-8"
            >
                Wazzafak is the best solution for software developers to find their dream job and for recruiters to hire top tech talents.
            </p>

            <a
                href="{{ route('register') }}"
                wire:navigate
                class="bg-white text-[#142b57] font-bold py-3 px-6 rounded-xl text-lg hover:bg-lime-300 hover:text-blue-800 transition">Get Started</a>
        </div>

        <div class="md:w-1/2">
            <img src="/images/home-photo.png" class="w-full max-w-md mx-auto">
        </div>

    </section>

    <section class="bg-white text-[#19468f] py-16 px-10 my-10 rounded-lg">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl font-bold mb-8 text-center">Why Choose Wazzafak?</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-6 bg-lime-300 rounded-lg shadow-lg text-center hover:scale-105 transition-transform duration-300">
                    <h3 class="text-xl font-semibold mb-4">For Developers</h3>
                    <p class="font-medium">Find your ideal job match based on your skills and preferences.</p>
                </div>

                <div class="p-6 bg-lime-300 rounded-lg shadow-lg text-center hover:scale-105 transition-transform duration-300">
                    <h3 class="text-xl font-semibold mb-4">For Companies</h3>
                    <p class="font-medium">Hire top tech talent quickly and efficiently.</p>
                </div>

                <div class="p-6 bg-lime-300 rounded-lg shadow-lg text-center hover:scale-105 transition-transform duration-300">
                    <h3 class="text-xl font-semibold mb-4">Instant Matching</h3>
                    <p class="font-medium">Get matched with the right candidates or jobs in real-time.</p>
                </div>
            </div>
        </div>
    </section>


    <section class="bg-gradient-to-br from-blue-50 to-indigo-100 py-16 px-10 mt-10 mb-5 rounded-lg">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl font-bold mb-4 text-center text-[#19468f]">How It Works</h2>
            <p class="text-lg font-medium text-center text-[#19468f] mb-12">Get matched with your perfect opportunity or find a talented developer in just 3 simple steps!</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">

                <div class="hidden md:block absolute top-16 left-1/4 w-1/2 h-0.5 bg-gradient-to-r from-[#19468f] to-lime-300"></div>
                <div class="hidden md:block absolute top-16 right-0 w-1/3 h-0.5 bg-gradient-to-r from-lime-300 to-green-400"></div>


                <div class="relative text-center group">
                    <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2 2xl:min-h-[270px]">

                        <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 w-8 h-8 bg-[#19468f] text-white rounded-full flex items-center justify-center font-bold text-sm">1</div>


                        <div class="w-16 h-16 bg-gradient-to-br from-[#19468f] to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>

                        <h3 class="text-xl font-bold mb-3 text-[#19468f]">Create an Account</h3>
                        <p class="text-[#19468f] font-medium leading-relaxed">Sign up and build your professional profile. You will be asked to fill some necessary information</p>
                    </div>
                </div>


                <div class="relative text-center group">
                    <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2 2xl:min-h-[270px]">

                        <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 w-8 h-8 bg-lime-400 text-[#19468f] rounded-full flex items-center justify-center font-bold text-sm">2</div>


                        <div class="w-16 h-16 bg-gradient-to-br from-lime-400 to-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>

                        <h3 class="text-xl font-bold mb-3 text-[#19468f]">Get Matched Instantly</h3>
                        <p class="text-[#19468f] font-medium leading-relaxed">We will analyze your profile and match you with perfect job opportunities or top candidates.</p>
                    </div>
                </div>


                <div class="relative text-center group">
                    <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2 2xl:min-h-[270px]">

                        <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center font-bold text-sm">3</div>


                        <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                            </svg>
                        </div>

                        <h3 class="text-xl font-bold mb-3 text-[#19468f]">Start Your Journey</h3>
                        <p class="text-[#19468f] font-medium leading-relaxed">Recruiters can post jobs, developers can apply for jobs and wait for the recruiters response!</p>
                    </div>
                </div>
            </div>


            <div class="text-center mt-12">
                <a href="{{ route('register') }}"
                   wire:navigate
                   class="inline-flex items-center bg-[#19468f] text-white font-bold py-3 px-8 rounded-xl text-lg hover:bg-lime-500 transition-all duration-300 hover:shadow-lg">
                    Get Started Now
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
                <p class="text-sm text-[#19468f] mt-3">No credit card required • Free for developers and recruiters</p>
            </div>
        </div>
    </section>

</div>
