<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProdutoCreateRequest extends FormRequest
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
        'altura' => 'required',
        'comprimento' => 'required',
        'largura' => 'required',
        'nome' => 'required|max:50',
        'foto' => 'nullable',
        'viagems_id' => 'required',
        // 'user_id' => 'required',
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
       'altura.required' => 'Altura é necessario',
       'comprimento.required' => 'Comprimento é necessario',
       'largura.required' => 'Largura é necessario',
       'nome.required' => 'Nome é necessario',
       'nome.max' => 'O nome do produto é demasiado comprido',
       'viagems_id.required' => 'É preciso associar a uma viagem',
    //    'user_id.required' => 'É preciso associar a um utilizador',
     ];
    }
}
