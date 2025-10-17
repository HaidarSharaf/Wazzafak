<?php

namespace App\Livewire\Admin;

use App\Models\Technology;
use App\Traits\Notifications;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title('Manage Technologies | Wazzafak')]
class ManageTechnologies extends Component
{
    use Notifications;
    use WithPagination, WithFileUploads;

    #[Validate('required|string|max:255|unique:technologies,name')]
    public $name = '';

    #[Validate('nullable|mimes:svg,png,jpg,jpeg|max:2048')]
    public $icon = null;
    public $editingId = null;
    public $showModal = false;
    public $showDeleteModal = false;
    public $deletingId = null;
    public $search = '';
    public $existingIcon = null;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openCreateModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function openEditModal($id)
    {
        $tech = Technology::findOrFail($id);
        $this->editingId = $tech->id;
        $this->name = $tech->name;
        $this->existingIcon = $tech->icon;
        $this->showModal = true;
    }

    public function create()
    {
        $this->authorize('manage-techs');

        $this->validate();

        $data = ['name' => $this->name];

        if ($this->icon) {
            $filename = Str::lower($this->name) . '.' . $this->icon->getClientOriginalExtension();
            $this->icon->storeAs('technologies_icons', $filename, 'public');
            $data['icon'] = $filename;
        }

        Technology::create($data);

        $this->notify(
            variant: 'success',
            title: 'Technology Created!',
            message: "New technology added."
        );

        $this->resetForm();
        $this->dispatch('close-modal');
    }

    public function update()
    {
        $this->authorize('manage-techs');

        $this->validate();

        $tech = Technology::findOrFail($this->editingId);
        $data = ['name' => $this->name];

        if ($this->icon) {
            if ($tech->icon && Storage::disk('public')->exists('technologies_icons/' . $tech->icon)) {
                Storage::disk('public')->delete('technologies_icons/' . $tech->icon);
            }

            $filename = Str::lower($this->name) . '.' . $this->icon->getClientOriginalExtension();
            $this->icon->storeAs('technologies_icons', $filename, 'public');
            $data['icon'] = $filename;
        }

        $tech->update($data);

        $this->notify(
            variant: 'success',
            title: 'Technology Updated!',
            message: "Technology details updated."
        );

        $this->resetForm();
        $this->dispatch('close-edit-modal');
    }


    public function confirmDelete($id)
    {
        $this->deletingId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $this->authorize('manage-techs');
        try {
            $tech = Technology::findOrFail($this->deletingId);

            if ($tech->icon && \Storage::disk('public')->exists('technologies_icons/' . $tech->icon)) {
                \Storage::disk('public')->delete('technologies_icons/' . $tech->icon);
            }

            $tech->delete();

            $this->notify(
                variant: 'success',
                title: 'Technology Deleted successfully!',
                message: "$tech->name deleted."
            );
        } catch (\Exception $e) {
            $this->notify(
                variant: 'danger',
                title: 'Error!',
                message: "Cannot delete technology. It may be in use."
            );
        }

        $this->showDeleteModal = false;
        $this->deletingId = null;
    }

    public function resetForm()
    {
        $this->name = '';
        $this->icon = null;
        $this->existingIcon = null;
        $this->editingId = null;
        $this->resetErrorBag();
    }

    public function getTechs()
    {
        return Technology::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->withCount('jobListings')
            ->orderBy('name')
            ->paginate(15);
    }

    public function render()
    {
        return view('livewire.admin.manage-technologies', [
            'technologies' => $this->getTechs(),
        ]);
    }
}
