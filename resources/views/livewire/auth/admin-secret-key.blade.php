<div class="w-full min-h-screen py-12">

    <div class="max-w-3xl mx-auto bg-white/10 backdrop-blur-xl border border-white/20 p-8 rounded-3xl shadow-xl">
        <h2 class="md:text-3xl sm:text-2xl text-xl text-center font-bold mb-4 text-white">
            Admin Verification
        </h2>

        <p class="text-[#19468f] text-center text-base font-semibold leading-6 mb-8">
            Please enter your secret code.
        </p>

        <form wire:submit.prevent="verify" class="space-y-6">

            <div>
                <label class="block text-sm md:text-base mb-1 text-white">Secret Code:</label>
                <input
                    wire:model="secret"
                    type="password"
                    class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
                <div>
                    @error('secret')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div>
                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    wire:loading.class="pointer-events-none"
                    wire:target="verify"
                    class="w-full bg-[#1750b6] hover:bg-lime-600 transition text-white md:text-base text-sm font-semibold cursor-pointer py-3 px-6 rounded-xl shadow-lg !mt-3 disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    <div
                        wire:loading
                        wire:target="verify"
                        class="animate-spin inline-block size-5 border-3 mt-1 border-current border-t-transparent text-white rounded-full"
                        role="status"
                        aria-label="loading"
                    >
                        <span class="sr-only">Verifying...</span>
                    </div>

                    <span
                        wire:loading.remove
                        wire:target="verify"
                    >
                        Verify
                    </span>
                </button>
            </div>

            <div class="mt-4 flex justify-center">
                <p class="text-sm text-white">
                    Not an admin? &nbsp;
                    <a
                        wire:navigate
                        href="{{ route('home') }}"
                        class="text-[#19468f] hover:underline font-bold"
                    >
                        Back to Home
                    </a>
                </p>
            </div>
        </form>
    </div>

</div>
