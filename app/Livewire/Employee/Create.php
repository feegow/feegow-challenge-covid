<?php

namespace App\Livewire\Employee;

use App\Models\User;
use Livewire\Attributes\Computed;
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
    public ?string $email = null;

    public $dataUsers = null;

    #[Validate]
    public string $password;

    protected function rules()
    {
        return [
            'user' => 'required|boolean',
            'email' => 'required_if:user,false|email:rfc,dns,filter|unique:users,email|min:1|max:100',
        ];
    }

    public function updatedEmail()
    {
        $user = User::where('email', 'like', "%$this->email%")->get(['email','name']);
    }

    #[Computed]
    public function users()
    {
        return User::where('email', 'like', "%{$this->email}%")->get(['email', 'name']);
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
