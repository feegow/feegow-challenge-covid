<?php

namespace App\Livewire\Employee;

use App\Models\Employee;
use Livewire\Attributes\Validate;
use Livewire\Component;
use DateTime;
use Illuminate\Validation\Rule;

class Update extends Component
{

    public Employee $employee;

    #[Validate]
    public string $name;

    #[Validate]
    public string $birthday;

    #[Validate]
    public bool $comorbidity = false;

    #[Validate]
    public ?string $email = null;

    #[validate]
    public string $cpf;

    public function mount()
    {
        $this->email = $this->employee->user->email;
        $this->name = $this->employee->user->name;
        $this->birthday = DateTime::createFromFormat('Y-m-d', $this->employee->birthday)->format('m/d/Y');
        $this->cpf = $this->employee->cpf;
        $this->comorbidity = $this->employee->comorbidity;
    }

    protected function rules()
    {
        return [
            'email'     => ['required','email:rfc,dns,filter',!Rule::unique('users', 'email')->whereNot('id', $this->employee->id),'min:1','max:100'],
            'name'      => 'required|max:90',
            'cpf'       => 'required|regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/|unique:employees,cpf|min:14|max:14',
            'birthday'  => 'required|date|date_format:m/d/Y|before:-16years',
        ];
    }

    public function save()
    {
        $this->validate();

        if($this->name != $this->employee->user->name || $this->email != $this->employee->user->email){
            $this->employee->user->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);
        }
        $this->employee->update([
            'cpf'           => $this->cpf,
            'birthday'      => (DateTime::createFromFormat('m/d/Y',$this->birthday))->format('Y-m-d'),
            'comorbidity'   => $this->comorbidity,
        ]);

        return redirect()->route('employee.index');
    }

    public function render()
    {
        return view('livewire.employee.update');
    }
}
