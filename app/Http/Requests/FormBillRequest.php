<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormBillRequest extends FormRequest
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

    public function attributes()
    {
        return [
            'name' => 'Nombre(s)',
            'lastname' => 'Apellido(s)',
            'city' => 'Ciudad',
            'store' => 'Tienda', 
            'article' => 'Articulo',
            'quantity' => 'Cantidad',       
        ];
    }

    public function rules()
    {
        $id = ( ($this->getMethod() === 'PUT') ? $this->bill->id : null);

        return [

            'name' => 'required',
            'lastname' => 'required',
            'city' => 'required',
            'store' => 'required', 
            'article' => 'required',
            'quantity' => 'required',  

        ];
    }
}
