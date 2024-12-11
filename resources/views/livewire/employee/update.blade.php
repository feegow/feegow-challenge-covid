<div class="mx-auto px-6 py-12 bg-white border-0 shadow-lg sm:rounded-3xl">
    <form id="form" class="flex flex-col justify-center items-center" wire:submit='save'>
        <x-forms.input-text wireModel='email' name="email" type="text" label="Enter your email"/>

        <x-forms.input-text wireModel="name" type="text" name="name" label="Enter your full name"/>

        <x-forms.input-text wireModel="cpf" type="text" name="cpf" label="Enter your CPF" mask="999.999.999-99"/>

        <div class="flex w-full justify-between">
            <x-forms.input-date wireModel='birthday' class="!w-3/5" name='birthday' label="Enter employee's birthday (mm/dd/yyyy)"/>

            <x-forms.checkbox wireModel="comorbidity" class="!w-2/5" name="comobidity" label="Comorbidity"/>
        </div>
        <button type="submit"
            class="w-1/2 px-6 py-3 mt-3 text-lg text-white transition-all duration-150 ease-linear rounded-lg shadow outline-none bg-gray-800 hover:bg-gray-600 hover:shadow-lg focus:outline-none">
            Update Employee
        </button>
    </form>
</div>
