<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Dichvu extends FormRequest
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
            'name' => ['required','min:3','max:55'],
            'content'=>['required','min:3'],
            'mota'=>['required','min:3','max:100000000'],
            'gia'=>['required','min:100000','max:10000000', 'integer'],
            'urlHinh'=>['required']
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Phải nhập dịch vụ',
            'name.min' => 'Dịch vụ ngắn quá vậy',
            'name.max' => 'Trời ơi dịch vụ quá dài bồ ơi',
            'content.required' => 'Phải nhập nội dung nha',
            'content.min' => 'Nội dung ngắn quá vậy',
            'mota.required' => 'Phải nhập mô tả nha',
            'mota.min' => 'Mô tả ngắn quá vậy',
            'mota.max' => 'Mô tả dài quá bồ ơi',
            'gia.required' => 'Phải nhập giá dịch vụ nha',
            'gia.min' => 'Giá phải lớn hơn 100k',
            'gia.max' => 'Giá phải nhỏ hơn 10 triệu',
            'gia.integer' => 'Giá phải là số',
            'urlHinh.required' => 'Phải tải hình dịch vụ nha',
        ];
    }

    public function attributes(){
        return [
            'name' => 'Tên dịch vụ',
            'content'=> 'Nội dung ',
            'mota'=> 'Mô tả',
            'gia'=> 'gia',
            'urlHinh'=> 'Ảnh '
        ];
    }
}
