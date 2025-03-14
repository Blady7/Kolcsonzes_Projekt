<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRentalRequest extends FormRequest
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
            'specimenId' => 'required|integer',
            'userId' => 'required|integer',
            'startingDate' => 'nullable|date',
            'endingDate' => 'nullable|date',
        ];
    }
}