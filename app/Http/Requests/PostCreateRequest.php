<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCreateRequest extends FormRequest
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
            'image' => [
                'required',
                'image',
                'max:2048',
                'mimes:jpeg,png,jpg,gif,svg'
            ],
            'title' => 'required',
            'content' => 'required',
            'category_id' => [
                'required',
                'exists:categories,id'
            ],
            'published_at' => [
                'nullable',
                'datetime'
            ],
        ];
    }
}
