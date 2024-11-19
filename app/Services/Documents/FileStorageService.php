<?php

namespace App\Services\Documents;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileStorageService
{
    public function storeFile(Request $request, $directory = 'data/documents'): string
    {
        $file = $request->file('document');
        $newFileName = 'document_' . time() . '.' . $file->getClientOriginalExtension();
        return $file->storeAs($directory, $newFileName);
    }
}