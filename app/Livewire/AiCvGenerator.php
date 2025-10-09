<?php

namespace App\Livewire;

use App\Models\Stack;
use App\Models\Technology;
use App\Services\AIService;
use App\Traits\Notifications;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('CV Generator | Wazzafak')]
class AiCvGenerator extends Component
{
    use Notifications;

    public $currentStep = 1;

    // Step 1: Personal Info
    public $name = '';
    public $email = '';
    public $phone = '';
    public $location = '';
    public $linkedin = '';
    public $github = '';

    // Step 2: Skills
    public $chosenStacks = [];
    public $chosenTechs = [];
    public $languages = [['name' => '', 'level' => '']];

    // Step 3: Experience & Education
    public $experiences = [];
    public $educations = [];
    public $certifications = [];

    // Data
    public $techs = [];
    public $stacks = [];

    // AI Generated
    public $aiContent = null;
    public $generatingContent = false;
    public $contentGenerated = false;

    public function mount()
    {
        $this->techs = Technology::query()->orderBy('name', 'asc')->get();
        $this->stacks = Stack::query()->orderBy('name', 'asc')->get();

        if (auth()->check()) {
            $this->prefillUserData();
        }
    }

    protected function prefillUserData()
    {
        $user = auth()->user();
        if ($user->role === 'developer' && $user->developer) {
            $developer = $user->developer;

            $this->name = $user->name;
            $this->email = $user->email;
            $this->chosenStacks = $user->stacks->pluck('id')->toArray();
            $this->chosenTechs = $user->technologies->pluck('id')->toArray();
            $this->linkedin = $developer->linkedin_url;
            $this->github = $developer->github_url;
        }
    }

    public function addExperience()
    {
        $this->experiences[] = [
            'title' => '',
            'company' => '',
            'duration' => '',
            'description' => ''
        ];
    }

    public function removeExperience($index)
    {
        unset($this->experiences[$index]);
        $this->experiences = array_values($this->experiences);
    }

    public function addEducation()
    {
        $this->educations[] = [
            'degree' => '',
            'institution' => '',
            'year' => ''
        ];
    }

    public function removeEducation($index)
    {
        unset($this->educations[$index]);
        $this->educations = array_values($this->educations);
    }

    public function addCertification()
    {
        $this->certifications[] = [
            'name' => '',
            'issuer' => '',
            'description' => ''
        ];
    }

    public function removeCertification($index)
    {
        unset($this->certifications[$index]);
        $this->certifications = array_values($this->certifications);
    }

    public function addLanguage()
    {
        $this->languages[] = ['name' => '', 'level' => ''];
    }

    public function removeLanguage($index)
    {
        if (count($this->languages) > 1) {
            unset($this->languages[$index]);
            $this->languages = array_values($this->languages);
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

    public function toggleStack($stackId)
    {
        $key = array_search($stackId, $this->chosenStacks);
        if ($key !== false) {
            unset($this->chosenStacks[$key]);
            $this->chosenStacks = array_values($this->chosenStacks);
        } else {
            $this->chosenStacks[] = $stackId;
        }
    }

    public function nextStep()
    {
        if ($this->currentStep == 1) {
            $this->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'phone' => 'nullable|string|max:20',
                'location' => 'nullable|string|max:255',
                'linkedin' => 'nullable|string',
                'github' => 'nullable|string',
            ]);
            $this->currentStep = 2;
        } elseif ($this->currentStep == 2) {
            $this->validate([
                'chosenStacks' => 'required|array|min:1',
                'chosenTechs' => 'required|array|min:1',
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

    public function generateWithAI()
    {
        $this->generatingContent = true;

        try {
            $stackNames = Stack::whereIn('id', $this->chosenStacks)->pluck('name')->toArray();
            $techNames = Technology::whereIn('id', $this->chosenTechs)->pluck('name')->toArray();

            $userData = [
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'location' => $this->location,
                'linkedin' => $this->linkedin,
                'github' => $this->github,
                'stacks' => $stackNames,
                'technologies' => $techNames,
                'experiences' => $this->experiences,
                'educations' => $this->educations,
                'certifications' => $this->certifications,
            ];

            $aiService = new AIService();
            $this->aiContent = $aiService->generateCVContent($userData);
            $this->contentGenerated = true;

        } catch (\Exception $e) {
            $this->notify(
                variant: 'danger',
                title: 'Failed to generate content',
                message: $e->getMessage()
            );
            logger()->error('CV Generation Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        } finally {
            $this->generatingContent = false;
        }
    }

    public function downloadPDF()
    {
        try {
            $stackNames = Stack::whereIn('id', $this->chosenStacks)->pluck('name')->toArray();
            $techNames = Technology::whereIn('id', $this->chosenTechs)->pluck('name')->toArray();

            $data = [
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'location' => $this->location,
                'linkedin' => $this->linkedin,
                'github' => $this->github,
                'stacks' => $stackNames,
                'technologies' => $techNames,
                'languages' => array_filter($this->languages, fn($lang) => !empty($lang['name'])),
                'experiences' => $this->experiences,
                'educations' => $this->educations,
                'certifications' => $this->certifications,
                'aiContent' => $this->aiContent,
            ];

            $pdf = Pdf::loadView('pdf.cv-template', $data);

            return response()->streamDownload(function() use ($pdf) {
                echo $pdf->output();
            }, $this->name . ' CV.pdf');

        } catch (\Exception $e) {
            $this->notify(
                variant: 'danger',
                title: 'Failed to generate PDF',
                message: $e->getMessage()
            );
            logger()->error('PDF Generation Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.ai-cv-generator');
    }
}
