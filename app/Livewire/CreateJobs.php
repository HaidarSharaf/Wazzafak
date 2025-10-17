<?php

namespace App\Livewire;

use App\Livewire\Forms\JobForm;
use App\Models\JobListing;
use App\Models\Stack;
use App\Models\Technology;
use App\Services\AIService;
use App\Traits\Notifications;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Create a Job | Wazzafak')]
class CreateJobs extends Component
{
    use Notifications;
    public JobForm $form;

    public $currentStep = 1;

    public $techs = [];
    public $stacks = [];

    public $levels = [];

    public $locations = [];

    public $chosenTechs = [];
    public $descriptionGenerated = false;
    public $isGenerating = false;

    public $techSearch = '';

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

    public function getFilteredTechsProperty()
    {
        if (empty($this->techSearch)) {
            return $this->techs;
        }

        return $this->techs->filter(function ($tech) {
            return stripos($tech->name, $this->techSearch) !== false;
        });
    }

    public function nextStep()
    {
        if ($this->currentStep == 1) {
            $this->form->validate([
                'stack' => $this->form->rules()['stack'],
                'experience' => $this->form->rules()['experience'],
                'location' => $this->form->rules()['location'],
                'salary' => $this->form->rules()['salary'],
            ]);
            $this->currentStep = 2;
        } elseif($this->currentStep == 2){
            $this->form->technologies = $this->chosenTechs;
            $this->form->validate([
                'technologies' => $this->form->rules()['technologies'],
            ]);
            $this->currentStep = 3;
        }
    }

    public function prevStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
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

    public function generateDescription(){

        try{
            $this->isGenerating = true;
            $stack = Stack::find($this->form->stack);
            $stack_name = $stack ? $stack->name : 'Technology';

            $technology_names = Technology::whereIn('id', $this->chosenTechs)
                ->pluck('name')
                ->toArray();

            $job_details = [
                'stack_name' => $stack_name,
                'experience' => $this->form->experience,
                'location' => $this->form->location,
                'salary' => $this->form->salary,
                'technologies' => $technology_names,
            ];

            $aiService = new AIService();
            $description = $aiService->generateJobDescription($job_details);

            $this->form->description = $description;
            $this->descriptionGenerated = true;
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to generate description. Please try again.');
            $this->notify(
                variant: 'danger',
                title: 'Error',
                message: 'Failed to generate description. Please try again.',
            );
        } finally {
            $this->isGenerating = false;
        }
    }

    public function create()
    {
        $this->authorize('create-job-listing');
        $this->form->validate([
            'description' => $this->form->rules()['description'],
        ]);
        $this->form->store();
        $this->chosenTechs = [];
        return $this->redirect(route('posted-jobs'), navigate: true);
    }

    public function render()
    {
        return view('livewire.create-jobs');
    }
}
