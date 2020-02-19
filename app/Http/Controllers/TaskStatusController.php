<?php

namespace App\Http\Controllers;

use App\Models\ProjectStatus;
use App\TaskStatus;
use Illuminate\Http\Request;

class TaskStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'taskStatuses' => TaskStatus::all(),
        ];
        return view('TaskStatus.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        TaskStatus::create($request->all());
        return redirect()->route('taskStatus.index')->with('success', __('messages.create'));;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TaskStatus  $taskStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $taskStatus = TaskStatus::findOrFail($id);
        $taskStatus->update($request->all());
        return redirect()->route('taskStatus.index')->with('success', __('messages.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TaskStatus  $taskStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $taskStatus= TaskStatus::findOrFail($id);
        $taskStatus->delete();
        return redirect()->route('taskStatus.index')->with('success', __('messages.destroy'));
    }
}
