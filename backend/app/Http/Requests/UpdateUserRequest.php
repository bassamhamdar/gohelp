<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            $email = $this->request->get("email");
            return [

                'firstname'=>['max:255'],
                'lastname'=>['max:255'],
                'email'=>[Rule::unique('users')->ignore($email,'email')],
                'password'=>['min:6', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'],                
                'phone'=>[''],
                'address'=>[''],
                'idCard'=>[''],

            ];

    }

    public function messages()
    {       

        return [
            'required'=> ':attribute must be provided',
            'name.min'=> 'Name must be more than 6',
            'password.regex'=>'Password should contain upper & lower case, numeric & character',
            'unique'=>':attribute already exists'
        ];
    }
    public function attributes()
    { 
        return [
            'firstname' => 'first name',
            'lastname' => 'last name',
            'phone' => 'phone number',
            'idCard'=>'ID Card number',
        ];
    }
    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {

            $errors = collect( $validator->errors());
            $errors = $errors->collapse();

            $response = response()->json([
                "status"=>400,
                'success' => false,
                'message' => 'Ops! Some errors occurred',
                'errors' => $errors
            ]);


        throw (new ValidationException($validator, $response));
    }

}
