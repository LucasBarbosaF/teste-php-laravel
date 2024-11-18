<?php

namespace App\Services\Documents;

use App\Exceptions\DocumentException;
use App\Jobs\Documents\DocumentJob;

class DocumentService
{
    public function import($filePath)
    {
        if (!file_exists($filePath)) {
            throw new DocumentException('Arquivo não encontrado.');
        }

        $data = json_decode(file_get_contents($filePath), true);

        if (!$data || !is_array($data)) {
            throw new DocumentException('O arquivo JSON está vazio ou inválido.');
        }

        foreach ($data['documentos'] as $record) {
            DocumentJob::dispatch($record);
        }
    }
}
