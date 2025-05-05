<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnswerMultipleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'answers' => ['required', 'array', 'min:1'],
            'answers.*.word_id' => ['required', 'integer', 'exists:words,id'],
            'answers.*.option_id' => ['required', 'integer', 'exists:options,id'],
        ];
    }
}
