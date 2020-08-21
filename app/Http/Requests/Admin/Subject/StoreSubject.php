<?php namespace App\Http\Requests\Admin\Subject;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreSubject extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.subject.create');
    }

/**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'course_id' => ['required'],
            'slug' => ['required', 'string'],
            'enabled' => ['required', 'boolean'],
        ];
    }

    public function getModifiedData()
    {
        $data = $this->only(collect($this->rules())->keys()->all());
        $data["course_id"] = $data["course_id"]["id"];
        return $data;
    }
}
