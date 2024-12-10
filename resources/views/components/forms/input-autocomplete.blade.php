@props([
    'name',
    'mask' => null,
    'label',
    'wireModel' => null,
    'values' =>null,
    'action' => null,
    'param' => null,
])

<div class="relative z-10 w-full mb-5">
    <x-dropdown align="top" width="min-w-max">
        <x-slot name="trigger">
            <input wire:model.live="{{$wireModel}}" type="text" name="{{$name}}" placeholder=" " @if ($mask) x-mask="{{$mask}}" @endif autocomplete="off" class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black @error($name) border-red-600 @else border-gray-500 @enderror" />
            <label for="{{$name}}" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">{{$label}}</label>
            @error($name)
                <span>{{ $message }}</span>
            @enderror
        </x-slot>

        <x-slot name="content">
            <div class="flex flex-col min-w-max bg-slate-200 overflow-y-auto max-h-40 h-auto">
                @foreach ($values as $key => $value)
                <div wire:key="option-{{$key}}" class="cursor-pointer hover:bg-slate-300" wire:click="{{ $action }}('{{ $value }}')">
                    <span>{{ $value }}</span>
                </div>
                @endforeach
            </div>
        </x-slot>
    </x-dropdown>
</div>
