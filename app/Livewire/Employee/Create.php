<?php

namespace App\Livewire\Employee;

use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    #[Validate]
    public string $name;

    #[Validate]
    public bool $user = false;

    #[Validate]
    public string $birthday;

    #[Validate]
    public bool $comorbidity = false;

    #[Validate]
    public string $email;

    #[Validate]
    public string $password;

    protected function rules()
    {
        return [
            'email' => 'required|email:rfc,dns,filter|unique:users,email|min:1|max:100',
        ];
    }

    public function updatedEmail()
    {
        dd($this->email);
    }

    public function save()
    {
        // $this->validate();
    }

    public function render()
    {
        return view('livewire.employee.create');
    }
}
