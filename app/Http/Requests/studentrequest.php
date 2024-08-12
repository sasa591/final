<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class studentrequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'p_fname'=>'alpha',
            'p_lname'=>'alpha',
            'First_Name'=>'alpha',
            'Last_Name'=>'alpha',
            'University_id'=>'unique:users,code',

        ];
    }

    public function messages()
    {
        return [
            'password_old.same' => 'nooo',
            'p_fname'=>"Accepts letters Only",
            'p_lname'=>"Accepts letters Only",
            'University_id'=>'The University id already exists',

        ];
    }
}
