@props(['name', 'label', 'wireModel' => null])

<div {{$attributes->merge(['class' => 'relative z-0 w-full mb-5'])}}>
    <input wire:model.defer="{{ $wireModel }}" type="text" name="{{$name}}" x-mask="99/99/9999" placeholder=" " autocomplete="off"
        class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black @error($name) border-red-600 @else border-gray-500  @enderror " />
    <label for="{{$name}}" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">{{$label}}</label>
    @error($name)
        <span class="text-sm text-red-600 ">{{ $message }}</span>
    @enderror
</div>
