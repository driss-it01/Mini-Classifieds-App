<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreAdRequest extends FormRequest
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
            'title' => ['required','string','max:150'],
            'description' => ['nullable','string','max:2000'],
            'price' => ['nullable','integer','min:0'],
            'location' => ['nullable','string','max:120'],
            'category_id' => ['required','exists:categories,id'],
            'images.*' => ['nullable','image','max:4096'], // 4MB
        ];
    }
}
