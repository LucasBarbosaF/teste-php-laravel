<?php

namespace App\Services\Documents;

use App\Exceptions\DocumentException;
use App\Jobs\Documents\DocumentJob;
use Illuminate\Support\Facades\Storage;

class DocumentService
{
    protected $validator;

    public function __construct(DocumentValidator $validator)
    {
        $this->validator = $validator;
    }

    public function import($filePath): void
    {
        if (!Storage::disk('local')->exists($filePath)) {
            throw new DocumentException('Arquivo não encontrado.');
        }

        $data = json_decode(Storage::get($filePath));
        $documents = $data->documentos;

        foreach ($documents as $document) {
            $this->validator->validate($document);
            DocumentJob::dispatch($document);
        }
    }
}
