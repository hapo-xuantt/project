<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTask;
use App\Http\Requests\UpdateTask;
use App\Models\Project;
use App\Models\Member;
use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Http\Request;
use Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tasks = Task::searchByProject($request)->searchByMember($request)
            ->with('project', 'member', 'taskStatuses')
            ->paginate(config('app.pagination'));
        $data = [
            'tasks' => $tasks
        ];
        return view('tasks.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'projects' => Project::all(),
            'statuses' => TaskStatus::all()
        ];
        return view('tasks.create', $data);
    }

    public function showMemberProject($id)
    {
        $member = Project::findOrFail($id)->members;
        return response()->json($member);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTask $request)
    {
        Task::create($request->all());
        return redirect()->route('tasks.index')
            ->with('success', __('messages.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        $data  = [
            'task' => $task,
            'members' => Member::all()
        ];
        return view('tasks.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        if(Auth::user()->is_admin == 1 || Auth::id() == $task->project->leader_id) {
            $data = [
                'task' => Task::findOrFail($id),
                'projects' => Project::all(),
                'statuses' => TaskStatus::all()
            ];
            return view('tasks.edit', $data);
        }
        else return redirect()->route('tasks.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTask $request, $id)
    {
        Task::findOrFail($id)->update($request->all());
        return redirect()->route('tasks.index')
            ->with('success', __('messages.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        if(Auth::user()->is_admin == 1 || Auth::id() == $task->project->leader_id) {
            $task->delete();
            return redirect()->route('tasks.index')
                ->with('success', __('messages.destroy'));
        }
        else return redirect()->route('tasks.index');
    }

    public function add($id)
    {
        $data = [
            'project' => Project::findOrFail($id),
            'members' => Project::findOrFail($id)->members,
            'statuses' => TaskStatus::all()
        ];
        return view('tasks.add', $data);
    }

    public function assign(Request $request, $id)
    {
        Task::findOrFail($id)->update($request->all());
        return redirect()->route('tasks.show', $id);
    }
}
