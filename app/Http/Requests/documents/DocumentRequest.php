<?php

namespace App\Http\Requests\documents;

use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
{
  
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'document' => [
                'required',
                'file', 
                'mimetypes:application/json',
                'max:2048',
            ],
        ];
    }

    /**
     * Customiza as mensagens de erro.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'document.required' => 'O arquivo é obrigatório.',
            'document.file' => 'O upload deve conter um arquivo válido.',
            'document.mimetypes' => 'O arquivo deve ser um JSON válido.',
            'document.max' => 'O arquivo não pode ser maior que 2 MB.',
        ];
    }
}
