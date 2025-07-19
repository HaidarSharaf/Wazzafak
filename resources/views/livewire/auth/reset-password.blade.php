<div class="rounded-2xl bg-white shadow-xl sm:w-[500px] w-[310px]">

    <form wire:submit.prevent="resetPassword" class="lg:p-11 p-7 mx-auto">

        <div class="mb-11">
            <h1 class="text-[#0D1B2A] text-center font-manrope text-3xl font-bold leading-10 mb-2">Reset Password</h1>
            <p class="text-[#FF4D30] text-center text-base font-medium leading-6">Please enter your new password below</p>
        </div>

        <div class="space-y-6">
            <div>
                <label class='text-sm text-[#0D1B2A] font-medium mb-2 block'>Email Address:</label>
                <input
                    wire:model="email"
                    type="email"
                    class="bg-gray-200 w-full text-sm text-[#0D1B2A] px-4 py-3 rounded-md outline-0 border-1 cursor-not-allowed border-[#0D1B2A]" readonly
                />
                <div>
                    @error('email')
                    <span class="text-[#FF4D30] text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div>
                <label class='text-sm text-[#0D1B2A] font-medium mb-2 block'>Password:</label>
                <input
                    wire:model="password"
                    type="password"
                    class="bg-gray-100 w-full text-sm text-[#0D1B2A] px-4 py-3 rounded-md outline-0 border-1 border-[#0D1B2A] focus-within:ring-2 focus-within:ring-[#0D1B2A] focus:outline-none"
                />
                <div>
                    @error('password')
                    <span class="text-[#FF4D30] text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div>
                <label class='text-sm text-[#0D1B2A] font-medium mb-2 block'>Confirm Password:</label>
                <input
                    wire:model="password_confirmation"
                    type="password"
                    class="bg-gray-100 w-full text-sm text-[#0D1B2A] px-4 py-3 rounded-md outline-0 border-1 border-[#0D1B2A] focus-within:ring-2 focus-within:ring-[#0D1B2A] focus:outline-none"
                />
            </div>

        </div>

        <div class="!mt-12">
            <button
                type="submit"
                wire:loading.attr="disabled"
                wire:target="resetPassword"
                class="w-full shadow-xl py-2.5 px-4 text-[15px] flex justify-center items-center font-medium rounded-md text-white bg-[#FF4D30] hover:bg-[#F53003] focus:outline-none cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed"
            >
                Reset Password
            </button>
        </div>
    </form>

</div>
