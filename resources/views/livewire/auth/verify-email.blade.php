<div class="rounded-2xl bg-white shadow-xl sm:w-[500px] w-[310px] p-5">

    <div class="mb-6">
        <h1 class="text-[#0D1B2A] text-center font-manrope text-3xl font-bold leading-10 mb-2">Email Verification</h1>
        <p
            class="text-[#FF4D30] text-center text-base font-medium leading-6"
        >
            An OTP code was sent to your email address:
            <span class="text-[#0D1B2A]">{{$this->email}}</span>
        </p>
    </div>

    <div class="mb-4">
        <label class='text-sm text-[#0D1B2A] font-medium mb-2 block'>Enter OTP:</label>
        <input
            wire:model="otp"
            type="password"
            maxlength="6"
            class="bg-gray-100 w-full text-sm text-[#0D1B2A] px-4 py-3 rounded-md outline-0 border-1 border-[#0D1B2A] focus-within:ring-2 focus-within:ring-[#0D1B2A] focus:outline-none"
        />
        @error('otp') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <button
        type="button"
        wire:click="verifyOtp"
        wire:loading.attr="disabled"
        wire:target="verifyOtp"
        class="w-full shadow-xl py-2.5 px-4 text-[15px] font-medium rounded-md text-white bg-[#FF4D30] hover:bg-[#F53003] focus:outline-none cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed"
    >
        Verify
    </button>


    <div class="mt-3 text-center">

        <a
            href=""
            class="mt-3 text-sm text-[#0D1B2A]"
        >
            Or,
            <span class="text-[#FF4D30] hover:underline cursor-pointer">logout from your account.</span>
        </a>
    </div>

    @if(!$valid)
        <button
            type="button"
            wire:click="sendOtp"
            wire:loading.attr="disabled"
            wire:target="sendOtp"
            class="w-full shadow-xl py-2.5 px-4 text-[15px] font-medium rounded-md text-white bg-[#0D1B2A] hover:bg-slate-800 focus:outline-none cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed"
        >
            Resend OTP
        </button>
    @endif

</div>
