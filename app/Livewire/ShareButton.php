<?php

namespace App\Livewire;

use App\Models\JobListing;
use Livewire\Component;

class ShareButton extends Component
{
    public JobListing $job;

    public function mount(JobListing $job)
    {
        $this->job = $job;
    }

    public function render()
    {
        return view('livewire.share-button');
    }
}
