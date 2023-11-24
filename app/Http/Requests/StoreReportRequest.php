<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function messages()
    {
        return[
            'type_id'    => 'The :attribute and :other must match.',
            'category_id'    => 'The :attribute must not be empty',
            'sum' => 'The :attribute must not be empty',
            'comment'      => 'The :attribute must not be empty',
        ];

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type_id' => 'required',
            'category_id' => 'required',
            'sum' => 'required|integer|min:1',
            'comment' => 'required',
        ];
    }
}
