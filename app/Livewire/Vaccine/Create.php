<?php

namespace App\Livewire\Vaccine;

use App\Models\Vaccine;
use DateTime;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    #[Validate]
    public string $name;
    #[Validate]
    public ?string $batch = null;
    #[Validate]
    public string $expiry;

    public bool $newBatch = false;

    protected function rules()
    {
        return [
            'name' => 'required|min:1|max:35',
            'batch' => 'required|regex:/^[a-zA-Z]{5}[0-9]{4}$/|max:9',
            'expiry' => 'required|date|date_format:m/d/Y|after:today',
        ];
    }

    public function updatedNewBatch()
    {
        $this->batch = null;
    }

    public function setBatch($batch)
    {
        $this->batch = $batch;
    }

    #[Computed]
    public function batches()
    {
        if($this->batch){
            return Vaccine::where('batch', 'like', '%'.strtoupper($this->batch).'%')
                ->get()
                ->pluck('batch');
        }

        return Vaccine::all()->pluck('batch');
    }

    public function save()
    {
        $this->validate();

        Vaccine::create([
          'name' => $this->name,
          'batch' => strtoupper($this->batch),
          'expiry' => DateTime::createFromFormat('m/d/Y', $this->expiry)->format('Y-m-d')
        ]);

        return redirect()->route('vaccine.index');
    }

    public function render()
    {
        return view('livewire.vaccine.create');
    }
}
