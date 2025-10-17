<?php

namespace App\Livewire\Admin;

use App\Models\Stack;
use App\Traits\Notifications;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title('Manage Stacks | Wazzafak')]
class ManageStacks extends Component
{
    use Notifications;
    use WithPagination;

    #[Validate('required|string|max:255|unique:stacks,name')]
    public $name = '';
    public $editingId = null;
    public $deletingId = null;
    public $search = '';

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

    public function create()
    {
        $this->authorize('manage-stacks');
        $this->validate();

        Stack::create(['name' => $this->name]);

        $this->notify(
            variant: 'success',
            title: 'Stack Created successfully!',
            message: "New stack added."
        );

        $this->resetForm();
        $this->dispatch('close-modal');
    }

    public function update()
    {
        $this->authorize('manage-stacks');
        $this->validate();

        $stack = Stack::findOrFail($this->editingId);
        $stack->update(['name' => $this->name]);

        $this->notify(
            variant: 'success',
            title: 'Stack Edited successfully!',
            message: "Stack name has been updated."
        );

        $this->resetForm();
        $this->dispatch('close-edit-modal');

    }
    public function confirmDelete($id)
    {
        $this->deletingId = $id;
    }

    public function delete()
    {
        $this->authorize('manage-stacks');
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
