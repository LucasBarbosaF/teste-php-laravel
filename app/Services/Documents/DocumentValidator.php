<?php
namespace App\Services\Documents;

use App\Exceptions\DocumentException;

class DocumentValidator
{
    public function validate($document): void
    {
        if (empty($document->categoria)) {
            throw new DocumentException("Categoria inválida");
        }

        if (empty($document->titulo)) {
            throw new DocumentException("Título inválido");
        }

        if (empty($document->conteúdo)) {
            throw new DocumentException("Conteúdo inválido");
        }
    }
}