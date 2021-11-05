<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function attributes()
    {
        return [
            'name'  => 'Nombre',
            'price' => 'price',
            'store' => 'store',
            'myListId'  => 'myListId'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'  => 'required',
            'price' => 'price',
            'store' => 'store',
            'myListId'  => 'myListId'
        ];
    }
}
