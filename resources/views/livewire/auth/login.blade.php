<div class="rounded-2xl bg-white shadow-xl sm:w-[500px] w-[310px]">

    <form wire:submit.prevent="login" class="lg:p-11 p-7 mx-auto">

        <div class="mb-11">
            <h1 class="text-[#19468f] text-center font-manrope text-3xl font-bold leading-10 mb-2">Welcome Back!</h1>
            <p class="text-lime-500 text-center text-base font-medium leading-6">Log In to your account</p>
        </div>

        <div class="space-y-6">
            <div>
                <label class='text-sm text-gray-800 font-medium mb-2 block'>Email Address:</label>
                <input
                    wire:model="email"
                    type="email"
                    class="bg-gray-100 w-full text-sm text-gray-800 px-4 py-3 rounded-md outline-0 border-1 border-gray-600 focus-within:ring-2 focus-within:ring-gray-600 focus:outline-none"
                />
                <div>
                    @error('email')
                    <span class="text-[#FF4D30] text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div>
                <label class='text-sm text-gray-800 font-medium mb-2 block'>Password:</label>
                <input
                    wire:model="password"
                    type="password"
                    class="bg-gray-100 w-full text-sm text-gray-800 px-4 py-3 rounded-md outline-0 border-1 border-gray-500 focus-within:ring-2 focus-within:ring-gray-500 focus:outline-none"
                />
                <div>
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>


            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center">
                    <input
                        wire:model="remember"
                        type="checkbox"
                        class="h-4 w-4 accent-[#19468f] border-slate-300 rounded focus:ring-2 focus:ring-[#19468f] focus:outline-none"
                    >
                    <label for="remember-me" class="ml-3 block font-semibold sm:text-sm text-xs text-gray-800">
                        Remember me
                    </label>
                </div>
                <a
                    wire:navigate
                    href="{{ route('forgot-password') }}"
                    class="text-sm font-semibold text-lime-600 hover:underline"
                >
                    Forgot your password?
                </a>
            </div>
        </div>

        <div class="!mt-10">
            <button
                type="submit"
                wire:loading.attr="disabled"
                wire:target="login"
                class="w-full shadow-xl py-2.5 px-4 text-[15px] flex justify-center items-center font-medium rounded-md text-white bg-[#19468f] hover:bg-blue-700 focus:outline-none cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed"
            >
                   Log In
            </button>
        </div>

        <div class="mt-4 flex justify-center">
            <p class="text-sm text-[#0D1B2A]">
                Don't have an account?
                <a wire:navigate href="{{ route('register') }}" class="text-lime-600 hover:underline">Register here.</a>
            </p>
        </div>
    </form>

</div>
