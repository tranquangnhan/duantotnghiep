<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Lich extends FormRequest
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
            'soluongkh' => ['required','min:1','max:150'],
        ];
    }

    public function messages() {
        return [
            'soluongkh.required' => 'Chưa nhập số khách hàng',
            'soluongkh.min' => 'Khách hàng phải lớn hơn 1',
            'soluongkh.max' => 'Khách hàng tối đa 150',
        ];
    }

    public function attributes(){
        return [
            'soluongkh' => 'Số lượng khách hàng',
        ];
    }
}
