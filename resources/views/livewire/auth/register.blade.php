<div class="rounded-2xl bg-white shadow-xl sm:w-[600px] w-[310px]">

    <form wire:submit.prevent="register" class="lg:p-11 p-7 mx-auto">

        <div class="mb-11">
            <h1 class="text-[#0D1B2A] text-center font-manrope text-3xl font-bold leading-10 mb-2">Register</h1>
            <p class="text-[#FF4D30] text-center text-base font-medium leading-6">Create a new account</p>
        </div>

        <div class="space-y-6">
            <div>
                <label class='text-sm text-[#0D1B2A] font-medium mb-2 block'>Full Name:</label>
                <input
                    wire:model="name"
                    type="text"
                    class="bg-gray-100 w-full text-sm text-[#0D1B2A] px-4 py-3 rounded-md outline-0 border-1 border-[#0D1B2A] focus-within:ring-2 focus-within:ring-[#0D1B2A] focus:outline-none"
                />
                <div>
                    @error('name')
                    <span class="text-[#FF4D30] text-sm">{{ $message }}</span>
                    @enderror
                </div>
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

        <div class="!mt-10">
            <button
                type="submit"
                wire:loading.attr="disabled"
                wire:target="register"
                class="w-full shadow-xl py-2.5 px-4 text-[15px] flex justify-center items-center font-medium rounded-md text-white bg-[#FF4D30] hover:bg-[#F53003] focus:outline-none cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed"
            >
                Register
            </button>
        </div>

        <div class="mt-4 flex justify-center">
            <p class="text-sm text-[#0D1B2A]">
                Already have an account?
                <a wire:navigate href="{{ route('login') }}" class="text-[#FF4D30] hover:underline">Log In here.</a>
            </p>
        </div>
    </form>

</div>
