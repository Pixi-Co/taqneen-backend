<?php

namespace App\Http\Requests\taqneen;

use App\Enum\UserType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TicketRequest extends FormRequest
{

    public $user ;
    public function __construct()
    {
        $this->user = auth()->user();
    }

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
            'computer_num'=>[
                Rule::requiredIf(function (){
                    return (is_null($this->user) or $this->user->user_type==UserType::$USERCUSTOMER) ;
                }),
            ],
            'client_name'=>[
                Rule::requiredIf(function (){
                    return (is_null($this->user) or $this->user->user_type==UserType::$USERCUSTOMER) ;

                }),
            ],
            'client_email'=>[
                Rule::requiredIf(function (){
                    return (is_null($this->user) or $this->user->user_type==UserType::$USERCUSTOMER) ;

                }),
            ],
            'agent_id'=>[
                Rule::requiredIf(function (){
                    return (isset($this->user) && $this->user->user_type ==UserType::$USER);

                })
            ],
            'sub_department'=>'required|integer',
            'description'=>'required',
            'file'=>'nullable|file|mimes:ppt,pptx,doc,docx,pdf,xls,xlsx,jpg,png,gif,jpeg,|max:204800',
        ];
    }


    public function messages()
    {
        return [
            "description"=>"description field is required"
        ];
    }
}
