<?php

namespace App\Http\Requests;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTask extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $projectId = $request->project_id;
        $project= Project::findOrFail($projectId);

        return [
            'name' => 'required|max:50',
            'description' => 'required',
            'began_at' => [
                'required',
                'date',
                'after_or_equal:' . $project['began_at'],
                'before_or_equal:' . $project['finished_at']
            ],
            'finished_at' => 'required|date|after_or_equal:began_at|before:' . $project['finished_at'],
        ];
    }
}
