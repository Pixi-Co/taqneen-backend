<?php

namespace App\Http\Requests\taqneen;

use Illuminate\Foundation\Http\FormRequest;

class TicketDepartmentRequest extends FormRequest
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
            'department_titles.*'=>'required',
            'titles_priorities.*'=>'required|exists:ticket_priorities,id',
            'users.*'=>'required|exists:users,id',
        ];
    }

    public function messages()
    {
        return
            [
                "name.required"=>"the :attribute is required",
                "department_titles.*.required"=>"the :attribute is required",
                "titles_priorities.*.required"=>"the :attribute is required",
                "users.*.required"=>"the :attribute is required",

            ];
    }
}
