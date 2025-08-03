<?php

namespace App\Policies;

use App\Models\JobListing;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class JobListingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, JobListing $jobListing): bool
    {
        if ($jobListing->status === 'Accepted') {
            return true;
        }

        if (in_array($jobListing->status, ['Pending', 'Rejected'])) {
            return $user->role === 'admin' || $user->id === $jobListing->user_id;
        }

        return false;
    }

    /**
     * Determine if the user can accept a job listing
     */
    public function accept(User $user, JobListing $jobListing): bool
    {
        return $user->role === 'admin' && $jobListing->status === 'Pending';
    }

    /**
     * Determine if the user can reject a job listing
     */
    public function reject(User $user, JobListing $jobListing): bool
    {
        return $user->role === 'admin' && $jobListing->status === 'Pending';
    }

    /**
     * Determine if the user can view applicants
     */
    public function viewApplicants(User $user, JobListing $jobListing): bool
    {
        return $user->id === $jobListing->user_id && $jobListing->status === 'Accepted';
    }

    /**
     * Determine if the user can manage applicants (accept/reject)
     */
    public function manageApplicants(User $user, JobListing $jobListing): bool
    {
        return $user->id === $jobListing->user_id &&
            $jobListing->status === 'Accepted' &&
            !$jobListing->is_disclosed;
    }

    /**
     * Determine if the user can disclose a job listing
     */

    public function disclose(User $user, JobListing $jobListing): bool
    {
        return $user->id === $jobListing->user_id &&
            $jobListing->status === 'Accepted' &&
            !$jobListing->is_disclosed;
    }

    public function apply(User $user, JobListing $jobListing): bool
    {
        return $user->role === 'developer' &&
            $jobListing->status === 'Accepted' &&
            !$jobListing->is_disclosed
            && !$user->appliedJobs()->where('job_listing_id', $jobListing->id)->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'recruiter';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, JobListing $jobListing): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, JobListing $jobListing): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, JobListing $jobListing): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, JobListing $jobListing): bool
    {
        return false;
    }
}
