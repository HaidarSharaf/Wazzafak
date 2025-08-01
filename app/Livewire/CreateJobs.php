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
        $this->techs = Technology::query()
                            ->orderBy('name', 'asc')
                            ->get();
        $this->stacks = Stack::query()
            ->orderBy('name', 'asc')
            ->get();
    }

    public function toggleTech($techId)
    {
        $key = array_search($techId, $this->chosenTechs);

        if ($key !== false) {
            unset($this->chosenTechs[$key]);
            $this->chosenTechs = array_values($this->chosenTechs);
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
