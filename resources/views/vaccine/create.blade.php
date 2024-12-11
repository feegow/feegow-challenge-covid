<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create vaccine') }}
        </h2>
    </x-slot>
    <div class="mt-4">
        <div class="max-w-xl bg-white rounded-lg mx-auto px-2 py-4">
            <livewire:vaccine.create />
        </div>
    </div>
</x-app-layout>
