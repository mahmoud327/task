<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Available attributes.
     *
     * @var string
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
            'email' => ['required', Rule::unique('users')->ignore($this->email, 'email')],
            'phone' => ['required', Rule::unique('users')->ignore($this->phone, 'phone')],
            'name' => ['required'],
            'password' => ['nullable', 'min:6'],
        ];
    }

    /**
     * Hash the user password against the bcrypt algorithm.
     *
     * @return $this|null
     */

}
