<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResourceRequest extends FormRequest
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
            'data' => 'required',
            'data.title' => 'required|max:255',
            'data.description' => 'max:1024',
            'data.topic' => 'integer|required|exists:topics,id',
            'data.subject' => 'integer|required|exists:subjects,id',
            'files.*' => 'file'
        ];
    }
}
