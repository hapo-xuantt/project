<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProject;
use App\Models\Customer;
use App\Models\Member;
use App\Models\Project;
use App\Models\ProjectStatus;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $projects = Project::SearchByName($request)->with('customer', 'projectStatus', 'leader')->paginate(config('app.pagination'));
        $data = [
            'projects' => $projects
        ];

        if (count($projects) > 0) return view('projects.index', $data);
        return view('projects.index')->with('message', __('messages.search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'customers' => Customer::all(),
            'leaders' => Member::all(),
            'statuses' => ProjectStatus::all()
        ];
        return view('projects.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProject $request)
    {
        $data = $request->all();
        Project::create($data);
        return redirect()->route('projects.index')->with('success', __('messages.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);
        $members = Project::find($id)->members;
        $data = [
            'project' => $project,
            'members' => $members
        ];
        if (count($members) > 0) return view('projects.detail', $data);
        return view('projects.detail', ['project' => $project])->with('message', __('messages.result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'project' => Project::findOrFail($id),
            'customers' => Customer::all(),
            'leaders' => Member::all(),
            'statuses' => ProjectStatus::all(),
        ];
        return view('projects.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProject $request, $id)
    {
        Project::findOrFail($id)->update($request->all());
        return redirect()->route('projects.index')->with('success', __('messages.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return redirect()->route('projects.index')->with('success', __('messages.destroy'));
    }

    public function add($id, Request $request)
    {
        $members = Member::paginate(config('app.pagination'));
        $project = Project::find($id);
        $data = [
            'members' => $members,
            'project' => $project,
        ];
        if (count($members) > 0) return view('projects.add', $data);
        return view('projects.add')->with('message', __('messages.search'));
    }

    public function storeMember($id, $memberId)
    {
        $project = Project::find($id);
        if (!$project->checkIsMyMember($memberId)) $project->members()->attach($memberId);
        return redirect()->route('projects.show', $id);
    }

    public function destroyMember($id, $memberId)
    {
        $project = Project::findOrFail($id);
        $member = $project->members()->where('member_id', $memberId)->get();
        $project->members()->detach($member);
        return redirect()->route('projects.show', $id)->with('success', __('messages.destroy'));
    }
}
