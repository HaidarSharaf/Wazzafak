<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'Page Title' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet"/>

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen" x-data>

<div
    class="relative flex w-full flex-col md:flex-row"
>
    <livewire:admin.admin-sidebar/>

    <div id="main-content" class="h-svh w-full overflow-y-auto bg-gradient-to-br from-blue-500 to-indigo-300 pt-20">
        {{ $slot }}

        <livewire:footer />
    </div>
</div>

<div
    x-data="{
        notifications: [],
        displayDuration: 5000,
        soundEffect: false,

        addNotification({ variant = 'info', sender = null, title = null, message = null }) {
            const id = Date.now()
            const notification = { id, variant, sender, title, message }

            if (this.notifications.length >= 20) {
                this.notifications.splice(0, this.notifications.length - 19)
            }

            this.notifications.push(notification)
        },

        removeNotification(id) {
            setTimeout(() => {
                this.notifications = this.notifications.filter(n => n.id !== id)
            }, 400)
        },
    }"
    @notify.window="addNotification($event.detail)"
    class="pointer-events-none fixed inset-x-8 top-0 z-[99] flex max-w-full flex-col gap-2 bg-transparent px-6 py-6
           md:bottom-0 md:left-[unset] md:right-0 md:top-[unset] md:max-w-sm"
>
    <template x-for="notification in notifications" :key="notification.id">
        <div>
            <template x-if="notification.variant === 'success'">
                <div
                    x-data="{ visible: false, t: null }"
                    x-init="$nextTick(() => { visible = true; t = setTimeout(() => { visible = false; removeNotification(notification.id) }, displayDuration) })"
                    x-show="visible"
                    x-transition
                    class="pointer-events-auto relative rounded-lg border border-green-600 bg-green-500 text-white"
                >
                    <div class="flex items-center gap-2.5 bg-green-500/10 rounded-radius p-4">
                        <div class="rounded-full bg-green-500/15 p-0.5 text-green-500">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 00-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="flex flex-col gap-1">
                            <h3 x-show="notification.title" x-text="notification.title" class="text-base font-bold text-white"></h3>
                            <p x-show="notification.message" x-text="notification.message" class="text-sm"></p>
                        </div>
                        <button type="button" x-on:click="visible = false; removeNotification(notification.id)" class="ml-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </template>

            <template x-if="notification.variant === 'danger'">
                <div
                    x-data="{ visible: false, t: null }"
                    x-init="$nextTick(() => { visible = true; t = setTimeout(() => { visible = false; removeNotification(notification.id) }, displayDuration) })"
                    x-show="visible"
                    x-transition
                    class="pointer-events-auto relative rounded-lg border border-red-500 bg-red-600 text-white"
                >
                    <div class="flex items-center gap-2.5 bg-red-500/10 rounded-radius p-4">
                        <div class="rounded-full bg-red-500/15 p-0.5 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                <path fill-rule="evenodd" d="M18 10A8 8 0 11 2 10a8 8 0 0116 0zM9 9a.75.75 0 000 1.5h.25a.25.25 0 01.25.25v.25a1 1 0 11-2 0V9.25A.75.75 0 019 9z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="flex flex-col gap-1">
                            <h3 x-show="notification.title" x-text="notification.title" class="text-base font-bold text-white"></h3>
                            <p x-show="notification.message" x-text="notification.message" class="text-sm"></p>
                        </div>
                        <button type="button" x-on:click="visible = false; removeNotification(notification.id)" class="ml-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </template>
        </div>
    </template>
</div>


</body>
</html>
