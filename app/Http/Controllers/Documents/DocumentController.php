<?php

namespace App\Http\Controllers\Documents;

use App\Exceptions\DocumentException;
use App\Http\Controllers\Controller;
use App\Http\Requests\documents\DocumentRequest;
use App\Models\Documents\DocumentModel;
use App\Services\Documents\DocumentService;
use App\Services\Documents\FileStorageService;
use Illuminate\Support\Facades\Artisan;

class DocumentController extends Controller
{

    protected $importService;
    protected $fileStorageService;

    public function __construct(DocumentService $importService, FileStorageService  $fileStorageService)
    {
        $this->importService = $importService;
        $this->fileStorageService = $fileStorageService;
    }

    
    public function index()
    {
        return view('documents.index', [
            'title' => 'Processar documento'
        ]);
    }

    public function importDocument(DocumentRequest $request)
    {
        try {
            $filePath = $this->fileStorageService->storeFile($request);
            $this->importService->import($filePath);
            return back()->with('success', 'Os registros foram adicionados à fila de importação.');            
        } catch (DocumentException $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function processDocument()
    {
        $jobs = \DB::table('jobs')->get();
        if($jobs->count() > 0) {
            Artisan::call('queue:work', [
                '--stop-when-empty' => true,
            ]);
            return back()->with('success', 'Os registros foram processados com sucesso.');
        }

        return back()->with('error', 'Nenhum registro para processar.');
    }
}
