<?php namespace App\Http\Requests\Admin\Grade;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateGrade extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.grade.edit', $this->grade);
    }

/**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
            'title' => ['sometimes', 'string'],
            'level_id' => ['required'],
            'courses' => ['sometimes', 'string'],
            'enabled' => ['sometimes', 'boolean'],
                    ];
    }


    /**
    * Modify input data
    *
    * @return  array
    */
    public function getSanitized()
    {
        $sanitized = $this->validated();


        //Add your code for manipulation with request data here

        return $sanitized;
    }

    public function getModifiedData()
    {
        $data = $this->only(collect($this->rules())->keys()->all());
        if (is_array($data["level_id"])) {
            $data["level_id"] = $data["level_id"]["id"];
        }
        if (is_array($data['courses'])) {
            $data["courses"] = $data["courses"]["id"];
        }

        return $data;
    }

}
