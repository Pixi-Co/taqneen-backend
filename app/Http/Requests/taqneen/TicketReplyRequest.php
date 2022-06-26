<?php

namespace App\Http\Requests\taqneen;

use App\Enum\UserType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TicketReplyRequest extends FormRequest
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
            'reply'=>'required|string',
            'status_id'=>[
                'nullable',Rule::requiredIf(function (){
                    $this->user->customer_type = UserType::$USERCUSTOMER;
                })
            ],
            'ticket_id'=>'required',
            'file'=>'nullable|array|min:1',
            'file.*'=>'file|mimes:ppt,pptx,doc,docx,pdf,xls,xlsx,jpg,png,gif,jpeg,|max:204800',
        ];
    }
}
