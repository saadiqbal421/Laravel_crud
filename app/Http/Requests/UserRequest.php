<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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

        $rules = [
            'name' => 'required|regex:/^[A-Za-z\s]+$/',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('insert_users')->ignore($this->id)],
            'age' => 'required|integer',
            'password' => 'required|string|min:8|regex:/^(?=.*[A-Z])/',
            'number'     => 'required|string|min:11',
        
            'address'     => 'required|string',
        ];

        if (request()->id) {
            $rules['image'] = 'nullable|image|mimes:jpeg,jpg,png';
        } else {
            $rules['image'] = 'required|image|mimes:jpeg,jpg,png';
        }
        if (request()->id) {
            $rules['subject'] = 'nullable|string';
        } else {
            $rules['subject'] = 'required|string';
        }
        return $rules;
    }
}