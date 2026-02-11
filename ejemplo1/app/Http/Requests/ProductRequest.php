<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $isUpdate = $this->isMethod('put') || $this->isMethod('patch');
        return [
            'name' => $isUpdate ? 'sometimes|string|max:255' : 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => $isUpdate ? 'sometimes|numeric|min:0' : 'required|numeric|min:0',
            'stock' => $isUpdate ? 'sometimes|integer|min:0' : 'required|integer|min:0',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del producto es obligatorio.',
            'name.string' => 'El nombre del producto debe ser una cadena de texto.',
            'name.max' => 'El nombre del producto no puede exceder los 255 caracteres.',
            'description.string' => 'La descripción del producto debe ser una cadena de texto.',
            'price.required' => 'El precio del producto es obligatorio.',
            'price.numeric' => 'El precio del producto debe ser un número.',
            'price.min' => 'El precio del producto no puede ser negativo.',
            'stock.required' => 'La cantidad en stock es obligatorio.',
            'stock.integer' => 'La cantidad en stock debe ser un número entero.',
            'stock.min' => 'La cantidad en stock no puede ser negativo.',
        ];
    }
}
