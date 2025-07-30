<div class="w-full">

    <div class="max-w-3xl mx-auto bg-white/10 backdrop-blur-xl border border-white/20 p-8 rounded-3xl shadow-xl">
        <h2 class="md:text-3xl sm:text-2xl text-xl text-center font-bold mb-6 text-white">Login to your Account</h2>

        <form class="space-y-6" wire:submit.prevent="login">

            <div>
                <label class="block text-sm md:text-base mb-1 text-white">Email:</label>
                <input
                    wire:model="email"
                    type="email"
                    class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
                <div>
                    @error('email')
                        <span class="text-[#FF4D30] text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm md:text-base mb-1 text-white">Password:</label>
                <input
                    wire:model="password"
                    type="password"
                    class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
                <div>
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>


            <div class="flex flex-wrap items-center sm:justify-between justify-center gap-4">
                <div class="flex items-center">
                    <input
                        wire:model="remember"
                        type="checkbox"
                        class="md:h-5 md:w-5 w-4 h-4 accent-[#19468f] border-slate-300 rounded focus:ring-2 focus:ring-[#19468f] focus:outline-none"
                    >
                    <label for="remember-me" class="md:ml-3 ml-1 block font-semibold md:text-base sm:text-sm text-xs text-white">
                        Remember me
                    </label>
                </div>
                <a
                    wire:navigate
                    href="{{ route('forgot-password') }}"
                    class="md:text-base sm:text-sm text-xs font-semibold text-white hover:text-[#19468f] hover:underline"
                >
                    Forgot your password?
                </a>
            </div>

            <div>
                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    wire:target="login"
                    class="w-full bg-[#1750b6] hover:bg-lime-600 transition text-white md:text-base text-sm font-semibold cursor-pointer py-3 px-6 rounded-xl shadow-lg !mt-3 disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    Log In
                </button>
            </div>

            <div class="mt-4 flex justify-center">
                <p class="text-sm text-white">
                    Don't have an account?
                    <a wire:navigate href="{{ route('register') }}" class="text-[#19468f] hover:underline">Register here.</a>
                </p>
            </div>
        </form>
    </div>

</div>
