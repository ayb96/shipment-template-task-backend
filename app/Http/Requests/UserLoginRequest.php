<?php

namespace App\Http\Requests;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UserLoginRequest extends FormRequest
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
            
            'email'=>'required',
            'password'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'required'=> ':attribute must be provided',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = collect($validator->errors());
        $errors = $errors->collapse();


        $response = response()->json([
                'success' => false,
                'message' => 'Ops! Some errors occurred',
                'errors' => $errors
        ]);

        throw (new ValidationException($validator, $response));
    }
}
