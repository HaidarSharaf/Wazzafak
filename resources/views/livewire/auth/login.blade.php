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
                <div class="flex items-center mt-1">
                    <label class="inline-flex items-center cursor-pointer">
                        <input
                            wire:model="remember"
                            type="checkbox"
                            class="sr-only peer"
                        >
                        <div class="relative w-11 h-6 bg-white peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-gray-200 after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-gray-200 after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        <span class="md:ml-3 ml-1 block font-semibold md:text-base sm:text-sm text-xs text-white">Remember me</span>
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
                    wire:loading.class="pointer-events-none"
                    wire:target="login"
                    class="w-full bg-[#1750b6] hover:bg-lime-600 transition text-white md:text-base text-sm font-semibold cursor-pointer py-3 px-6 rounded-xl shadow-lg !mt-3 disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    <div
                        wire:loading
                        wire:target="login"
                        class="animate-spin inline-block size-5 border-3 mt-1 border-current border-t-transparent text-white rounded-full" role="status" aria-label="loading"
                    >
                        <span class="sr-only">Loading...</span>
                    </div>

                    <span
                        wire:loading.remove
                        wire:target="login"
                    >
                        Log In
                    </span>
                </button>
            </div>

            <div class="mt-4 flex justify-center">
                <p class="text-sm text-white">
                    Don't have an account? &nbsp;
                    <a wire:navigate href="{{ route('register') }}" class="text-[#19468f] hover:underline font-bold">Register here.</a>
                </p>
            </div>
        </form>
    </div>

</div>
