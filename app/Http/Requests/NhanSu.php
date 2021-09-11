<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NhanSu extends FormRequest
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
     * @return array
     */
    public function rules() {
        return [
            'tennv' => ['required','min:3','max:25'],
            'email'=>['required','min:3','email'],
            'password'=>['required','min:5','max:25'],
            'luong'=>['required','min:100000','max:100000000', 'integer'],
            'urlAnh'=>['required'],
            'idcv'=>['required']
        ];
    }

    public function messages() {
        return [
            'tennv.required' => 'Phải nhập họ tên nhân viên',
            'tennv.min' => 'Họ tên ngắn quá vậy',
            'tennv.max' => 'Trời ơi họ tên quá dài bồ ơi',
            'email.required'  => 'Bạn phải nhập email',
            'email.min' => 'Email ngắn quá vậy',
            'email.max' => 'Email dài quá vậy',
            'email.email' => 'Bạn phải nhập đúng định dạng email',
            'password.min' => 'Mật khẩu ngắn quá vậy',
            'password.max' => 'Mật khẩu dài quá bồ ơi',
            'luong.required' => 'Phải nhập lương nhân viên nha',
            'luong.min' => 'Lương phải lớn hơn 100k',
            'luong.max' => 'Lương phải nhỏ hơn 1 tỷ',
            'luong.integer' => 'Lương phải là số',
            'urlAnh.required' => 'Phải tải hình nhân viên nha',
            'idcv.required' => 'Phải chọn chức vụ',
        ];
    }

    public function attributes(){
        return [
            'name' => 'Tên nhân viên',
            'email'=> 'Email ',
            'password'=> 'Mật khẩu',
            'luong'=> 'Lương',
            'urlAnh'=> 'Ảnh',
            'idcv' => 'id chức vụ'
        ];
    }
}
