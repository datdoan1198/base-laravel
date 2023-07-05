<?php

namespace App\Http\Requests\Employee;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'      => 'required',
            'email'     => 'required|email|unique:admins',
            'password'  => 'required|min:6',
//            'phone'     => ['required','unique:admins','digits:10','regex:/(84|0[3|5|7|8|9])+([0-9]{8})\b/'],
        ];
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'required'  => ':attribute không được để trống',
            'email'     => ':attribute sai định dạng',
            'unique'    => ':attribute đã tồn tại.',
            'digits'    => ':attribute sai định dạng',
            'regex'     => ':attribute sai định dạng',
            'min'       => ':attribute ít nhất phải 6 ký tự trở lên',
            'file'      => ':attribute sai định dạng',
            'mimes'     => ':attribute chỉ được hỗ trợ kiểu jpg,jpeg,png',
            'max'       => ':attribute có kích thước quá lớn',
            'array'     => ':attribute sai định dạng',
            'exists'    => ':attribute không tồn tại',
            'in'        => ':attribute không tồn tại',
        ];
    }

    /**
     * @return string[]
     */
    public function attributes()
    {
        return [
            'name'      => 'Tên nhân viên',
            'email'     => 'Email',
            'phone'     => 'Số điện thoại',
            'password'  => 'Mật khẩu',
        ];
    }
}
