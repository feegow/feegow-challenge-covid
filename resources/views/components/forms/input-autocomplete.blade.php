@props([
    'name',
    'mask' => null,
    'label',
    'values' =>null,
])

<div class="relative z-10 w-full mb-5">
    <x-dropdown align="top">
        <x-slot name="trigger">
            <input type="text" name="{{$name}}" placeholder=" " @if ($mask) x-mask="{{$mask}}" @endif class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black @error($name) border-red-600 @else border-gray-500 @enderror" />
            <label for="{{$name}}" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">{{$label}}</label>
        </x-slot>

        <x-slot name="content">
            <div class="flex flex-col bg-slate-200 overflow-y-auto h-40">
                @foreach ($values as $value)
                    <span>{{ $value }}</span>
                @endforeach
            </div>
        </x-slot>
    </x-dropdown>
</div>
