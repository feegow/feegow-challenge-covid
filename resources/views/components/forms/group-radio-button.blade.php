@props([
    'name',
    'label' => 'Choose an option',
    'options',
    'wireModel' => null,
])

<fieldset class="relative z-0 w-full p-px mb-5">
    <legend class="absolute text-gray-500 transform scale-75 -top-3 origin-0">{{ $label }}</legend>
    <div class="block pt-3 pb-2 space-x-4">
        @foreach ($options as $key => $value)
            <label class="cursor-pointer">
                <input type="radio" name="{{$name}}" value="{{$value}}" @if ($wireModel) wire:model.live="{{$wireModel}}" @endif
                    class="mr-2 text-black border-2 border-gray-300 focus:border-gray-300 focus:ring-black" />
                {{$key}}
            </label>
        @endforeach
    </div>
    @error($name)
        <span class="text-sm text-red-600">{{ $message }}</span>
    @enderror
</fieldset>
