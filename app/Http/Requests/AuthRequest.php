<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'emailLogin' => 'required|email',
            'passwordLogin' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'emailLogin.required' => 'Vui lòng nhập email.',
            'emailLogin.email' => 'Địa chỉ email không hợp lệ. Ví dụ: qtnghia2002@gmail.com',
            'passwordLogin.required' => 'Vui lòng nhập mật khẩu.'
        ];
    }
}
