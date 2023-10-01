<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogFormPostRequest extends FormRequest
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
            'title' => ['required','min:10','max:120'],
            'slug' => ['required','min:10','max:120','regex:/^[0-9a-z\-]+$/', Rule::unique('posts')->ignore($this->route()->parameter('post'))],
            'content' => ['required','min:10','max:5000'],
            'category_id' => ['required','exists:categories,id'],
            'tags' => ['array','exists:tags,id', 'required']
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => $this->input('slug') ?: \Str::slug($this->input('title'))
        ]);
    }
}
