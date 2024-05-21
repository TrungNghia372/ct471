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
            //Đăng nhập
            'emailLogin' => 'required|email',
            'passwordLogin' => 'required',
            //Đăng ký
            'fullName' => 'required',
            'date' => 'required',
            'gender' => 'required',
            'emailRegister' => 'required|email',
            'passwordRegister1' => 'required',
            'passwordRegister2' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            //Đăng nhập
            'emailLogin.required' => 'Vui lòng nhập email.',
            'emailLogin.email' => 'Địa chỉ email không hợp lệ. Ví dụ: qtnghia2002@gmail.com',
            'passwordLogin.required' => 'Vui lòng nhập mật khẩu.',
            //Đăng ký
            'fullName.required' => 'Vui lòng nhập họ và tên',
            'date.required' => 'Vui lòng nhập ngày sinh',
            'gender.required' => 'Vui lòng nhập giới tính',
            'emailRegister.required' => 'Vui lòng nhập email',
            'emailRegister.email' => 'Địa chỉ email không hợp lệ. Ví dụ: qtnghia2002@gmail.com',
            'passwordRegister1.required' => 'Vui lòng nhập mật khẩu',
            'passwordRegister2.required' => 'Vui lòng nhập lại mật khẩu',
        ];
    }
}
