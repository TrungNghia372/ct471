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

    /** Kiểm tra xem yêu cầu có phải là đăng nhập không */
    public function isLoginRequest(): bool 
    {
        return $this->has('emailLogin') && $this->has('passwordLogin');
    }

    /** Kiểm tra xem yêu cầu có phải là đăng ký không */
    public function isRegisterRequest(): bool 
    {
        return $this->has('fullName') && $this->has('date') && $this->has('gender') 
            && $this->has('email') 
            && $this->has('passwordRegister1') && $this->has('passwordRegister2');
    }

    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->isLoginRequest()) {
            return [
                //Đăng nhập
                'emailLogin' => 'required|email',
                'passwordLogin' => 'required',
            ];
        }
        if ($this->isRegisterRequest()) {
            return [
                //Đăng ký
                'fullName' => 'required',
                'date' => 'required',
                'gender' => 'required',
                'phone' => 'required',
                'nationalId' => 'required',
                'email' => 'required|email|unique:customer',
                'province' => 'required',
                'district' => 'required',
                'ward' => 'required',
                'passwordRegister1' => 'required',
                'passwordRegister2' => 'required',
            ];            
        }

    }

    public function messages(): array
    {
        if ($this->isLoginRequest()) {
            return [
                //Đăng nhập
                'emailLogin.required' => 'Vui lòng nhập email.',
                'emailLogin.email' => 'Địa chỉ email không hợp lệ. Ví dụ: qtnghia2002@gmail.com',
                'passwordLogin.required' => 'Vui lòng nhập mật khẩu.',
            ];
        }

        if ($this->isRegisterRequest()) {
            return [
                //Đăng ký
                'fullName.required' => 'Vui lòng nhập họ và tên',
                'date.required' => 'Vui lòng nhập ngày sinh',
                'gender.required' => 'Vui lòng nhập giới tính',
                'phone.required' => 'Vui lòng nhập số điện thoại liên hệ',
                'nationalId.required' => 'Vui lòng nhập số CCCD',
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Địa chỉ email không hợp lệ. Ví dụ: qtnghia2002@gmail.com',
                'email.unique' => 'Địa chỉ email đã tồn tại',
                'province.required' => 'Vui lòng nhập thông Tỉnh/Thành phố.',
                'district.required' => 'Vui lòng nhập thông Quận/Huyện.',
                'ward.required' => 'Vui lòng nhập thông Xã/Phường.',
                'passwordRegister1.required' => 'Vui lòng nhập mật khẩu',
                'passwordRegister2.required' => 'Vui lòng nhập lại mật khẩu',
            ];
        }
    }
}
