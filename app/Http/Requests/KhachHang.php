<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KhachHang extends FormRequest
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
            'sdt'=>['required','min:0','max:11'],
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Phải nhập tên khách hàng',
            'name.min' => 'Tên khách hàng ngắn quá vậy',
            'name.max' => 'Trời ơi tên khách hàng quá dài bồ ơi',
            'sdt.required' => 'Phải nhập số điện thoại nha',
            'sdt.min' => 'Số điện thoại ngắn quá vậy',
            'sdt.max' => 'Số điện thoại dài quá vậy',
           
        ];
    }

    public function attributes(){
        return [
            'name' => 'Tên khách hàng',
            'sdt'=> 'Số điện thoại '
           
        ];
    }
}
