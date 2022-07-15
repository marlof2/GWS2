<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class ProgramationRequest extends FormRequest
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
            'valor' => 'required',
            'situacao' => 'required',
            'garantia' => 'required',
            'data' => 'required',
            'hora' => 'required',
            'forma_pagamento_id' => 'required',
            'condominium_id' => 'required',
            'user_id' => 'required',
            'client_id' => 'required',
        ];
    }
    protected function failedValidation(Validator $validator)
    {

        throw new HttpResponseException(
            response()->json(['error' => $validator->errors(), 'tipo' => 'Validação de Campo'], Response::HTTP_NOT_ACCEPTABLE)
        );
    }
}
