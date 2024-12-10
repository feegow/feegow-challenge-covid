@props([
    'name',
    'label' => '',
    'wireModel',
])

<div class='flex items-center gap-2 justify-center cursor-pointer' x-data="{ check: @entangle($wireModel) }" @click="check = !check">
    <input wire:model.live="{{$wireModel}}" name="{{$name}}" type="checkbox" class="relative w-6 h-6 aspect-square !appearance-none !bg-none checked:!bg-gradient-to-tr checked:!bg-gray-800 checked:!to-white bg-white border border-gray-300 shadow-sm rounded !outline-none !ring-0 !text-transparent !ring-offset-0 checked:!border-gray-800 hover:!border-gray-800 cursor-pointer transition-all duration-300 ease-in-out focus-visible:!outline-offset-2 focus-visible:!outline-2 focus-visible:!outline-gray-800/30 focus-visible:border-gray-800 after:w-[35%] after:h-[53%] after:absolute after:opacity-0 after:top-[40%] after:left-[50%] after:-translate-x-2/4 after:-translate-y-2/4 after:rotate-[25deg] after:drop-shadow-[1px_0.5px_1px_rgba(56,149,248,0.5)] after:border-r-[0.25em] after:border-r-white after:border-b-[0.25em] after:border-b-white after:transition-all after:duration-200 after:ease-linear checked:after:opacity-100 checked:after:rotate-45">
    <span>{{$label}}</label>
</div>
