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
                <h1 class="text-4xl font-bold text-white">Manage Stacks</h1>
                <p class="text-xl text-white/80 mt-2">Add, edit, or delete stacks</p>
            </div>

            <button
                @click="openModal(); $wire.call('openCreateModal')"
                class="bg-blue-600 hover:bg-lime-500 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 hover:scale-105 cursor-pointer flex items-center gap-2"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add New Stack
            </button>
        </div>

        <div class="mb-6">
            <input
                wire:model.live.debounce.100ms="search"
                type="text"
                placeholder="Search stacks..."
                class="w-full md:w-96 bg-white/10 backdrop-blur-lg border border-white/20 rounded-xl p-3 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
        </div>

        <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-white/20">
                    <thead class="bg-white/5">
                    <tr>
                        <th class="px-6 py-4 text-left text-base font-semibold text-white uppercase tracking-wider">Name</th>
                        <th class="px-6 py-4 text-left text-base font-semibold text-white uppercase tracking-wider">Jobs Count</th>
                        <th class="px-6 py-4 text-right text-base font-semibold text-white uppercase tracking-wider">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10">
                    @forelse($stacks as $stack)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-base text-white font-semibold">
                                {{ $stack->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                                    <span class="bg-blue-600 text-white px-3 py-2 rounded-xl font-semibold">
                                        {{ $stack->job_listings_count }} {{ Str::plural('job', $stack->job_listings_count) }}
                                    </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button
                                    @click="openEditModal(); $wire.call('openEditModal', {{ $stack->id }})"
                                    class="text-blue-700 hover:text-blue-800 mr-3 transition cursor-pointer"
                                >
                                    <svg class="size-8 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>

                                <button
                                    @click="openDeleteModal(); $wire.call('confirmDelete', {{ $stack->id }})"
                                    class="text-red-700 hover:text-red-800 transition cursor-pointer"
                                >
                                    <svg class="size-8 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-white/60">
                                <svg class="w-16 h-16 mx-auto mb-4 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                </svg>
                                <p class="text-lg font-semibold">No stacks found</p>
                                <p class="text-sm mt-1">Create your first stack to get started</p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t border-white/10">
                {{ $stacks->links() }}
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
                    Create New Stack
                </h2>

                <form wire:submit.prevent="create">
                    <div class="mb-6">
                        <label class="block text-gray-900 font-semibold mb-2">Stack Name</label>
                        <input
                            wire:model="name"
                            type="text"
                            class="w-full bg-gray-300 border border-gray-200 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="e.g., Full Stack, Backend, Frontend"
                        />
                        @error('name')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
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
                    Edit Stack
                </h2>

                <form wire:submit.prevent="update">
                    <div class="mb-6">
                        <label class="block text-gray-900 font-semibold mb-2">Stack Name</label>
                        <input
                            wire:model="name"
                            type="text"
                            class="w-full bg-gray-300 border border-gray-200 rounded-xl p-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="e.g., Full Stack, Backend, Frontend"
                        />
                        @error('name')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
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
                    <h3 class="text-xl font-bold text-red-600 mb-2 text-center">Delete Stack?</h3>
                    <p class="text-gray-800 mb-6 font-semibold">
                        Are you sure you want to delete this stack? This action cannot be undone.
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
</div>
