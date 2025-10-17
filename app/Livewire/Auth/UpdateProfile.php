<?php

namespace App\Livewire\Auth;

use App\Models\Stack;
use App\Models\Technology;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Update Profile | Wazzafak')]
class UpdateProfile extends Component
{
    use WithFileUploads;

    public $stacks = [];
    public $techs = [];

    public $selectedStacks = [];
    public $selectedTechs = [];
    public $cv;
    public $existingCv;
    public $techSearch = '';
    public $stackSearch = '';

    public function mount()
    {
        $user = Auth::user();

        $this->stacks = Stack::query()->orderBy('name', 'asc')->get();
        $this->techs = Technology::query()->orderBy('name', 'asc')->get();

        $this->selectedStacks = $user->stacks()->pluck('stacks.id')->toArray();
        $this->selectedTechs = $user->technologies()->pluck('technologies.id')->toArray();
        $this->existingCv = $user->developer?->cv;
    }

    public function getFilteredStacksProperty()
    {
        if (empty($this->stackSearch)) {
            return $this->stacks;
        }

        return $this->stacks->filter(function ($stack) {
            return stripos($stack->name, $this->stackSearch) !== false;
        });
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

    public function toggleStack($stackId)
    {
        $key = array_search($stackId, $this->selectedStacks);

        if ($key !== false) {
            unset($this->selectedStacks[$key]);
            $this->selectedStacks = array_values($this->selectedStacks);
        } else {
            $this->selectedStacks[] = $stackId;
        }
    }

    public function toggleTech($techId)
    {
        $key = array_search($techId, $this->selectedTechs);

        if ($key !== false) {
            unset($this->selectedTechs[$key]);
            $this->selectedTechs = array_values($this->selectedTechs);
        } else {
            $this->selectedTechs[] = $techId;
        }
    }


    public function save()
    {
        $this->validate([
            'selectedStacks' => 'required|array|min:1',
            'selectedTechs' => 'required|array|min:1',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $user = Auth::user();
        $developer = $user->developer;

        $user->stacks()->sync($this->selectedStacks);
        $user->technologies()->sync($this->selectedTechs);

        if ($this->cv) {
            if ($developer->cv) {
                Storage::disk('public')->delete('dev_cvs/' . $developer->cv);
            }

            $cvFilename = Str::slug($user->name) . '-' . Str::random(8) . '.' . $this->cv->getClientOriginalExtension();
            $this->cv->storePubliclyAs('dev_cvs', $cvFilename, ['disk' => 'public']);
            $developer->update([
                'cv' => $cvFilename,
            ]);
        }

        return $this->redirect(route('home'), navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.update-profile');
    }
}
