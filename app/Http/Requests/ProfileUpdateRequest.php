<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Personal Information
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'extension_name' => ['nullable', 'string', 'max:50'],

            // Contact Information
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->user_id, 'user_id'),
            ],
            'contact_number' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],

            // Personal Details
            'date_of_birth' => ['nullable', 'date', 'before:today'],
            'sex' => ['nullable', 'string', 'in:male,female,other'],
            'civil_status' => ['nullable', 'string', 'in:Single,Married,Divorced,Widowed'],

            // Additional Information
            'citizenship' => ['nullable', 'string', 'max:100'],
            'place_of_birth' => ['nullable', 'string', 'max:255'],
            'blood_type' => ['nullable', 'string', 'in:A+,A-,B+,B-,AB+,AB-,O+,O-'],
            'religion' => ['nullable', 'string', 'max:100'],

            // Family Information
            'birth_order' => ['nullable', 'integer', 'min:0'],
            'no_of_siblings' => ['nullable', 'integer', 'min:0'],

            // Profile Picture
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'profile_pic' => 'profile picture',
            'no_of_siblings' => 'number of siblings',
        ];
    }
}
