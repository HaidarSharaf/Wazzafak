<?php

namespace App\Livewire\Admin;

use App\Models\Stack;
use App\Traits\Notifications;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title('Manage Stacks | Wazzafak')]
class ManageStacks extends Component
{
    use Notifications;
    use WithPagination;

    public $name = '';
    public $editingId = null;
    public $deletingId = null;
    public $search = '';

    protected $rules = [
        'name' => 'required|string|max:255|unique:stacks,name',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openCreateModal()
    {
        $this->resetForm();
    }

    public function openEditModal($id)
    {
        $stack = Stack::findOrFail($id);
        $this->editingId = $stack->id;
        $this->name = $stack->name;
    }

    public function save()
    {
        if ($this->editingId) {
            $this->validate([
                'name' => 'required|string|max:255|unique:stacks,name,' . $this->editingId,
            ]);

            $stack = Stack::findOrFail($this->editingId);
            $stack->update(['name' => $this->name]);

            $this->notify(
                variant: 'success',
                title: 'Stack Edited successfully!',
                message: "Stack name has been updated."
            );
        } else {
            $this->validate();

            Stack::create(['name' => $this->name]);

            $this->notify(
                variant: 'success',
                title: 'Stack Created successfully!',
                message: "New stack added."
            );
        }

        $this->resetForm();
        $this->dispatch('close-modal');
    }

    public function confirmDelete($id)
    {
        $this->deletingId = $id;
    }

    public function delete()
    {
        try {
            $stack = Stack::findOrFail($this->deletingId);
            $stack->delete();

            $this->notify(
                variant: 'success',
                title: 'Stack Deleted successfully!',
                message: "$stack->name deleted."
            );
        } catch (\Exception $e) {
            $this->notify(
                variant: 'danger',
                title: 'Error!',
                message: "Cannot delete stack."
            );
        }

        $this->deletingId = null;
        $this->dispatch('close-delete-modal');
    }

    public function resetForm()
    {
        $this->name = '';
        $this->editingId = null;
        $this->resetErrorBag();
    }

    public function getStacks()
    {
        return Stack::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->withCount('jobListings')
            ->orderBy('name')
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.admin.manage-stacks', [
            'stacks' => $this->getStacks(),
        ]);
    }
}
