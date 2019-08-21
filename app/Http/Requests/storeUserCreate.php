<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class storeUserCreate
 * @package App\Http\Requests
 */
class storeUserCreate extends FormRequest
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
            'name' => 'required',
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
}
