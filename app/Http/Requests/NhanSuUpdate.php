<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NhanSuUpdate extends FormRequest
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
            'chucvu'=>['required','min:3','max:20'],
            'luong'=>['required','min:100000','max:100000000', 'integer']
        ];
    }

    public function messages() {
        return [
            'tennv.required' => 'Phải nhập họ tên nhân viên',
            'tennv.min' => 'Họ tên ngắn quá vậy',
            'tennv.max' => 'Trời ơi họ tên quá dài bồ ơi',
            'chucvu.required' => 'Phải nhập chức vụ nha',
            'chucvu.min' => 'Chức vụ ngắn quá vậy',
            'chucvu.max' => 'Chức vụ quá dài quá bồ ơi',
            'luong.required' => 'Phải nhập lương nhân viên nha',
            'luong.min' => 'Lương phải lớn hơn 100k',
            'luong.max' => 'Lương phải nhỏ hơn 1 tỷ',
            'luong.integer' => 'Lương phải là số',
        ];
    }

    public function attributes(){
        return [
            'name' => 'Tên nhân viên',
            'chucvu'=> 'Chức vụ',
            'luong'=> 'Lương',
        ];
    }
}
