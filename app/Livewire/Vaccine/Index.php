<?php

namespace App\Livewire\Vaccine;

use App\Models\Vaccine;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    public string $search = '';

    #[Computed]
    public function vaccines()
    {
        if($this->search){
            return Vaccine::where('name',  'like', "%$this->search%")
                ->orWhere('batch', 'like', "%$this->search%")
                ->paginate(20);
        }

        return Vaccine::paginate(20);
    }

    public function render()
    {
        return view('livewire.vaccine.index');
    }
}
