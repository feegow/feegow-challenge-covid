<div class="mx-auto px-6 py-12 bg-white border-0 shadow-lg sm:rounded-3xl">
    <form id="form" class="flex flex-col justify-center items-center" wire:submit='save'>

        <x-forms.input-text wireModel='selectedEmployee' type="text" name="employee" label="Enter an employee" disabled />

        <div class="w-full mb-3">
            <x-dropdown align="top">
                <x-slot name="trigger">
                    <input wire:model.defer="selectedVaccine" type="text" name="vaccine" placeholder=" " autocomplete="off" class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black @error('vaccine') border-red-600 @else border-gray-500 @enderror" />
                    <label for="vaccine" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Select an Vaccine</label>
                </x-slot>

                <x-slot name="content">
                    <div class="flex flex-col min-w-max bg-slate-200 overflow-y-auto max-h-40 h-auto">
                        @foreach ($this->vaccines as $vaccine)
                        <div wire:key="option-{{$vaccine->id}}" class="cursor-pointer hover:bg-slate-300" wire:click="setVaccine({{$vaccine->id}})">
                            <span>{{ $vaccine->name }}</span>
                        </div>
                        @endforeach
                    </div>
                </x-slot>
            </x-dropdown>
        </div>

        <button type="submit"
            class="w-full px-6 py-3 mt-3 text-lg text-white transition-all duration-150 ease-linear rounded-lg shadow outline-none bg-gray-800 hover:bg-gray-600 hover:shadow-lg focus:outline-none">
            Apply Vaccine
        </button>
    </form>
</div>
