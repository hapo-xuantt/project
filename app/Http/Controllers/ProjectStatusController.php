<?php

namespace App\Http\Controllers;

use App\Models\ProjectStatus;
use Illuminate\Http\Request;

class ProjectStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'projectStatuses' => ProjectStatus::all(),
        ];
        return view('projectstatus.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ProjectStatus::create($request->all());
        return redirect()->route('project_status.index')->with('success', __('messages.create'));;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjectStatus  $projectStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $projectStatus = ProjectStatus::findOrFail($id);
        $projectStatus->update($request->all());
        return redirect()->route('project_status.index')->with('success', __('messages.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectStatus  $projectStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $projectStatus = ProjectStatus::findOrFail($id);
        $projectStatus->delete();
        return redirect()->route('project_status.index');
    }
}
