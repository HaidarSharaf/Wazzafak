<div
    class="min-h-screen w-full py-8"
    x-data="{
        showModal: false,
        showEditModal: false,
        showDeleteModal: false,
        openModal() { this.showModal = true },
        closeModal() { this.showModal = false },
        openEditModal() { this.showEditModal = true },
        closeEditModal() { this.showEditModal = false },
        openDeleteModal() { this.showDeleteModal = true },
        closeDeleteModal() { this.showDeleteModal = false },
    }"
    @close-modal.window="closeModal()"
    @close-edit-modal.window="closeEditModal()"
    @close-delete-modal.window="closeDeleteModal()"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-4xl font-bold text-white">Manage Technologies</h1>
                <p class="text-xl text-white/80 mt-2">Add, edit, or remove technologies</p>
            </div>

            <button
                @click="openModal(); $wire.call('openCreateModal')"
                class="bg-blue-600 hover:bg-lime-500 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 hover:scale-105 cursor-pointer flex items-center gap-2"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add New Technology
            </button>
        </div>

        <div class="mb-6">
            <input
                wire:model.live.debounce.100ms="search"
                type="text"
                placeholder="Search technologies..."
                class="w-full md:w-96 bg-white/10 backdrop-blur-lg border border-white/20 rounded-xl p-3 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($technologies as $tech)
                <div class="bg-white/10 hover:bg-white/20 backdrop-blur-lg border border-white/20 rounded-2xl p-6 transition-all duration-300">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-3">
                            @if($tech->icon)
                                <img src="{{ asset('storage/technologies_icons/' . $tech->icon) }}"
                                     alt="{{ $tech->name }}" class="w-10 h-10">
                            @else
                                <div class="w-10 h-10 rounded-lg flex items-center justify-center"
                                     style="background-color: {{ $tech->color ?? '#1750b6' }}">
                                    <span class="text-white font-bold text-lg">{{ substr($tech->name, 0, 1) }}</span>
                                </div>
                            @endif
                            <div>
                                <h3 class="text-lg font-bold text-white">{{ $tech->name }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <span class="bg-blue-600 text-white px-3 py-2 rounded-xl text-sm font-semibold">
                            {{ $tech->job_listings_count }} {{ Str::plural('job', $tech->job_listings_count) }}
                        </span>
                    </div>

                    <div class="flex items-center justify-end pt-4 border-t border-white/10">
                        <div class="flex gap-2">
                            <button
                                @click="openEditModal(); $wire.call('openEditModal', {{ $tech->id }})"
                                class="text-blue-700 hover:text-blue-800 transition cursor-pointer"
                            >
                                <svg class="size-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <button
                                @click="openDeleteModal(); $wire.call('confirmDelete', {{ $tech->id }})"
                                class="text-red-700 hover:text-red-800 transition cursor-pointer"
                            >
                                <svg class="size-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl p-12 text-center">
                    <svg class="w-16 h-16 mx-auto mb-4 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p class="text-lg font-semibold text-white/60">No technologies found</p>
                    <p class="text-sm mt-1 text-white/60">Create your first technology to get started</p>
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $technologies->links() }}
        </div>
    </div>

    <div
        x-show="showModal"
        x-transition.opacity
        x-cloak
        class="fixed inset-0 bg-white/30 backdrop-blur-sm z-[9999] flex items-center justify-center p-4"
    >
        <div
            class="bg-white backdrop-blur-xl border border-white/20 rounded-2xl p-6 w-full max-w-md"
            @click.away="closeModal"
        >
            <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">
                Create New Technology
            </h2>

            <form wire:submit.prevent="create">
                <div class="mb-4">
                    <label class="block text-gray-900 font-semibold mb-2">Technology Name</label>
                    <input
                        wire:model="name"
                        type="text"
                        class="w-full bg-gray-300 border border-gray-200 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="e.g., React, Node.js, Python"
                    />
                    @error('name')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-900 font-semibold mb-2">Icon</label>
                    <input
                        wire:model="icon"
                        type="file"
                        accept=".svg,.png,.jpg,.jpeg"
                        class="w-full bg-gray-300 border border-gray-200 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    <p class="text-gray-600 text-xs mt-1">PNG, JPG, SVG (Max 2MB)</p>
                    @error('icon')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror

                    @if($icon)
                        <div class="mt-3 flex items-center gap-3 bg-gray-100 p-3 rounded-lg">
                            <span class="text-gray-800 text-base font-semibold">Preview</span>
                            <img src="{{ $icon->temporaryUrl() }}" alt="Preview" class="w-10 h-10">
                        </div>
                    @endif
                </div>

                <div class="flex gap-3">
                    <button
                        type="button"
                        @click="closeModal"
                        class="flex-1 bg-white hover:bg-gray-200 text-gray-900 font-semibold py-3 px-6 rounded-xl transition cursor-pointer border border-gray-300"
                    >
                        Cancel
                    </button>
                    <button
                        type="submit"
                        class="flex-1 bg-blue-600 hover:bg-lime-500 text-white font-semibold py-3 px-6 rounded-xl transition cursor-pointer"
                    >
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div
        x-show="showEditModal"
        x-transition.opacity
        x-cloak
        class="fixed inset-0 bg-white/30 backdrop-blur-sm z-[9999] flex items-center justify-center p-4"
    >
        <div
            class="bg-white backdrop-blur-xl border border-white/20 rounded-2xl p-6 w-full max-w-md"
            @click.away="closeEditModal"
        >
            <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">
                Edit Technology
            </h2>

            <form wire:submit.prevent="update">
                <div class="mb-4">
                    <label class="block text-gray-900 font-semibold mb-2">Technology Name</label>
                    <input
                        wire:model="name"
                        type="text"
                        class="w-full bg-gray-300 border border-gray-200 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    @error('name')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-900 font-semibold mb-2">Icon</label>

                    @if($existingIcon && !$icon)
                        <div class="mb-3 flex items-center gap-3 bg-gray-400 p-3 rounded-lg">
                            <span class="text-gray-800 text-base font-semibold">Current</span>
                            <img src="{{ asset('storage/technologies_icons/' . $existingIcon) }}" alt="Current icon"
                                 class="w-10 h-10">
                        </div>
                    @endif

                    <input
                        wire:model="icon"
                        type="file"
                        accept=".svg,.png,.jpg,.jpeg"
                        class="w-full bg-gray-300 border border-gray-200 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    <p class="text-gray-600 text-xs mt-1">PNG, JPG, SVG (Max 2MB)</p>
                    @error('icon')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror

                    @if($icon)
                        <div class="mt-3 flex items-center gap-3 bg-gray-100 p-3 rounded-lg">
                            <span class="text-gray-800 text-base font-semibold">New Preview</span>
                            <img src="{{ $icon->temporaryUrl() }}" alt="Preview" class="w-10 h-10">
                        </div>
                    @endif
                </div>

                <div class="flex gap-3">
                    <button
                        type="button"
                        @click="closeEditModal"
                        class="flex-1 bg-white hover:bg-gray-200 text-gray-900 font-semibold py-3 px-6 rounded-xl transition cursor-pointer border border-gray-300"
                    >
                        Cancel
                    </button>
                    <button
                        type="submit"
                        class="flex-1 bg-blue-600 hover:bg-lime-500 text-white font-semibold py-3 px-6 rounded-xl transition cursor-pointer"
                    >
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>


    <div
        x-show="showDeleteModal"
        x-transition.opacity
        x-cloak
        class="fixed inset-0 bg-white/30 backdrop-blur-sm z-[9999] flex items-center justify-center p-4"
    >
        <div
            class="bg-white backdrop-blur-xl border border-white/20 rounded-2xl p-6 w-full max-w-md"
            @click.away="closeDeleteModal"
        >
            <div class="text-center">
                <svg class="w-16 h-16 mx-auto mb-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                <h3 class="text-xl font-bold text-red-600 mb-2 text-center">Delete Technology?</h3>
                <p class="text-gray-800 mb-6 font-semibold">
                    Are you sure you want to delete this technology? This action cannot be undone.
                </p>

                <div class="flex gap-3">
                    <button
                        type="button"
                        @click="closeDeleteModal"
                        class="flex-1 bg-white hover:bg-gray-200 text-gray-900 font-semibold py-3 px-6 rounded-xl transition cursor-pointer border border-gray-300"
                    >
                        Cancel
                    </button>
                    <button
                        type="button"
                        wire:click="delete"
                        @click="closeDeleteModal"
                        class="flex-1 bg-red-500 hover:bg-red-600 text-white font-semibold py-3 px-6 rounded-xl transition cursor-pointer"
                    >
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
