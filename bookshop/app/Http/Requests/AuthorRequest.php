<?php

namespace App\Http\Requests;

use App\GenderEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AuthorRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'birthday' => 'nullable|date|before_or_equal:today',
            'deathdate' => 'nullable|date|after_or_equal:birthday',
            'gender' => ['nullable', Rule::in([GenderEnum::MALE->value, GenderEnum::FEMALE->value, GenderEnum::OTHER->value])],
        ];
    }
}
