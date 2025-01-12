<?php

namespace App\Http\Requests;

use App\Models\Lesson;
use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            "name" => "required|string|max:20|unique:" . Lesson::class,
            "description" => "required|string|max:400",
        ];

        if ($this->isMethod('PUT')) {
            $rules["name"] = "required|string|max:20|unique:lessons,name," . $this->route('lesson.id');
        }

        return $rules;
    }
}
