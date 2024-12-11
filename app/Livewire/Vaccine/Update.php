<?php

namespace App\Livewire\Vaccine;

use App\Models\Vaccine;
use DateTime;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Update extends Component
{
    public Vaccine $vaccine;

    #[Validate]
    public string $name;

    #[Validate]
    public string $batch;

    #[Validate]
    public string $expiry;

    protected function rules()
    {
        return [
            'name' => 'required|min:1|max:35',
            'batch' => 'required|regex:/^[a-zA-Z]{5}[0-9]{4}$/|max:9',
            'expiry' => 'required|date|date_format:m/d/Y|after:today',
        ];
    }

    public function mount()
    {
        $this->name = $this->vaccine->name;
        $this->batch = $this->vaccine->batch;
        $this->expiry = $this->vaccine->expiryFormatted;
    }

    public function save()
    {
        $this->validate();

        $this->vaccine->update([
            'name' => $this->name,
            'batch' => $this->batch,
            'expiry' => DateTime::createFromFormat('m/d/Y', $this->expiry)->format('Y-m-d')
        ]);

        return redirect()->route('vaccine.index');
    }

    public function render()
    {
        return view('livewire.vaccine.update');
    }
}
