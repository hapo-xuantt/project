<?php

namespace App\Http\Requests;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class StoreTask extends FormRequest
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
        $project_id = $request->project_id;
        $began_at = $request->began_at;
        $project= Project::find($project_id);
        if(isset($began_at)){
            $count = Project::find($project_id)->where('began_at', '<=', $began_at)
                ->where('finished_at', '>=', $began_at)->count();
            if ($count == 0) {
                 return [
                    'name' => 'required|max:50',
                    'description' => 'required',
                    'began_at' => 'between:min, max'.': '.$project['began_at'].' and '.$project['finished_at'],
                    'finished_at' => 'required|date|after_or_equal:began_at|before:'.$project['finished_at'],
                ];
            }
            return [
                'name' => 'required|max:50',
                'description' => 'required',
                'finished_at' => 'required|date|after_or_equal:began_at|before:'.$project['finished_at'],
            ];
        }

        return [
            'name' => 'required|max:50',
            'description' => 'required',
            'began_at' => 'required|date|',
            'finished_at' => 'required|date|after_or_equal:began_at|before:'.$project['finished_at'],
        ];
    }
}
