<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsFormRequest extends FormRequest
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
            'name'              => 'required',
            'email'              => 'required',
            'telephone'              => 'required',
            'subject'              => 'required',
            'message'              => 'required',
//            'captcha'           => 'required|captcha'
        ];
    }

    /**
     * 提示信息s
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'     => trans('message.err_name'),
            'email.required' => trans('message.err_email'),
            'telephone.required' => trans('message.err_telephone'),
            'subject.required' => trans('message.err_subject'),
            'message.required' => trans('message.err_message'),
//            'captcha'           => trans('message.err_valid_code')
        ];
    }
}
