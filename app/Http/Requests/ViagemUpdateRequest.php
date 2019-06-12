<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ViagemUpdateRequest extends FormRequest
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
            'estado' => 'required',
        ];
    }

    protected function failedValidation(Validator $validator){
     throw new HttpResponseException(
       response()->json([
         'status' => 1,
         'data' => $validator->errors()->all(),
         'msg' => 'Erro de validação'
       ], 422)
     );
       // throw new \Error('erro que eu estou a dizer');
    }

    public function messages(){
     return[
       'estado.required' => 'Estado é necessário, se isto aparece há um problema'
     ];
    }
}
