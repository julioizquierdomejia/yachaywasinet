<?php namespace App\Http\Requests\Admin\Subject;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateSubject extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.subject.edit', $this->subject);
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
            'description' => ['required', 'string'],
            'course_id' => ['required'],
            'slug' => ['required', 'string'],
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
        if (is_array($data["course_id"]))
            $data["course_id"] = $data["course_id"]["id"];

        return $data;
    }

}
