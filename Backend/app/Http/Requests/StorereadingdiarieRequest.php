<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorereadingdiarieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Általában true, ha bejelentkezett a felhasználó
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'userId' => 'required|integer',
            'studentOpinion' => 'required|string|max:250',
            'bookId' => 'required|integer|exists:books,id',
            'grade' => 'required|integer',
        ];
    }
}