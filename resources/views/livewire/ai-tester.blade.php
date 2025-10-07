<div class="w-full" x-data="{ analyzed: @entangle('analyzed') }">
    <div class="max-w-3xl mx-auto bg-white/10 backdrop-blur-xl border border-white/20 p-8 rounded-3xl shadow-xl">

        <h2 class="md:text-3xl sm:text-2xl text-xl text-center font-bold mb-6 text-white">AI Resume Analyzer</h2>

        @if($errorMessage)
            <div class="mb-4 p-4 bg-red-500/20 border border-red-500/50 rounded-xl">
                <p class="text-white text-sm">{{ $errorMessage }}</p>
            </div>
        @endif

        <form wire:submit.prevent="analyzeCV">
            <div>
                <label class="block font-medium text-sm md:text-base mb-1 text-white">Upload CV:</label>
                <div class="relative">
                    <input
                        wire:model="cv"
                        type="file"
                        accept=".pdf,.doc,.docx"
                        class="w-full bg-white border border-white/20 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    <p class="text-white/60 text-xs mt-1">PDF, DOC, DOCX (Max 5MB)</p>
                    @error('cv')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div wire:loading wire:target="cv" class="text-white/70 text-sm mt-1">
                    Uploading...
                </div>
            </div>

            <div class="mt-5 flex justify-end" x-show="!analyzed">
                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    wire:loading.class="pointer-events-none"
                    wire:target="analyzeCV"
                    class="bg-[#1750b6] hover:bg-lime-600 transition text-white md:text-base text-sm font-semibold cursor-pointer py-3 px-8 rounded-xl shadow-lg disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    <div
                        wire:loading
                        wire:target="analyzeCV"
                        class="animate-spin inline-block size-5 border-3 mt-1 border-current border-t-transparent text-white rounded-full" role="status" aria-label="loading"
                    >
                        <span class="sr-only">Loading...</span>
                    </div>

                    <span
                        class="flex gap-2 items-center"
                        wire:loading.remove
                        wire:target="analyzeCV"
                    >
                        <svg class="size-7" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M7.45284 2.71266C7.8276 1.76244 9.1724 1.76245 9.54716 2.71267L10.7085 5.65732C10.8229 5.94743 11.0526 6.17707 11.3427 6.29148L14.2873 7.45284C15.2376 7.8276 15.2376 9.1724 14.2873 9.54716L11.3427 10.7085C11.0526 10.8229 10.8229 11.0526 10.7085 11.3427L9.54716 14.2873C9.1724 15.2376 7.8276 15.2376 7.45284 14.2873L6.29148 11.3427C6.17707 11.0526 5.94743 10.8229 5.65732 10.7085L2.71266 9.54716C1.76244 9.1724 1.76245 7.8276 2.71267 7.45284L5.65732 6.29148C5.94743 6.17707 6.17707 5.94743 6.29148 5.65732L7.45284 2.71266Z" fill="#e2d20a"></path> <path d="M16.9245 13.3916C17.1305 12.8695 17.8695 12.8695 18.0755 13.3916L18.9761 15.6753C19.039 15.8348 19.1652 15.961 19.3247 16.0239L21.6084 16.9245C22.1305 17.1305 22.1305 17.8695 21.6084 18.0755L19.3247 18.9761C19.1652 19.039 19.039 19.1652 18.9761 19.3247L18.0755 21.6084C17.8695 22.1305 17.1305 22.1305 16.9245 21.6084L16.0239 19.3247C15.961 19.1652 15.8348 19.039 15.6753 18.9761L13.3916 18.0755C12.8695 17.8695 12.8695 17.1305 13.3916 16.9245L15.6753 16.0239C15.8348 15.961 15.961 15.8348 16.0239 15.6753L16.9245 13.3916Z" fill="#e2d20a"></path> </g></svg>
                        Analyze CV
                    </span>
                </button>
            </div>
        </form>

        <div wire:loading wire:target="analyzeCV" class="w-full mt-6 text-center">
            <p class="text-white/80 text-lg">Analyzing your CV... Please wait</p>
        </div>

        <div
            class="mt-8 space-y-6"
            x-show="analyzed"
            x-transition
            x-transition:enter.duration.500ms
            x-transition:leave.duration.400ms
        >
            @if(!empty($analysisResult))
                <div class="space-y-4">
                    <div class="p-4">
                        <h2 class="text-xl text-green-600 font-bold mb-2">Strengths:</h2>
                        <ul class="list-disc ml-6 text-white font-semibold space-y-1">
                            @forelse($analysisResult['strengths'] ?? [] as $item)
                                <li>{{ $item }}</li>
                                @empty
                                <p>Nothing to show!</p>
                            @endforelse
                        </ul>
                    </div>

                    <div class="p-4">
                        <h2 class="text-xl text-red-600 font-bold mb-2">Weaknesses:</h2>
                        <ul class="list-disc ml-6 text-white font-semibold space-y-1">
                            @forelse($analysisResult['weaknesses'] ?? [] as $item)
                                <li>{{ $item }}</li>
                            @empty
                                <p>Nothing to show!</p>
                            @endforelse
                        </ul>
                    </div>

                    <div class="p-4 mb-2">
                        <h2 class="text-xl text-amber-600 font-bold mb-2">Suggested Improvements:</h2>
                        <ol class="list-decimal ml-6 text-white font-semibold space-y-1">
                            @forelse($analysisResult['improvements'] ?? [] as $item)
                                <li>{{ $item }}</li>
                            @empty
                                <p>Nothing to show!</p>
                            @endforelse
                        </ol>
                    </div>

                    <div
                        @php
                            $rating = $analysisResult['rating'] ?? 'N/A';
                        @endphp

                        @class([
                           'bg-red-500' => $rating !== 'N/A' && $rating < 5,
                           'bg-yellow-500' => $rating !== 'N/A' && $rating >= 5 && $rating < 8,
                           'bg-green-500' => $rating !== 'N/A' && $rating >= 8,
                           'p-4 flex items-center justify-center gap-4 rounded-xl mt-2'
                        ])
                    >
                        <h2 class="text-2xl font-bold text-white">Final Rating: {{ $rating }}/10</h2>
                    </div>

                    <div class="flex justify-center mt-6">
                        <button
                            wire:click="resetResponse"
                            class="bg-white/20 cursor-pointer hover:bg-white/30 transition text-white font-semibold py-2 px-6 rounded-xl"
                        >
                            Analyze Another CV
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
