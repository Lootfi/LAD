<?php

namespace App\Http\Requests\Teacher\Quiz;

use App\Models\Quiz;
use Illuminate\Foundation\Http\FormRequest;

class UpdateQuizRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string|unique:quizzes,name,' . $this->quiz->id,
            'start_date' => 'required|date|after:now'
        ];
    }
}
