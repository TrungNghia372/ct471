<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeInterfaceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /** Kiểm tra xem yêu cầu có phải là đăng ký không */
    public function insertCustOfEmp(): bool 
    {
        return $this->has('fullName') && $this->has('date') && $this->has('gender') 
            && $this->has('email') && $this->has('phone') && $this->has('nationalId') 
            && $this->has('password1') && $this->has('password2');
    }

    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $customer_id = $this->route('customer_id'); 

        return [
            'fullName' => 'required',
            'date' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'nationalId' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('customer')->ignore($customer_id, 'customer_id'),
            ],
            'province' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'password1' => 'required',
            'password2' => 'required',
        ];            

    }

    public function messages(): array
    {
            return [
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
                'password1.required' => 'Vui lòng nhập mật khẩu',
                'password2.required' => 'Vui lòng nhập lại mật khẩu',
            ];
    }
}
