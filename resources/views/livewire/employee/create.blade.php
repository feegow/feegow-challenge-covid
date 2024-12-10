<div class="mx-auto px-6 py-12 bg-white border-0 shadow-lg sm:rounded-3xl">
    <form id="form" class="flex flex-col justify-center items-center" wire:submit='save'>
        @dump($errors->get('password'))
        <x-forms.group-radio-button wireModel="user" name="account" :options="['I already have an account' => 1, 'I haven`t an account yet' => 0]" />

        @if(!$user)
            <x-forms.input-text wireModel='email' type="email" name="email" label="Enter your email address"/>

            <x-forms.input-password wireModel="password" name="password" label="Enter your password"/>
            <x-forms.input-password wireModel="passwordConfirmation" name="passwordConfirmation" label="Repeat your password"/>
        @else
            <x-forms.input-autocomplete wireModel='email' :values="$this->users->pluck('email')" name="email" label="Email" :action="'setEmail'" />
        @endif
        <x-forms.input-text wireModel="name" type="text" name="name" label="Enter your full name"/>

        <x-forms.input-text wireModel="cpf" type="text" name="cpf" label="Enter your CPF" mask="999.999.999-99"/>

        <div class="flex w-full justify-between">
            <x-forms.input-date wireModel='birthday' class="w-3/5" name='birthday' label="Enter employee's birthday (mm/dd/yyyy)"/>

            <x-forms.checkbox wireModel="comorbidity" class="w-1/5" name="comobidity" label="Comorbidity"/>
        </div>

        <button type="submit"
            class="w-1/2 px-6 py-3 mt-3 text-lg text-white transition-all duration-150 ease-linear rounded-lg shadow outline-none bg-gray-800 hover:bg-gray-600 hover:shadow-lg focus:outline-none">
            Create Employee
        </button>
    </form>
</div>
