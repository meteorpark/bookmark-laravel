<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class loginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'join_type' => 'required|in:kakao,facebook,google',
            'sns_id' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'join_type.required' => '허용 가능한 접근은 kakao, facebook, google 입니다.',
        ];
    }

    public function failedValidation(Validator $validator)
    {

        $json = [
            'status' => 'input_error',
            'errors' => $validator->errors()
        ];
        $response = new JsonResponse($json, 400);
        throw (new ValidationException($validator, $response))->status(400);
    }
}
