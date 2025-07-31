<?php

namespace App\Livewire;

use App\Models\Stack;
use App\Models\Technology;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Create a Job | Wazzafak')]
class CreateJobs extends Component
{

    public $techs = [];
    public $stacks = [];

    public $locations = [
        'Remote',
        'Hybrid',
        'OnSite'
    ];

    public $chosenTechs = [];

    public $salary = 400;

    public function mount(){
        $this->techs = Technology::all();
        $this->stacks = Stack::all();
    }

    public function toggleTech($techId)
    {
        if (in_array($techId, $this->chosenTechs)) {
            $this->chosenTechs = array_filter($this->chosenTechs, fn($id) => $id != $techId);
        } else {
            $this->chosenTechs[] = $techId;
        }
    }

    public function create(){

    }

    public function render()
    {
        return view('livewire.create-jobs');
    }
}
