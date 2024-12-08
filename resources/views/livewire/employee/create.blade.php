<div class="mx-auto px-6 py-12 bg-white border-0 shadow-lg sm:rounded-3xl">
    <form id="form" class="flex flex-col justify-center items-center" wire:submit='save'>
        <x-forms.group-radio-button wireModel="user" name="account" :options="['I already have an account' => 1, 'I haven`t an account yet' => 0]" />

        <x-forms.input-autocomplete :values="$this->users->only('email')" name="test" label="testAutoComplete"/>

        @if(!$user)
            <x-forms.input-text wire:model.live='email' type="email" name="email" label="Enter your email address"/>
            <x-forms.input-text type="text" name="name" label="Enter your full name"/>
            <x-forms.input-password name="password" label="Enter your password"/>
        @endif
        <x-forms.input-text type="text" name="cpf" label="Enter your CPF" mask="999.999.999-99"/>

        <x-forms.checkbox name="comobidity" label="The employee has a comorbidity"/>



        <x-forms.input-date name='birthday' label="Select employee's birthday"/>

        <button type="submit"
            class="w-1/3 px-6 py-3 mt-3 text-lg text-white transition-all duration-150 ease-linear rounded-lg shadow outline-none bg-gray-800 hover:bg-gray-600 hover:shadow-lg focus:outline-none">
            Create Employee
        </button>
    </form>
</div>
