<?php namespace App\Http\Requests\Admin\Grade;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreGrade extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.grade.create');
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
            'level_id' => ['required', 'array'],
            'courses' => ['required', 'string'],
            'enabled' => ['required', 'boolean'],
        ];
    }

    public function getModifiedData()
    {
        $data = $this->only(collect($this->rules())->keys()->all());
        $data["level_id"] = $data["level_id"]["id"];
        return $data;
    }
}
