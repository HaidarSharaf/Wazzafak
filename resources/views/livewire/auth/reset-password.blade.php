<div class="w-full">

    <div class="max-w-3xl mx-auto bg-white/10 backdrop-blur-xl border border-white/20 p-8 rounded-3xl shadow-xl">
        <h2 class="md:text-3xl sm:text-2xl text-xl text-center font-bold mb-6 text-white">Reset Password</h2>

        <form class="space-y-6" wire:submit.prevent="resetPassword">

            <div>
                <label class="block text-sm md:text-base mb-1 text-white">Email:</label>
                <input
                    wire:model="email"
                    type="email"
                    class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    readonly
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

            <div>
                <label class="block text-sm md:text-base mb-1 text-white">Confirm Password:</label>
                <input
                    wire:model="password_confirmation"
                    type="password"
                    class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
            </div>

            <div>
                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    wire:loading.class="pointer-events-none"
                    wire:target="resetPassword"
                    class="w-full bg-[#1750b6] hover:bg-lime-600 transition text-white md:text-base text-sm font-semibold cursor-pointer py-3 px-6 rounded-xl shadow-lg !mt-3 disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    Reset Password
                </button>
            </div>
        </form>
    </div>

</div>




