<?php

namespace App\Livewire\Employee;

use App\Models\Employee;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Http\Controllers\Auth\RegisteredUserController;
use DateTime;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

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

    #[validate]
    public string $cpf;

    #[Validate]
    public string $password;

    #[Validate]
    public string $passwordConfirmation;

    public $dataUsers = null;

    public ?User $userModel = null;

    protected function rules()
    {
        return [
            'user'      => 'required|boolean',
            'email'     => 'exclude_if:user,true|required|email:rfc,dns,filter|unique:users,email|min:1|max:100',
            'name'      => 'required|max:90',
            'cpf'       => 'required|regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/|unique:employees,cpf|min:14|max:14',
            'birthday'  => 'required|date|date_format:m/d/Y|before:-16years',
            'password'  => 'exclude_if:user,true|required',
        ];
    }

    public function updatedUser()
    {
        $this->resetExcept('user');
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
        $this->userModel = User::where('email', $email)->first();
        $this->name = $this->userModel->name;
    }

    #[Computed]
    public function users()
    {
        if (strlen($this->email) > 2) {
            return User::where('email', 'like', "%$this->email%")->get(['email', 'name']);
        }

        return User::all(['email', 'name']);
    }

    public function save()
    {
        $user = null;

        $this->validate();

        if(!$this->user){
            $registerUser = new RegisteredUserController();

            $userRequest = Request::create('', 'POST', parameters:[
                'name'                  => $this->name,
                'email'                 => $this->email,
                'password'              => $this->password,
                'password_confirmation' => $this->passwordConfirmation
            ]);

            $user = $registerUser->store($userRequest, true);
        }

        Employee::create([
            'user_id'       => $this->userModel->id ?? $user->id,
            'cpf'           => $this->cpf,
            'birthday'      => (DateTime::createFromFormat('m/d/Y',$this->birthday))->format('Y-m-d'),
            'comorbidity'   => $this->comorbidity,
        ]);

        return redirect()->route('employee.index');
    }

    public function render()
    {
        return view('livewire.employee.create');
    }
}
