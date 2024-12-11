<?php

namespace App\Livewire\Vaccine;

use App\Models\Employee;
use App\Models\Vaccine;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Apply extends Component
{
    public ?Employee $employee = null;

    public ?string $selectedEmployee = null;

    public ?Vaccine $vaccine = null;

    public ?string $selectedVaccine = null;

    protected function rules()
    {
        return [

        ];
    }

    public function mount($id)
    {
        $this->employee = Employee::find($id);

        $this->selectedEmployee = $this->employee->user->name;
    }

    public function setVaccine($id)
    {
        $this->vaccine = $id;
    }

    #[Computed]
    public function vaccines()
    {
        return Vaccine::all()->pluck('name');
    }

    public function render()
    {
        return view('livewire.vaccine.apply');
    }
}
