<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ViagemCreateRequest extends FormRequest
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
          'origem' => 'required',
          'destino' => 'required',
          'data' => 'required|date',
          'horaInicio' => 'required',
          'horaFim' => 'required',
        //   'user_id' => 'required',
          'tipo_id' => 'required',

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
       'origem.required' => 'Origem é necessaria',
       'destino.required' => 'Destino é necessario',
       'data.required' => 'Data de início é necessária',
       'horaInicio.required' => 'Hora de início é necessária',
       'horaFim.required' => 'Hora de fim é necessária',
    //    'user_id.required' => 'É necessário que a viagem tenha um utilizador associado',
       'tipo_id.required' => 'É necessário que a viagem tenha um tipo associado',
       'data.date' => 'Este campo é suposto ter uma data',
      //  'horaInicio.time' => 'Este campo é suposto ter uma hora',
      //  'horaFim.time' => 'Este campo é suposto ter uma hora',
     ];
    }
}
