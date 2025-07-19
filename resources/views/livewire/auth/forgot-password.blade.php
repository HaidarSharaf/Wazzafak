<div class="rounded-2xl bg-white shadow-xl sm:w-[500px] w-[310px]">

    <form wire:submit.prevent="sendPasswordResetLink" class="lg:p-11 p-7 mx-auto">

        <div class="mb-11">
            <h1 class="text-[#0D1B2A] text-center font-manrope text-3xl font-bold leading-10 mb-2">Forgot Password</h1>
            <p class="text-[#FF4D30] text-center text-base font-medium leading-6">Enter your email to receive a password reset link</p>
        </div>

        <div>
            <label class='text-sm text-[#0D1B2A] font-medium mb-2 block'>Email Address:</label>
            <input
                wire:model="email"
                type="email"
                class="bg-gray-100 w-full text-sm text-[#0D1B2A] px-4 py-3 rounded-md outline-0 border-1 border-[#0D1B2A] focus-within:ring-2 focus-within:ring-[#0D1B2A] focus:outline-none"
            />
            <div>
                @error('email')
                <span class="text-[#FF4D30] text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="!mt-10">
            <button
                type="submit"
                wire:loading.attr="disabled"
                wire:target="sendPasswordResetLink"
                class="w-full shadow-xl py-2.5 px-4 text-[15px] flex justify-center items-center font-medium rounded-md text-white bg-[#FF4D30] hover:bg-[#F53003] focus:outline-none cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed"
            >
                Email Password Reset Link
            </button>
        </div>

        <div class="mt-4 flex justify-center">
            <p class="text-sm text-[#0D1B2A]">
                Or, return to
                <a wire:navigate href="{{ route('login') }}" class="text-[#FF4D30] hover:underline">Log In.</a>
            </p>
        </div>
    </form>
</div>
