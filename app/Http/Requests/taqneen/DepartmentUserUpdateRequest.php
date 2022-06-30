<?php

namespace App\Http\Requests\taqneen;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentUserUpdateRequest extends FormRequest
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
            'sub_department'=>'required|exists:ticket_departments,id',
            'user'=>'required|exists:users,id',
        ];
    }
}
