<div class="w-full">

    <div class="max-w-3xl mx-auto bg-white/10 backdrop-blur-xl border border-white/20 p-8 rounded-3xl shadow-xl">
        <h2 class="md:text-3xl sm:text-2xl text-xl text-center font-bold mb-6 text-white">Email Verification</h2>
        <h2 class="md:text-2xl sm:text-xl text-lg text-center font-bold mb-6 text-white">
            An OTP code {{ $send ? 'was' : 'will be' }} sent to your email address:
            <span class="text-[#19468f]">{{$this->email}}</span>
        </h2>

        @if(!$send)
            <div class="mt-6 text-center">
                <button
                    wire:click="sendOtp"
                    wire:loading.class="pointer-events-none"
                    wire:loading.attr="disabled"
                    wire:target="sendOtp"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform -translate-y-4"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-4"
                    class="w-full bg-[#1750b6] hover:bg-lime-600 transition text-white md:text-base text-sm font-semibold cursor-pointer py-3 px-6 rounded-xl shadow-lg !mt-3 disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    Send OTP
                </button>
            </div>
        @endif

        @if($send)
            <form class="space-y-6" wire:submit.prevent="verifyOtp">

                <div>
                    <label class="block text-sm md:text-base mb-1 text-white">Enter OTP:</label>
                    <input
                        wire:model="otp"
                        type="password"
                        maxlength="6"
                        class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    <div>
                        @error('otp')
                        <span class="text-[#FF4D30] text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        wire:loading.class="pointer-events-none"
                        wire:target="verifyOtp"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform -translate-y-4"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform -translate-y-4"
                        class="w-full bg-[#1750b6] hover:bg-lime-600 transition text-white md:text-base text-sm font-semibold cursor-pointer py-3 px-6 rounded-xl shadow-lg !mt-3 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        Verify
                    </button>
                </div>

                <div class="mt-4 flex justify-center">
                    <p class="text-sm text-white">
                        Or,
                        <a
                            wire:navigate
                            href=""
                            class="text-[#19468f] hover:underline"
                        >
                            logout from your account.
                        </a>
                    </p>
                </div>
            </form>
        @endif

    </div>

</div>




