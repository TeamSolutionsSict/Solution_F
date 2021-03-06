<?php

namespace App\Http\Requests;
use App\User;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username' => 'required|unique:tb_user,username|max:15',
            'fullname' => 'required|max:50',
            'email' => 'required|unique:tb_user,email|email',
            'phone' => 'required|unique:tb_user,phone|min:10|max:12|regex:/[0-9]+/',
            'password'=> 'required|min:6|max:20',
            'confirmpassword'=> 'required|same:password'
        ];
    }

    public function messages()
    {
//        return parent::messages(); // TODO: Change the autogenerated stub
        return[
            'required'=>':attribute Không Được Để Trống',
            'unique'=>':attribute Đã Tồn Tại',
            'max'=>':attribute Không Được Quá :max Ký Tự',
            'min'=>':attribute Không Được Ít Hơn :min Ký Tự',
            'email.email'=>'Email Không Đúng',
            'confirmpassword.same'=>'Mật Khẩu Không Khớp'

        ];
    }
}
