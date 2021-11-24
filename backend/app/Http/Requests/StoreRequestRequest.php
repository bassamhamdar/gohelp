<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreRequestRequest extends FormRequest
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
                'user_id'=>['required'],
                'org_id'=>['required'],
                'title'=>['required'],
                'description'=>['required'],
                'image'=>[''],

            ];

    }

    public function messages()
    {       

        return [
            'required'=> ':attribute must be provided',
            'name.min'=> 'Name must be more than 6',
            'password.regex'=>'Password should contain at least one Uppercase, one Lowercase, one Numeric and one special character',
            'unique'=>':attribute already exists'
            
        ];
    }
    public function attributes()
    { 
        return [
            'org_id'=>'Organization',
            'user_id'=>'User',
            'title' => 'Title field',
            'description' => 'description field',
            'country' => 'Country field',
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
