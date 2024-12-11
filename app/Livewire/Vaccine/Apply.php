<?php

namespace App\Livewire\Vaccine;

use App\Models\Dose;
use App\Models\Employee;
use App\Models\Vaccine;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Apply extends Component
{
    public ?Employee $employee = null;

    public ?string $selectedEmployee = null;

    public ?Vaccine $vaccine = null;

    #[Validate]
    public ?string $selectedVaccine = null;

    protected function rules()
    {
        return [
            'selectedVaccine' => 'required|exists:vaccines,name',
        ];
    }

    public function mount($id)
    {
        $this->employee = Employee::find($id);

        $this->selectedEmployee = $this->employee->user->name;
    }

    public function setVaccine($id)
    {
        $this->vaccine = Vaccine::find($id);
        $this->selectedVaccine = $this->vaccine->name;
    }

    #[Computed]
    public function vaccines()
    {
        if($this->selectedVaccine){
            return Vaccine::where('name', 'like', "%$this->selectedVaccine%")->get();
        }

        return Vaccine::all();
    }

    public function save()
    {
        $this->validate();

        Dose::create([
            'employee_id' => $this->employee->id,
            'vaccine_id' => $this->vaccine->id,
            'dose_date' => now(),
        ]);

        return redirect()->route('employee.index');
    }

    public function render()
    {
        return view('livewire.vaccine.apply');
    }
}
