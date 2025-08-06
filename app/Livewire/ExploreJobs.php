<?php

namespace App\Livewire;

use App\Models\JobListing;
use App\Models\Stack;
use App\Models\Technology;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Explore Jobs | Wazzafak')]
class ExploreJobs extends Component
{
    Use WithPagination;

    public $stacks = [];

    public $techs = [];

    public $locations = [];

    public $levels = [];

    public $chosenTechs = [];


    #[Url(as: 'q', except: '')]
    public $text = '';

    #[Url(as: 's', except: '')]
    public $stack = '';

    #[Url(as: 'loc', except: '')]
    public $location = '';

    #[Url(as: 'ex', except: '')]
    public $experience= '';

    #[Url(as: 'sortBy', except: '')]
    public $sortBy = '';


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

    public function getJobListings(){
        $query =  JobListing::query();
        switch($this->sortBy) {
            case 'salary_high_to_low':
                $query->orderBy('salary', 'desc');
                break;
            case 'salary_low_to_high':
                $query->orderBy('salary', 'asc');
                break;
            case 'latest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        return $query->when(!empty($this->chosenTechs), function ($query) {
            $query->whereHas('technologies', function ($q) {
                $q->whereIn('technology_id', $this->chosenTechs);
            });
        })
        ->when($this->text, fn($query) => $query->where('description', 'like', "%{$this->text}%"))
        ->when($this->stack, fn($query) => $query->where('stack_id', $this->stack))
        ->when($this->location, fn($query) => $query->where('location', $this->location))
        ->when($this->experience, fn($query) => $query->where('experience', $this->experience))
        ->where('status', 'Accepted')
        ->whereDoesntHave('jobApplications', function ($query) {
            $query->where('user_id', auth()->id());
        })
        ->paginate(6);
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

    public function updatedText()
    {
        $this->resetPage();
    }

    public function updatedStack()
    {
        $this->resetPage();
    }

    public function updatedLocation()
    {
        $this->resetPage();
    }

    public function updatedExperience()
    {
        $this->resetPage();
    }

    public function updatedSortBy()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->reset([
            'text', 'stack', 'location', 'experience', 'sortBy', 'chosenTechs',
        ]);
        $this->resetPage();
    }

    public function render()
    {
        $jobListings = $this->getJobListings();

        return view('livewire.explore-jobs', [
            'job_listings' => $jobListings,
            'job_listings_count' => $jobListings->total(),
        ]);
    }
}
