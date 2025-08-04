<?php

namespace App\Livewire\Auth;

use App\Models\Developer;
use App\Models\JobListing;
use App\Models\Recruiter;
use App\Models\Stack;
use App\Models\Technology;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;


#[Title('Register | Wazzafak')]
class Register extends Component
{
    Use WithFileUploads;
    public $currentStep = 1;

    // Step 1 properties
    public $email;
    public $account_type;

    // Developer properties
    public $name;
    public $experience_level;

    public $chosenStacks = [];
    public $chosenTechs = [];
    public $linkedin_url;
    public $github_url;
    public $cv;

    // Recruiter properties
    public $city;
    public $company_name;
    public $company_logo;

    // Step 3 properties
    public $password;
    public $password_confirmation;

    public $techs = [];
    public $stacks = [];
    public $levels = [];
    public $cities = [
        'Beirut',
        'Mount Lebanon',
        'Sidon',
        'Tyre',
        'Zahle',
        'Bekaa',
        'Byblos',
        'Tripoli',
    ];

    public function mount()
    {
        $this->techs = Technology::query()
            ->orderBy('name', 'asc')
            ->get();
        $this->stacks = Stack::query()
            ->orderBy('name', 'asc')
            ->get();
        $this->levels = JobListing::getExperienceLevels();
    }


    public function rules(){
        return [
            'email' => 'required|email|unique:users',
            'account_type' => 'required|in:developer,recruiter',


            'name' => 'required_if:account_type,developer|string|max:255',
            'chosenStacks' => 'required_if:account_type,developer|array|min:1',
            'chosenStacks.*' => 'exists:stacks,id',
            'chosenTechs' => 'required_if:account_type,developer|array|min:1',
            'chosenTechs.*' => 'exists:technologies,id',
            'experience_level' => ['required_if:account_type,developer', Rule::in($this->levels)],
            'linkedin_url' => [
                'required',
                'string',
                'regex:/^linkedin\.com\/in\/[A-Za-z0-9_-]+$/i',
            ],

            'github_url' => [
                'required',
                'string',
                'regex:/^github\.com\/[A-Za-z0-9_-]+$/i',
            ],

            'cv' => 'required|file|mimes:pdf,doc,docx|max:5120',


            'city' => ['required_if:account_type,recruiter', 'string', Rule::in($this->cities)],
            'company_name' => 'required_if:account_type,recruiter|string|max:255',
            'company_logo' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048',

        ];
    }

    public function nextStep()
    {
        if ($this->currentStep == 1) {
            $this->validate([
                'email' => $this->rules()['email'],
                'account_type' => $this->rules()['account_type']
            ]);
            $this->currentStep = 2;
        } elseif ($this->currentStep == 2) {
            if ($this->account_type == 'developer') {
                $this->validate([
                    'name' => $this->rules()['name'],
                    'chosenStacks' => $this->rules()['chosenStacks'],
                    'chosenStacks.*' => $this->rules()['chosenStacks.*'],
                    'chosenTechs' => $this->rules()['chosenTechs'],
                    'chosenTechs.*' => $this->rules()['chosenTechs.*'],
                    'experience_level' => $this->rules()['experience_level'],
                    'linkedin_url' => $this->rules()['linkedin_url'],
                    'github_url' => $this->rules()['github_url'],
                    'cv' => $this->rules()['cv'],
                ]);
            } else {
                $this->validate([
                    'city' => $this->rules()['city'],
                    'company_name' => $this->rules()['company_name'],
                    'company_logo' => $this->rules()['company_logo'],
                ]);
            }
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

    public function register(): void
    {
        $this->validate([
            'password' => ['required', 'string', 'confirmed', 'min:10', Rules\Password::defaults()],
        ]);

        $hashedPassword = Hash::make($this->password);

        $user = User::create([
            'name' => $this->account_type === 'recruiter' ? $this->company_name : $this->name,$this->name,
            'email' => $this->email,
            'password' => $hashedPassword,
            'role' => $this->account_type,
        ]);

        if ($this->account_type === 'developer') {

            $cvFilename = Str::slug($user->name) . '-' . Str::random(8) . '.' . $this->cv->getClientOriginalExtension();
            $this->cv->storePubliclyAs('dev_cvs', $cvFilename, ['disk' => 'public']);

            Developer::create([
                'user_id' => $user->id,
                'experience_level' => $this->experience_level,
                'github_url' => $this->github_url,
                'linkedin_url' => $this->linkedin_url,
                'cv' => $cvFilename,
            ]);


            $user->technologies()->sync($this->chosenTechs);
            $user->stacks()->sync($this->chosenStacks);

        } elseif ($this->account_type === 'recruiter') {
            $logoFilename = Str::slug($user->name) . '-' . Str::random(8) . '.' . $this->company_logo->getClientOriginalExtension();
            $this->company_logo->storePubliclyAs('users_avatars', $logoFilename, ['disk' => 'public']);

            Recruiter::create([
                'user_id' => $user->id,
                'company_name' => $this->company_name,
                'location' => $this->city,
                'company_logo' => $logoFilename,
            ]);
        }

        event(new Registered($user));
        Auth::login($user);

        $this->redirect(route('verify-email'), navigate: true);
    }


    public function render()
    {
        return view('livewire.auth.register');
    }
}
