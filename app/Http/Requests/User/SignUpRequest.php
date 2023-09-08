<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends BaseApiRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name'    => ['required', 'string'],
            'last_name'     => ['required', 'string'],
            'email'         => ['required', 'email', 'unique:users,email'],
            'password'      => ['required', 'string', 'confirmed', 'min: 8'],
            'mobile_number' => ['required', 'string', 'between:8,15', 'unique:users,mobile_number'],
            'birthday'      => ['required', 'date'],
            'user_photo'    => ['file', 'mimes: jpeg,jpg,png'],
            'wallet_value'  => ['required', 'numeric']
        ];
    }
}
