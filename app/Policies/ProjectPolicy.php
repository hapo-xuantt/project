<?php

namespace App\Policies;

use App\Models\Member;
use App\Models\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
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
        return true;
    }

    /**
     * Determine whether the user can create projects.
     *
     * @param  \App\Models\Member  $user
     * @return mixed
     */
    public function create(Member $user)
    {
        return $user->id > 0;
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
        return $user->id == $project->member_id;
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
       if( $user->is_admin == 1 ) return true;
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
