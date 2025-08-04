<div class="w-full">

    <div class="max-w-3xl mx-auto bg-white/10 backdrop-blur-xl border border-white/20 p-8 rounded-3xl shadow-xl">
        <h2 class="md:text-3xl sm:text-2xl text-xl text-center font-bold mb-6 text-white">Email Verification</h2>
        <h2 class="md:text-2xl sm:text-xl text-lg text-center font-bold mb-6 text-white">
            An OTP code was sent to your email address:
            <span class="text-[#19468f]">{{$this->email}}</span>
        </h2>

        <form class="space-y-6" wire:submit.prevent="verifyOTP">

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
    </div>

</div>




