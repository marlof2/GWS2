<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $nameRoute = Route::currentRouteName();
        return [
            'email' => ['required', Rule::unique('users')->ignore($this->id)],
            'name' => ['required', Rule::unique('users')->ignore($this->id)],
            'password' => $nameRoute == 'users.update' ? '' : 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'E-mail já está cadastrado.',
            'name.unique' => 'Nome de usuário já está cadastrado.',
        ];
    }
    protected function failedValidation(Validator $validator)
    {

        throw new HttpResponseException(
            response()->json(['error' => $validator->errors(), 'tipo' => 'Validação de Campo'], Response::HTTP_NOT_ACCEPTABLE)
        );
    }
}
