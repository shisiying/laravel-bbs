<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name'=>'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,'.Auth::id(),
            'email'=>'required|email',
            'introduction'=>'max:80',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '用户名不能为空。',
            'name.between'  => '用户名必须介于 3 - 25 个字符之间。',
            'name.unique' => '用户名已被占用，请重新填写',
            'name.regex' => '用 户名只支持英文，数字，横杆和下划线',
        ];
    }
}
