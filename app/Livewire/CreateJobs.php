<?php

namespace App\Livewire;

use App\Livewire\Forms\JobForm;
use App\Models\JobListing;
use App\Models\Stack;
use App\Models\Technology;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Create a Job | Wazzafak')]
class CreateJobs extends Component
{
    public JobForm $form;

    public $techs = [];
    public $stacks = [];

    public $levels = [];

    public $locations = [];

    public $chosenTechs = [];

    public function mount(){
        $this->techs = Technology::query()
                            ->orderBy('name', 'asc')
                            ->get();
        $this->stacks = Stack::query()
            ->orderBy('name', 'asc')
            ->get();
        $this->locations = JobListing::getLocations();
        $this->levels = JobListing::getExperienceLevels();
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

    public function create()
    {
        $this->authorize('create-job-listing');

        $this->form->technologies = $this->chosenTechs;
        $this->form->store();
        $this->chosenTechs = [];
        return $this->redirect(route('posted-jobs'), navigate: true);    }

    public function render()
    {
        return view('livewire.create-jobs');
    }
}
