<?php

namespace App\Http\Requests\Teacher\Quiz;

use Illuminate\Foundation\Http\FormRequest;

class CreateQuizRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'string|unique:quizzes,name',
            'start_date' => 'required|date|after:tomorrow'
        ];
    }
}
