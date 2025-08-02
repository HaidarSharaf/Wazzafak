<?php

namespace App\Livewire\Forms;

use App\Models\JobListing;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;

class JobForm extends Form
{
    public ?JobListing $jobListing;

    #[Locked]
    public $id;

    public $stack;

    public $technologies;

    public $description;

    public $salary = 400;

    public $location;

    public $experience;

    public function rules()
    {
        return [
            'stack' => 'required|exists:stacks,id',
            'technologies' => 'required|array|min:1',
            'technologies.*' => 'exists:technologies,id',
            'description' => 'required|string|min:50',
            'salary' => 'required|numeric|min:400',
            'location' => ['required', 'in:' . implode(',', array_keys(JobListing::getLocations()))],
            'experience' => ['required', 'in:' . implode(',', array_keys(JobListing::getExperienceLevels()))],
        ];
    }

    public function setJob(JobListing $job)
    {
        $this->id = $job->id;
        $this->stack = $job->stack_id;
        $this->technologies = $job->technologies->pluck('id')->toArray();
        $this->description = $job->description;
        $this->salary = $job->salary;
        $this->location = $job->location;
        $this->experience = $job->experience;

        $this->jobListing = $job;
    }

    public function store(){
        $this->validate();

        $job = JobListing::create([
            'user_id' => auth()->id(),
            'stack_id' => $this->stack,
            'description' => $this->description,
            'salary' => $this->salary,
            'location' => $this->location,
            'experience' => $this->experience,
            'status' => 'Pending'
        ]);

        $job->technologies()->attach($this->technologies);
        $this->reset();
    }

}
