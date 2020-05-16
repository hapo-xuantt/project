<?php

namespace App\Policies;

use App\Models\Member;
use App\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any projects.
     *
     * @param  \App\Models\Member  $user
     * @return mixed
     */
    public function viewAny(Member $user)
    {
        //
    }

    /**
     * Determine whether the user can view the project.
     *
     * @param  \App\Models\Member  $user
     * @param  \App\Project  $project
     * @return mixed
     */
    public function view(Member $user, Project $project)
    {
        //
    }

    /**
     * Determine whether the user can create projects.
     *
     * @param  \App\Models\Member  $user
     * @return mixed
     */
    public function create(Member $user)
    {
        //
    }

    /**
     * Determine whether the user can update the project.
     *
     * @param  \App\Models\Member  $user
     * @param  \App\Project  $project
     * @return mixed
     */
    public function update(Member $user, Project $project)
    {
        //
    }

    /**
     * Determine whether the user can delete the project.
     *
     * @param  \App\Models\Member  $user
     * @param  \App\Project  $project
     * @return mixed
     */
    public function delete(Member $user, Project $project)
    {
        //
    }

    /**
     * Determine whether the user can restore the project.
     *
     * @param  \App\Models\Member  $user
     * @param  \App\Project  $project
     * @return mixed
     */
    public function restore(Member $user, Project $project)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the project.
     *
     * @param  \App\Models\Member  $user
     * @param  \App\Project  $project
     * @return mixed
     */
    public function forceDelete(Member $user, Project $project)
    {
        //
    }
}
