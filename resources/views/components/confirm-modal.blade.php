@props([
    'title' => 'Modal Title',
])

<div class="flex justify-center items-center" x-cloak>
    <div x-data="{ open: false }">
        <!-- Open modal button -->
        <button x-on:click="open = true">
            @isset($button)
                {{ $button }}
            @endisset
        </button>
        <!-- Modal Overlay -->
        <div x-show="open" class="fixed inset-0 px-2 z-10 overflow-hidden flex items-center justify-center">
            <div x-show="open" x-transition:enter="transition-opacity ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-in duration-300" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
            <!-- Modal Content -->
            <div x-show="open" x-transition:enter="transition-transform ease-out duration-300"
                x-transition:enter-start="transform scale-75" x-transition:enter-end="transform scale-100"
                x-transition:leave="transition-transform ease-in duration-300"
                x-transition:leave-start="transform scale-100" x-transition:leave-end="transform scale-75"
                class="bg-white rounded-md shadow-xl overflow-hidden max-w-md w-full sm:w-96 md:w-1/2 lg:w-2/3 xl:w-1/3 z-50">
                <!-- Modal Header -->
                <div class="bg-slate-800 text-white px-4 py-2 flex justify-between">
                    <h2 class="text-lg font-semibold">{{$title}}</h2>
                </div>
                <!-- Modal Body -->
                <div class="p-4 text-black">
                    {{ $slot }}
                </div>
                <!-- Modal Footer -->
                <div class="border-t px-4 py-2 flex justify-end space-x-3">
                    <button @click="open = false" class="p-2 bg-slate-700 hover:bg-slate-600 rounded-md text-white">Cancelar</button>
                    @isset($confirm)
                        {{ $confirm }}
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
