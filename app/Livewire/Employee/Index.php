<?php

namespace App\Livewire\Employee;

use App\Models\Employee;
use App\Models\Vaccine;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    public string $search = '';

    public string $employeeToApply;

    public string $vaccineToApply;

    public array $vaccines = [];

    public function setEmployee($id)
    {
        $this->employeeToApply = Employee::find($id)->user->name;
    }

    public function setVaccine($vaccine)
    {
        $this->vaccineToApply = $vaccine;
    }

    #[Computed]
    public function employees()
    {
        if(strlen($this->search) > 2){
            $search = $this->search;
            return Employee::whereHas('user', function($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })->with('user')->withCount('doses')->paginate(15);
        }

        return Employee::with('user')->withCount('doses')->paginate(15);
    }

    public function render()
    {
        return view('livewire.employee.index');
    }
}
