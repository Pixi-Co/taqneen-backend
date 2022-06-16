<?php

namespace App\Http\Requests\taqneen;

use Illuminate\Foundation\Http\FormRequest;

class TicketStatusRequest extends FormRequest
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
            'name'=>'required|string',
            'is_send_mail'=>'sometimes|required',
            'description'=>'required_if:is_send_mail,on',
        ];
    }


    public function messages()
    {
        return [
            "description.required_if"=>"description field is required if send mail checked"
        ];
    }
}
