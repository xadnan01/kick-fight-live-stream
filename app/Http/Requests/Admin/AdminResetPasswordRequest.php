<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Services\ApiResponseService;

class AdminResetPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email'                 => 'required|email|exists:admins,email',
            'token'                 => 'required|string',
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email is required',
            'email.email'    => 'Provide a valid email address',
            'email.exists'   => 'No admin found with this email',
            'token.required' => 'Reset token is required',

            'password.required' => 'New password is required',
            'password.min'      => 'Password must be at least 6 characters',
            'password.confirmed'=> 'Password confirmation does not match',

            'password_confirmation.required' => 'Confirm password is required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            ApiResponseService::error('Validation error', $validator->errors(), 422)
        );
    }
}
