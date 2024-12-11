<div class="mx-auto px-6 py-12 bg-white border-0 shadow-lg sm:rounded-3xl">
    <form id="form" class="flex flex-col justify-center items-center" wire:submit='save'>

        <x-forms.input-text wireModel='name' type="text" name="name" label="Enter the vaccine name"/>

        <x-forms.input-text wireModel="batch" type="text" mask="aaaaa9999" name="batch" label="Enter new batch code"/>

        <x-forms.input-date wireModel='expiry' name='expiry' label="Enter vaccine expiration date (mm/dd/yyyy)"/>

        <button type="submit"
            class="w-1/2 px-6 py-3 mt-3 text-lg text-white transition-all duration-150 ease-linear rounded-lg shadow outline-none bg-gray-800 hover:bg-gray-600 hover:shadow-lg focus:outline-none">
            Update Vaccine
        </button>
    </form>
</div>
