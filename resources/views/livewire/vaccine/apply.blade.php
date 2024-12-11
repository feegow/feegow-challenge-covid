<div class="mx-auto px-6 py-12 bg-white border-0 shadow-lg sm:rounded-3xl">
    <form id="form" class="flex flex-col justify-center items-center" wire:submit='save'>

        <x-forms.input-text wireModel='selectedEmployee' type="text" name="employee" label="Enter an employee" disabled />

        <x-forms.input-autocomplete wireModel='selectedVaccine' :values="$this->vaccines" name="selectedVaccine" label="Select a vaccine" :action="'setVaccine'" />

        <button type="submit"
            class="w-1/2 px-6 py-3 mt-3 text-lg text-white transition-all duration-150 ease-linear rounded-lg shadow outline-none bg-gray-800 hover:bg-gray-600 hover:shadow-lg focus:outline-none">
            Apply Vaccine
        </button>
    </form>
</div>
