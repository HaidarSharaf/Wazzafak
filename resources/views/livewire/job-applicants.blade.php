<div class="lg:overflow-x-hidden overflow-x-scroll">
    <div class="min-w-[800px]">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="grid grid-cols-12 gap-4 ext-base font-medium text-white text-lg">
                <div class="col-span-3">Applicant</div>
                <div class="col-span-2">Exp. & Stack</div>
                <div class="col-span-2 text-center">Status</div>
                <div class="col-span-1 flex justify-center items-center">
                    LinkedIn
                </div>
                <div class="col-span-1 flex justify-center items-center">
                    GitHub
                </div>
                <div class="col-span-1 flex justify-center">CV</div>
                <div class="col-span-2 flex justify-center">Actions</div>
            </div>
        </div>

        <div class="divide-y divide-gray-200">

            @forelse($applications as $application)
                <div class="px-2 py-4 rounded-lg hover:bg-black/10 transition-all duration-200">
                    <div class="grid grid-cols-12 gap-4 items-center">
                        <div class="col-span-3">
                            <div class="flex items-center gap-3">
                                <div class="md:size-12 size-10 rounded-2xl bg-gradient-to-br from-[#1750b6]/60 to-lime-400 flex items-center justify-center text-lg font-bold text-white">
                                    {{ $application->user->name[0] }}
                                </div>

                                <div class="overflow-hidden">
                                    <h3 class="font-bold text-white">{{ $application->user->name }}</h3>
                                    <p class="text-sm font-semibold text-white">{{ $application->user->email }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-2 flex flex-col items-start">
                            <span class="text-base font-semibold text-blue-900">{{ $application->getApplicantExperienceAttribute() }}:</span>
                            <p class="text-sm font-semibold text-white">{{ $application->getApplicantStacksAttribute() }}</p>
                        </div>

                        <div class="col-span-2 overflow-hidden flex justify-center">
                            <span
                                @class([
                                    'bg-green-600' => $application->status === 'Accepted',
                                    'bg-red-600' => $application->status === 'Rejected',
                                    'bg-amber-600' => $application->status === 'Pending',
                                    'inline-flex px-3 py-2 text-base font-medium rounded-lg text-white',
                                ])
                            >
                                {{ $application->status }}
                            </span>
                        </div>

                        <div class="col-span-1 overflow-hidden flex justify-center">
                            <a
                                href="{{ 'https://' . $application->user?->developer?->linkedin_url }} "
                                target="_blank"
                            >
                                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128"><path fill="#0076b2" d="M116 3H12a8.91 8.91 0 00-9 8.8v104.42a8.91 8.91 0 009 8.78h104a8.93 8.93 0 009-8.81V11.77A8.93 8.93 0 00116 3z"/><path fill="#fff" d="M21.06 48.73h18.11V107H21.06zm9.06-29a10.5 10.5 0 11-10.5 10.49 10.5 10.5 0 0110.5-10.49M50.53 48.73h17.36v8h.24c2.42-4.58 8.32-9.41 17.13-9.41C103.6 47.28 107 59.35 107 75v32H88.89V78.65c0-6.75-.12-15.44-9.41-15.44s-10.87 7.36-10.87 15V107H50.53z"/></svg>
                            </a>
                        </div>

                        <div class="col-span-1 overflow-hidden flex justify-center">
                            <a
                                href="{{ 'https://' . $application->user?->developer?->github_url }} "
                                target="_blank"
                            >
                                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128"><g fill="#181616"><path fill-rule="evenodd" clip-rule="evenodd" d="M64 5.103c-33.347 0-60.388 27.035-60.388 60.388 0 26.682 17.303 49.317 41.297 57.303 3.017.56 4.125-1.31 4.125-2.905 0-1.44-.056-6.197-.082-11.243-16.8 3.653-20.345-7.125-20.345-7.125-2.747-6.98-6.705-8.836-6.705-8.836-5.48-3.748.413-3.67.413-3.67 6.063.425 9.257 6.223 9.257 6.223 5.386 9.23 14.127 6.562 17.573 5.02.542-3.903 2.107-6.568 3.834-8.076-13.413-1.525-27.514-6.704-27.514-29.843 0-6.593 2.36-11.98 6.223-16.21-.628-1.52-2.695-7.662.584-15.98 0 0 5.07-1.623 16.61 6.19C53.7 35 58.867 34.327 64 34.304c5.13.023 10.3.694 15.127 2.033 11.526-7.813 16.59-6.19 16.59-6.19 3.287 8.317 1.22 14.46.593 15.98 3.872 4.23 6.215 9.617 6.215 16.21 0 23.194-14.127 28.3-27.574 29.796 2.167 1.874 4.097 5.55 4.097 11.183 0 8.08-.07 14.583-.07 16.572 0 1.607 1.088 3.49 4.148 2.897 23.98-7.994 41.263-30.622 41.263-57.294C124.388 32.14 97.35 5.104 64 5.104z"/><path d="M26.484 91.806c-.133.3-.605.39-1.035.185-.44-.196-.685-.605-.543-.906.13-.31.603-.395 1.04-.188.44.197.69.61.537.91zm2.446 2.729c-.287.267-.85.143-1.232-.28-.396-.42-.47-.983-.177-1.254.298-.266.844-.14 1.24.28.394.426.472.984.17 1.255zM31.312 98.012c-.37.258-.976.017-1.35-.52-.37-.538-.37-1.183.01-1.44.373-.258.97-.025 1.35.507.368.545.368 1.19-.01 1.452zm3.261 3.361c-.33.365-1.036.267-1.552-.23-.527-.487-.674-1.18-.343-1.544.336-.366 1.045-.264 1.564.23.527.486.686 1.18.333 1.543zm4.5 1.951c-.147.473-.825.688-1.51.486-.683-.207-1.13-.76-.99-1.238.14-.477.823-.7 1.512-.485.683.206 1.13.756.988 1.237zm4.943.361c.017.498-.563.91-1.28.92-.723.017-1.308-.387-1.315-.877 0-.503.568-.91 1.29-.924.717-.013 1.306.387 1.306.88zm4.598-.782c.086.485-.413.984-1.126 1.117-.7.13-1.35-.172-1.44-.653-.086-.498.422-.997 1.122-1.126.714-.123 1.354.17 1.444.663zm0 0"/></g></svg>
                            </a>
                        </div>

                        <div class="col-span-1 overflow-hidden lg:ml-1">
                            <button
                                wire:click="downloadCV('{{ $application->user?->id }}')"
                                class="text-blue-800 hover:underline hover:text-blue-900 cursor-pointer"
                            >
                                View
                            </button>
                        </div>

                        @if($application->status === 'Pending')
                            <div class="col-span-2 overflow-hidden">
                            <div class="flex justify-center items-center gap-4">
                                <button
                                    wire:click="rejectApplicant('{{ $application->id }}')"
                                    class="cursor-pointer"
                                >
                                    <svg class="w-9 h-9" viewBox="0 0 512 512" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:#e60000;} .st1{fill:none;stroke:#e60000;stroke-width:32;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;} </style> <g id="Layer_1"></g> <g id="Layer_2"> <g> <path class="st0" d="M263.24,43.5c-117.36,0-212.5,95.14-212.5,212.5s95.14,212.5,212.5,212.5s212.5-95.14,212.5-212.5 S380.6,43.5,263.24,43.5z M367.83,298.36c17.18,17.18,17.18,45.04,0,62.23v0c-17.18,17.18-45.04,17.18-62.23,0l-42.36-42.36 l-42.36,42.36c-17.18,17.18-45.04,17.18-62.23,0v0c-17.18-17.18-17.18-45.04,0-62.23L201.01,256l-42.36-42.36 c-17.18-17.18-17.18-45.04,0-62.23v0c17.18-17.18,45.04-17.18,62.23,0l42.36,42.36l42.36-42.36c17.18-17.18,45.04-17.18,62.23,0v0 c17.18,17.18,17.18,45.04,0,62.23L325.46,256L367.83,298.36z"></path> </g> </g> </g></svg>
                                </button>
                                <button
                                    wire:click="acceptApplicant('{{ $application->id }}')"
                                    class="cursor-pointer"
                                >
                                    <svg class="w-8 h-8" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><defs><style> .cls-1 { fill: #008200; fill-rule: evenodd; } </style></defs><path class="cls-1" d="M800,510a30,30,0,1,1,30-30A30,30,0,0,1,800,510Zm-16.986-23.235a3.484,3.484,0,0,1,0-4.9l1.766-1.756a3.185,3.185,0,0,1,4.574.051l3.12,3.237a1.592,1.592,0,0,0,2.311,0l15.9-16.39a3.187,3.187,0,0,1,4.6-.027L817,468.714a3.482,3.482,0,0,1,0,4.846l-21.109,21.451a3.185,3.185,0,0,1-4.552.03Z" id="check" transform="translate(-770 -450)"></path></g></svg>
                                </button>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="px-6 py-4 text-center text-white font-bold text-lg mt-3">
                    <span class="grid-cols-12">No applications found.</span>
                </div>
            @endforelse

        </div>
    </div>
</div>
